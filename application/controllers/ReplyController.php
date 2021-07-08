<?php

namespace application\controllers;

use application\core\Controller;

class ReplyController extends Controller
{
    function getView()
    {
        $this->view->generate();
    }
    function sessionStart(){
        $this->model->SessionStart();
        $this->model->VerificationAuthorization();
    }
    function getInfo(){
        $pdo = $this->model->base();
        $information_about_user = $this->model->getInfoAboutUser($pdo);
        return $information_about_user;
    }
    function submitComment($information_about_user, $pdo) {
        $this->model->InsertComments($_POST['comments'], $information_about_user, $pdo);
    }
    function submitReply($pdo) {
        $getChildren = $this->model->GetChildren($pdo);
        $this->model->InsertReplies($nameButtom, $information_about_user, $date, $pdo);
    }


}
