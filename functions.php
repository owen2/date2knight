<?php
require_once("dbauth.php");
function db_connect()
{
    return new mysqli(DbAuth::$host,DbAuth::$user,DbAuth::$password,DbAuth::$db);
}
?>
