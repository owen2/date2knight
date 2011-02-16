<?php error_reporting(E_ALL);
ini_set('display_errors', '1');
    
    mysql_connect("mysql.owenjohnson.info", "lovematch","lovematch");
    mysql_query("USE `lovematch`");

$sql = "INSERT INTO `lovematch`.`responses` (`id`, `name`, `box`, `phone`, `email`, `gender`, `seeksmale`, `seeksfemale`, `1`, `2`, `3`, `4`, `5`, `6`, `7`, `8`, `9`, `10`, `11`, `12`, `13`, `14`, `15`, `16`, `17`, `18`, `19`, `20`, `21`, `22`, `23`, `24`, `25`) VALUES (NULL, '". $_REQUEST['name'] ."', '". $_REQUEST['box'] ."', '". $_REQUEST['phone'] ."', '". $_REQUEST['email'] ."', '". $_REQUEST['gender'] ."', '". $_REQUEST['seeksmale'] ."', '". $_REQUEST['seeksfemale'] ."', ". $_REQUEST['1'] .", ". $_REQUEST['2'] .", ". $_REQUEST['3'] .", ". $_REQUEST['4'] .", ". $_REQUEST['5'] .", ". $_REQUEST['6'] .", ". $_REQUEST['7'] .", ". $_REQUEST['8'] .", ". $_REQUEST['9'] .", ". $_REQUEST['10'] .", ". $_REQUEST['11'] .", ". $_REQUEST['12'] .", ". $_REQUEST['13'] .", ". $_REQUEST['14'] .", ". $_REQUEST['15'] .", ". $_REQUEST['16'] .", ". $_REQUEST['17'] .", ". $_REQUEST['18'] .", ". $_REQUEST['19'] .", ". $_REQUEST['20'] .", ". $_REQUEST['21'] .", ". $_REQUEST['22'] .", ". $_REQUEST['23'] .", ". $_REQUEST['24'] .", ". $_REQUEST['25'] .");";
if(mysql_query($sql))
{
    header("location: saved.php");    
}
    ?><h1>SOMETHING WENT WRONG!</h1><p>There was an error saving the responses.</p><?php
    mysql_error();
    ?><br><?php
    //print_r($_REQUEST); 
    ?><br><?php
    //echo($sql);
?>
