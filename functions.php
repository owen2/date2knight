<?php
require_once("config.php");
function db_connect()
{
    return new mysqli(DbAuth::$host,DbAuth::$user,DbAuth::$password,DbAuth::$db);
}
?>
