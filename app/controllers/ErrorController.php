<?php

use Phalcon\Http\Response;

class ErrorController extends ControllerBase
{

    public function show404Action(): Response
    {
        try {

            return parent::response('{"success":true}');
        } catch (Exception $e) {

            return parent::HandleException(__CLASS__, __FUNCTION__, $e);
        }
    }

}