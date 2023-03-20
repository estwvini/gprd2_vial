<?php

use App\Models\Business\Plan;
use App\Processes\Business\Planning\BudgetAdjutmentProcess;
use App\Processes\Business\Planning\JustificationProcess;
use App\Processes\System\FileProcess;
use App\Repositories\Repository\Business\Planning\FiscalYearRepository;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Log;

/**
 * Get the current logged user
 *
 * @return Authenticatable|null
 */
function currentUser()
{
    return auth()->user();
}

/**
 * Get the permission for the role
 *
 * @param null $role
 * @param int $module
 *
 * @return array
 */
function permissions($role = null, int $module = null)
{
    $result = [];

    // base permissions
    $bases = (config('acl.permission'))::whereNull('inherit_id')
        ->where(function ($query) use ($module) {
            if ($module) {
                $query->where('module_id', $module);
            }
        }
        )->get();
    foreach ($bases as $base) {
        $result[$base->id] = [
            'name' => $base->name,
            'module' => $base->module_id,
            'label' => (null != $base->label ? $base->label : $base->name),
            'actions' => $base->slug
        ];
    }


    // rewrite role permissions
    if (null != $role) {
        $permissions = (config('acl.permission'))::join('permission_role', 'permission_role.permission_id', 'permissions.id')
            ->where('permission_role.role_id', $role->id)
            ->where(function ($query) use ($module) {
                if ($module) {
                    $query->where('permissions.module_id', $module);
                }
            })
            ->get();

        foreach ($permissions as $permission) {
            if (null == $permission->inherit_id) {
                $result[$permission->permission_id] = [
                    'name' => $permission->name,
                    'module' => $permission->module_id,
                    'label' => (null != $permission->label ? $permission->label : $permission->name),
                    'actions' => $permission->slug
                ];
            } else {
                foreach ($permission->slug as $key => $action) {
                    $result[$permission->inherit_id]['actions'][$key] = $action;
                }
            }
        }
    }
    return $result;
}

/**
 * Orden personalizado de permisos por importancia.
 *
 * @param array $data
 *
 * @return Collection
 */
function order_permissions(array $data)
{
    $data_permissions = collect($data);
    return $data_permissions->sortBy('is_primary')->sortBy('order');
}

/**
 * @param $date
 * @param $format
 *
 * @return string
 */
function formatDate($date, $format)
{
    return Carbon::parse($date)->format($format);
}

/**
 * @param string $filename
 * @param string $delimiter
 *
 * @return array|bool
 */
function csv_to_array($filename = '', $delimiter = ',')
{
    if (!file_exists($filename) || !is_readable($filename)) {
        return false;
    }

    $header = null;
    $data = array();
    if (($handle = fopen($filename, 'r')) !== false) {
        while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
            if (!array_filter($row)) {
                break;
            }

            if (!$header) {
                $header = $row;
                foreach ($header as &$h) {
                    $h = trim($h);
                }
            } else {
                $new_row = array_combine($header, $row);
                if (!is_bool($new_row)) {
                    $data[] = $new_row;
                }
            }

        }
        fclose($handle);
    }
    return $data;
}

/**
 * @param $value
 * @param $total
 *
 * @return float|int
 */
function percent($value, $total)
{
    if ($total == 0) {
        return 0;
    }

    return round($value * 100 / $total, 2);
}

/**
 * @param Throwable $e
 * @param bool $success
 *
 * @return mixed
 */
function defaultCatchHandler(Throwable $e, bool $success = true)
{
    $code = $e->getCode();

    switch ($code) {
        case 2000:
            $type = 'warning';
            break;
        default:
            $type = 'error';
    }

    $response['message'] = [
        'type' => $type,
        'text' => $code == 1000 || $code == 2000 ? $e->getMessage() : trans('app.messages.exceptions.unexpected')
    ];

    if (!$success) {
        $response['success'] = false;
    }

    if (displayException($code)) {
        $response['exception']['message'] = $e->getMessage();
    }

    if (!($e instanceof TokenMismatchException) && $code != 2000) {
        Illuminate\Support\Facades\Log::error($e->getMessage());
        Illuminate\Support\Facades\Log::error($e->getTraceAsString());
    }

    return $response;
}

