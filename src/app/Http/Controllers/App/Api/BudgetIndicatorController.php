<?php

namespace App\Http\Controllers\App\Api;

use App\Repositories\Repository\App\BudgetIndicatorRepository;
use App\Repositories\Repository\App\ProjectRepository;
use App\Repositories\Repository\Configuration\SettingRepository;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BudgetIndicatorController extends Controller
{

    /**
     * @var BudgetIndicatorRepository
     */
    private $indicatorRepository;

    /**
     * @var SettingRepository
     */
    private $settingRepository;

    /**
     * @var ProjectRepository
     */
    private $projectRepository;

    /**
     * @param BudgetIndicatorRepository $indicatorRepository
     * @param SettingRepository $settingRepository
     * @param ProjectRepository $projectRepository
     */
    public function __construct(
        BudgetIndicatorRepository $indicatorRepository,
        SettingRepository $settingRepository,
        ProjectRepository $projectRepository
    ) {
        $this->indicatorRepository = $indicatorRepository;
        $this->settingRepository = $settingRepository;
        $this->projectRepository = $projectRepository;
    }

    /**
     * Retrieve budget indicators.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $year = $request->year ?? now()->year;
        $date = Carbon::create($year ?? now()->year, 12, 31)->format('Y-m-d');
        $data = [];
        $incomeIndicators = json_decode($this->settingRepository->findByKey('app_indicators'))->value->income;
        $expenseIndicators = json_decode($this->settingRepository->findByKey('app_indicators'))->value->expenses;
        $subnational = json_decode($this->settingRepository->findByKey('app_indicators'))->value->subnational;

        foreach (json_decode(json_encode($incomeIndicators), true) as $key => $value) {
            $result = $this->indicatorRepository->getIndicatorBudget($year, $date, $value['value'], 1, 3, 2);
            $data['incomes'][$key]['value'] = count($result) > 0 ? $result[0]->encoded : null;
            $data['incomes'][$key]['value_f'] = count($result) > 0 ? short_number($result[0]->encoded) : null;
            $data['incomes'][$key]['description'] = $value['description'];
        }

        foreach (json_decode(json_encode($expenseIndicators), true) as $key => $value) {
            $result = $this->indicatorRepository->getIndicatorBudget($year, $date, $value['value']);
            $data['expenses'][$key]['value'] = count($result) > 0 ? $result[0]->encoded : null;
            $data['expenses'][$key]['value_f'] = count($result) > 0 ? short_number($result[0]->encoded) : null;
            $data['expenses'][$key]['description'] = $value['description'];
        }

        foreach (json_decode(json_encode($subnational), true) as $key => $value) {
            $data['subnational'][$key]['description'] = $value['description'];
        }

        $result = $this->indicatorRepository->getIndicatorBudget($year, $date, [], 1, 7, 2);
        $data['incomes']['total']['value'] = count($result) > 0 ? $result[0]->encoded : 0.00;
        $data['incomes']['total']['value_f'] = count($result) > 0 ? short_number($result[0]->encoded) : 0.00;

        $data['expenses']['project']['value'] = number_format($this->projectRepository->getProjectBudget($year, $date)->sum('encoded'), 2, '.', '');
        $data['expenses']['project']['value_f'] = short_number($this->projectRepository->getProjectBudget($year, $date)->sum('encoded'));
        $data['expenses']['total']['value'] = $this->indicatorRepository->getIndicatorBudget($year, $date, [], 1, 20)[0]->encoded;
        $data['expenses']['total']['value_f'] = short_number($this->indicatorRepository->getIndicatorBudget($year, $date, [], 1, 20)[0]->encoded);

        // % MET/Presupuesto
        $data['subnational']['met']['value'] = $data['incomes']['total']['value'] > 0 ? number_format(($data['incomes']['met']['value'] * 100) / $data['incomes']['total']['value'],
            2, '.', '') : 0;

        // % Gasto corriente
        $data['subnational']['current_expense']['value'] = $data['expenses']['total']['value'] > 0 ? number_format(($data['expenses']['current']['value'] * 100) / $data['incomes']['total']['value'],
            2, '.', '') : 0;

        // % Proyectos de inversión
        $data['subnational']['project_investment']['value'] = $data['expenses']['total']['value'] > 0 ? number_format(($data['expenses']['project']['value'] * 100) / $data['incomes']['total']['value'],
            2, '.', '') : 0;

        // % Gasto corriente de inversión
        $data['subnational']['current_investment']['value'] = $data['expenses']['total']['value'] > 0 ? number_format(($data['expenses']['current_investment']['value'] * 100) /
            $data['incomes']['total']['value'], 2, '.', '') : 0;

        // Ahorro corriente
        $data['subnational']['current_saving']['value'] = $data['incomes']['current']['value'] > 0 ? number_format(($data['expenses']['current']['value'] * 100) /
            $data['incomes']['current']['value'], 2, '.', '') : 0;

        // Grado de autonomía financiera
        $data['subnational']['financial_autonomy']['value'] = $data['incomes']['total']['value'] > 0 ? number_format(($data['incomes']['own']['value'] * 100) /
            $data['incomes']['total']['value'], 2, '.', '') : 0;

        return $this->response($data);
    }
}
