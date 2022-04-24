<?php

/**
 * Root controller and actions
 *
 * @author Francisco Martins
 * @version 1.000.000, 2021-11-8 14:30
 */
class IndexController extends ControllerBase
{
    public function indexAction()
    {
        $this->view->content = "";
    }

    public function anotherAction()
    {
        $this->view->content = "AnotherPage!";
    }

}
