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
$stmt1 = $db->stmt_init();
$stmt2 = $db->stmt_init();
$stmt3 = $db->stmt_init();
$word[0] = 'person';
$word[1] = 'people';

$result = mysql_query("SELECT COUNT(*) FROM profile WHERE validated='true'");
$count = mysql_fetch_row($result);
echo "Of ". $count[0] . ' people who took the survey...<br /><br />';
$result = mysql_query("SELECT COUNT(*) FROM profile WHERE validated='1' AND gender=2");
$count = mysql_fetch_row($result);
echo "There are " . $count[0] . " women.<br />";
$result = mysql_query("SELECT COUNT(*) FROM profile WHERE validated='1' AND gender=1");
$count = mysql_fetch_row($result);
echo "There are " . $count[0] . " men.<br />";
$result = mysql_query("SELECT COUNT(*) FROM profile WHERE validated='1' AND seeks=3");
$count =  mysql_fetch_row($result);
echo("There are ". $count[0] ." bisexuals.<br>");
$result = mysql_query("SELECT COUNT(*) FROM profile WHERE validated='1' AND seeks=1 AND gender=1");
$count = mysql_fetch_row($result);
echo("There are ". $count[0] ." gays.<br>");
$result = mysql_query("SELECT COUNT(*) FROM profile WHERE validated='1' AND seeks=2 AND gender=2");
$count = mysql_fetch_row($result);
echo("There are ". $count[0] ." lesbians.<br>");

$sql = "SELECT id,text,lefttext,righttext FROM question WHERE enable=1";
$sql1 = "SELECT count(response.id) from response inner join profile on (response.profile_id=profile.id) WHERE answer > 5 AND validated='1' AND response.question_id=?";
$sql2 = "SELECT count(response.id) from response inner join profile on (response.profile_id=profile.id) WHERE answer=5 AND validated='1' AND response.question_id=?";
$sql3 = "SELECT count(response.id) from response inner join profile on (response.profile_id=profile.id) WHERE answer<5 AND validated='1' AND response.question_id=?";

echo '<br />';
if ($stmt->prepare($sql) && $stmt1->prepare($sql1) && $stmt2->prepare($sql2) && $stmt3->prepare($sql3))
{
    $stmt1->bind_param('i',$id);
    $stmt2->bind_param('i',$id);
    $stmt3->bind_param('i',$id);    
    $stmt->bind_result($id,$text,$left,$right);
    $stmt1->bind_result($num1);
    $stmt2->bind_result($num2);
    $stmt3->bind_result($num3);
    $stmt->execute();
    $stmt->store_result();
    echo "<center>";
    echo "<table border='1'>";
    while ($stmt->fetch())
    {
	echo "<tr><td align='center'><br />$left</td><td align='center'><b>$text</b><br />Don't care</td><td align='center'><br />$right</td></tr>";
	$stmt1->execute();
	$stmt1->store_result();
	$stmt1->fetch();
	echo "<tr><td align='center'>$num1</td>";
	$stmt2->execute();
	$stmt2->store_result();
	$stmt2->fetch();
	echo "<td align='center'>$num2</td>";
	$stmt3->execute();
	$stmt3->store_result();
	$stmt3->fetch();
	echo "<td align='center'>$num3</td></tr>";
	$stmt1->free_result();
	$stmt2->free_result();
	$stmt3->free_result();
    }
    $stmt->close();
    $stmt1->close();
    $stmt2->close();
    $stmt3->close();
    $db->close();
    echo "</table>";
    echo "</center>";
}
?>
          <br />
	  <a href="admin.php">[back]</a> <a href="killsession.php">[logout]</a>
        </div>
    </body>
</html>
