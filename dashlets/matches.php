<h2>Matches</h2><?php
if (!$paid)
{
    ?><p>To see your matches, please donate $2 to a <?php echo(Settings::$organization);?> representative.</p><?php
}
elseif ($paid)
{
    require_once("reportlib.php");

    $dates = getTopDates($_SESSION['id']);    
    $source = $_SESSION['id'];
    if ($dates != '') {
	foreach ($dates as $id => $score)
	    showMiniProfile($id,$source, $score);
    }
}
?><br class="reset-float">
