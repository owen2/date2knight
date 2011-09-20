<?php

if (Settings::isPollOpen())
{
    ?><h2>Take the survey</h2>
    <p>TODO: Move Quiz Code to this dashlet (dashlets/quiz.php)</p>
    <?php
}
else
{
    ?><h2>Survey</h2><p>Survey is not availible at the moment.</p><?php
}
?>
