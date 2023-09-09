<?php

use Phalcon\Config\Config;

return new Config([
    "messages" => [
        "500ISE" => "500 Internal Server Error",
        "old-browser" => 'Está a usar um navegador <strong>desatualizado!</strong> Por razões de segurança atualize '
            . 'seu navegador imediatamente!<a href="//browsehappy.com/" class="btn-link"><strong>Aqui</strong>.</a>',
        "ajax-only" => "This page can only be accessed via XMLHttpRequest <b>POST</b> request!"
    ],
    "popups" => [
        "success" => "Successful!"
    ],
    "placeholders" => [
        "form.registry.city" => "City"
    ],
    "validations" => [
        "form.registry.city.error" => "Invalid city name!"
    ],
    "config" => [
        "page_title" => "Phalcon MVC",
        "meta_title" => "Phalcon MVC clean template",
        "meta_image" => "none",
        "favicon_png" => "/assets/favicon.png",
        "favicon_ico" => "/assets/favicon.ico"
    ]
]);