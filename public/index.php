<?php

error_reporting(E_ALL);

define('APP_PATH', realpath('..') . '/');

use Phalcon\Mvc\Application;
use Phalcon\Config\Adapter\Json as JsonConfig;

use Fcmartins\Services\Core\ApplicationLoader;
use Fcmartins\Services\ServicesManager;

/**
 * Phalcon's application bootstrap
 *
 * @author Francisco Martins
 * @version 1.000.000, 2022-02-3 22:42
 */
try {
    include APP_PATH . "app/services/core/ApplicationLoader.php";
    $config = new JsonConfig(APP_PATH . "app/config/config.json");

    ApplicationLoader::register($config);

    $application = new Application();
    $application->setDI(new ServicesManager($config));
    $application->handle("/")->send();
} catch (Exception $e) {
    echo $e->getMessage();
}
