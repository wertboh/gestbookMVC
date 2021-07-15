<?php

namespace application\controllers;

use application\core\Controller;
use application\models\ReplyModel;
use application\view\ReplyView;

class ReplyController extends Controller
{

    function getView()
    {
//        $getChildren = $this->model->GetChildren();
        $this->view->generate();

//        foreach ($getChildren as $value) {
//            $this->view->getComment($value);
//        }
//        $pdo = $this->model->base();
//        $information_about_user = $this->model->getInfoAboutUser($pdo);
//        $this->model->PrintChildren($getChildren, $information_about_user, $pdo, 0);

//        $array = $this->model->getComment();


//        foreach ($array as $value) {
//            $this->view->getComment($value);
//        }
//
//        if (isset($_POST['submitbtn'])) {
//            $this->getInfo();
//        }
        $this->getComment();
    }
    function getComment() {
        $pdo = $this->model->base();
        $getChildren = $this->model->GetChildren($pdo);
        $information_about_user = $this->model->getInfoAboutUser($pdo);
        $this->model->PrintChildren($getChildren, $information_about_user, $pdo, 0);
        $array = $this->model->getComment();
        foreach ($array as $value) {
            $this->view->getComment($value);
        }

        if (isset($_POST['submitbtn'])) {
            $this->getInfo();
        }
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
        $this->model->PrintChildren($getChildren, $information_about_user, $pdo, 0);
    }
}
