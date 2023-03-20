<?php

namespace App\Helpers;

use Monolog\Handler\LogglyHandler;
use Monolog\Logger;

class LogglyLogger
{
    public function __invoke($config) {
        $logger = new Logger(env('LOGGLY_APP_NAME'));
        $logger->pushHandler(new LogglyHandler(env('LOGGLY_API_KEY') . '/tag/' . config('services.loggly.tag'), Logger::INFO ));
        return $logger;
    }
}