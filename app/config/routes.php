<?php

use Phalcon\Mvc\Router;

$router = new Router(false);
$router->add('/ajax-cc/example', [
    'controller' => 'Ajax',
    'action' => 'example'
]);
$router->handle();

return $router;
