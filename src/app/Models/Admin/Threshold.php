<?php

namespace App\Models\Admin;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Clase Threshold (Umbral)
 *
 * @package App\Models\Admin
 * @mixin IdeHelperThreshold
 */
class Threshold extends BaseModel
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'thresholds';

    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'type',
        'color',
        'min',
        'max'
    ];
}
