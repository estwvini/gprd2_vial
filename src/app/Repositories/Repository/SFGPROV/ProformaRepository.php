<?php

namespace App\Repositories\Repository\SFGPROV;

use App\Models\Business\Planning\FiscalYear;
use App\Models\Business\Tracking\Operation;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Throwable;

/**
 * Clase SFGPROVRepository
 * @package App\Repositories\Repository\SFGPROV
 */
class ProformaRepository
{
    /**
     * Obtener el año fiscal de la BD de SFGPROV.
     *
     * @param FiscalYear $fiscalYear
     * @param string $companyCode
     *
     * @return mixed
     */
    public function getFiscalYear(FiscalYear $fiscalYear, string $companyCode)
    {
        return collect(DB::connection('pgsql')->select("select * from coejefis where anio = :year and codemp = :company_code",
            ['year' => $fiscalYear->year, 'company_code' => $companyCode]));
    }

    /**
     * Verificar si una proforma ya existe en el sistema SFGPROV.
     *
     * @param FiscalYear $fiscalYear
     * @param string $companyCode
     *
     * @return mixed
     */
    public function proformaExists(FiscalYear $fiscalYear, string $companyCode)
    {
        return collect(DB::connection('pgsql')->select("select count(*) from prplacta where anio = :year and codemp = :company_code",
            ['year' => $fiscalYear->year, 'company_code' => $companyCode]))->first()->count;
    }

