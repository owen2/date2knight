<?php 
    require_once("config.php");
    require_once("connect.php");
    
    if (!isset($_SESSION))
        session_start();
        
    if (!isset($_SESSION['id']))
        header("location: user-login.php");
        
    $box = $_REQUEST['box'];
    $phone = $_REQUEST['phone'];
    $gender_mask = $_REQUEST['gender'];
    $seeks_mask = $_REQUEST['seeks'];
    $bio = $_REQUEST['bio'];
    $id = $_SESSION['id'];
        
    $q = "UPDATE `profile` SET `box` = '$box', `phone` = '$phone',`gender` = '$gender_mask', `seeks` = '$seeks_mask', `bio` = '$bio' WHERE `id` = '$id';";
    $result = mysql_query($q);
    if (!$result)
    {
        die(mysql_error());
    }
    else
    {
        header("location: dashboard.php");
        //echo("Success!");
    }
?>
