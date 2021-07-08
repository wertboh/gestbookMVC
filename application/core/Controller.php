<?php

namespace application\core;

class Controller
{
    public $model;
    public $view;

    function __construct($route)
    {
        $name_model = 'application\models\\' . $route['controllers'] . 'Model';
        $name_view = 'application\view\\' . $route['controllers'] . 'View';
        $this->view = new $name_view();
        $this->model = new $name_model();
    }

    function submitInfo()
    {
    }
}