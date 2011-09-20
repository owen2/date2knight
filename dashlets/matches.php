<h2>Matches</h2><?php
if (!$paid)
{
    ?><p>To see your matches, please donate $1 to a <?php echo(Settings::$organization);?> representative.</p><?php
}
elseif ($paid)
{
    ?>TODO: Use report.php's logic to make some pretty match display here.<?php
}
?>
