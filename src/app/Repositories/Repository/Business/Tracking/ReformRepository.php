<?php

namespace App\Repositories\Repository\Business\Tracking;

use App\Models\Business\Certification;
use App\Models\Business\Planning\FiscalYear;
use App\Models\Business\Tracking\Operation;
use App\Models\Business\Tracking\OperationDetail;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use stdClass;
use Throwable;

/**
 * Clase ReformRepository
 * @package App\Repositories\Repository\Business\Tracking
 */
class ReformRepository
{
    const OPERATION_STATE_APPROVED = 'APROBADO';
    const OPERATION_STATE_SQUARE = 'CUADRADO';
    const OPERATION_STATE_DRAFT = 'DIGITADO';
    const OPERATION_STATE_APPROVED_3 = 3;
    const OPERATION_STATE_SQUARE_2 = 2;
    const OPERATION_STATE_DRAFT_1 = 1;

    const REFORMS_TYPE_TRANSFER = 'TRASPASO';
    const REFORMS_TYPE_INCREASE = 'INCREMENTO';
    const REFORMS_TYPE_DECREASE = 'DISMINUCIÓN';
    const REFORMS_TYPE_TRANSFER_0 = 0;
    const REFORMS_TYPE_INCREASE_1 = 1;
    const REFORMS_TYPE_DECREASE_2 = 2;

    const BUDGET_ITEM_INCOME = 2;
    const BUDGET_ITEM_EXPENSE = 1;

    const MOV_REFORM_TYPE = 'RE';
    const MOV_CERTIFICATION_TYPE = 'CE';

    /**
     * Buscar operaciones por tipo y año fiscal
     *
     * @param int $year
     * @param string $type
     * @param string $company_code
     * @param array $data
     *
     * @return Collection
     */
    public function getOperationByTypeAndYear(int $year, string $type, string $company_code, array $data)
    {
        $params = [
            'year' => $year,
            'type' => $type,
            'company_code' => $company_code,
            'state_approved' => self::OPERATION_STATE_APPROVED,
            'state_square' => self::OPERATION_STATE_SQUARE,
            'state_draft' => self::OPERATION_STATE_DRAFT,
            'transfer' => self::REFORMS_TYPE_TRANSFER,
            'increase' => self::REFORMS_TYPE_INCREASE,
            'decrease' => self::REFORMS_TYPE_DECREASE
        ];
        $select = "select trim(b.codemp) as company_code,
                           b.anio as year,
                           b.sig_tip as operation_type,
                           b.acu_tip as operation_number,
                           b.des_cab as description,
                           b.tot_cre as total_credit,
                           b.tot_deb as total_debit,
                           b.fec_apr as approved_date,
                           case
                               when b.incremen = 0 then :transfer
                               when b.incremen = 1 then :increase
                               when b.incremen = 2 then :decrease
                               else '' end as type,
                           case
                               when b.estado = 3 then :state_approved
                               when b.estado = 2 then :state_square
                               when b.estado = 1 then :state_draft
                               else '' end as state,
                           row_number() over (order by b.acu_tip) as id
                    from prcabmov b ";

        $conditions = " where b.codemp = :company_code and b.anio = :year  and b.sig_tip = :type ";

        if (isset($data['filters']) and count($data['filters'])) {
            if ($data['filters']['date_from'] and $data['filters']['date_to']) {
                $conditions .= " and b.fec_apr >= :date_from";
                $conditions .= " and b.fec_apr <= :date_to";
                $params['date_from'] = $data['filters']['date_from'];
                $params['date_to'] = $data['filters']['date_to'];
            } elseif ($data['filters']['date_from']) {
                $conditions .= " and b.fec_apr >= :date_from";
                $params['date_from'] = $data['filters']['date_from'];
            } elseif ($data['filters']['date_to']) {
                $conditions .= " and b.fec_apr <= :date_to";
                $params['date_to'] = $data['filters']['date_to'];
            }
        }

        $order = " order by operation_number desc;";

        return collect(DB::connection('pgsql')->select($select . $conditions . $order, $params));
    }

