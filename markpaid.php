<?php error_reporting(E_ALL);
ini_set('display_errors', '1');
    
    mysql_connect("mysql.owenjohnson.info", "lovematch","lovematch");
    mysql_query("USE `lovematch`");

$update = "UPDATE `lovematch`.`responses` SET `paid` = 'paid' WHERE `responses`.`id` =" .$_REQUEST['id'];
$r = mysql_query("SELECT * FROM `responses` WHERE `id` = ". $_REQUEST['id']);
$person = mysql_fetch_array($r);
    $name = $person['name'];
    $email = $person['email'];
    $box = $person['box'];

$body = 
"
Dear $name,

Thank you for supporting the Wartburg Computer Club!

We will be sending your results to the campus mailbox you provided ($box). Results will be available on February 11th once everyone has had a chance to take the survey. 

The more people that take the survey the better your results will be, so be sure to tell your friends about this event.

We really hope you find a Valentine or a friend. 

Sincerely,
Date 2 Knight Team
Owen Johnson
Joshua Osbeck
Jacob Hinrichsen
Nathan Stumme
Heath Rost
Lacey Stonehocker
Dr. John Zelle
Terry Letsche

You received this email because you took the Date 2 Knight survey and you purchased your results. (Or someone paid to send them to you!)
";

if(mysql_query($update))
{
    $headers = "From: mail-robot@wartburg.edu";
    mail($email,"Date 2 Knight",$body,$headers);
    header("location: kiosk.php");    
}
    ?><h1>SOMETHING WENT WRONG!</h1><p>There was an error marking as paid.</p><?php
    mysql_error();
    ?><br><?php
    print_r($_REQUEST); 
    ?><br><?php
    echo($sql);
?>
