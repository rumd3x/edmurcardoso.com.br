<?php
namespace EasyRest\System;

final class TimeTracker
{
    /**
     * @var float
     */
    private $start;

    /**
     * @SuppressWarnings(PHPMD.Superglobals)
     * @param float $ts
     */
    public function __construct(float $ts = null)
    {
        $this->start = isset($_SERVER['REQUEST_TIME_FLOAT']) ? $_SERVER['REQUEST_TIME_FLOAT'] : microtime(true);
        if ($ts) {
            $this->start = $ts;
        }
    }
    /**
     * Get Elapsed time since object creation in float
     *
     * @return float
     */
    public function getElapsed()
    {
        return microtime(true) - $this->start;
    }
}
