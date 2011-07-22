<?php
include("functions.php");
date_default_timezone_set('America/Chicago');
require_once('class.phpmailer.php');
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
// Delete previous tokens for this user if they exist
if ($stmt->prepare("DELETE FROM `queue` WHERE `username`=?"))
{
    $stmt->bind_param('s',$_POST['email']);
    $stmt->execute();
}
// Insert new token
if ($stmt->prepare("INSERT INTO `queue` (`username`,`token`) VALUES (?,?)"))
{
    $stmt->bind_param('ss',$_POST['email'],$token);
    $stmt->execute();
    $stmt->close();
}
$db->close();
$mail = new PHPMailer();
$link = 'http://' .$SERVER['SERVER_NAME'] .'/date2knight/quiz.php?token=' . $token;
$body = "Hi $first $last!\r\n";
$body .= "The " . Date('Y') . " edition of Wartburg's is ready and waiting for you as requested.\r\n";
$body .= "Click on the following link to get started. \r\n" . $link . "\r\n\r\nThank you!\r\nWartburg Computer Club\r\n";

$mail->IsSMTP();
//$mail->SMTPDebug  = 2;
$mail->SMTPAuth = true;
$mail->SMTPSecure = "ssl";
$mail->Host = "smtp.gmail.com";
$mail->Port = 465;
$mail->Username = "date2knight@gmail.com";
$mail->Password = "datepass";
$mail->SetFrom("date2knight@gmail.com","Match Maker");
$mail->Subject = "Pending Quiz";
$mail->Body = $body;
$mail->AddAddress($to,$toName);

if(!$mail->Send()) {
    echo "<font color=\"red\">Mailer Error: " . $mail->ErrorInfo . '</font>';
} else {
  echo "<font color=\"green\">Message has been sent</font>";
}

?>
