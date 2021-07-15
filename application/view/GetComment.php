<?php

echo '<div class="accordion" id="accordionExample">
    <div class="accordion-item">';
echo '<br><div style="margin-left:' . $indent . ';"><big>' . $firstname . ' ' . $lastname . '</big>' . ' ' . '<small>' . $date . '</small></div>'
    . '<br><div style="margin-left:' . $indent . ';border: 2px solid deeppink; width: 1000px; border-radius: 10px; background: lightyellow; word-break: break-all;
padding-left:20px; padding-top:5px; padding-right:35px; padding-bottom:10px; ">' . $comments . '</div>';

echo '<button class="buttonMain" type="button" data-bs-toggle="collapse" data-bs-target="#collapse' . $id_comment . '" aria-expanded="false" aria-controls="collapseTwo"
style="margin-left:' . $indent . 'px;" name="reply">
            Reply</button>';
echo '<div id="collapse' . $id_comment . '" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordion1">
      <div class="accordion-body">
      <form action="" method="get"><textarea rows="4" required cols="45" name="reply" placeholder="Write you comment.." style="margin-left:' . $indent .
    '"></textarea><br>';

echo '<input type="button" value="Submit" id="' . $id_comment . '" name="' . $id_comment . '" style="margin-left:' . $indent . '">
<input type="reset" value="Reset" name="' . $id_comment . '"></form>';
echo '</div>
    </div>';
echo '</div></div>';



