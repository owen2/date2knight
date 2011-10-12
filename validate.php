<?
require_once("config.php");
require_once("connect.php");

$token = $_GET['token'];

$q = "UPDATE `profile` SET validated=1 WHERE token ='$token'";
$result = mysql_query($q);
header('Location: dashboard.php');
?>
