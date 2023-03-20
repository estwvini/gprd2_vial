<?php

namespace App\Repositories\Repository\Business;

use App\Models\Business\Link;
use App\Models\Business\PlanElement;
use App\Models\Business\PlanIndicator;
use App\Repositories\Library\Eloquent\Repository;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;

/**
 * Clase LinkRepository
 * @package App\Repositories\Repository
 */
class LinkRepository extends Repository
{
    /**
     * Constructor de LinkRepository.
     *
     * @param App $app
     * @param Collection $collection
     *
     * @throws \App\Repositories\Library\Exceptions\RepositoryException
     */
    public function __construct(App $app, Collection $collection)
    {
        parent::__construct($app, $collection);
    }

    /**
     * Especifica el nombre de la clase del modelo
     *
     * @return mixed
     */
    function model()
    {
        return Link::class;
    }


    /**
     * Obtener de la BD una colección de todas las articulaciones
     *
     * @return mixed
     */
    public function findAll()
    {
        return $this->model->get();
    }

    /**
     * Obtener una articulación de la base de datos usando los identificadores padre e hijo
     *
     * @param int $parent_id
     * @param int $child_id
     *
     * @return mixed
     */
    public function findByIds(int $parent_id, int $child_id)
    {
        return $this->model->where('parent_element', $parent_id)->where('child_element', $child_id)->first();
    }

    /**
     * Almacenar en la BD una nueva articulación
     *
     * @param array $data
     *
     * @return mixed
     */
    public function createFromArray(array $data)
    {
        $model = new $this->model;
        $link = $model->create($data);

        return $link;
    }


    /**
     * Eliminar de la BD las articulaciones de un indicador
     *
     * @param PlanIndicator $entity
     * @param int $targetPlan
     *
     * @return bool|mixed|null
     */
    public function deleteParentLinks(PlanIndicator $entity, int $targetPlan)
    {
        $links = $entity->parentLinks()
            ->whereHas('objective.plan', function ($query) use ($targetPlan) {
                $query->where('id', $targetPlan);
            })->get()->pluck('id')->toArray();

        $entity->parentLinks()->wherePivotIn('parent_indicator', $links)->detach();

        return $entity->fresh();
    }

    /**
     * Almacena las articulaciones de la meta de un plan en la base de datos
     *
     * @param PlanIndicator $entity
     * @param array $parentIndicators
     *
     * @return PlanIndicator
     */
    public function storeParentLinks(PlanIndicator $entity, array $parentIndicators)
    {
        $entity->parentLinks()->sync($parentIndicators);
        return $entity;
    }

    /**
     * Verifica si una meta está articulada o no
     *
     * @param int $goalId
     * @param PlanElement $element
     *
     * @return bool
     */
    public function isLinked(int $goalId, PlanElement $element)
    {
        if ($element->type != PlanElement::TYPE_GOAL) {
            return false;
        }

        return $this->model->where('child_element', $goalId)->where('parent_element', $element->id)->exists();

    }

}