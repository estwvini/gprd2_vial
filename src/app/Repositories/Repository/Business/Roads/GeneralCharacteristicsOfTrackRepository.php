<?php

namespace App\Repositories\Repository\Business\Roads;

use App\Models\Business\Roads\GeneralCharacteristicsOfTrack;
use App\Repositories\Library\Eloquent\Repository;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Clase GeneralCharacteristicsOfTrackRepository
 * @package App\Repositories\Repository\Business\Roads
 */
class GeneralCharacteristicsOfTrackRepository extends Repository
{
    /**
     * Constructor de GeneralCharacteristicsOfTrackRepository.
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
        return GeneralCharacteristicsOfTrack::class;
    }

    /**
     * Obtener de la BD una colección de todas las vias.
     *
     * @return mixed
     */
    public function findAll()
    {
        return $this->model->get();
    }

    /**
     * Obtener de la BD todas las vias.
     *
     * @return mixed
     */
    public function findAllDataTable()
    {
        return $this->model->select('codigo', 'prov', 'canton', 'parroquia', 'origen', 'destino', 'longi', 'longf');
    }

    /**
     * Obtener de la BD las vias por filtros.
     *
     * @param string $canton
     * @param string $parish
     *
     * @return mixed
     */
    public function findFilters(string $canton, string $parish)
    {
        return $this->model::where(function ($query) use ($canton, $parish) {
            if ($canton !== '0') {
                $query->Where('canton', 'like', $canton);
            }
            if ($parish !== '0') {
                $query->Where('parroquia', 'like', $parish);
            }
        })->select('codigo', 'prov', 'canton', 'parroquia', 'origen', 'destino', 'longi', 'longf');
    }

    /**
     * Obtener de la BD una vía por codigo.
     *
     * @param $code
     *
     * @return mixed
     */
    public function findByCode(string $code)
    {
        return $this->model->where('codigo', $code)->first();
    }

    /**
     * Obtener de la BD una vía por código para verificar su existencia.
     *
     * @param $code
     * @param $ActualCode
     *
     * @return mixed
     */
    public function findByCodeEdit(string $code, string $ActualCode)
    {
        return $this->model->where('codigo', $code)->where('codigo', '!=', $ActualCode)->first();
    }

    /**
     * Obtiene todos los cantones registrados en las vías.
     *
     * @return Collection
     */
    public function getCantons()
    {
        return $this->model->select('canton')
        ->groupBy('canton')
        ->orderBy('canton')
        ->get();
    }

    /**
     * Actualizar en la BD la información de una via.
     *
     * @param array $data
     * @param GeneralCharacteristicsOfTrack $entity
     *
     * @return GeneralCharacteristicsOfTrack|null
     */
    public function updateFromArray(array $data, GeneralCharacteristicsOfTrack $entity)
    {

        if (isset($data['altermat']) && $data['altermat'] == 'on') {
            $data['altermat'] = 't';
        } else {
            $data['altermat'] = 'f';
        }
        if (isset($data['planttr']) && $data['planttr'] == 'on') {
            $data['planttr'] = 't';
        } else {
            $data['planttr'] = 'f';
        }
        if (isset($data['relleno']) && $data['relleno'] == 'on') {
            $data['relleno'] = 't';
        } else {
            $data['relleno'] = 'f';
        }
        if (isset($data['proysoc']) && $data['proysoc'] == 'on') {
            $data['proysoc'] = 't';
        } else {
            $data['proysoc'] = 'f';
        }
        if (isset($data['proyest']) && $data['proyest'] == 'on') {
            $data['proyest'] = 't';
        } else {
            $data['proyest'] = 'f';
        }
        if (isset($data['proyseg']) && $data['proyseg'] == 'on') {
            $data['proyseg'] = 't';
        } else {
            $data['proyseg'] = 'f';
        }
        if (isset($data['proypro']) && $data['proypro'] == 'on') {
            $data['proypro'] = 't';
        } else {
            $data['proypro'] = 'f';
        }
        $entity->fill($data);
        $entity->save();
        return $entity->fresh();
    }

    /**
     * Almacenar en la BD un nueva vía.
     *
     * @param array $data
     *
     * @return mixed
     */
    public function createFromArray(array $data)
    {
        $entity = new $this->model;
        if (isset($data['altermat']) && $data['altermat'] == 'on') {
            $data['altermat'] = 't';
        } else {
            $data['altermat'] = 'f';
        }
        if (isset($data['planttr']) && $data['planttr'] == 'on') {
            $data['planttr'] = 't';
        } else {
            $data['planttr'] = 'f';
        }
        if (isset($data['relleno']) && $data['relleno'] == 'on') {
            $data['relleno'] = 't';
        } else {
            $data['relleno'] = 'f';
        }
        if (isset($data['proysoc']) && $data['proysoc'] == 'on') {
            $data['proysoc'] = 't';
        } else {
            $data['proysoc'] = 'f';
        }
        if (isset($data['proyest']) && $data['proyest'] == 'on') {
            $data['proyest'] = 't';
        } else {
            $data['proyest'] = 'f';
        }
        if (isset($data['proyseg']) && $data['proyseg'] == 'on') {
            $data['proyseg'] = 't';
        } else {
            $data['proyseg'] = 'f';
        }
        if (isset($data['proypro']) && $data['proypro'] == 'on') {
            $data['proypro'] = 't';
        } else {
            $data['proypro'] = 'f';
        }
        $entity = $entity->create($data);
        return $entity->fresh();
    }

    /**
     * Generar archivo para el HDM4.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function importHdm4(Request $request)
    {
        $file = $request->file('hdm4_file')->store('images');
        $this->generalCharacteristicsOfTrackHdm4Repository->truncateTable();
        Excel::import(new RoadsExport, $file);
        File::delete($file);
        return Excel::download(new NewRoadsExport, 'newgad.xlsx');
    }

    /**
     * Obtener de la BD las parroquias según el cantón.
     *
     * @param string $name
     *
     * @return Collection
     */
    public function findByCanton(string $name)
    {
        $query = $this->model
            ->select('parroquia')
            ->groupBy('canton', 'parroquia')
            ->having('canton', '=', $name)
            ->get();

        return $query;
    }
}