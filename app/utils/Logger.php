<?php

namespace Fcmartins\Utils;

use Phalcon\Logger\Adapter\Stream;
use Phalcon\Logger\LoggerFactory;
use Phalcon\Logger\AdapterFactory;

class Logger
{

    public static function write($message)
    {
        $adapters = [
            "main" => new Stream("/storage/logs/main.log"),
            "admin" => new Stream("/storage/logs/admin.log"),
        ];

        $adapterFactory = new AdapterFactory();
        $loggerFactory = new LoggerFactory($adapterFactory);

        $logger = $loggerFactory->newInstance('prod-logger', $adapters);
    }
}