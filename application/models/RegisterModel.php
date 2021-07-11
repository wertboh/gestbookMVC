<?php

namespace application\models;

use PDO;

class RegisterModel

{
    public function base()
    {
        $pdo = new PDO('mysql:dbname=registeruser;host=127.0.0.1', 'root', 'root');
        return $pdo;
    }

    public function Hashing($pass)
    {
        $hash = password_hash($pass, PASSWORD_BCRYPT);
        return $hash;
    }

    public function CheckDublicationLogin($pdo, $login)
    {
        $stmt = $pdo->prepare('SELECT * FROM user WHERE login = :login');
        $stmt->bindParam(':login', $login);
        $stmt->execute();
        $check_dublication_login = $stmt->rowCount();

        if ($check_dublication_login > 0) {
            $dublication_login = true;
        } else $dublication_login = false;
        return $dublication_login;
    }

    public function CheckDublicationEmail($pdo, $email)
    {
        $stmt = $pdo->prepare('SELECT * FROM user WHERE email = :email ');
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $check_dublication_email = $stmt->rowCount();

        if ($check_dublication_email > 0) {
            $dublication_email = true;
        } else $dublication_email = false;
        return $dublication_email;
    }

    public function InsertUser($login, $email, $hash, $firstname, $lastname, $phnumber, $pdo, $dublication_login, $dublication_email)
    {
        if ($dublication_login != true) {
            if ($dublication_email != true) {
                $stmt = $pdo->prepare('INSERT INTO user (login, email, pass, firstname, lastname, phnumber)VALUE(:login, :email, :pass, :firstname,:lastname, :phnumber )');
                $stmt->bindParam(':login', $login);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':pass', $hash);
                $stmt->bindParam(':firstname', $firstname);
                $stmt->bindParam(':lastname', $lastname);
                $stmt->bindParam(':phnumber', $phnumber);
                $stmt->execute();
            }
        }
    }
}

