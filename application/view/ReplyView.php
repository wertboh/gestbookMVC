<?php

namespace application\view;

use application\core\View;

class ReplyView extends View
{
    public function generate()
    {
        include 'application/html/Reply.php';
    }
}