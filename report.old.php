<?php error_reporting(E_ALL);
    ini_set('display_errors', '1');

	 require_once("scripts/connect.php");
    
    $result = mysql_query("SELECT * FROM `responses` WHERE id=" . $_REQUEST['id']);
    $personA = mysql_fetch_array($result);
    
    function getTopDates($personA, $limit=10)
    {
        if ($personA['paid'] != "paid")
        {
            echo("Results are availible from the computer club for $2. Please mail an envelope with your name and $2 to Computer Club Box 707 or purchase results at our table in the student center. Also, why are you trying to steal your results? It isn't nice.");
            return false; 
        }
        $matchlist = array();
        $results = mysql_query("SELECT * FROM `responses` WHERE `id` <> " . $personA['id']);
        while ($personB = mysql_fetch_array($results))
        {
            //echo($personBh['name']);
            if (($personA['seeksmale'] == "on" and $personB['gender'] =="m") or ($personA['seeksfemale'] == "on" and $personB['gender'] =="f")) // TODO: Check both sexual prefs, not just personA's 
            {
                $score = getScore($personA, $personB);
                $matchlist[$personB['id']] = $score;
            }
        }
        asort($matchlist);
        //print_r($matchlist);
        ?>
        <table width = 100%>
        <tr>
            <th>Best Matches</th>
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
            ?><tr><td><?php printName($id); ?></td><td><?php printPhone($id); ?></td><td>Mailbox <?php printBox($id); ?></td><td><?php printHearts($matchscore);?></td></tr><?php
        }?>
        </table>
        <?php
    }
    function getTopFriends()
    {
    //TODO: table of folks who fail sexual pref check
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
        echo($person['name']);
    }
    
    function printPhone($id)
    {
        $result = mysql_query("SELECT * FROM `responses` WHERE id=" . $id);
        $person = mysql_fetch_array($result);
        echo($person['phone']);
    }
    
    function printBox($id)
    {
        $result = mysql_query("SELECT * FROM `responses` WHERE id=" . $id);
        $person = mysql_fetch_array($result);
        echo($person['box']);
    }
    
    function printHearts($score)
    {
        if ($score < 30) echo("&hearts;");
        if ($score < 25) echo("&hearts;");
        if ($score < 20) echo("&hearts;");
        if ($score < 15) echo("&hearts;");
        if ($score < 10) echo("&hearts;");
        echo("(". round($score, 4) .")" );
    }
?>
<!doctype html>
<head>
    <link rel="stylesheet" href="css/style.css" media="screen" />
    <link rel="stylesheet" href="css/print.css" media="print" />
</head>

<body>
    <div class="padded bodywrap content">
    <h1><?php echo($personA['name'] . "<br>Mailbox " . $personA['box']);?></h1>
    <?php getTopDates($personA, 10); ?>
    <?php getTopFriends($personA, 10); ?>
    </div>
</body>
