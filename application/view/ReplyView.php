<?php

namespace application\view;

use application\controllers\ReplyController;
use application\core\View;
use application\models\ReplyModel;

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
    public  function getReplies($reply) {
        var_dump($reply);
        extract($reply);
        ob_start();
        include 'application/view/GetComment.php';
        $reply = ob_get_contents();
    }
}