<?php
// A simple authentication library by Owen Johnson
// auth.php
// require_once this file before output starts.
session_start();
require_once("config.php");



if(isset($_SESSION['key']))
{
    if ($_SESSION['key'] == Settings::$adminpass)
        return true;
    else
        header("location: login.php");
}
elseif (Settings::$adminpass==$_REQUEST['pass'])
{
    $_SESSION['key'] = Settings::$adminpass;
    return true;
}
else
{
    header("location: login.php");
}   

?>
