<?php

use Phalcon\Http\Response;
use Fcmartins\Exceptions\Security\AccessException;

/**
 * Example controller that defines an ajax access only component
 */
class AjaxController extends ControllerBase
{
    /**
     * Defines that this controller can only access via Ajax POST requests
     *
     * @throws AccessException This component has been accessed without an XMLHttpRequest object
     */
    public function initialize(): void
    {
        parent::initialize();
        parent::SetAjaxOnly();
    }

    /**
     * Basic example
     *
     * @return Response Response built
     */
    public function exampleAction(): Response
    {
        try {

            return parent::response('{"success":true}');
        } catch (Exception $e) {

            return parent::HandleException(__CLASS__, __FUNCTION__, $e);
        }
    }

}