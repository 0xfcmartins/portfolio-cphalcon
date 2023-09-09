<?php

namespace Fcmartins\Services\Core;

use Phalcon\Autoload\Loader;
use Phalcon\Config\Adapter\Json as JsonConfig;

/**
 * Application configurations loader
 *
 * @author Francisco Martins
 * @version 1.000.000, 2021-11-8 12:20
 */
class ApplicationLoader
{
    /**
     * Registers the project directories and namespaces
     *
     * @param $baseConfig JsonConfig Base configuration
     */
    public static function register(JsonConfig $baseConfig): void
    {
        $loader = new Loader();
        $loader->setDirectories(
            [
                $baseConfig->application->controllersDir
            ]
        );

        if (isset($baseConfig->namespaces))
            $loader->setNamespaces($baseConfig->namespaces->toArray());

        $loader->register();
    }

}