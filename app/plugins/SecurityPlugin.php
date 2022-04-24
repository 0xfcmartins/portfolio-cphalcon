<?php

use Phalcon\Di\Injectable;
use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;

/**
 *  Plugin that validates the session access to certain component
 *
 * @author Francisco Martins
 * @version 1.000.000, 2022-02-3 22:52
 */
class SecurityPlugin extends Injectable
{

    const ROLE = "GENERIC.APPLICATION.USER";

    /**
     * TODO: Develop this plugin
     * @noinspection PhpUnusedParameterInspection
     */
    public function beforeDispatch(
        Event      $event,
        Dispatcher $dispatcher
    ): bool
    {
        return true;
    }

}
