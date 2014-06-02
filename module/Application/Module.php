<?php

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Application\SharedListenerAggregate\Foo;
use Application\SharedListenerAggregate\Bar;

class Module
{

    public function onBootstrap(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        // attach foo listener
        $fooListener = new Foo();
        $fooListener->attachShared($eventManager->getSharedManager());
        // attach bar listener
        $barListener = new Bar();
        $barListener->attachShared($eventManager->getSharedManager());
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

}
