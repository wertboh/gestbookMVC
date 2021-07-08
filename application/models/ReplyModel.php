<?php
//session_start();
//$date = date("d-m-Y, h:i:s");
//$indent = 10;
namespace application\models;
use PDO;
class ReplyModel
{
    public function SessionStart() {
        session_start();
    }

    function VerificationAuthorization()
    {
        if ($_SESSION['id_user'] == NULL) {
            header('Location: login');
            die();
        }
    }

    function removeRefresh($comment, $reply)
    {
        if (!empty($comment) || !empty($reply)) {
            header("Location: http://gestbookoop/reply.php");
        }
    }

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

    function GetChildren($pdo)
    {
        $stmt3 = $pdo->prepare('SELECT * FROM comment WHERE ISNULL(id_maternal)');
        $stmt3->execute();
        $getChildren = $stmt3->fetchAll(PDO::FETCH_ASSOC);
        return $getChildren;
    }

    function InsertComments($comment, $information_about_user, $pdo)
    {
        $date = date("d-m-Y, h:i:s");
        $statement2 = $pdo->prepare('INSERT INTO comment (comments, date, firstname,lastname)VALUE(:comments, :date, :firstname, :lastname)');
        $statement2->bindParam(':comments', $comment);
        $statement2->bindParam(':date', $date);
        $statement2->bindParam(':firstname', $information_about_user[0]['firstname']);
        $statement2->bindParam(':lastname', $information_about_user[0]['lastname']);
        $statement2->execute();
    }

    function InsertReplies($nameButtom, $information_about_user, $date, $pdo)
    {
        if (isset($_GET[$nameButtom])) {
            $statement1 = $pdo->prepare('INSERT INTO comment (comments, date, firstname,lastname, id_maternal)VALUE(:comments, :date, :firstname, :lastname, :id_maternal)');
            $statement1->bindParam(':comments', $_GET['reply']);
            $statement1->bindParam(':date', $date);
            $statement1->bindParam(':firstname', $information_about_user[0]['firstname']);
            $statement1->bindParam(':lastname', $information_about_user[0]['lastname']);
            $statement1->bindParam(':id_maternal', $nameButtom);
            $statement1->execute();
        }
        return $this->NameButton(0, $information_about_user, $date);
    }

    function Replies($information_about_user, $date, $comment, $indent, $pdo)
    {
        $stmt2 = $pdo->prepare('SELECT * FROM comment WHERE  id_maternal = :id_comment');
        $stmt2->bindParam(':id_comment', $comment['id_comment']);
        $stmt2->execute();
        $replies = $stmt2->fetchAll(PDO::FETCH_ASSOC);

        echo '<br><div style="margin-left:' . $indent . ';"><big>' . $comment['firstname'] . ' ' . $comment['lastname'] . '</big>' . ' ' . '<small>' . $comment['date'] . '</small></div>'
            . '<br><div style="margin-left:' . $indent . ';border: 2px solid deeppink; width: 1000px; border-radius: 10px; background: lightyellow; word-break: break-all;
padding-left:20px; padding-top:5px; padding-right:35px; padding-bottom:10px; ">' . $comment['comments'] . '</div>';

        echo '<button class="buttonMain" type="button" data-bs-toggle="collapse" data-bs-target="#collapse' . $comment['id_comment'] . '" aria-expanded="false" aria-controls="collapseTwo"
style="margin-left:' . $indent . 'px;" name="reply">
            Reply</button>';
        echo '<div id="collapse' . $comment['id_comment'] . '" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordion1">
      <div class="accordion-body">
      <form action="" method="get"><textarea rows="4" required cols="45" name="reply" placeholder="Write you comment.." style="margin-left:' . $indent .
            '"></textarea><br>';

        echo '<input type="Submit" value="Submit" name="' . $comment['id_comment'] . '" style="margin-left:' . $indent . '">
<input type="reset" value="Reset" name="' . $comment['id_comment'] . '"></form>';
        echo '</div>
    </div>';
        echo '</div></div>';

        $this->InsertReplies($comment['id_comment'], $information_about_user, $date);

        foreach ($replies as $item) {
            $this->Replies($information_about_user, $date, $item, $indent + 40);
        }
    }


    function PrintChildren($getChildren, $information_about_user, $date, $indent)
    {
        foreach ($getChildren as $GETchildren) {
            $this->Replies($information_about_user, $date, $GETchildren, $indent);
        }
    }
}

$reply = new Reply();
$reply->VerificationAuthorization();
$reply->removeRefresh($_POST['comments'], $_GET['reply']);
$reply->includeHTML();
$information_about_user = $reply->getInfoAboutUser();
$getChildren = $reply->GetChildren();
$reply->InsertComments($_POST['comments'], $information_about_user);
$reply->PrintChildren($getChildren, $information_about_user, $date, $indent);
