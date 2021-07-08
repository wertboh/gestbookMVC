<?php

namespace application\controllers;

use application\core\Controller;

class LoginController extends Controller
{
    function getView()
    {
        $this->view->generate();
    }

    function submitInfo()
    {
        $this->model->SessionStart();
        $pdo = $this->model->base();
        $informationAboutUser = $this->model->GetDataAboutUser($_POST['email'], $pdo);
        $check_email_In_BD = $this->model->CheckEmail($informationAboutUser);
        $hesh = $this->model->RemoveHeshing($informationAboutUser);
        $check_pass_In_BD = $this->model->CheckPass($informationAboutUser, $_POST['pass'], $hesh);
        $getSessionId = $this->model->getSessionId($_POST['email'], $_POST['pass'], $hesh, $informationAboutUser);
        var_dump($getSessionId);
        $chech_info = ['check_email_In_BD' => $check_email_In_BD, 'check_pass_In_BD' => $check_pass_In_BD];
        echo json_encode($chech_info);
    }
}