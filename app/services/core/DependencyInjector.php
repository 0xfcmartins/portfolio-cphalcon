<?php

namespace Fcmartins\Services\Core;

use Phalcon\Config\Config;
use Phalcon\DI\FactoryDefault;
use ReflectionObject;

/**
 * {@link \Phalcon\DI} Declaration adapter
 *
 * @author Francisco Martins
 * @version 1.000.000, 2021-11-5 16:51
 */
class DependencyInjector extends FactoryDefault
{

    public function __construct($baseConfig)
    {
        parent::__construct();
        $this->setShared('config', $baseConfig);
        $this->bindServices();
    }

    /**
     * @return Config config object
     */
    protected function getConfig(): Config
    {
        return $this->get('config');
    }

    /**
     * Bind all the declared services
     */
    protected function bindServices(): void
    {
        $reflection = new ReflectionObject($this);
        $methods = $reflection->getMethods();

        foreach ($methods as $method) {

            if ((strlen($method->name) > 10) && (str_starts_with($method->name, 'initShared'))) {
                $this->setShared(lcfirst(substr($method->name, 10)), $method->getClosure($this));
            }

            if ((strlen($method->name) > 4) && (str_starts_with($method->name, 'init'))) {
                $this->set(lcfirst(substr($method->name, 4)), $method->getClosure($this));
            }
        }
    }

}