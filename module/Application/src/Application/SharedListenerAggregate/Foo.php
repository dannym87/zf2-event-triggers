<?php

namespace Application\SharedListenerAggregate;

use Zend\EventManager\SharedEventManagerInterface;
use Application\Controller\IndexController;

class Foo
{

    /**
     * Attach one or more listeners
     * @param \Zend\EventManager\SharedEventManagerInterface $events
     */
    public function attachShared(SharedEventManagerInterface $events)
    {
        $events->attach(IndexController::EVENT_FOO, 'Bar', array($this, 'onFoo'), 100);
    }

    /**
     * Detach one or more listeners
     * @param \Zend\EventManager\SharedEventManagerInterface $events
     */
    public function detachShared(SharedEventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }

    public function onFoo($e)
    {
        return 'Foo';
    }

}
