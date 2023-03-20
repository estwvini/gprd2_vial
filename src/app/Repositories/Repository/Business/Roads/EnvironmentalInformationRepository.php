<?php

namespace App\Repositories\Repository\Business\Roads;

use App\Models\Business\Roads\EnvironmentalInformation;
use App\Repositories\Library\Eloquent\Repository;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;

/**
 * Clase EnvironmentalInformationRepository
 * @package App\Repositories\Repository\Business\Roads
 */
class EnvironmentalInformationRepository extends Repository
{
    /**
     * Constructor de EnvironmentalInformationRepository.
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
     * Especificar el nombre de la clase del modelo.
     *
     * @return mixed|string
     */
    function model()
    {
        return EnvironmentalInformation::class;
    }

    /**
     * Obtener de la BD una colección de todos los informes ambientales de la via.
     *
     * @param string $code
     *
     * @return mixed
     */
    public function findByCode(string $code)
    {
        return $this->model->where('codigo', $code)->get();
    }

    /**
     * Obtener de la BD todos los informes ambientales de la via.
     *
     * @param string $code
     *
     * @return mixed
     */
    public function findByCodeDataTable(string $code)
    {
        return $this->model->where('codigo', $code);
    }

    /**
     * Obtener de la BD uun informe ambiental por gid.
     *
     * @param $gid
     *
     * @return mixed
     */
    public function findByCodeFirst(string $gid)
    {
        return $this->model->where('gid', $gid)->first();
    }

    /**
     * Actualizar en la BD la información de un informe ambientale.
     *
     * @param array $data
     * @param EnvironmentalInformation $entity
     *
     * @return EnvironmentalInformation|null
     */
    public function updateFromArray(array $data, EnvironmentalInformation $entity)
    {
        if (isset($data['participa']) && $data['participa'] == 'on') {
            $data['participa'] = 'T';
        } else {
            $data['participa'] = 'F';
        }
        if (isset($data['eval_riesg']) && $data['eval_riesg'] == 'on') {
            $data['eval_riesg'] = 'T';
        } else {
            $data['eval_riesg'] = 'F';
        }
        if (isset($data['riesg_pot']) && $data['riesg_pot'] == 'on') {
            $data['riesg_pot'] = 'T';
        } else {
            $data['riesg_pot'] = 'F';
        }
        if (isset($data['reserv_nat']) && $data['reserv_nat'] == 'on') {
            $data['reserv_nat'] = 'T';
        } else {
            $data['reserv_nat'] = 'F';
        }
        if (isset($data['pueb_indig']) && $data['pueb_indig'] == 'on') {
            $data['pueb_indig'] = 'T';
        } else {
            $data['pueb_indig'] = 'F';
        }
        if (isset($data['prot_cuenc']) && $data['prot_cuenc'] == 'on') {
            $data['prot_cuenc'] = 'T';
        } else {
            $data['prot_cuenc'] = 'F';
        }
        if (isset($data['resforest']) && $data['resforest'] == 'on') {
            $data['resforest'] = 'T';
        } else {
            $data['resforest'] = 'F';
        }
        if (isset($data['act_ambie']) && $data['act_ambie'] == 'on') {
            $data['act_ambie'] = 'T';
        } else {
            $data['act_ambie'] = 'F';
        }
        $entity->fill($data);
        $entity->save();
        return $entity->fresh();
    }

    /**
     * Almacenar en la BD un informe ambientale.
     *
     * @param array $data
     *
     * @return mixed
     */
    public function createFromArray(array $data)
    {
        $entity = new $this->model;
        if (isset($data['participa']) && $data['participa'] == 'on') {
            $data['participa'] = 'T';
        } else {
            $data['participa'] = 'F';
        }
        if (isset($data['eval_riesg']) && $data['eval_riesg'] == 'on') {
            $data['eval_riesg'] = 'T';
        } else {
            $data['eval_riesg'] = 'F';
        }
        if (isset($data['riesg_pot']) && $data['riesg_pot'] == 'on') {
            $data['riesg_pot'] = 'T';
        } else {
            $data['riesg_pot'] = 'F';
        }
        if (isset($data['reserv_nat']) && $data['reserv_nat'] == 'on') {
            $data['reserv_nat'] = 'T';
        } else {
            $data['reserv_nat'] = 'F';
        }
        if (isset($data['pueb_indig']) && $data['pueb_indig'] == 'on') {
            $data['pueb_indig'] = 'T';
        } else {
            $data['pueb_indig'] = 'F';
        }
        if (isset($data['prot_cuenc']) && $data['prot_cuenc'] == 'on') {
            $data['prot_cuenc'] = 'T';
        } else {
            $data['prot_cuenc'] = 'F';
        }
        if (isset($data['resforest']) && $data['resforest'] == 'on') {
            $data['resforest'] = 'T';
        } else {
            $data['resforest'] = 'F';
        }
        if (isset($data['act_ambie']) && $data['act_ambie'] == 'on') {
            $data['act_ambie'] = 'T';
        } else {
            $data['act_ambie'] = 'F';
        }
        $entity = $entity->create($data);
        return $entity->fresh();
    }
}