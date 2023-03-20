<?php

namespace App\Processes\Business\Planning;

use App\Models\Business\Planning\PrioritizationTemplate;
use App\Repositories\Repository\Business\Planning\FiscalYearRepository;
use App\Repositories\Repository\Business\Planning\PrioritizationRepository;
use App\Repositories\Repository\Business\Planning\PrioritizationTemplateRepository;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

/**
 * Clase PrioritizationTemplateProcess
 * @package App\Processes\Business\Planning
 */
class PrioritizationTemplateProcess
{
    /**
     * @var PrioritizationTemplateRepository
     */
    protected $prioritizationTemplateRepository;

    /**
     * @var FiscalYearRepository
     */
    protected $fiscalYearRepository;

    /**
     * @var PrioritizationRepository
     */
    protected $prioritizationRepository;

    /**
     * Constructor de PrioritizationTemplateProcess.
     *
     * @param PrioritizationTemplateRepository $prioritizationTemplateRepository
     * @param FiscalYearRepository $fiscalYearRepository
     * @param PrioritizationRepository $prioritizationRepository
     */
    public function __construct(
        PrioritizationTemplateRepository $prioritizationTemplateRepository,
        FiscalYearRepository $fiscalYearRepository,
        PrioritizationRepository $prioritizationRepository
    ) {
        $this->prioritizationTemplateRepository = $prioritizationTemplateRepository;
        $this->fiscalYearRepository = $fiscalYearRepository;
        $this->prioritizationRepository = $prioritizationRepository;
    }

    /**
     * Cargar información de templates.
     *
     * @return mixed
     * @throws Exception
     */
    public function data()
    {
        $user = currentUser();
        $actions = [];

        if ($user->can('show.prioritization_templates')) {
            $actions['search'] = [
                'route' => 'show.prioritization_templates',
                'tooltip' => trans('prioritization_templates.labels.show')
            ];
        }

        if ($user->can('edit.prioritization_templates')) {
            $actions['edit'] = [
                'route' => 'edit.prioritization_templates',
                'tooltip' => trans('prioritization_templates.labels.edit')
            ];
        }

        if ($user->can('destroy.prioritization_templates')) {
            $actions['trash'] = [
                'route' => 'destroy.prioritization_templates',
                'tooltip' => trans('prioritization_templates.labels.destroy'),
                'btn_class' => 'btn-danger',
                'method' => 'delete'
            ];
        }

        $dataTable = DataTables::of($this->prioritizationTemplateRepository->findAll())
            ->setRowId('id')
            ->addColumn('fiscal_year', function (PrioritizationTemplate $entity) {
                return $entity->fiscalYear ? $entity->fiscalYear->year : '';
            })
            ->editColumn('status', function (PrioritizationTemplate $entity) {
                return trans('prioritization_templates.status.' . strtolower($entity->status));
            })
            ->editColumn('creation_date', function (PrioritizationTemplate $entity) {
                return $entity->created_at ? formatDate($entity->created_at, 'Y-m-d') : '';
            })
            ->addColumn('actions', function (PrioritizationTemplate $entity) use ($actions) {

                if ($this->prioritizationRepository->findByTemplate($entity)->count()) {
                    $actions['trash']['confirm_message'] = trans('prioritization_templates.messages.confirm.delete');
                }

                if (in_array($entity->status, [PrioritizationTemplate::STATUS_DEFAULT, PrioritizationTemplate::STATUS_BLOCKED])) {
                    unset($actions['edit']);
                    unset($actions['trash']);
                }

                return view('layout.partial.actions_tooltip', [
                    'entity' => $entity,
                    'actions' => $actions
                ]);
            })
            ->rawColumns(['fiscal_year', 'status', 'creation_date', 'actions'])
            ->make(true);

        return $dataTable;
    }

    /**
     * Retornar data necesaria para mostrar el formulario de creación de template.
     *
     * @return array
     * @throws Exception
     */
    public function create()
    {
        $reusableTemplates = $this->prioritizationTemplateRepository->findReusableTemplates();

        if (!$reusableTemplates) {
            throw new Exception(trans('prioritization_templates.messages.exceptions.templates_not_found'), 1000);
        }

        $currentFiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();

        if (!$currentFiscalYear) {
            throw new Exception(trans('prioritization_templates.messages.exceptions.current_fiscal_year_not_found'), 1000);
        }

        $fiscalYearsWithoutTemplate = $this->fiscalYearRepository->findFiscalYearsWithoutTemplate();

        if (!$fiscalYearsWithoutTemplate->count()) {
            throw new Exception(trans('prioritization_templates.messages.exceptions.fiscal_years_completed'), 1000);
        }

        $configuration = collect([]);

        foreach ($reusableTemplates as $template) {
            $configuration->put($template->id, json_decode($template->configuration, true));
        }

        return [
            'fiscalYearsWithoutTemplate' => $fiscalYearsWithoutTemplate,
            'reusableTemplates' => $reusableTemplates,
            'templatesConfiguration' => json_encode($configuration)
        ];
    }

