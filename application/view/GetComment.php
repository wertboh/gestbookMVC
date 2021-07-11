<?php
echo '<br>';
echo '<div><big>' . $firstname . ' ' . $lastname . '</big></div>';
echo '<br>';
echo '<div style="border: 2px solid deeppink; width: 1000px; border-radius: 10px; background: lightyellow; word-break: break-all;
padding-left:20px; padding-top:5px; padding-right:35px; padding-bottom:10px; ">' . $comments . '</div>';

echo '<button class="buttonMain" type="button" data-bs-toggle="collapse" data-bs-target="#collapse' . $id_comment . '" aria-expanded="false" aria-controls="collapseTwo"
               name="reply">
    Reply</button>
<div id="collapse' . $id_comment . '" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordion1">
    <div class="accordion-body">
        <form action="" method="get"><textarea rows="4" required cols="45" name="reply" placeholder="Write you comment.."
            </textarea><br>';

 echo '<input type="Submit" value="Submit" name="' . $id_comment . '">
            <input type="reset" value="Reset" name="' . $id_comment . '"></form>';
 echo '</div></div>
</div></div>';


