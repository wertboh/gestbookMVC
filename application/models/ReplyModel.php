<?php
//session_start();
//$date = date("d-m-Y, h:i:s");
//$indent = 10;
namespace application\models;
use PDO;
class ReplyModel
{

public $array = [];
    function VerificationAuthorization()
    {
        session_start();
        if ($_SESSION['id_user'] == NULL) {
            header('Location: login');
            die();
        }
    }
//
//    function removeRefresh($comment, $reply)
//    {
//        if (!empty($comment) || !empty($reply)) {
//            header("Location: http://gestbookoop/reply.php");
//        }
//    }

    public function base()
    {
        $pdo = new PDO('mysql:dbname=registeruser;host=127.0.0.1', 'root', 'root');
        return $pdo;
    }

    function getInfoAboutUser($pdo)
    {
        $stmt = $pdo->prepare('SELECT * FROM user WHERE id_user = :id_user');
        $stmt->bindParam(':id_user', $_SESSION['id_user']);
        $stmt->execute();
        $information_about_user = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $information_about_user;
    }

    function GetChildren()
    {
        $pdo = new PDO('mysql:dbname=registeruser;host=127.0.0.1', 'root', 'root');
        $stmt3 = $pdo->prepare('SELECT * FROM comment WHERE ISNULL(id_maternal)');
        $stmt3->execute();
        $getChildren = $stmt3->fetchAll(PDO::FETCH_ASSOC);
        return $getChildren;
    }


     public function InsertComments($comment, $information_about_user, $pdo)
    {
        $date = date("d-m-Y, h:i:s");
        $statement2 = $pdo->prepare('INSERT INTO comment (comments, date, firstname,lastname)VALUE(:comments, :date, :firstname, :lastname)');
        $statement2->bindParam(':comments', $comment);
        $statement2->bindParam(':date', $date);
        $statement2->bindParam(':firstname', $information_about_user[0]['firstname']);
        $statement2->bindParam(':lastname', $information_about_user[0]['lastname']);
        $statement2->execute();
    }


    public function InsertReplies($nameButtom, $information_about_user, $pdo)
    {
        if (isset($_GET[$nameButtom])) {
            $statement1 = $pdo->prepare('INSERT INTO comment (comments, date, firstname,lastname, id_maternal)VALUE(:comments, :date, :firstname, :lastname, :id_maternal)');
            $statement1->bindParam(':comments', $_GET['reply']);
//            $statement1->bindParam(':date', $date);
            $statement1->bindParam(':firstname', $information_about_user[0]['firstname']);
            $statement1->bindParam(':lastname', $information_about_user[0]['lastname']);
            $statement1->bindParam(':id_maternal', $nameButtom);
            $statement1->execute();
        }
    }

    public function Replies($information_about_user, $comment,$pdo, $array)
    {
        $stmt2 = $pdo->prepare('SELECT * FROM comment WHERE  id_maternal = :id_comment');
        $stmt2->bindParam(':id_comment', $comment['id_comment']);
        $stmt2->execute();
        $replies = $stmt2->fetchAll(PDO::FETCH_ASSOC);
//        echo $comment['comments'];
        $this->InsertReplies($comment['id_comment'], $information_about_user,  $pdo);

        foreach ($replies as $item) {
            $array = [$item];
            $this->Replies($information_about_user, $item, $pdo, $array);
        }
        return $array;
    }

    public function PrintChildren($getChildren, $information_about_user, $pdo, $array)
    {
        foreach ($getChildren as $key => $GETchildren) {
            $array = [$GETchildren];
            $this->Replies( $information_about_user, $GETchildren, $pdo, $array);
        }
        return $array;
    }
}