/**
 * @param null $code
 *
 * @return bool
 */
function displayException($code = null): bool
{
    return $code !== 1000 && currentUser()->hasRole(config('app.display_exception_to_roles'));
}

/**
 * @param $url
 *
 * @return string
 */
function fullUrl($url): string
{
    return url('/') . $url;
}

/**
 * @param Throwable $e
 * @param Throwable $prevException
 *
 * @return string
 * @throws JsonException
 */
function datatableEmptyResponse(Throwable $e, Throwable $prevException)
{
    Log::error($prevException->getMessage());
    Log::error($prevException->getTraceAsString());

    return json_encode(['draw' => 0, 'recordsTotal' => 0, 'recordsFiltered' => 0, 'data' => [], 'exception' => $e->getMessage()], JSON_THROW_ON_ERROR);
}

/**
 * Verificar si el plan es justificable de acuerdo a su tipo y estado.
 *
 * @param Plan $plan
 *
 * @return bool
 */
function isJustifiable(Plan $plan): bool
{
    if (in_array($plan->type,
        [Plan::TYPE_PDOT, Plan::TYPE_PEI, Plan::TYPE_SECTORAL, Plan::TYPE_OTHER])) {
        return (Plan::STATUS_APPROVED == $plan->status || Plan::STATUS_VERIFIED == $plan->status) ? true : false;
    }

    return false;
}

/**
 * Crear la entidad de justificación y retornarla para ser guardada en el controlador respectivo.
 *
 * @param array $data
 * @param Model $model
 * @param bool|null $suffix
 *
 * @return mixed
 */
function storeJustification(array $data, Model $model, bool $suffix = false)
{
    return resolve(JustificationProcess::class)->store($data, $model, $suffix);
}

/**
 * Crear la entidad de archivo y retornarla para ser guardada en el proceso respectivo.
 *
 * @param array $data
 * @param Model $model
 *
 * @return mixed
 */
function storeFile(array $data, Model $model)
{
    return resolve(FileProcess::class)->storeGlobal($data, $model);
}

/**
 * Redirect to specified route on env file
 *
 * @return string
 */
function defaultRoute()
{
    $defaultRoute = route('dashboard.app');
    if (env('DEFAULT_ROUTE') && env('DEFAULT_ROUTE') !== '') {
        if (env('DEFAULT_ROUTE_PARAMS') && env('DEFAULT_ROUTE_PARAMS') !== '') {
            $params = explode(',', env('DEFAULT_ROUTE_PARAMS'));
            $defaultRoute = route(env('DEFAULT_ROUTE'), $params);
        } else {
            $defaultRoute = route(env('DEFAULT_ROUTE'));
        }
    }

    return $defaultRoute;
}

/**
 * Test postgresql connection
 *
 * @return void
 */
function testPGSQLConnection()
{
    DB::connection('pgsql')->getPdo();
}

/**
 * Check if budget adjustment was already created for next fiscal year.
 *
 * @return array|bool
 */
function isBudgetAdjustmentCreatedForNextFiscalYear()
{
    try {
        $budgetAdjustmentProcess = resolve(BudgetAdjutmentProcess::class);

        $approved = $budgetAdjustmentProcess->isApproved($budgetAdjustmentProcess->findBudgetAdjutmentForNextFiscalYear());
    } catch (Throwable $e) {
        $approved = false;
    }

    if ($approved) {
        return [
            'type' => 'warning',
            'text' => trans('app.messages.warning.budget_adjustment_approved', ['year' => (resolve(FiscalYearRepository::class))->findNextFiscalYear()->year])
        ];
    }

    return $approved;
}

/**
 * Check if budget adjustment was already created for current fiscal year.
 *
 * @return array|bool
 */
