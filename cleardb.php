<?php
session_start();
require_once("scripts/connect.php");
require_once("scripts/auth.php");
if (!checkSimplePasskey("missingbytes", $_REQUEST['pass']))
{
    header("location: login.php");
}

if ($_REQUEST['really'] == "yes")
{
    if(mysql_query("TRUNCATE TABLE `responses`;"))
    {
        ?><!doctype html><html><body><h1>Responses have been erased!</h1></body></html><?php
    }
    else
    {
        ?><!doctype html><html><body><h1>Responses may not have been erased!</h1></body></html><?php
    }
}

?>
