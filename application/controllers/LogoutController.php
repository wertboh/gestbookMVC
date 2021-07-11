<?php

namespace application\controllers;

use application\core\Controller;

class LogoutController extends Controller
{
    function getView()
    {
        $this->view->generate();
    }

    function getLogout()
    {
        $this->model->LogOut();
    }

}