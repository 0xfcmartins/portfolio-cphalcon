<?php

use Phalcon\Http\Response;
use Phalcon\Mvc\Controller;
use Phalcon\Url;
use Phalcon\Mvc\View;
use Phalcon\Session\Manager;
use Fcmartins\Exceptions\Security\AccessException;
use Fcmartins\Utils\Translator;

/**
 * Base controller that should only include generic methods
 *
 * @property Manager $session Application session adapter
 * @property Url $url Application url adapter
 * @property View $view Application view adapter
 * @property Translator $translator Application translator utils as a service
 *
 * @author Francisco Martins
 * @version 1.000.000, 2021-11-8 14:21
 */
class ControllerBase extends Controller
{

    public function initialize(): void
    {
        $this->view->page_title = $this->translator->getConfig("page_title");
        $this->view->meta_title = $this->translator->getConfig("meta_title");
        $this->view->meta_image = $this->translator->getConfig("meta_image");

        $headerCollection = $this->assets->collection('header');
        $headerCollection->addCss('/css/background.css');
        //$headerCollection->addJs('/js/generic/background.js');
        $headerCollection->addJs('/js/generic/test.js');
    }

    /**
     * Defines that an action can only be accesed via XMLHttpRequest POST
     *
     * @throws AccessException
     */
    public function SetAjaxOnly(): void
    {
        $this->view->disable();
        if (!$this->request->isAjax() || $this->request->isGet()) {

            throw new AccessException($this->translator->getMessage("ajax-only"));
        }
    }

    /**
     * Handles actions generic exceptions
     *
     * @param string $controller Controller name
     * @param string $action Action name
     * @param Exception $e Exception thrown
     * @return Response Built response to be sent
     */
    public function HandleException(string $controller, string $action, Exception $e): Response
    {
        $this->logger->error($controller, $action, $e->getMessage(), $e->getTrace());

        if ($this->request->isAjax()) {
            $this->logger->ajaxResponseErrorLog($e->getMessage());

            $content = 'Internal Server Error!';
            $statusCode = 500;
            $statusDesc = "Internal Server Error!";
            $contentType = "text/plain";

            return self::response($content, $statusCode, $statusDesc, $contentType);
        }
        $this->dispatcher->forward(['controller' => 'Errors', 'action' => 'show500']);

        return $this->response;
    }

    /**
     * Creates a Http response object
     *
     * @param string $body Response content
     * @param int $sc Status code, 200 as Default value
     * @param string $des Status descrition, 'Ok' as Default value
     * @param string $ct Content type, 'application/json' as Default value
     * @param array $h Aditicional headers
     * @return Response Response object
     */
    protected static function response(
        string $body, int $sc = 200, string $des = 'Ok', string $ct = 'application/json', array $h = array()
    ): Response
    {
        $response = new Response();
        $response->setStatusCode($sc, $des);
        $response->setContentType($ct, 'UTF-8');
        $response->setContent($body);
        foreach ($h as $key => $value) {
            $response->setHeader($key, $value);
        }

        return $response;
    }

}
