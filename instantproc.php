<?php
require_once("functions.php");
$flag = strpos($_POST['email'],'@');
if (!($flag === false))
    die('<font color="red">Only enter your username (not full email address)</font>');
$to = $_POST['email'] . '@wartburg.edu';
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
	echo '<font color="red">';
	echo("You have already taken this quiz.");
	echo " You can go to " . Settings::$baseurl;
	echo " to retake the quiz.";
	echo '</font>';
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
$link = Settings::$baseurl .'date2knight/validate.php?token=' . $token;
$body = "Hi $first $last!\r\n";
$body .= "Your responses must be validated!\r\n";
$body .= "Click on the following link to validate your responses. \r\n" . $link . "\r\n\r\nThank you!\r\nWartburg Computer Club\r\n";

$headers = "From: date2knight@gmail.com";
mail($to,"Validation Required",$body,$headers);
$_SESSION['instant'] = $token;
header('Location: quiz.php');
?>
