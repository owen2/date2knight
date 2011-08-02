<?php
include("functions.php");
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
	header("Location: index.php");
    }
}
if ($stmt->prepare("INSERT INTO `profile` (firstname,lastname,email,validated) VALUES (?,?,?,?)"))
{
    $stmt->bind_param('ssss',$first,$last,$to,$token);
    $stmt->execute();
    $stmt->close();
}
$db->close();
$link = Settings::$baseurl .'date2knight/validate.php?token=' . $token;
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
