<?php

namespace App\Models\Business\Planning;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Clase PrioritizationTemplate
 *
 * @property string description
 * @property string configuration
 * @property string status
 * @property PrioritizationTemplate parentTemplate
 * @property FiscalYear fiscalYear
 * @package App\Models\Business\Planning
 * @mixin IdeHelperPrioritizationTemplate
 */
class PrioritizationTemplate extends BaseModel
{
    // Prioritization Template statuses
    public const STATUS_DEFAULT = 'DEFAULT';
    public const STATUS_ENABLED = 'ENABLED';
    public const STATUS_BLOCKED = 'BLOCKED';

    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'prioritization_templates';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id',
        'fiscal_year_id',
        'description',
        'configuration',
        'status'
    ];

    /**
     * Obtener el template original del que se copiaron los valores.
     *
     * @return BelongsTo
     */
    public function parentTemplate()
    {
        return $this->belongsTo(PrioritizationTemplate::class, 'parent_id');
    }

    /**
     * Obtener el año fiscal al que pertenece el template de priorización.
     *
     * @return BelongsTo
     */
    public function fiscalYear()
    {
        return $this->belongsTo(FiscalYear::class, 'fiscal_year_id');
    }

    /**
     * Obtener los ámbitos del template de priorización.
     *
     * @return array
     */
    public function areas(): array
    {
        $configuration = json_decode($this->configuration);

        $configuration = collect($configuration)->sortBy(function ($scope, $key) {
            return count($scope->criteria);
        })->toArray();

        return $configuration ?? [];
    }
}