    /**
     * Buscar una reforma
     *
     * @param string $companyCode
     * @param int $year
     * @param string $operationType
     * @param int $operationNumber
     * @param bool $withBalance
     *
     * @return stdClass
     * @throws Exception
     */
    public function findReform(string $companyCode, int $year, string $operationType, int $operationNumber, bool $withBalance = false)
    {
        $query = "select trim(codemp) as codemp,
                         anio,
                         sig_tip,
                         acu_tip,
                         des_cab,
                         tot_cre,
                         tot_deb,
                         fec_asi,
                         fec_apr,
                         incremen,
                         estado,
                         fec_cre,
                         cre_por,
                         case
                               when estado = 3 then :state_approved
                               when estado = 2 then :state_square
                               when estado = 1 then :state_draft
                               else '' end as state,
                           case
                               when incremen = 0 then :transfer
                               when incremen = 1 then :increase
                               when incremen = 2 then :decrease
                               else '' end as type,
                         row_number() over (order by acu_tip) as id
                    from prcabmov 
                    where codemp = :company_code
                      and anio = :year
                      and sig_tip = :type 
                      and acu_tip = :operation_number;";

        $result = DB::connection('pgsql')->select($query, [
            'year' => $year,
            'type' => $operationType,
            'company_code' => $companyCode,
            'operation_number' => $operationNumber,
            'state_approved' => self::OPERATION_STATE_APPROVED,
            'state_square' => self::OPERATION_STATE_SQUARE,
            'state_draft' => self::OPERATION_STATE_DRAFT,
            'transfer' => self::REFORMS_TYPE_TRANSFER,
            'increase' => self::REFORMS_TYPE_INCREASE,
            'decrease' => self::REFORMS_TYPE_DECREASE
        ]);

        if (!isset($result[0])) {
            throw new Exception();
        } else {
            $reform = $result[0];
        }

        // find reform details
        $reform->details = self::findReformDetails($companyCode, $year, $operationType, $operationNumber, $withBalance);

        return $reform;
    }

