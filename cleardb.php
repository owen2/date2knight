<?php
require_once("auth.php");
require_once("connect.php");

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
