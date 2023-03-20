<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class ProgramAreaChanged
{
    use SerializesModels;

    /**
     * @var string
     */
    public $code;

    /**
     * @var int
     */
    public $fiscalYearId;

    /**
     * Create a new event instance.
     *
     * @param string $code
     * @param int $fiscalYearId
     */
    public function __construct(string $code, int $fiscalYearId)
    {
        $this->code = $code;
        $this->fiscalYearId = $fiscalYearId;
    }
}
