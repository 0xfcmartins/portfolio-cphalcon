<?php

namespace Fcmartins\Services;

use Phalcon\Events\Manager;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Url;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Volt;
use Phalcon\Session\Manager as Session;
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

    public function initDispatcher(): Dispatcher
    {
        $eventsManager = new Manager();
        $dispatcher = new Dispatcher();
        $dispatcher->setEventsManager($eventsManager);

        return $dispatcher;
    }

    protected function initBaseUrl()
    {
        return $this->getConfig()->application->baseUri;
    }

    public function initUrl(): Url
    {
        $url = new Url();
        $url->setBaseUri(
            $this->getConfig()->domain
        );

        return $url;
    }

    public function initView(): View
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


    public function initSession(): Session
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

}