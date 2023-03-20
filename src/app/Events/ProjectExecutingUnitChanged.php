<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class ProjectExecutingUnitChanged
{
    use SerializesModels;

    /**
     * @var string
     */
    public $code;

    /**
     * @var int
     */
    public $projectFiscalYearId;

    /**
     * Create a new event instance.
     *
     * @param string $code
     * @param int $projectFiscalYearId
     */
    public function __construct(string $code, int $projectFiscalYearId)
    {
        $this->code = $code;
        $this->projectFiscalYearId = $projectFiscalYearId;
    }
}
