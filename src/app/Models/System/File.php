<?php

namespace App\Models\System;

use App\Models\BaseModel;

/**
 * Clase File
 *
 * @package App\Models\System
 * @mixin IdeHelperFile
 */
class File extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'files';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Extensiones de archivos válidos
     */
    const EXTENSIONS_FILES = ["xls", "xlsx", "xlm", "xla", "xlc", "xlt", "xlw", "pdf"];

    /**
     * Extensión archivo tipo json
     */
    const SHAPE_FILE_EXTENSION = 'geojson';

     /**
     * Extensión archivo tipo pdf
     */
    const PDF_FILE_EXTENSION = 'pdf';
  

    /**
     * Filtro para planes
     */
    const FILTER_PLANS = [
        'Indicadores',
        'Justificaciones'
    ];

    /**
     * Filtro para planes
     */
    const FILTER_PLANS_PEI = [
        'Indicadores',
        'Justificaciones',
        'Objetivos Operativos'
    ];

    /**
     * Filtro para proyectos
     */
    const FILTER_PROJECTS = [
        'Justificaciones',
        'Indicadores',
        'Indicadores Componentes'
    ];

    /**
     * Filtro para seguimiento
     */
    const FILTER_TRACKING = [
        'Justificaciones Ajuste Presupuestario',
        'Justificaciones Avance Físico',
        'Adjuntos Reformas',
        'Adjuntos Reprogramación'
    ];

    const FILTER_ZERO = 0;
    const FILTER_ONE = 1;
    const FILTER_TWO = 2;
    const FILTER_THREE = 3;
    const FILTER_FOUR = 4;

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'version',
        'path',
        'fileable_type',
        'fileable_id',
        'is_road'
    ];

    /**
     * Obtener el usuario que subió el archivo.
     */
    public function owner()
    {
        return $this->belongsTo('App\Models\System\User', 'user_id');
    }

    /**
     * Obtener todos los modelos fileables.
     */
    public function fileable()
    {
        return $this->morphTo();
    }

    /**
     * Obtener el usuario que creó el archivo.
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}