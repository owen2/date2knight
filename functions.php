<?php
function db_connect()
{
    $host = 'mysql.owenjohnson.info';
    $user = 'lovematch';
    $password = 'lovematch';
    $db = 'lovematch';
    return new mysqli($host,$user,$password,$db);
}
?>
