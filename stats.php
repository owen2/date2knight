<?php
    require_once("auth.php");		        
    require_once("connect.php");
require_once("functions.php");
//    require_once("auth.php");
//    if (!checkSimplePasskey("missingbytes", $_SESSION['realpass']))
//        header("Location: login.php");
?>
<!doctype html>
<html>
    <head>
        <link rel="stylesheet" href="css/style.css" media="screen" />
        <link rel="stylesheet" href="css/print.css" media="print" />
    </head>
    <body>

        <div class="centered bodywrap">
		    <h1>Date 2 Knight Stats Page</h1>
<?php
$db = db_connect();
$stmt = $db->stmt_init();
$word[0] = 'person';
$word[1] = 'people';

$result = mysql_query("SELECT COUNT(*) FROM profile WHERE validated='true'");
$count = mysql_fetch_row($result);
echo "Of ". $count[0] . ' people who took the survey...<br /><br />';
$result = mysql_query("SELECT COUNT(*) FROM profile WHERE validated='true' AND gender=2");
$count = mysql_fetch_row($result);
echo "There are " . $count[0] . " women.<br />";
$result = mysql_query("SELECT COUNT(*) FROM profile WHERE validated='true' AND gender=1");
$count = mysql_fetch_row($result);
echo "There are " . $count[0] . " men.<br />";
$result = mysql_query("SELECT COUNT(*) FROM profile WHERE validated='true' AND seeks=3");
$count =  mysql_fetch_row($result);
echo("There are ". $count[0] ." bisexuals.<br>");
$result = mysql_query("SELECT COUNT(*) FROM profile WHERE validated='true' AND seeks=1 AND gender=1");
$count = mysql_fetch_row($result);
echo("There are ". $count[0] ." gays.<br>");
$result = mysql_query("SELECT COUNT(*) FROM profile WHERE validated='true' AND seeks=2 AND gender=2");
$count = mysql_fetch_row($result);
echo("There are ". $count[0] ." lesbians.<br>");
?>
        </div>
    </body>
</html>
