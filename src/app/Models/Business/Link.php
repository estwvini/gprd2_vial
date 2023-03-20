<?php

namespace App\Models\Business;

use App\Models\BaseModel;

/**
 * Clase Link
 *
 * @package App\Models\Business
 * @mixin IdeHelperLink
 */
class Link extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'links';

    /**
     * @var bool
     */
    public $timestamps = false;


    /**
     * @var array
     */
    protected $fillable = [
        'parent_element',
        'child_element'
    ];

}
