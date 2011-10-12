<h2>Matches</h2><?php
if (!$paid)
{
    ?><p>To see your matches, please donate $2 to a <?php echo(Settings::$organization);?> representative.</p><?php
}
elseif ($paid)
{
    require_once("reportlib.php");
    $dates = getTopDates($_SESSION['id']);    
    foreach ($dates as $id => $score)
        showMiniProfile($id, $score, "&hearts;");
}
?><br class="reset-float">
