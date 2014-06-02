<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{

    const EVENT_FOO = 'Foo';

    public function indexAction()
    {
        $this->getEventManager()->setIdentifiers(self::EVENT_FOO);
        $return = $this->getEventManager()->trigger('Bar', $this);
        return new ViewModel(array('return' => $return));
    }

}
