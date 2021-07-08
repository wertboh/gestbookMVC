<?php

namespace application\core;

use application\controllers\RegisterController;

use application\controllers\LoginController;

class Route
{
    private $path_routes = [
        'register' => [
            'controllers' => 'register',
            'action' => 'getView'
        ],
        'register/register' => [
            'controllers' => 'register',
            'action' => 'submitInfo'
        ],
        'login' => [
            'controllers' => 'login',
            'action' => 'getView'
        ],
        'login/login' => [
            'controllers' => 'login',
            'action' => 'submitInfo'
        ],
        'reply' => [
            'controllers' => 'reply',
            'action' => 'getView'
        ],
        'reply/submit_comment' => [
            'controllers' => 'reply',
            'action' => 'submitComment'
        ],
        'reply/reply' => [
            'controllers' => 'reply',
            'action' => 'getInfo'
        ],
        'reply/id' =>[
            'controllers' => 'reply',
            'action' => 'sessionStart'
        ]
    ];

    static function start()
    {
        $uri = explode('/', $_SERVER['REQUEST_URI']);
        if (!empty($uri[1])) {
            $path = $uri[1];
        }

        if (!empty($uri[2])) {
            $path = $uri[1] . '/' . $uri[2];
        }
        return $path;
    }

    public function path_route()
    {
        if ($this->start()) {
            $path = $this->start();
            foreach ($this->path_routes as $key => $value) {
                if ($key == $path) {
                    $name_controller = 'application\controllers' . '\\' . ucfirst($value['controllers']) . 'Controller';
                    $name_action = $value['action'];
                    $controllers = new $name_controller($value);
                    $controllers->$name_action();
                }
            }
        }

    }
}

