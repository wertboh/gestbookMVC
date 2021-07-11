<?php

namespace application\controllers;

use application\core\Controller;
use application\models\ReplyModel;
use application\view\ReplyView;

class ReplyController extends Controller
{

    function getView()
    {
        $getChildren = $this->model->GetChildren();
        $this->view->generate();
        foreach ($getChildren as $value) {
            $this->view->getComment($value);
        }

        $pdo = $this->model->base();
        $information_about_user = $this->model->getInfoAboutUser($pdo);
        $replies = $this->model->Replies($information_about_user, $value, $pdo);
        var_dump($replies);
    foreach ($replies as $reply) {var_dump($reply);
    $this->view->getReplies($reply);
}
//        if (isset($_POST['submitbtn'])) {
////            $this->getInfo();
//        }
        return $getChildren;
    }

    function getInfo()
    {
        $pdo = $this->model->base();
        $information_about_user = $this->model->getInfoAboutUser($pdo);
        $this->submitReply($information_about_user, $pdo);
        return $information_about_user;
    }

    function submitReply($information_about_user, $pdo)
    {
        $this->model->InsertComments($_POST['comments'], $information_about_user, $pdo);
    }

    function submitComment($getChildren, $information_about_user, $pdo)
    {
        $this->model->PrintChildren($getChildren, $information_about_user, $pdo);
    }
}
