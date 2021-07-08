<?php


namespace application\models;

use PDO;

class LoginModel
{
    public function SessionStart()
    {
        session_start();
    }

    public function base()
    {
        $pdo = new PDO('mysql:dbname=registeruser;host=127.0.0.1', 'root', 'root');
        return $pdo;
    }

    function GetDataAboutUser($postEmail, $pdo)
    {
        $stmt2 = $pdo->prepare('SELECT * FROM user WHERE email = :email');
        $stmt2->bindParam(':email', $postEmail);
        $stmt2->execute();
        $data = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    function CheckEmail($informationAboutUser) {
        if (isset($data[0]['email'])) {
            $check_email_In_BD =  true;
        }
        else $check_email_In_BD = false;
        return $check_email_In_BD;
    }

    function RemoveHeshing($data)
    {
        $hesh = substr($data[0]['pass'], 0, 60);
        return $hesh;
    }

    function CheckPass($informationAboutUser,$pass, $hesh){
        if(password_verify($pass, $hesh))  $check_pass_In_BD = true;
        else $check_pass_In_BD = false;
        return $check_pass_In_BD;
    }

    function getSessionId($email, $pass, $hesh, $data)
    {
        if (!empty($email) && !empty($pass)) {
            if (password_verify($pass, $hesh) && $email == $data[0]['email']) {
                $_SESSION['id_user'] = $data[0]['id_user'];
            }
            else $_SESSION['id_user'] = NULL;
        }
        return $_SESSION['id_user'];
    }
}