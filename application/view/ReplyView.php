<?php

namespace application\view;

use application\core\View;

class ReplyView extends View
{
    public function generate()
    {
        include 'application/html/Reply.php';
    }

    public function getComment($value)
    {
        extract($value);
        ob_start();
        include 'application/view/GetComment.php';
        $value = ob_get_contents();
    }
}