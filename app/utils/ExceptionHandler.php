<?php

namespace Fcmartins\Utils;

use Exception;
use Phalcon\Http\Response;

/**
 *
 * @author Francisco Martins
 * @version 1.000.000, 2022-02-3 22:59
 */
class ExceptionHandler
{
    static public function handle(Exception $exception): Response
    {
        try {
            $response = new Response();
            $response->setContent($exception->getMessage());

            return $response;
        } catch (Exception $e) {
            return new Response();
        }
    }
}