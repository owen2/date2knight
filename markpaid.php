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

$update = "UPDATE profile SET `paid` = 1 WHERE id =" .$_REQUEST['id'];
$r = mysql_query("SELECT * FROM `profile` WHERE `id` = ". $_REQUEST['id']);
$person = mysql_fetch_array($r);
    $first = $person['firstname'];
$last = $person['lastname'];
    $name = $first . " " . $last;
    $email = $person['email'];
    $box = $person['box'];

$body = 
"
Dear $name,

Thank you for supporting the Wartburg Computer Club!

You may now check your current matches by logging in to date2knight.com.

The more people that take the survey the better your results will be, so be sure to tell your friends about this event.

We really hope you find a Valentine or a friend. 

Sincerely,
Date 2 Knight Team 2012
Owen Johnson
Joshua Osbeck
Jacob Hinrichsen
Andrew Reisner
Nathan Stumme
Heath Rost
Lacey Stonehocker
Dr. John Zelle
Dr. Terry Letsche

You received this email because you took the Date 2 Knight survey and you purchased your results. (Or someone paid to send them to you!)
";

if(mysql_query($update))
{
    $headers = "From: mail-robot@wartburg.edu";
    mail($email,"Date 2 Knight",$body,$headers);
    header("location: admin.php");    
}
    ?><h1>SOMETHING WENT WRONG!</h1><p>There was an error marking as paid.</p><?php
    mysql_error();
    ?><br><?php
    print_r($_REQUEST); 
    ?><br><?php
    echo($sql);
?>
