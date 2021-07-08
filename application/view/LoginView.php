<?php

namespace application\view;

use application\core\View;

class LoginView extends View
{
    public function generate()
    {
        include 'application/html/Login.php';
    }
}