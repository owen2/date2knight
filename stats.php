<!doctype html>
<html>
    <head>
        <link rel="stylesheet" href="style.css" media="screen" />
        <link rel="stylesheet" href="print.css" media="print" />
    </head>
    <body>

        <div class="centered bodywrap">
		    <h1>Date 2 Knight Stats Page</h1>
		    <?php
				 require_once("connect.php");
			    $count_result= mysql_query("SELECT COUNT(*) AS `total` FROM `responses`");
			    $count = mysql_fetch_array($count_result);
			    echo("Of ". $count['total'] . " people who took the survey...<br><br>");
			    $count_result= mysql_query("SELECT COUNT(*) AS `total` FROM `responses` WHERE `gender` = 'f'");
			    $count =  mysql_fetch_array($count_result);
			    echo("There are ". $count['total'] ." women.<br>");
			    $count_result= mysql_query("SELECT COUNT(*) AS `total` FROM `responses` WHERE `gender` = 'm'");
			    $count =  mysql_fetch_array($count_result);
			    echo("There are ". $count['total'] ." men.<br>");
			    $count_result= mysql_query("SELECT COUNT(*) AS `total` FROM `responses` WHERE `seeksmale` = 'on' AND `seeksfemale` = 'on'");
			    $count =  mysql_fetch_array($count_result);
			    echo("There are ". $count['total'] ." bisexuals.<br>");
			    $count_result= mysql_query("SELECT COUNT(*) AS `total` FROM `responses` WHERE `seeksmale` = 'on' AND `gender` = 'm'");
			    $count =  mysql_fetch_array($count_result);
			    echo("There are ". $count['total'] ." gays.<br>");
			    $count_result= mysql_query("SELECT COUNT(*) AS `total` FROM `responses` WHERE `gender` = 'f' AND `seeksfemale` = 'on'");
			    $count =  mysql_fetch_array($count_result);
			    echo("There are ". $count['total'] ." lesbians.<br>");
			    $count_result= mysql_query("SELECT COUNT(*) AS `total` FROM `responses` WHERE `1` = '10'");
			    $count =  mysql_fetch_array($count_result);
			    echo("There are ". $count['total'] ." who &hearts; LAN parties.<br>");
			    $count_result= mysql_query("SELECT COUNT(*) AS `total` FROM `responses` WHERE `12` < 5");
			    $count =  mysql_fetch_array($count_result);
			    echo($count['total'] ." prefer Edward. ");
			    $count_result= mysql_query("SELECT COUNT(*) AS `total` FROM `responses` WHERE `12` > 5");
			    $count =  mysql_fetch_array($count_result);
			    echo($count['total'] ." prefer Jacob. ");
			    $count_result= mysql_query("SELECT COUNT(*) AS `total` FROM `responses` WHERE `12` = 5");
			    $count =  mysql_fetch_array($count_result);
			    echo($count['total'] ." don't care about Twilight.<br>");
			    $count_result= mysql_query("SELECT COUNT(*) AS `total` FROM `responses` WHERE `4` < 3");
			    $count =  mysql_fetch_array($count_result);
			    echo($count['total'] ." wouldn't date a smoker. ");
			    $count_result= mysql_query("SELECT COUNT(*) AS `total` FROM `responses` WHERE `5` < 5");
			    $count =  mysql_fetch_array($count_result);
			    echo($count['total'] ." wouldn't date a drinker.<br>");
			    $count_result= mysql_query("SELECT COUNT(*) AS `total` FROM `responses` WHERE `3` < 5");
			    $count =  mysql_fetch_array($count_result);
			    echo($count['total'] ." are introverts, ");
			    $count_result= mysql_query("SELECT COUNT(*) AS `total` FROM `responses` WHERE `3` > 5");
			    $count =  mysql_fetch_array($count_result);
			    echo($count['total'] ." extroverts.<br>");
			    $count_result= mysql_query("SELECT COUNT(*) AS `total` FROM `responses` WHERE `10`> 5");
			    $count =  mysql_fetch_array($count_result);
			    echo($count['total'] ." like to dance.<br>");
			    $count_result= mysql_query("SELECT COUNT(*) AS `total` FROM `responses` WHERE `22`< 5");
			    $count =  mysql_fetch_array($count_result);
			    echo($count['total'] ." keep a messy room.<br>");
        ?>
        </div>

    </body>

</html>
