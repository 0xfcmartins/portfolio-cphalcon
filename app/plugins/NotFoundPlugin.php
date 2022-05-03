<?php

use Phalcon\Di\Injectable;
use Phalcon\Dispatcher\Exception;
use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;

/**
 * Plugin that handles unhandled routes
 *
 * @author Francisco Martins
 * @version 1.000.000, 2022-01-20 22:38
 */
class NotFoundPlugin extends Injectable
{

    public function beforeException(Event $event, Dispatcher $dispatcher, Exception $exception): bool
    {
        error_log($event->getSource(), $exception->getMessage() . PHP_EOL . $exception->getTraceAsString());
        switch ($exception->getCode()) {
            case Exception::EXCEPTION_HANDLER_NOT_FOUND:
            case Exception::EXCEPTION_ACTION_NOT_FOUND:
                $dispatcher->forward(
                    [
                        'controller' => 'Errors',
                        'action' => 'show404'
                    ]
                );
                return false;
        }
        $dispatcher->forward(
            [
                'controller' => 'Errors',
                'action' => 'show500'
            ]
        );

        return false;
    }
}
