<?php

namespace application\controllers;

use application\core\Controller;

class ReplyController extends Controller
{

    function getView()
    {
        $this->model->VerificationAuthorization();
        $this->view->generate();
        $this->getComment();
    }
    function getComment() {
        $pdo = $this->model->base();
        $getChildren = $this->model->GetChildren();
        $information_about_user = $this->model->getInfoAboutUser($pdo);
        $this->model->PrintChildren($getChildren, $information_about_user, $pdo, 10);
        $array = $this->model->getComment();
        foreach ($array as $value) {
            $this->view->getComment($value);
        }

        if (isset($_POST['submitbtn'])) {
            $this->submitReply($information_about_user, $pdo);
        }
    }
    function InsertReplies() {
        $this->model->InsertReplies();
    }

    function submitReply($information_about_user, $pdo)
    {
        $this->model->InsertComments($_POST['comments'], $information_about_user, $pdo);
    }
}
