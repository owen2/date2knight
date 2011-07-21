<?php
function db_connect()
{
    $host = 'localhost';
    $user = 'lovematch';
    $password = 'lovematch';
    $db = 'lovematch';
    return new mysqli($host,$user,$password,$db);
}
?>
