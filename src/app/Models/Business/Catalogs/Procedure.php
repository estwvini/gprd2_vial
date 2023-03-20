<?php

namespace App\Models\Business\Catalogs;

use App\Models\BaseModel;

/**
 * Clase Procedure
 *
 * @package App
 * @property string name
 * @mixin IdeHelperProcedure
 */
class Procedure extends BaseModel
{

    const ELECTRONIC_CATALOG_ID = 1;

    /**
     * @var string
     */
    protected $table = 'procedures';

    /**
     * @var bool
     */
    public $timestamps = false;
}
