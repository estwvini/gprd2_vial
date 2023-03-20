<?php

namespace App\Models\Business\Planning;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;

/**
 * Clase Prioritization
 *
 * @property string configuration
 * @property float value
 * @property ProjectFiscalYear projectFiscalYear
 * @property Collection budgetAdjustments
 * @package App\Models\Business\Planning
 * @mixin IdeHelperPrioritization
 */
class Prioritization extends BaseModel
{
    // Prioritization actions
    const ACTION_CREATE = 'CREATE';
    const ACTION_EDIT = 'EDIT';
    const ACTION_SHOW = 'SHOW';

    protected $table = 'prioritizations';

    public $timestamps = true;

    protected $fillable = [
        'project_fiscal_year_id',
        'configuration',
        'value'
    ];

    /**
     * Obtener el proyecto en su año fiscal.
     *
     * @return BelongsTo
     */
    public function projectFiscalYear()
    {
        return $this->belongsTo(ProjectFiscalYear::class, 'project_fiscal_year_id');
    }

    /**
     * Obtener la configuración de la priorización.
     *
     * @return array|mixed
     */
    public function configuration()
    {
        return json_decode($this->configuration, true) ?? [];
    }

    /**
     * Obtener los ajustes presupuestarios.
     *
     * @return array|mixed
     */
    public function budgetAdjustments()
    {
        return $this->hasMany(BudgetAdjustment::class, 'prioritization_id');
    }
}
