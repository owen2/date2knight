<?php

if (Settings::isPollOpen())
{
    ?><h2>Take the survey</h2>
    <form id="quiz" action="capturedata.php" method="post" >
    <?php 
    quizTable();
    ?>
    <input type="submit" class="hugebutton" value="Save Answers" >
    </form>    <?php
}
else
{
    ?><h2>Survey</h2><p>Survey is not availible at the moment.</p><?php
}
?>