    /**
     * Buscar detalles de una operación
     *
     * @param string $companyCode
     * @param int $year
     * @param string $operationType
     * @param int $operationNumber
     * @param bool $withBalance
     *
     * @return Collection
     */
    public function findReformDetails(string $companyCode, int $year, string $operationType, int $operationNumber, bool $withBalance = false)
    {
        $state_approved = self::OPERATION_STATE_APPROVED_3;
        $queryBalance = $withBalance ? "(select COALESCE(round(cast((sum(case
                                 when det.sig_tip = 'PR'
                                     then (case when det.asociac = 1 then det.val_cre else det.val_deb end)
                                 else 0 end) +
                         sum(case
                                 when det.sig_tip = 'RE' then case
                                                                  when det.val_cre < 0 then det.val_deb + det.val_cre
                                                                  else det.val_deb - det.val_cre end
                                 else 0 end)) -
                        (sum((case when det.sig_tip IN ('CO') and mov.comprom = 0 then det.val_cre else 0 end) + ((case
                                                                                                                       when det.sig_tip NOT IN ('PR', 'RE', 'CO', 'CE') and mov.comprom = 0
                                                                                                                           then det.val_cre - det.val_deb
                                                                                                                       else 0 end))) +
                         (sum((case when det.sig_tip IN ('CE') then det.val_cert else 0 end)) - sum((case
                                                                                                     when det.sig_tip IN ('CE') and det.val_cert = det.val_cre
                                                                                                         then 0
                                                                                                     else case
                                                                                                              when det.sig_tip IN ('CE') and det.val_cert <> det.val_cre
                                                                                                                  then det.val_cert - det.val_cre
                                                                                                              else 0 end end))))
                        as numeric(14, 2)), 2), 0)
               from prdetmov det
                         left join prcabmov mov on det.codemp = mov.codemp and det.anio = mov.anio and det.sig_tip = mov.sig_tip and det.acu_tip = mov.acu_tip
               where det.codemp = :company_code
                  and det.anio = :year
                  and mov.estado = {$state_approved}
                  and det.cuenta = a.cuenta) as balance, " : '';

        $query = "select trim(a.cuenta) as cuenta,
                           p.nom_cue,
                           a.val_deb,
                           a.val_cre,
                           a.sec_det,
                           trim(a.codemp) as codemp,
                           a.anio,
                           a.sig_tip,
                           a.acu_tip,
                           a.asociac, {$queryBalance}
                           row_number() over (order by a.sec_det) as id
                    from prdetmov a
                             inner join prplacta p on a.codemp = p.codemp and a.anio = p.anio and a.cuenta = p.cuenta and a.asociac = p.identifi
                    where a.codemp = :company_code
                      and a.anio = :year
                      and a.sig_tip = :type
                      and a.acu_tip = :operation_number;";

        return collect(DB::connection('pgsql')->select($query, [
            'year' => $year,
            'type' => $operationType,
            'company_code' => $companyCode,
            'operation_number' => $operationNumber
        ]));
    }

    /**
     * Buscar partidas presupuestarias
     *
     * @param int $year
     * @param string $companyCode
     * @param array $data
     *
     * @return Collection
     */
    public function findAllBudgetItems(int $year, string $companyCode, array $data)
    {
        $params = [
            'year' => $year,
            'company_code' => $companyCode
        ];

        $select = "select pp.codemp,
                   pp.anio,
                   trim(pp.cuenta) as cuenta,
                   pp.identifi,
                   pp.nom_cue,
                   case when pp.identifi = 2 
                        then (select parent.nom_cue from prplacta parent where parent.cuenta = pp.cuenta_p and parent.codemp = :company_code and parent.anio = :year)
                        else '' end as cuenta_p,
                   case
                       when pp.cuenta not in(select det.cuenta
                                       from prdetmov det
                                                inner join prcabmov mov on det.codemp = mov.codemp and det.anio = mov.anio and det.sig_tip = mov.sig_tip and det.acu_tip = mov.acu_tip
                                       where mov.codemp = :company_code
                                         and mov.anio = :year
                                         and mov.estado = 3
                                         and det.asociac = :type
                                         and mov.sig_tip = 'PR') then true
                       else false end                                                                                                              as is_new,
                   sum(case when det.sig_tip = 'PR' then (case when det.asociac = 1 then det.val_cre else det.val_deb end) else 0 end)             as assigned,
                   sum(case when det.sig_tip = 'RE' then case when val_cre < 0 then det.val_deb + det.val_cre else det.val_deb - det.val_cre end else 0 end) as reform,
                   COALESCE(round(cast((sum(case
                                 when det.sig_tip = 'PR'
                                     then (case when det.asociac = 1 then det.val_cre else det.val_deb end)
                                 else 0 end) +
                         sum(case
                                 when det.sig_tip = 'RE' then case
                                                                  when det.val_cre < 0 then det.val_deb + det.val_cre
                                                                  else det.val_deb - det.val_cre end
                                 else 0 end)) -
                        (sum((case when det.sig_tip IN ('CO') and mov.comprom = 0 then det.val_cre else 0 end) + ((case
                                                                                                                       when det.sig_tip NOT IN ('PR', 'RE', 'CO', 'CE') and mov.comprom = 0
                                                                                                                           then det.val_cre - det.val_deb
                                                                                                                       else 0 end))) +
                         (sum((case when det.sig_tip IN ('CE') then det.val_cert else 0 end)) - sum((case
                                                                                                     when det.sig_tip IN ('CE') and det.val_cert = det.val_cre
                                                                                                         then 0
                                                                                                     else case
                                                                                                              when det.sig_tip IN ('CE') and det.val_cert <> det.val_cre
                                                                                                                  then det.val_cert - det.val_cre
                                                                                                              else 0 end end))))
                        as numeric(14, 2)), 2), 0)                  as balance ";

        $from = "from prdetmov det
         inner join prcabmov mov on det.codemp = mov.codemp and det.anio = mov.anio and mov.estado = 3
         right join prplacta pp on det.codemp = mov.codemp and det.anio = mov.anio and det.sig_tip = mov.sig_tip and
                                   det.acu_tip = mov.acu_tip and pp.cuenta = det.cuenta  and det.anio = :year and mov.anio = :year";

        // 'S' Last level, '3' Approved
        $conditions = " where pp.codemp = :company_code and pp.anio = :year and pp.ult_cue = 'S' ";

        if (isset($data['filters']) and count($data['filters'])) {
            if ($data['filters']['budget_item_type']) {
                $conditions .= " and pp.identifi = :type";
                $params['type'] = $data['filters']['budget_item_type'];

                // '1' expense budget item
                if ($data['filters']['budget_item_type'] == '1') {
                    if ($data['filters']['executing_unit'] and $data['filters']['project'] and $data['filters']['activity']) {
                        $conditions .= " and pp.cuenta LIKE '___' || :project_code || '.' || :unit_code || '.' || :activity_code || '%'";
                        $params['activity_code'] = $data['filters']['activity'];
                        $params['project_code'] = $data['filters']['project'];
                        $params['unit_code'] = $data['filters']['executing_unit'];
                    } elseif ($data['filters']['executing_unit'] and $data['filters']['project']) {
                        $conditions .= " and pp.cuenta LIKE '___' || :project_code || '.' || :unit_code || '%'";
                        $params['project_code'] = $data['filters']['project'];
                        $params['unit_code'] = $data['filters']['executing_unit'];
                    } elseif ($data['filters']['executing_unit']) {
                        $conditions .= " and substring(pp.cuenta, 14, 3) = :unit_code";
                        $params['unit_code'] = $data['filters']['executing_unit'];
                    }
                }
            }
        }

        $orderGroup = " group by 1, 2, 3, 4, 5, 6, 7 order by 3";

        return collect(DB::connection('pgsql')->select($select . $from . $conditions . $orderGroup, $params));
    }

    /**
     * Crea reforma presupuestaria
     *
     * @param FiscalYear $fiscalYear
     * @param string $companyCode
     * @param string $userCode
     *
     * @return array
     * @throws Throwable
     */
    public function createReform(FiscalYear $fiscalYear, string $companyCode, string $userCode)
    {

        $reform = [];
        DB::connection('pgsql')->transaction(function () use (&$reform, $userCode, $companyCode, $fiscalYear) {

            $query = "UPDATE cotipcom
                      SET acu_tip = acu_tip + 1
                      WHERE codemp = :company_code and anio = :year and sig_tip = :sig_tip 
                      RETURNING acu_tip;";

            $acu_tip = DB::connection('pgsql')->select($query, [
                'company_code' => $companyCode,
                'year' => $fiscalYear->year,
                'sig_tip' => self::MOV_REFORM_TYPE
            ]);

            if (!isset($acu_tip[0])) {
                throw new Exception(trans('reforms.messages.exceptions.reform_type_not_fount'));
            }

            $currentDate = now()->format('Y-m-d');
            $period = now()->month;
            $sig_tip = self::MOV_REFORM_TYPE;
            $state = self::OPERATION_STATE_SQUARE_2;
            $query = "insert into prcabmov (codemp, anio, sig_tip, acu_tip, ucodemp, uanio, num_com, des_cab, tot_deb, tot_cre, totinid, totinic, fec_asi, fec_apr, cre_por, fec_cre, estado, 
                                            periodo, nropagos, pagosre, incremen, comprom, acu_tip1, estadono, liquida, departam, solicita, tipopro, retfte, retiva, pagado, 
                                            recaudad, acu_tipce) 
                                            values ";
            $query .= "('$companyCode', 
            $fiscalYear->year, 
            '$sig_tip', 
            {$acu_tip[0]->acu_tip}, 
            '$companyCode', 
            $fiscalYear->year, 
            '', '', 0, 0, 0, 0, 
            '$currentDate', 
            '$currentDate', 
            '$userCode', 
            '$currentDate', {$state}, 
            $period, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0) RETURNING *;";
            $reform = DB::connection('pgsql')->select($query);

            Operation::firstOrCreate(
                [
                    'company_code' => $companyCode,
                    'year' => $fiscalYear->year,
                    'voucher_type' => $sig_tip,
                    'number' => $acu_tip[0]->acu_tip,
                    'description' => '',
                    'total_debit' => 0,
                    'total_credit' => 0,
                    'created_by' => $userCode,
                    'status' => $state,
                    'period' => $period,
                    'date_assignment' => Carbon::now(),
                    'date_approval' => Carbon::now(),
                    'date_created' => Carbon::now()
                ]);

        }, 5);

        return $reform;
    }

    /**
     * Actualizar una reforma presupuestaria
     *
     * @param array $reform
     * @param string $userCode
     *
     * @throws Throwable
     */
    public function updateReform(array $reform, string $userCode)
    {
        // Update reform in table prcabmov
        DB::connection('pgsql')->transaction(function () use ($userCode, $reform) {
            $query = "UPDATE prcabmov
                        SET fec_apr = :fec_apr, 
                            fec_asi = :fec_asi, 
                            fec_mod = :fec_mod, 
                            estado = :estado, 
                            des_cab = :des_cab, 
                            periodo = :periodo, 
                            incremen = :incremen,
                            tot_deb = :tot_deb,
                            tot_cre = :tot_cre
                        WHERE codemp = :company_code 
                        AND anio = :year  
                        AND sig_tip = :sig_tip 
                        AND acu_tip = :acu_tip;";

            DB::connection('pgsql')->update($query, [
                'fec_apr' => $reform['fec_apr'],
                'fec_asi' => $reform['fec_asi'],
                'fec_mod' => $reform['fec_mod'],
                'estado' => $reform['estado'],
                'des_cab' => $reform['des_cab'],
                'periodo' => $reform['periodo'],
                'incremen' => $reform['incremen'],
                'company_code' => $reform['codemp'],
                'year' => $reform['anio'],
                'sig_tip' => $reform['sig_tip'],
                'acu_tip' => $reform['acu_tip'],
                'tot_deb' => $reform['tot_deb'],
                'tot_cre' => $reform['tot_cre']
            ]);

            $operation = Operation::where([
                ['company_code', '=', $reform['codemp']],
                ['year', '=', $reform['anio']],
                ['voucher_type', '=', $reform['sig_tip']],
                ['number', '=', $reform['acu_tip']],
            ])->first();

            if ($operation) {
                $operation->date_assignment = $reform['fec_asi'];
                $operation->date_approval = $reform['fec_apr'];
                $operation->status = $reform['estado'];
                $operation->period = $reform['periodo'];
                $operation->total_debit = $reform['tot_deb'];
                $operation->total_credit = $reform['tot_cre'];
                $operation->voucher_type = $reform['sig_tip'];
                $operation->number = $reform['acu_tip'];
                $operation->description = $reform['des_cab'];
                $operation->save();
            } else {
                Operation::create(
                    [
                        'company_code' => $reform['codemp'],
                        'year' => $reform['anio'],
                        'voucher_type' => $reform['sig_tip'],
                        'number' => $reform['acu_tip'],
                        'date_assignment' => $reform['fec_asi'],
                        'date_approval' => $reform['fec_apr'],
                        'status' => $reform['estado'],
                        'period' => $reform['periodo'],
                        'total_debit' => $reform['tot_deb'],
                        'total_credit' => $reform['tot_cre'],
                        'description' => $reform['des_cab'],
                        'date_created' => $reform['fec_cre'],
                        'created_by' => $reform['cre_por']
                    ]
                );
            }

            // Update Reform details
            $currentDate = now()->format('Y-m-d');
            $period = now()->month;
            $sec_det = 0;

            // find reform details
            $details = self::findReformDetails($reform['codemp'], $reform['anio'], $reform['sig_tip'], $reform['acu_tip']);

            if ($details->count()) {
                $sec_det = $details->last()->sec_det;

                $newDetails = collect([]);
                $updateDetails = collect([]);

                $reform['budget_items']->each(function ($item, $key) use (&$details, $updateDetails, $newDetails) {
                    if (!isset($item['sec_det'])) {
                        $newDetails->push($item);
                    } else {
                        $updateDetails->push($item);
                        $details = $details->reject(function ($value, $key) use ($item) {
                            return $value->sec_det == $item['sec_det'];
                        });
                    }
                });
                if ($updateDetails->count()) {
                    self::updateDetails($updateDetails, $reform);
                }
                if ($details->count()) {
                    self::deleteDetails($details->pluck('sec_det')->toArray(), $reform);
                }
                if ($newDetails->count()) {
                    self::insertDetails($newDetails, $reform, $userCode, $currentDate, $period, $sec_det);
                }

            } else { // all details are new
                self::insertDetails($reform['budget_items'], $reform, $userCode, $currentDate, $period, $sec_det);
            }

        }, 5);
    }

    /**
     * Crear nuevos detalles de la reforma
     *
     * @param Collection $details
     * @param array $reform
     * @param string $userCode
     * @param string $currentDate
     * @param int $period
     * @param int $sec_det
     */
    private function insertDetails(Collection $details, array $reform, string $userCode, string $currentDate, int $period, int $sec_det)
    {
        $query = 'insert into prdetmov (codemp, anio, sig_tip, acu_tip, sec_det, ycodemp, yanio, ysig_tip, yacu_tip, cuenta, val_deb, val_cre, fec_det, cod_cli, fec_pos, 
                      nroctac, nro_che, tip_com, cre_por, fec_cre, mod_por, fec_mod, des_det, estado, periodo, factura, asociac, devengad, saldo, pagado, recaudad, val_cert) 
                      values';

        foreach ($details as $item) {
            $sec_det++;
            $query .= "('{$reform['codemp']}',
                 {$reform['anio']}, '{$reform['sig_tip']}', '{$reform['acu_tip']}', {$sec_det}, '{$reform['codemp']}', {$reform['anio']}, '{$reform['sig_tip']}', '{$reform['acu_tip']}',
                  '{$item['cuenta']}', {$item['val_deb']}, {$item['val_cre']}, '{$currentDate}', 
                  '', '', '', 0, 0, '{$userCode}', '{$currentDate}', '', '', '', 2, {$period}, '', {$item['asociac']}, 0, 0.00, 0, 0, 0),";

            OperationDetail::create([
                'company_code' => $reform['codemp'],
                'year' => $reform['anio'],
                'voucher_type' => $reform['sig_tip'],
                'number' => $reform['acu_tip'],
                'sequential' => $sec_det,
                'code' => $item['cuenta'],
                'income_amount' => $item['val_deb'],
                'expense_amount' => $item['val_cre'],
                'type' => $item['asociac'],
                'status' => $reform['estado'],
                'period' => $period,
                'created_by' => $userCode
            ]);
        }

        $query = rtrim($query, ',') . ';';
        DB::connection('pgsql')->insert($query);
    }

    /**
     * Actualiza los detalles de una reforma
     *
     * @param Collection $updateDetails
     * @param array $reform
     */
    private function updateDetails(Collection $updateDetails, array $reform)
    {
        $values = '';
        foreach ($updateDetails as $item) {
            $values .= "('{$reform['codemp']}', {$reform['anio']}, '{$reform['sig_tip']}', {$reform['acu_tip']}, {$item['sec_det']}, {$item['val_deb']}, {$item['val_cre']}), ";
            $detail = OperationDetail::where([
                ['company_code', '=', $reform['codemp']],
                ['year', '=', $reform['anio']],
                ['voucher_type', '=', $reform['sig_tip']],
                ['number', '=', $reform['acu_tip']],
                ['sequential', '=', $item['sec_det']],
            ])->first();

            if ($detail) {
                $detail->voucher_type = $reform['sig_tip'];
                $detail->number = $reform['acu_tip'];
                $detail->sequential = $item['sec_det'];
                $detail->income_amount = $item['val_deb'];
                $detail->expense_amount = $item['val_cre'];

                $detail->save();
            } else {
                OperationDetail::create(
                    [
                        'company_code' => $reform['codemp'],
                        'year' => $reform['anio'],
                        'voucher_type' => $reform['sig_tip'],
                        'number' => $reform['acu_tip'],
                        'sequential' => $item['sec_det'],
                        'code' => $item['cuenta'],
                        'income_amount' => $item['val_deb'],
                        'expense_amount' => $item['val_cre'],
                        'type' => $item['asociac'],
                        'status' => $reform['estado'],
                        'period' => $reform['periodo'],
                        'created_by' => $reform['cre_por']
                    ]
                );
            }
        }
        $values = rtrim($values, ', ');

        $query = "update prdetmov as det_mov
                    set val_deb = v.val_deb,
                        val_cre = v.val_cre
                    from (values {$values}) as v(codemp, anio, sig_tip, acu_tip, sec_det, val_deb, val_cre)
                  where det_mov.codemp = v.codemp and det_mov.anio = v.anio and det_mov.sig_tip = v.sig_tip and det_mov.acu_tip = v.acu_tip and det_mov.sec_det = v.sec_det;";

        DB::connection('pgsql')->update($query);
    }

    /**
     * Elimina detalles de una reforma
     *
     * @param array $sec_det
     * @param array $reform
     */
    private function deleteDetails(array $sec_det, array $reform)
    {
        $bindingsString = trim(str_repeat('?,', count($sec_det)), ',');
        if ($bindingsString === "") {
            $bindingsString = "''";
        }

        $query = "delete from prdetmov det_mov
                  where codemp = ? 
                        AND anio = ?  
                        AND sig_tip = ? 
                        AND acu_tip = ? 
                        and det_mov.sec_det in ( {$bindingsString} );";

        DB::connection('pgsql')->delete($query, array_merge([$reform['codemp'], $reform['anio'], $reform['sig_tip'], $reform['acu_tip']], $sec_det));

        $details = OperationDetail::where([
            ['year', '=', $reform['anio']],
            ['voucher_type', '=', $reform['sig_tip']],
            ['number', '=', $reform['acu_tip']]
        ])->whereIn('sequential', $sec_det)->get();

        foreach ($details as $detail) {
            $detail->delete();
        }
    }

    /**
     * Actualiza estados de una reforma presupuestaria
     *
     * @param stdClass $reform
     *
     * @throws Throwable
     */
    public function updateStatusReform(stdClass $reform)
    {
        DB::connection('pgsql')->transaction(function () use ($reform) {

            $currentDate = now()->format('Y-m-d');
            $period = date("n", strtotime($reform->fec_apr));

            $query = "UPDATE prcabmov
                        SET fec_apr = :fec_apr,
                            fec_mod = :fec_mod, 
                            estado = :estado, 
                            periodo = :periodo
                        WHERE codemp = :company_code 
                        AND anio = :year  
                        AND sig_tip = :sig_tip 
                        AND acu_tip = :acu_tip;";

            DB::connection('pgsql')->update($query, [
                'fec_apr' => $reform->fec_apr,
                'fec_mod' => $currentDate,
                'estado' => $reform->estado,
                'periodo' => $period,
                'company_code' => $reform->codemp,
                'year' => $reform->anio,
                'sig_tip' => $reform->sig_tip,
                'acu_tip' => $reform->acu_tip
            ]);

            $operation = Operation::where([
                ['company_code', '=', $reform->codemp],
                ['year', '=', $reform->anio],
                ['voucher_type', '=', $reform->sig_tip],
                ['number', '=', $reform->acu_tip],
            ])->first();

            if ($operation) {
                $operation->date_approval = $reform->fec_apr;
                $operation->status = $reform->estado;
                $operation->period = $period;
                $operation->voucher_type = $reform->sig_tip;
                $operation->number = $reform->acu_tip;
                $operation->save();
            } else {
                Operation::create(
                    [
                        'company_code' => $reform->codemp,
                        'year' => $reform->anio,
                        'voucher_type' => $reform->sig_tip,
                        'number' => $reform->acu_tip,
                        'date_assignment' => $reform->fec_asi,
                        'date_approval' => $reform->fec_apr,
                        'status' => $reform->estado,
                        'period' => $period,
                        'total_debit' => $reform->tot_deb,
                        'total_credit' => $reform->tot_cre,
                        'description' => $reform->des_cab,
                        'date_created' => $reform->fec_cre,
                        'created_by' => $reform->cre_por
                    ]
                );
            }

            $query = "update prdetmov as det_mov
                        set fec_mod = :fec_mod, 
                            fec_det = :fec_det, 
                            estado = :estado, 
                            periodo = :periodo
                      where det_mov.codemp = :company_code and det_mov.anio = :year and det_mov.sig_tip = :sig_tip and det_mov.acu_tip = :acu_tip";

            DB::connection('pgsql')->update($query, [
                'fec_mod' => $currentDate,
                'fec_det' => $reform->fec_apr,
                'estado' => $reform->estado,
                'periodo' => $period,
                'company_code' => $reform->codemp,
                'year' => $reform->anio,
                'sig_tip' => $reform->sig_tip,
                'acu_tip' => $reform->acu_tip
            ]);

            $details = OperationDetail::where([
                ['company_code', '=', $reform->codemp],
                ['year', '=', $reform->anio],
                ['voucher_type', '=', $reform->sig_tip],
                ['number', '=', $reform->acu_tip],
            ])->get();

            foreach ($details as $detail) {
                $detail->status = $reform->estado;
                $detail->save();
            }
        });
    }

    /**
     * Buscar periodo contable
     *
     * @param int $year
     * @param string $companyCode
     * @param int $period
     *
     * @return array
     */
    public function findAccountingPeriod(int $year, string $companyCode, int $period)
    {
        $query = "select * from copercon where anio = :year and codemp = :company_code and id_per = :period;";

        return DB::connection('pgsql')->select($query, [
            'period' => $period,
            'company_code' => $companyCode,
            'year' => $year
        ]);
    }

    /**
     * Crea certificacion presupuestaria
     *
     * @param FiscalYear $fiscalYear
     * @param string $companyCode
     * @param string $userCode
     *
     * @return array
     * @throws Throwable
     */
    public function createReformCertification(FiscalYear $fiscalYear, string $companyCode, string $userCode, Certification $certification)
    {

        $reform = [];
        $entity=$certification->load([
            'activity',
            'budgetItems'
        ]);
        DB::connection('pgsql')->transaction(function () use ($certification, &$reform, $userCode, $companyCode, $fiscalYear) {

            $query = "UPDATE cotipcom
                      SET acu_tip = acu_tip + 1
                      WHERE codemp = :company_code and anio = :year and sig_tip = :sig_tip 
                      RETURNING acu_tip;";

            $acu_tip = DB::connection('pgsql')->select($query, [
                'company_code' => $companyCode,
                'year' => $fiscalYear->year,
                'sig_tip' => self::MOV_CERTIFICATION_TYPE
            ]);

            if (!isset($acu_tip[0])) {
                throw new Exception(trans('reforms.messages.exceptions.reform_type_not_fount'));
            }
            $entity=$certification->load([
                'activity',
                'budgetItems'
            ]);

            $tot_cre=0;//variable para almacenar la suma de las certificaciones de las partidas
            //funcion que suma los valores certificados de las partidas
            foreach ($entity['budgetItems'] as $budgetItem) {
                $tot_cre+=$budgetItem->pivot->amount;
            }
            $currentDate = now()->format('Y-m-d');
            $period = now()->month;
            $sig_tip = self::MOV_CERTIFICATION_TYPE;
            $state = self::OPERATION_STATE_SQUARE_2;
            $query = "insert into prcabmov (codemp, anio, sig_tip, acu_tip, ucodemp, uanio, num_com, des_cab, tot_deb, tot_cre, 
                                             totinid, totinic, fec_asi, fec_apr, cre_por, fec_cre, estado, periodo, 
                                         nropagos, pagosre,    incremen, comprom, acu_tip1, estadono, liquida, departam, solicita, tipopro, retfte, retiva, pagado,    recaudad, acu_tipce
                                         ) 
                                            values ";
            $query .= "('$companyCode', $fiscalYear->year,  '$sig_tip', {$acu_tip[0]->acu_tip}, '$companyCode',  $fiscalYear->year, '{$certification->name}', '{$entity->name}', 0, $tot_cre,
                            0, 0, '$currentDate', '$currentDate', '$userCode', '$currentDate', {$state}, $period, 
            0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0) RETURNING *;";
            $reform = DB::connection('pgsql')->select($query);

        }, 5);
        $this->insertDetailsCertification($entity, $reform,$userCode );


        return $reform;
    }

    /**
     * Crear nuevos detalles de una certificacion
     *
     * @param Model $entity
     * @param array $reform
     * @param string $userCode
     */
    private function insertDetailsCertification(Model $entity, array $reform, string $userCode)
    {
        $currentDate = now()->format('Y-m-d');
        $period = now()->month;
        $sec_det = 0;
        foreach ($entity['budgetItems'] as $budgetItem) {
            foreach ($reform as $ref)
            $details = self::findReformDetails($ref->codemp, $ref->anio, $ref->sig_tip, $ref->acu_tip);

            $query = 'insert into prdetmov (codemp, anio, sig_tip, 
                      acu_tip, sec_det, ycodemp, yanio, ysig_tip, 
                      yacu_tip, cuenta, val_deb, val_cre, fec_det, 
                      cod_cli, fec_pos, 
                      nroctac, nro_che, tip_com, cre_por, fec_cre, mod_por,
                      fec_mod, des_det, estado, periodo, factura, asociac, 
                      devengad, saldo, pagado, recaudad, val_cert) 
                      values';

            if ($details->count()) {
                $sec_det = $details->last()->sec_det;

            }
                $sec_det++;
                $query .= "('{$ref->codemp}',
                 {$ref->anio}, '{$ref->sig_tip}', '{$ref->acu_tip}', {$sec_det}, 
                 '{$ref->codemp}', {$ref->anio}, '{$ref->sig_tip}', '{$ref->acu_tip}',
                  '{$budgetItem->code}', 0, {$budgetItem->pivot->amount}, '{$currentDate}', 
                  '', '', '', 0, 0, '{$userCode}', '{$currentDate}', '', '', '', 2, {$period}, '', 
                  1, 0, 0.00, 0, 0, 0),";
            $query = rtrim($query, ',') . ';';
            DB::connection('pgsql')->insert($query);
        }
    }
}