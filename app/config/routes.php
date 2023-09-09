<?php

use Phalcon\Mvc\Router;

$router = new Router(true);
$router->add('/ajax-cc/example', [
    'controller' => 'Ajax',
    'action' => 'example'
]);

$router->handle(
    $_SERVER["REQUEST_URI"]
);

return $router;
