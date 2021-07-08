<?php

namespace application\controllers;


use application\core\Controller;
use application\models\RegisterModel;
use application\view\RegisterView;

class  RegisterController extends Controller
{
    function getView()
    {
        $this->view->generate();
    }

    function submitInfo()
    {
        $pdo = $this->model->base();
        $hash = $this->model->Hashing($_POST['pass']);
        $dublication_login = $this->model->CheckDublicationLogin($pdo, $_POST['login']);
        $dublication_email = $this->model->CheckDublicationEmail($pdo, $_POST['email']);
        $this->model->InsertUser($_POST['login'], $_POST['email'], $hash, $_POST['firstname'], $_POST['lastname'],
            $_POST['phnumber'], $pdo, $dublication_login, $dublication_email);
        $dublication = ['dublication_login' => $dublication_login, 'dublication_email' => $dublication_email];
        echo json_encode($dublication);
    }

}



