<?php

namespace App\Repositories\Repository\Business\Planning;

use App\Models\Business\Planning\FiscalYear;
use App\Models\Business\Planning\PrioritizationTemplate;
use App\Repositories\Library\Eloquent\Repository;
use App\Repositories\Library\Exceptions\RepositoryException;
use Exception;
use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Clase PrioritizationTemplateRepository
 * @package App\Repositories\Repository\Business\Planning
 */
class PrioritizationTemplateRepository extends Repository
{
    /**
     * @var PrioritizationRepository
     */
    protected $prioritizationRepository;

    /**
     * Constructor de PrioritizationTemplateRepository.
     *
     * @param App $app
     * @param Collection $collection
     * @param PrioritizationRepository $prioritizationRepository
     *
     * @throws RepositoryException
     */
    public function __construct(App $app, Collection $collection, PrioritizationRepository $prioritizationRepository)
    {
        parent::__construct($app, $collection);
        $this->prioritizationRepository = $prioritizationRepository;
    }

    /**
     * Nombre del modelo de la clase.
     *
     * @return mixed|string
     */
    function model()
    {
        return PrioritizationTemplate::class;
    }

    /**
     * Obtener de la BD una colección de todos los templates de priorización.
     *
     * @return mixed
     */
    public function findAll()
    {
        return $this->model->get();
    }

    /**
     * Obtener de la BD la cantidad de templates de priorización.
     *
     * @return  mixed
     */
    public function count()
    {
        return $this->model->count();
    }

    /**
     * Actualizar en la BD la información de un template de priorización.
     *
     * @param array $data
     * @param PrioritizationTemplate $entity
     *
     * @return PrioritizationTemplate|null
     */
    public function updateFromArray(array $data, PrioritizationTemplate $entity)
    {
        $entity->fill($data);
        $entity->save();
        return $entity->fresh();
    }

    /**
     * Almacenar en la BD un nuevo template de priorización.
     *
     * @param array $data
     *
     * @return mixed
     */
    public function createFromArray(array $data)
    {
        $entity = new $this->model;
        return $entity->create($data);
    }

    /**
     * Obtener de la BD el template predefinido.
     *
     * @return PrioritizationTemplate|null
     */
    public function findDefaultTemplate()
    {
        return $this->model->where('status', PrioritizationTemplate::STATUS_DEFAULT)->first();
    }

    /**
     * Obtener todos los templates cuya configuración pueda ser replicada a nuevos templates.
     *
     * @return mixed
     */
    public function findReusableTemplates()
    {
        return $this->model->whereIn('status', [PrioritizationTemplate::STATUS_DEFAULT, PrioritizationTemplate::STATUS_BLOCKED])->get();
    }

    /**
     * Obtener el template de acuerdo al año fiscal especificado.
     *
     * @param FiscalYear $fiscalYear
     *
     * @return PrioritizationTemplate|null
     */
    public function findByFiscalYear(FiscalYear $fiscalYear)
    {
        return $this->model->where('fiscal_year_id', $fiscalYear->id)->first();
    }

    /**
     * Eliminar template junto con sus priorizaciones.
     *
     * @param Model $entity
     *
     * @return bool|mixed|null
     * @throws Exception
     */
    public function delete(Model $entity)
    {
        DB::transaction(function () use ($entity) {
            $prioritizations = $this->prioritizationRepository->findByTemplate($entity);

            foreach ($prioritizations as $prioritization) {
                $prioritization->budgetAdjustments()->delete();
                $prioritization->delete();
            }

            $entity->delete();
        }, 5);

        return $entity->fresh();
    }

    /**
     * Cambiar el estado de un template a bloqueado.
     *
     * @param PrioritizationTemplate $prioritizationTemplate
     */
    public function blockTemplate(PrioritizationTemplate $prioritizationTemplate)
    {
        $prioritizationTemplate->status = PrioritizationTemplate::STATUS_BLOCKED;
        $prioritizationTemplate->save();
    }
}