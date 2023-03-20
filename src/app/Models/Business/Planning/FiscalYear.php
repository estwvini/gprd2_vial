<?php

namespace App\Models\Business\Planning;

use App\Models\BaseModel;
use App\Models\Business\Project;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Clase FiscalYear
 *
 * @property int year
 * @property int id
 * @package App\Models\Business\Planning
 * @mixin IdeHelperFiscalYear
 */
class FiscalYear extends BaseModel
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'fiscal_years';

    /**
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'year',
        'enabled'
    ];

    /**
     * Obtener el template de priorización para el año fiscal.
     *
     * @return HasOne
     */
    public function prioritizationTemplate()
    {
        return $this->hasOne(PrioritizationTemplate::class, 'fiscal_year_id');
    }

    /**
     * Obtiene los proyectos de un año fiscal.
     *
     * @return BelongsToMany
     */
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_fiscal_years', 'fiscal_year_id', 'project_id');
    }
}
