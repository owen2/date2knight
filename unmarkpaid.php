<?php error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once('auth.php');
// TODO: CHECK LOGIN SESSION
/*
require_once("auth.php");

if (!checkSimplePasskey("missingbytes", $_REQUEST['pass']))
{
    header("location: login.php");
}
*/
require_once("connect.php");

$update = "UPDATE profile SET `paid`=0 WHERE id =" .$_REQUEST['id'];
mysql_query($update)
?>
