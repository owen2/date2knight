<?php
session_start();
require_once("scripts/auth.php");
if (!checkSimplePasskey("missingbytes", $_REQUEST['pass']))
{
    header("location: login.php");
}
?>
<!doctype html>
<html>
    <head>
        <link rel="stylesheet" href="css/style.css" media="screen" />
        <link rel="stylesheet" href="css/print.css" media="print" />
    </head>
    <body>

        <div class="centered bodywrap">
		    <h1>Admin Page</h1>
		    <?php
		       require_once("scripts/connect.php");
				 mysql_query("USE `lovematch`");
			    $result = mysql_query("SELECT * FROM `responses` ORDER BY `name`;");
			    mysql_error();
			    ?><a href="stats.php">[stats]</a> <a href="report-all.php">[get all reports]</a> <a href="killsession.php">[logout]</a><br><br><?php
			    $count_result= mysql_query("SELECT COUNT(*) AS `total` FROM `responses`");
			    $count = mysql_fetch_array($count_result);
			    echo("Of ". $count['total'] . " people who took the survey, ");
			    $count_result= mysql_query("SELECT COUNT(*) AS `total_paid` FROM `responses` WHERE `paid` = 'paid'");
			    $count = mysql_fetch_array($count_result);
			    echo($count['total_paid'] . " of them paid for results.<br>");
			    ?><a href="stats.php">[stats]</a> <a href="report-all.php">[get all reports]</a> <a href="scripts/killsession.php">[logout]</a><br><br><?php
			    ?><table style="margin: auto; text-align:left;"><?php
                while ($row = mysql_fetch_array($result))
                {
                    echo("<tr>");
                    echo("<td>". $row['name'] ."</td>");
                    echo("<td>");
                    if ($row['paid'] == "paid"){echo('<a href="report.php?id='. $row['id'] .'">get report</a></td><td>');}else{echo('</td><td><a href="scripts/markpaid.php?id='. $row['id'] .'">mark as paid</a>');}
                    echo("</td>");
                    echo("</tr>");
                }
	     ?></ul>
        </div>
    </body>
</html>
