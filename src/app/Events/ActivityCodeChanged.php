<?php

namespace App\Events;

use App\Models\Business\Planning\ActivityProjectFiscalYear;
use Illuminate\Queue\SerializesModels;

class ActivityCodeChanged
{
    use SerializesModels;

    /**
     * @var ActivityProjectFiscalYear
     */
    public $activityProjectFiscalYear;

    /**
     * Create a new event instance.
     *
     * @param ActivityProjectFiscalYear $activityProjectFiscalYear
     */
    public function __construct(ActivityProjectFiscalYear $activityProjectFiscalYear)
    {
        $this->activityProjectFiscalYear = $activityProjectFiscalYear;
    }
}
