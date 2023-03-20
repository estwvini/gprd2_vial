<?php

namespace App\Models\Business\Library;

use Illuminate\Database\Eloquent\Model;

/**
 * Clase Document
 *
 * @package App\Models\Business\Library
 * @mixin IdeHelperDocument
 */
class Document extends Model
{
    /**
     * @var string
     */
    protected $table = 'library_document';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'code',
        'name',
        'description',
        'type',
        'path'
    ];

     /**
     * Maximo tamaño para subir archivos (bytes)
     */
    const MAX_SIZE_UPLOAD = 10485760;

    /**
     * Maximo tamaño para subir archivos (bytes)
     */
    const STRING_MAX_SIZE_UPLOAD = '10 Mb';

     /**
     * tipo de archivo pdf
     */
    const EXTENSION_PDF = 'pdf';

}
