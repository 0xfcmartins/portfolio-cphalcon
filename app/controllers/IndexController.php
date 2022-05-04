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
        try {

            $this->view->innerText = "Francisco Martins";
        } catch (Exception $e) {

            return parent::HandleException(__CLASS__, __FUNCTION__, $e);
        }
    }

    public function anotherAction()
    {
        try {

            $this->view->innerText = "AnotherPage";
        } catch (Exception $e) {

            return parent::HandleException(__CLASS__, __FUNCTION__, $e);
        }
    }

}
