<?php

namespace Fcmartins\Services;

use Phalcon\Di\Injectable;

/**
 * Application generic service
 *
 * @author Francisco Martins
 * @version 1.000.000, 2022-02-3 22:53
 */
class ApplicationService extends Injectable
{
    public function getConfig(string $key): string
    {
        return $key;
    }
}