<?php 
function canDoIt($a, $b)
{   

    $resultA = mysql_query("SELECT gender,seeks FROM profile WHERE id=$a");
    $resultB = mysql_query("SELECT gender,seeks FROM profile WHERE id=$b");
    $rowA = mysql_fetch_assoc($resultA);
    $rowB = mysql_fetch_assoc($resultB);
    
    return ($rowA['gender'] & $rowB['seeks']) && ($rowA['seeks'] & $rowB['gender']);
}

function getTopDates($personAID, $limit=10)
{
    $result = mysql_query("SELECT paid FROM profile WHERE id=$personAID");
    $row = mysql_fetch_array($result);
    
    if ($row['paid'] != 1)
	    return false; //NO STEALING THE RESULTS, It's creepy. Yeah you, stumme.
	    
    $result = mysql_query("SELECT count(*) FROM response WHERE profile_id=$personAID");
    $count = mysql_fetch_row($result);
    if ($count[0] == 0)
        return false;
	    
    $matchlist = array();
    $results = mysql_query("SELECT id FROM `profile` WHERE `id` <> " . $personAID . " AND validated= 1;");
    while ($personB = mysql_fetch_assoc($results))
    {
	    $score = getScore($personAID, $personB['id']);
	    //if (canDoIt($personAID, $personB['id']))
	    if ($score != -1) { // taken quiz
	        $matchlist[$personB['id']] = $score;
	    }
    }
    
    asort($matchlist);
    
    return $matchlist;
}

function printReport($id) 
{
    $result = mysql_query("SELECT * FROM `profile` WHERE `id` = '$id' AND `validated` = '1';");
    if (!$result)
        die(mysql_error());
    $profile = mysql_fetch_array($result);
    $firstName = $profile['firstname'];
    $lastName = $profile['lastname'];
    $email = $profile['email'];
    $box = $profile['box'];
    $bio = $profile['bio'];
    $phone = $profile['phone'];
    $dates = getTopDates($id);
    echo '<h1>';
    echo $firstName . ' '  . $lastName . "<br />Mailbox " . $box;
    echo '</h1>';
    if ($dates != '') {
	foreach ($dates as $date_id => $score) {
	    showMiniProfile($date_id,$id,$score);
	    echo '<br class="reset-float" />';
	}
    }    
    echo '<br><br>    <p>Scores: &hearts;&hearts;&hearts;&hearts;&hearts; and &#9775;&#9775;&#9775;&#9775;&#9775; are the best ratings possible. &#9775;&#9775;&#9775; and above are considered good matches. The lowest possible score shows no &hearts; or &#9775;.</p>
';
    
    
}
function showMiniProfile($id,$source_id, $score)
{
    $result = mysql_query("SELECT * FROM `profile` WHERE `id` = '$id' AND `validated` = '1';");
    if (!$result)
        die(mysql_error());
    
    $profile = mysql_fetch_array($result);
    $firstName = $profile['firstname'];
    $lastName = $profile['lastname'];
    $email = $profile['email'];
    $box = $profile['box'];
    $bio = $profile['bio'];
    $phone = $profile['phone'];
    $profileImage = "http://www.gravatar.com/avatar/".md5(strtolower(trim($email)))."?r=x&d=mm";
    $valid = $profile['validated'];
    $paid = $profile['paid'];
    
    if (!canDoIt($source_id, $id))
        $char = "&#9775;";
    else
        $char = "&hearts;";
    
    ?>
        <div class="mini-profile stackleft">
            <img src="<?php echo($profileImage); ?>" alt="" class="stackleft mp-avatar">
            <div class="stackleft">
                <h3><?php echo("$firstName $lastName ");printHearts($score,$char); ?></h3>
                <p><?php echo($bio);?></p>
                <p><?php echo("$phone - Box $box");?></p>
                <p><a href="mailto:<?php echo($email);?>"><?php echo($email);?></a></p>
            </div>
        </div>
    <?php
}

function getScore($a, $b)
{
    // This function will fail if questions were changed while people
    // were filling out/had already filled out quiz
    $resultA = mysql_query("SELECT `answer` FROM `response` WHERE `profile_id`='$a' ORDER BY `question_id`");
    $resultB = mysql_query("SELECT `answer` FROM `response` WHERE `profile_id`='$b' ORDER BY `question_id`");
    $sum = 0;
    if (mysql_num_rows($resultB) == 0) {
	return -1;
    }
    while (($rowA = mysql_fetch_array($resultA)) && ($rowB = mysql_fetch_array($resultB))) {
	$sum += pow(abs($rowA[0] - $rowB[0]),2);
    }
    echo(mysql_error());
    return sqrt($sum);
}

function printHearts($score, $char)
{
    $h5 = 10;
    $h4 = 13;
    $h3 = 15;
    $h2 = 20;
    $h1 = 25;
    //Whole hearts
    if ($score < $h5) echo($char);
    if ($score < $h4) echo($char);
    if ($score < $h3) echo($char);
    if ($score < $h2) echo($char);
    if ($score < $h1) echo($char);
    //half hearts
    $half = ($h5 + $h4) / 2.;
    if ($score <= $half and $score >= $h5) echo('<span style="color:#888">'. $char .'</span>');
    $half = ($h4 + $h3) / 2.;
    if ($score <= $half and $score >= $h4) echo('<span style="color:#888">'. $char .'</span>');
    $half = ($h3 + $h2) / 2.;
    if ($score <= $half and $score >= $h3) echo('<span style="color:#888">'. $char .'</span>');
    $half = ($h2 + $h1) / 2.;
    if ($score <= $half and $score >= $h2) echo('<span style="color:#888">'. $char .'</span>');
    if ($score >= $h1) echo('<span style="color:#888">'. $char .'</span>');
    //Numbers
    //echo("(". round($score, 4) .")" );
}
?>
