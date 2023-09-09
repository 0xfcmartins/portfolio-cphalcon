<?php

namespace Fcmartins\Plugins;

use Phalcon\Di\Injectable;
use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;

/**
 * Plugin that handles exceptions on the dispatching cycle
 *
 * @author Francisco Martins
 * @version 1.000.000, 2022-02-3 22:50
 */
class BeforeExceptionPlugin extends Injectable
{
    /**
     * TODO: Develop this plugin
     * @noinspection PhpUnusedParameterInspection
     */
    public function beforeException(
        Event      $event,
        Dispatcher $dispatcher
    ): bool
    {
        return true;
    }
}