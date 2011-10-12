<?php 

require_once("config.php");

if (Settings::isPollOpen())
{
    ?><p>Come back again! We still have <?php echo(Settings::$pollDayClose - Date('j')); ?> more days of research to do.</p><?php
}
else
{
    ?><p>These are your final results! What are you waiting for?</p><?php
}