function isBudgetAdjustmentCreatedForCurrentFiscalYear()
{
    try {
        $budgetAdjustmentProcess = resolve(BudgetAdjutmentProcess::class);

        $approved = $budgetAdjustmentProcess->isApproved($budgetAdjustmentProcess->findBudgetAdjutmentForCurrentFiscalYear());
    } catch (Throwable $e) {
        $approved = false;
    }

    if ($approved) {
        return [
            'type' => 'warning',
            'text' => trans('app.messages.warning.budget_adjustment_approved', ['year' => (resolve(FiscalYearRepository::class))->findCurrentFiscalYear()->year])
        ];
    }

    return $approved;
}

/**
 * Obtener el código padre para el ítem de la proforma.
 *
 * @param string $code
 *
 * @return array|string
 */
function getParentCode(string $code)
{
    $parentCode = explode('.', $code);
    unset($parentCode[count($parentCode) - 1]);
    $parentCode = implode('.', $parentCode);

    return $parentCode;
}

/**
 * Replace special characters
 *
 * @param $string
 *
 * @return string
 */
function normalize($string)
{
    $table = array(
        'Š' => 'S',
        'š' => 's',
        'Ð' => 'Dj',
        'Ž' => 'Z',
        'ž' => 'z',
        'C' => 'C',
        'c' => 'c',
        'À' => 'A',
        'Á' => 'A',
        'Â' => 'A',
        'Ã' => 'A',
        'Ä' => 'A',
        'Å' => 'A',
        'Æ' => 'A',
        'Ç' => 'C',
        'È' => 'E',
        'É' => 'E',
        'Ê' => 'E',
        'Ë' => 'E',
        'Ì' => 'I',
        'Í' => 'I',
        'Î' => 'I',
        'Ï' => 'I',
        'Ñ' => 'N',
        'Ò' => 'O',
        'Ó' => 'O',
        'Ô' => 'O',
        'Õ' => 'O',
        'Ö' => 'O',
        'Ø' => 'O',
        'Ù' => 'U',
        'Ú' => 'U',
        'Û' => 'U',
        'Ü' => 'U',
        'Ý' => 'Y',
        'Þ' => 'B',
        'ß' => 'Ss',
        'à' => 'a',
        'á' => 'a',
        'â' => 'a',
        'ã' => 'a',
        'ä' => 'a',
        'å' => 'a',
        'æ' => 'a',
        'ç' => 'c',
        'è' => 'e',
        'é' => 'e',
        'ê' => 'e',
        'ë' => 'e',
        'ì' => 'i',
        'í' => 'i',
        'î' => 'i',
        'ï' => 'i',
        'ð' => 'o',
        'ñ' => 'n',
        'ò' => 'o',
        'ó' => 'o',
        'ô' => 'o',
        'õ' => 'o',
        'ö' => 'o',
        'ø' => 'o',
        'ù' => 'u',
        'ú' => 'u',
        'û' => 'u',
        'ý' => 'y',
        'þ' => 'b',
        'ÿ' => 'y',
        'R' => 'R',
        'r' => 'r',
    );

    return strtr($string, $table);
}

function nextFiscalYear()
{
    return resolve(FiscalYearRepository::class)->findNextFiscalYear();
}

function currentFiscalYear()
{
    return resolve(FiscalYearRepository::class)->findCurrentFiscalYear();
}


function short_number($n)
{
    // first strip any formatting;
    $n = (0 + str_replace(',', '', $n));

    // is this a number?
    if (!is_numeric($n)) {
        return false;
    }

    // now filter it;
    if ($n > 1000000000000) {
        return round(($n / 1000000000000), 1) . 'T';
    } else {
        if ($n > 1000000000) {
            return round(($n / 1000000000), 1) . 'B';
        } else {
            if ($n > 1000000) {
                return round(($n / 1000000), 1) . 'M';
            } else {
                if ($n > 1000) {
                    return round(($n / 1000), 1) . 'K';
                }
            }
        }
    }

    return number_format($n);
}

function api_available()
{
    return config('services.api.available');
}
