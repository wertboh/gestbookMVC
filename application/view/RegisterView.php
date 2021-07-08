<?php

namespace application\view;

use application\core\View;

class RegisterView extends View
{
    public function generate()
    {
        include 'application/html/Register.php';
    }
}