    /**
     * Almacenar nuevo template de priorización.
     *
     * @param Request $request
     *
     * @throws Exception
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $fiscalYear = $this->fiscalYearRepository->find($data['fiscalYearId']);

        if (!$fiscalYear) {
            throw  new Exception(trans('prioritization_templates.messages.exceptions.fiscal_year_not_found'), 1000);
        }

        $baseTemplate = $this->prioritizationTemplateRepository->find($data['templateId']);

        if (!$baseTemplate) {
            throw  new Exception(trans('prioritization_templates.messages.exceptions.base_template_not_found'), 1000);
        }

        $data['parent_id'] = $data['templateId'];
        $data['fiscal_year_id'] = $data['fiscalYearId'];
        unset($data['templateId']);
        unset($data['fiscalYearId']);

        $data = self::normalizeData($data, $baseTemplate);

        if (!$this->prioritizationTemplateRepository->createFromArray($data)) {
            throw new Exception(trans('prioritization_templates.messages.errors.create'), 1000);
        }
    }

    /**
     * Retornar data necesaria para mostrar el formulario de edición de template.
     *
     * @param int $id
     *
     * @return array
     * @throws Exception
     */
    public function edit(int $id)
    {
        $template = $this->prioritizationTemplateRepository->find($id);

        if (!$template) {
            throw  new Exception(trans('prioritization_templates.messages.exceptions.entity_not_found'), 1000);
        }

        return [
            'template' => $template
        ];
    }

    /**
     * Actualizar la información de template.
     *
     * @param Request $request
     * @param int $id
     *
     * @throws Exception
     */
    public function update(Request $request, int $id)
    {
        $data = $request->all();
        $template = $this->prioritizationTemplateRepository->find($id);

        if (!$template) {
            throw  new Exception(trans('prioritization_templates.messages.exceptions.entity_not_found'), 1000);
        }

        $baseTemplate = $this->prioritizationTemplateRepository->find($template->parentTemplate->id);

        if (!$baseTemplate) {
            throw  new Exception(trans('prioritization_templates.messages.exceptions.base_template_not_found'), 1000);
        }

        $data = self::normalizeData($data, $baseTemplate);

        if (!$this->prioritizationTemplateRepository->updateFromArray($data, $template)) {
            throw new Exception(trans('prioritization_templates.messages.errors.update'), 1000);
        }
    }

    /**
     * Retornar data necesaria para mostrar la información de template.
     *
     * @param int $id
     *
     * @return array
     * @throws Exception
     */
    public function show(int $id)
    {
        return self::edit($id);
    }

    /**
     * Eliminar un template.
     *
     * @param int $id
     *
     * @throws Exception
     */
    public function destroy(int $id)
    {
        $template = $this->prioritizationTemplateRepository->find($id);

        if (!$template) {
            throw new Exception(trans('prioritization_templates.messages.exceptions.entity_not_found'), 1000);
        }

        if ($template->status === PrioritizationTemplate::STATUS_BLOCKED) {
            throw new Exception(trans('prioritization_templates.messages.exceptions.blocked_status'), 1000);
        }

        if (!$this->prioritizationTemplateRepository->delete($template)) {
            throw new Exception(trans('prioritization_templates.messages.errors.delete'), 1000);
        }
    }

    /**
     * Normalizar la información previo al almacenamiento.
     *
     * @param array $data
     * @param PrioritizationTemplate $baseTemplate
     *
     * @return array
     * @throws Exception
     */
    private function normalizeData(array $data, PrioritizationTemplate $baseTemplate)
    {
        $scopes = collect($baseTemplate->areas());
        $configuration = $data['configuration'];
        $newTemplate = [];

        // Build JSON object with new template data
        foreach ($configuration as $scopeKey => $criteria) {

            $newScope = [];

            $baseScope = $scopes->first(function ($value, $key) use ($scopeKey) {
                return $value->id == $scopeKey;
            });

            if ($baseScope) {

                $newScope['id'] = $scopeKey;
                $newScope['scope'] = $baseScope->scope;
                $newScope['weight'] = $criteria['weight'] / 100;

                unset($criteria['weight']);
                $newScope['criteria'] = [];
                $newCriterion = [];

                foreach ($criteria as $criterionKey => $criterionOptions) {

                    $baseCriterion = collect($baseScope->criteria)->first(function ($value, $key) use ($criterionKey) {
                        return $value->id == $criterionKey;
                    });

                    if ($baseCriterion) {
                        $newCriterion['id'] = $criterionKey;
                        $newCriterion['question'] = $baseCriterion->question;
                        $newCriterion['answers'] = [];

                        foreach ($criterionOptions as $optionName => $optionValue) {
                            $baseOption = collect($baseCriterion->answers)->first(function ($value, $key) use ($optionName) {
                                return $key == $optionName;
                            });

                            if ($baseOption) {
                                $newAnswer = [];
                                $newAnswer['name'] = $optionName;
                                $newAnswer['value'] = $optionValue;

                                array_push($newCriterion['answers'], $newAnswer);

                            } else {
                                throw new Exception(trans('prioritization_templates.messages.validation.invalid_options'), 1000);
                            }
                        }

                        array_push($newScope['criteria'], $newCriterion);

                    } else {
                        throw new Exception(trans('prioritization_templates.messages.validation.invalid_criteria'), 1000);
                    }
                }

            } else {
                throw new Exception(trans('prioritization_templates.messages.validation.invalid_scope'), 1000);
            }

            array_push($newTemplate, $newScope);
        }

        $data['configuration'] = json_encode($newTemplate);

        return $data;
    }
}
