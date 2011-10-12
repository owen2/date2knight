<?php
require_once("functions.php");
if (!isset($_SESSION))
   session_start();
$flag = strpos($_POST['email'],'@');
if (!($flag === false))
    die('<div style="color: red">Only enter your username (not full email address)</div>');
$to = $_POST['email'] . Settings::$validEmailDomain;
$emailFrags = explode('.',$_POST['email']);
$first = ucfirst($emailFrags[0]);
$last = ucfirst($emailFrags[1]);
$toName = $first . ' ' . $last;
$token = md5(microtime() . $_POST['email']);
$db = db_connect();
$stmt = $db->stmt_init();
// Check if there is already a profile for this user

if ($stmt->prepare("SELECT id FROM `profile` WHERE `email`=?"))
{
    $stmt->bind_param('s',$to);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0)
    {
	$stmt->free_result();
	$stmt->close();
	$db->close();
	echo '<div style="color: green">';
	echo("We already have a profile for you.");
	echo " You can go to </a href=\"" . Settings::$baseurl. "\">".Settings::$baseurl."</a>";
	echo " to retake the quiz if you wish.";
	echo '</div>';
	die();
    }
}
$sql = "INSERT INTO profile (firstname,lastname,email,validated) VALUES (?,?,?,?)";
if ($stmt->prepare($sql))
{
    $stmt->bind_param('ssss',$first,$last,$to,$token);
    $stmt->execute();
    $stmt->close();
}
$db->close();
$link = Settings::$baseurl .'validate.php?token=' . $token;
$body = "Hi $first $last!\r\n";
$body .= "Your responses must be validated!\r\n";
$body .= "Click on the following link to validate your responses. \r\n" . $link . "\r\n\r\nThank you!\r\nWartburg Computer Club\r\n";

$headers = "From: date2knight@gmail.com";
mail($to,"Validation Required",$body,$headers);
$_SESSION['instant'] = $token;
?>
<script type="text/javascript">
document.location = 'quiz.php';
</script>
