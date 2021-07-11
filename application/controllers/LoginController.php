<?php


namespace application\controllers;

use application\core\Controller;
use application\models\LoginModel;
use application\view\LoginView;

class LoginController extends Controller
{

    function getView()
    {
        $this->view->generate();
    }

    function submitInfo()
    {
        $pdo = $this->model->base();
        $informationAboutUser = $this->model->GetDataAboutUser($_POST['email'], $pdo);
        $check_email_In_BD = $this->model->CheckEmail($informationAboutUser, $_POST['email']);
        $hesh = $this->model->RemoveHeshing($informationAboutUser);
        $check_pass_In_BD = $this->model->CheckPass($_POST['pass'], $hesh);
        $this->model->getSessionId($_POST['email'], $_POST['pass'], $hesh, $informationAboutUser);
        $chech_info = ['check_email_In_BD' => $check_email_In_BD, 'check_pass_In_BD' => $check_pass_In_BD];
        echo json_encode($chech_info);

    }

}