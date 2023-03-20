<?php

namespace App\Models\Business;

use App\Models\BaseModel;
use App\Models\Business\Planning\ProjectFiscalYear;
use App\Models\System\File;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Clase Reprogramming
 *
 * @property ProjectFiscalYear projectFiscalYear
 * @property string status
 * @property string created_at
 * @property string approved_date
 * @package App\Models\Business
 * @mixin IdeHelperReprogramming
 */
class Reprogramming extends BaseModel
{

    const STATUS_DRAFT = 'DRAFT';
    const STATUS_APPROVED = 'APPROVED';

    /**
     * @var string
     */
    protected $table = 'reprogramming';

    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'code',
        'description',
        'status',
        'approved_date',
        'project_fiscal_year_id'
    ];

    /**
     * Obtiene año fiscal del proyecto
     *
     * @return BelongsTo
     */
    public function projectFiscalYear()
    {
        return $this->belongsTo(ProjectFiscalYear::class, 'project_fiscal_year_id');
    }

    /**
     * Obtener los archivos de una reprogramación.
     *
     * @return MorphMany
     */
    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    /**
     * Obtener el archivo de una reprogramación.
     *
     * @return MorphMany
     */
    public function file()
    {
        return $this->files()->first();
    }
}
