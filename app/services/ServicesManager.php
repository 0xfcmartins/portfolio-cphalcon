<?php

namespace Fcmartins\Services;

use Fcmartins\Plugins\BeforeExceptionPlugin;
use Fcmartins\Plugins\NotFoundPlugin;
use Phalcon\Events\Manager;
use Phalcon\Session\Manager as Session;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Url;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Volt;
use Phalcon\Session\Adapter\Stream;
use Fcmartins\Services\Core\DependencyInjector;
use Fcmartins\Utils\Translator;

/**
 * Application dependencies injector manager
 *
 * @author Francisco Martins
 * @version 1.000.000, 2021-11-8 13:47
 */
class ServicesManager extends DependencyInjector
{

    protected function initDispatcher(): Dispatcher
    {
        $eventsManager = new Manager();
        $eventsManager->attach('dispatch:beforeException', new BeforeExceptionPlugin());
        $eventsManager->attach('dispatch:beforeExecuteRoute', new NotFoundPlugin());
        //$eventsManager->attach('dispatch:beforeExecuteRoute', new SecurityPlugin());

        $dispatcher = new Dispatcher();
        $dispatcher->setEventsManager($eventsManager);

        var_dump($dispatcher->getControllerName());
        var_dump($dispatcher->getActionName());

        return $dispatcher;
    }

    protected function initBaseUrl()
    {
        return $this->getConfig()->application->baseUri;
    }

    protected function initUrl(): Url
    {
        $url = new Url();
        $url->setBaseUri(
            $this->getConfig()->domain
        );

        return $url;
    }

    protected function initView(): View
    {
        $view = new View();
        $view->setViewsDir($this->getConfig()->application->viewsDir);
        $view->registerEngines(
            [
                '.volt' => 'volt',
            ]
        );

        return $view;
    }

    protected function initVolt($view): Volt
    {
        $volt = new Volt($view, $this);
        $volt->setOptions([
            'always' => $this->getConfig()->system->volt->compile,
            'extension' => $this->getConfig()->system->volt->extension,
            'separator' => $this->getConfig()->system->volt->separator,
            'stat' => $this->getConfig()->system->volt->stat,
            'path' => $this->getConfig()->system->volt->voltCache
        ]);

        return $volt;
    }

    protected function initSession(): Session
    {
        $session = new Session();
        $files = new Stream(
            [
                'savePath' => '/tmp',
            ]
        );
        $session->setAdapter($files);
        $session->start();

        return $session;
    }

    protected function initTranslator(): Translator
    {
        return new Translator();
    }

    protected function initApp(): ApplicationService
    {
        return new ApplicationService();
    }

    protected function initRouter()
    {
        var_dump(APP_PATH . 'app/config/routes.php');

        return require APP_PATH . 'app/config/routes.php';
    }

}