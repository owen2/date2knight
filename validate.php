<?
require_once("config.php");
require_once("connect.php");

$token = $_GET['token'];

$q = "UPDATE `profile` SET validated=1 WHERE token ='$token'";
$result = mysql_query($q);
$q = "SELECT id,email FROM profile WHERE token='$token'";
$result = mysql_query($q);
$row = mysql_fetch_array($result);
$id = $row['id'];
$email = $row['email'];
session_start();
$_SESSION['id'] = $id;
// Delete any stray unvalidated accounts
$q = "DELETE FROM profile WHERE email='$email' AND token != '$token'";
mysql_query($q);
header('Location: dashboard.php');
?>
