<?php

if (Settings::isPollOpen())
{
    ?><div id="quizbox" style="display:none"><h2>The Quiz</h2>
    <form id="quiz" action="capturedata.php" method="post" >
    <input type="hidden" name="email" value="<?php echo($email); ?>">
    <?php 
    quizTable();
    ?>
    <input type="submit" class="hugebutton" value="Save Answers" >
    </form></div>    <?php
}
else
{
    ?><h2>Survey</h2><p>Survey is not availible at the moment.</p><?php
}
?>
<div id="quizclicky" onclick="$('#quizbox').slideDown(600); $('#quizclicky').slideUp(500);"><h2>&raquo; Take The Quiz</h2></div>