    /**
     * Sincronizar la proforma (almacenar en la BD de SFGPROV).
     *
     * @param Collection $proformas
     * @param Operation $operation
     * @param Collection $operationDetails
     *
     * @throws Throwable
     */
    public function syncProforma(Collection $proformas, Operation $operation, Collection $operationDetails)
    {
        DB::connection('pgsql')->transaction(function () use ($proformas, $operation, $operationDetails) {

            // PRPLACTA
            $query = 'insert into prplacta (codemp, anio, cuenta, identifi, ucodemp, uanio, nom_cue, ult_cue, niv_cue, cuenta_p, cre_por, con_mov, sal_deb, sal_cre, sal_inid, 
                                            sal_inic, cod_p, cod_h, fec_mod, mod_por, fec_cre, aux_cue, ban_cue, estado, comp_db, comp_cr, scompdb, scompcr) values';

            foreach ($proformas as $record) {
                $query .= "('$record->company_code',
                $record->year, 
                '$record->code', 
                $record->type, 
                '$record->company_code', 
                $record->year, 
                '$record->description', 
                '$record->last_level', 
                $record->level, 
                '$record->parent_code', 
                '$record->created_by', 0, 0, 0, 0, 0, 0, 0, ' ', ' ', ' ', ' ', ' ', 1, 0, 0, 0, 0),";
            }

            $query = rtrim($query, ',') . ';';
            DB::connection('pgsql')->insert($query);

            $date = $operation->year . '-01-01';
            // PRCABMOV
            $query = 'insert into prcabmov (codemp, anio, sig_tip, acu_tip, ucodemp, uanio, des_cab, tot_deb, tot_cre, fec_asi, fec_apr, fec_cre, fec_mod, estado, periodo, 
                                            cre_por, num_com, totinid, fec_anu, mod_por, nropagos, pagosre, incremen, comprom, sig_tip1, acu_tip1, estadono, liquida, 
                                            departam, solicita, cedruc, tipopro, retfte, retiva, cur, pagado, recaudad) values';
            $query .= "('$operation->company_code', 
            $operation->year, '$operation->voucher_type', 
            $operation->number, '$operation->company_code', 
            $operation->year, '$operation->description', 
            $operation->total_debit, $operation->total_credit, 
            '$date', 
            '$date', 
            '$date', 
            '$date', 
            $operation->status, 
            $operation->period, 
            '$operation->created_by', ' ', 0, ' ', ' ', 0, 0, 0, 0, ' ', 0, 0, 0, 0, 0, ' ', 0, 0, 0, ' ', 0, 0),";

            $query = rtrim($query, ',') . ';';
            DB::connection('pgsql')->insert($query);

            // PRDETMOV
            $query = 'insert into prdetmov (codemp, anio, sig_tip, acu_tip, sec_det, ycodemp, yanio, ysig_tip, yacu_tip, cuenta, val_deb, val_cre, fec_det, nro_che, estado, 
                                            periodo, asociac, cre_por, cod_cli, fec_pos, nroctac, tip_com, fec_cre, mod_por, fec_mod, des_det, factura, devengad, saldo, 
                                            pagado, recaudad) values';

            foreach ($operationDetails as $operationDetail) {
                $query .= "('$operationDetail->company_code', 
                $operationDetail->year, 
                '$operationDetail->voucher_type', 
                $operationDetail->number, 
                $operationDetail->sequential, 
                '$operationDetail->company_code', 
                $operationDetail->year, 
                '$operationDetail->voucher_type', 
                $operationDetail->number, 
                '$operationDetail->code', 
                $operationDetail->income_amount, 
                $operationDetail->expense_amount, 
                '$date', 
                $operationDetail->type, $operationDetail->status, 
                $operationDetail->period, $operationDetail->type, 
                '$operationDetail->created_by', ' ', ' ', ' ', 0, ' ', ' ', ' ', ' ', ' ', 0, 0, 0, 0),";
            }

            $query = rtrim($query, ',') . ';';
            DB::connection('pgsql')->insert($query);

        }, 5);
    }

    /**
     * Obtiene los ingresos con sus valores codificados
     *
     * @param FiscalYear $fiscalYear
     * @param string $companyCode
     *
     * @return Collection
     */
    public function getCodifiedIncomes(FiscalYear $fiscalYear, string $companyCode)
    {

        $query = "SELECT trim(a.cuenta) AS cuenta,
                          (sum(CASE WHEN a.sig_tip = 'PR' THEN a.val_deb ELSE 0 END) + sum(CASE WHEN a.sig_tip = 'RE' THEN CASE WHEN val_cre < 0 THEN a.val_deb + a.val_cre ELSE a.val_deb - a.val_cre END ELSE 0 END)) AS codified
                    FROM prdetmov a
                    LEFT JOIN prcabmov b ON a.codemp = b.codemp AND a.anio = b.anio AND a.sig_tip = b.sig_tip AND a.acu_tip = b.acu_tip
                    WHERE a.codemp = :company_code
                      AND a.anio = :year
                      AND a.asociac = 2
                      AND b.estado = 3
                    GROUP BY 1
                    ORDER BY cuenta;";

        return collect(DB::connection('pgsql')
            ->select($query,
                [
                    'year' => $fiscalYear->year,
                    'company_code' => $companyCode
                ]
            ));
    }

    /**
     * Obtiene los gastos con sus valores codificados
     *
     * @param FiscalYear $fiscalYear
     * @param string $companyCode
     *
     * @return Collection
     */
    public function getCodifiedExpenses(FiscalYear $fiscalYear, string $companyCode)
    {

        $query = "SELECT trim(a.cuenta) AS cuenta,
                          (sum(CASE WHEN a.sig_tip = 'PR' THEN a.val_cre ELSE 0 END) + sum(CASE WHEN a.sig_tip = 'RE' THEN CASE WHEN val_cre < 0 THEN a.val_deb + a.val_cre ELSE a.val_deb - a.val_cre END ELSE 0 END)) AS codified
                    FROM prdetmov a
                    LEFT JOIN prcabmov b ON a.codemp = b.codemp AND a.anio = b.anio AND a.sig_tip = b.sig_tip AND a.acu_tip = b.acu_tip
                    WHERE a.codemp = :company_code
                      AND a.anio = :year
                      AND a.asociac = 1
                      AND b.estado = 3
                    GROUP BY 1
                    ORDER BY cuenta;";

        return collect(DB::connection('pgsql')
            ->select($query,
                [
                    'year' => $fiscalYear->year,
                    'company_code' => $companyCode
                ]
            ));
    }

    /**
     * Obtiene los ingresos almacenados en la proforma
     *
     * @param FiscalYear $fiscalYear
     * @param string $companyCode
     *
     * @return Collection
     */
    public function getProformaIncomes(FiscalYear $fiscalYear, string $companyCode)
    {

        $query = "SELECT trim(prplacta.cuenta) AS cuenta
                    FROM prplacta
                    WHERE prplacta.codemp = :company_code
                      AND prplacta.anio = :year
                      AND prplacta.identifi = 2;";

        return collect(DB::connection('pgsql')
            ->select($query,
                [
                    'year' => $fiscalYear->year,
                    'company_code' => $companyCode
                ]
            ));
    }

    /**
     * Obtiene los gastos almacenados en la proforma
     *
     * @param FiscalYear $fiscalYear
     * @param string $companyCode
     *
     * @return Collection
     */
    public function getProformaExpenses(FiscalYear $fiscalYear, string $companyCode)
    {

        $query = "SELECT trim(prplacta.cuenta) AS cuenta
                    FROM prplacta
                    WHERE prplacta.codemp = :company_code
                      AND prplacta.anio = :year
                      AND prplacta.identifi = 1;";

        return collect(DB::connection('pgsql')
            ->select($query,
                [
                    'year' => $fiscalYear->year,
                    'company_code' => $companyCode
                ]
            ));
    }

    /**
     * Ingresa una nueva estructura de ingresos o partidas presupuestarias en el sistema financiero
     *
     * @param Collection $structure
     * @param string|null $currentCode
     * @param int|null $year
     *
     * @throws Throwable
     */
    public function syncStructure(Collection $structure, string $currentCode = null, int $year = null)
    {
        DB::connection('pgsql')->transaction(function () use ($structure, $currentCode, $year) {

            // PRPLACTA
            $query = 'insert into prplacta (codemp, anio, cuenta, identifi, ucodemp, uanio, nom_cue, ult_cue, niv_cue, cuenta_p, cre_por, con_mov, sal_deb, sal_cre, sal_inid, 
                                            sal_inic, cod_p, cod_h, fec_mod, mod_por, fec_cre, aux_cue, ban_cue, estado, comp_db, comp_cr, scompdb, scompcr) values';

            foreach ($structure as $record) {
                $query .= "('{$record['company_code']}',
                {$record['year']}, 
                '{$record['code']}', 
                {$record['type']}, 
                '{$record['company_code']}', 
                {$record['year']}, 
                '{$record['description']}', 
                '{$record['last_level']}', 
                {$record['level']}, 
                '{$record['parent_code']}', 
                '{$record['created_by']}', 0, 0, 0, 0, 0, 0, 0, ' ', ' ', ' ', ' ', ' ', 1, 0, 0, 0, 0),";
            }

            $query = rtrim($query, ',') . ';';
            DB::connection('pgsql')->insert($query);

            if ($currentCode) {
                $query = "DELETE FROM prplacta WHERE trim(prplacta.cuenta) = :code and prplacta.anio = :year;";
                DB::connection('pgsql')->delete($query, [
                    'year' => $year,
                    'code' => $currentCode
                ]);
            }

        }, 5);
    }

    /**
     * Elimina un registro de ingreso de la tabla prplacta
     *
     * @param string $code
     * @param int $year
     */
    public function destroy(string $code, int $year)
    {
        $query = "DELETE FROM prplacta WHERE trim(prplacta.cuenta) = :code and prplacta.anio = :year;";
        DB::connection('pgsql')->delete($query, [
            'year' => $year,
            'code' => $code
        ]);
    }
}