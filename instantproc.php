<?php

require_once("config.php");
require_once("connect.php");
require_once("quizlib.php");

if (!isset($_SESSION))
    session_start();

// If new user signing up
if (isset($_REQUEST['isNewUser']) and isset($_REQUEST['email']) and isset($_REQUEST['password']) and isset($_REQUEST['password-check']) and ($_REQUEST['password'] == $_REQUEST['password-check']))
{
    //Check to see if there is a * valid * user already
    $q = "SELECT * FROM `profile WHERE `email` = '".$_REQUEST['email']."' and `validated` <> null";
    $result = mysql_query($q);
    if(!$result)
    {
        $emailFrags = explode('.',$_REQUEST['email']);
        $first = ucfirst($emailFrags[0]);
        $last = explode("@",ucfirst($emailFrags[1]));
        $last = $last[0];
        $email = $_REQUEST['email'];
        $hash = md5($_REQUEST['password']);
        $token = md5(microtime() . $_POST['email']);
        $q = "INSERT INTO `profile` (`id`, `firstname`, `lastname`, `box`, `phone`, `email`, `password`, `gender`, `seeks`, `paid`, `bio`, `validated`,`token`) VALUES (NULL, '$first', '$last', NULL, NULL, '$email', '$hash', NULL, NULL, NULL, NULL, NULL,'$token');";
        $result = mysql_query($q);
        if ($result)
        {
            $to      = "$first $last <$email>";
            $subject = Settings::$name.' Profile Created';
            $message = "Hi $first $last,\r\n\r\nYou (or someone pretending to be you) just set up a profile at ".Settings::$name."\r\n\r\n"
                       ."In order to make sure this was really you, please verify your account here:\r\n\r\n"
                       .Settings::$baseurl."validate.php?token=$token\r\n\r\n"
                       ."If you did not sign up for an account, just ignore this, and the profile will not be seen or used and you will not recieve any more mail.\r\n\r\n"
                       ."See you soon,\r\nYour friendly ".Settings::$organization." date-matching robot";
            $headers = 'From: '.Settings::$envelopefrom.' <'.Settings::$mailfrom.'>' . "\r\n" .
                        'X-Mailer: PHP/'.Settings::$name;

            mail($to, $subject, $message, $headers);
        }
        else
            die(mysql_error());
    }
    
}

// If this is first login, store session variable
if (isset($_REQUEST['email']) and isset($_REQUEST['password']))
{
    $email = $_REQUEST['email'];
    $q = "SELECT * FROM `profile` WHERE `email` = '$email'";
    $result = mysql_query($q);
    if ($result)
    {
        $profile = mysql_fetch_array($result);
        //echo($profile);
    }
    else
    {
        header("location: index.php");
    }
    if ($email == $profile['email'] and md5($_REQUEST['password']) == $profile['password'])
    {
        $_SESSION['id'] = $profile['id'];
    }
    else
    {
        header("location: /");
    }

}

//If not authenticated, bail!
if (!isset($_SESSION['id']))
    header('location: /');

header('location: quiz.php');
?>
