<?php error_reporting(E_ALL);
    ini_set('display_errors', '1');
require_once("auth.php");
	 require_once("connect.php");

    
    $result = mysql_query("SELECT * FROM `responses` WHERE id=" . $_REQUEST['id']);
    $personA = mysql_fetch_array($result);
    
    //////////////////////
    function canDoIt($a, $b)
    {/////////////////////////////
        return //////////////////
        ((($a['seeksmale'] == "on" and $b['gender'] =="m") or ($a['seeksfemale'] == "on" and $b['gender'] =="f"))  and
        (($b['seeksmale'] == "on" and $a['gender'] =="m") or ($b['seeksfemale'] == "on" and $a['gender'] =="f")));//////
        // Code is poetry. This is one of those weird shape poems that is kinda hard to read and makes you feel awkward.
    }/////////////////////////////
    //////////////////////////////
    ////////////////////////////
    
    function getTopDates($personA, $limit=10)
    {
        if ($personA['paid'] != 1)
        {
            echo("Results are availible from the computer club for $2. Please mail an envelope with your name and $2 to Computer Club Box 707 or purchase results at our table in the student center. Also, why are you trying to steal your results? It isn't nice.");
            return false; 
        }
        $matchlist = array();
        $friendlist = array();
        $results = mysql_query("SELECT * FROM `responses` WHERE `id` <> " . $personA['id']);
        while ($personB = mysql_fetch_array($results))
        {
            $score = getScore($personA, $personB);
            if (canDoIt($personA, $personB))
                {$matchlist[$personB['id']] = $score;}
            else
                {$friendlist[$personB['id']] = $score;}
        }
        asort($matchlist);
        asort($friendlist);
        ?>
        
        
        <table width = 100%>
        <tr>
            <th>Love Matches</th>
            <th>Say Hello:</th>
            <th>Leave a note:</th>
            <th>Score:</th>
        </tr>
        <?php
        $count = 0;
        foreach($matchlist as $id => $matchscore)
        {
            $count++;
            if ($count > $limit){break;}
            ?><tr><td><?php printName($id); ?></td><td><?php printPhone($id); ?></td><td>Mailbox <?php printBox($id); ?></td><td><?php printHearts($matchscore, "&hearts;");?></td></tr><?php
        }?>
        <tr>
            <td><br /></td>
            <td><br /></td>
            <td><br /></td>
            <td><br /></td>
        </tr>
        <tr>
            <th>Buddy Matches</th>
            <th>Say Hello:</th>
            <th>Leave a note:</th>
            <th>Score:</th>
        </tr>
        <?php
        $count = 0;
        foreach($friendlist as $id => $matchscore)
        {
            $count++;
            if ($count > $limit){break;}
            ?><tr><td><?php printName($id); ?></td><td><?php printPhone($id); ?></td><td>Mailbox <?php printBox($id); ?></td><td><?php printHearts($matchscore, "&#9775;");?></td></tr><?php
        }?>
        </table>
        
        <?php
    }

    function getScore($a, $b)
    {
        $sum = 0;
        $i = 1;
        while ($i <= 25)
        {
            $sum += pow(abs($a[$i] - $b[$i]),2);
            $i++;
        }
        return sqrt($sum);
    }
    
    function printName($id)
    {
        $result = mysql_query("SELECT * FROM `responses` WHERE id=" . $id);
    $person = mysql_fetch_array($result);
    $name = $person['firstname'] . ' ' . $person['lastname'];
        echo($name);
    }
    
    function printPhone($id)
    {
        $result = mysql_query("SELECT * FROM `responses` WHERE id=" . $id);
        $person = mysql_fetch_array($result);
        echo(decrapify($person['phone']));
    }
    
    function printBox($id)
    {
        $result = mysql_query("SELECT * FROM `responses` WHERE id=" . $id);
        $person = mysql_fetch_array($result);
        echo($person['box']);
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
    
    function decrapify($phone)
    {
        return preg_replace("/[^0-9]/", "", $phone);
        //return $phone;
    }
?>
<!doctype html>
<head>
    <link rel="stylesheet" href="css/print.css" />
</head>

<body>
    <div class="padded bodywrap content">
    <h1><?php echo($personA['firstname'] . ' ' . $personA['lastname'] . "<br>Mailbox " . $personA['box']);?></h1>
    <?php getTopDates($personA, 10); ?>
    <br><br>
    <p>Scores: &hearts;&hearts;&hearts;&hearts;&hearts; and &#9775;&#9775;&#9775;&#9775;&#9775; are the best ratings possible. &#9775;&#9775;&#9775; and above are considered good matches. The lowest possible score shows no &hearts; or &#9775;.</p>
    </div>
</body>
