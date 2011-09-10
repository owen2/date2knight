<?php

require_once("config.php");
require_once("connect.php");

if (!isset($_SESSION))
    session_start();

// If new user signing up
if (isset($_REQUEST['isNewUser']) and isset($_REQUEST['email']) and isset($_REQUEST['password']) and isset($_REQUEST['password-check']) and ($_REQUEST['password'] == $_REQUEST['password-check']))
{
    //Check to see if there is a * valid * user already
    $q = "SELECT * FROM `profile WHERE `email` = '".$_REQUEST['email']."'";
    if(!($result = mysql_query($q)))
    {
        $emailFrags = explode('.',$_REQUEST['email']);
        $first = ucfirst($emailFrags[0]);
        $last = explode("@",ucfirst($emailFrags[1]));
        $last = $last[0];
        $email = $_REQUEST['email'];
        $hash = md5($_REQUEST['password']);
        $token = md5(microtime() . $_POST['email']);
        $q = "INSERT INTO `lovematch`.`profile` (`id`, `firstname`, `lastname`, `box`, `phone`, `email`, `password`, `gender`, `seeks`, `paid`, `bio`, `validated`,`token`) VALUES (NULL, '$first', '$last', NULL, NULL, '$email', '$hash', NULL, NULL, NULL, NULL, NULL,'$token');";
        $result = mysql_query($q);
        if ($result)
        {
            $to      = "$first $last <$email>";
            $subject = Settings::$name.' Profile Created';
            $message = "Hi $first $last,\r\n\r\nYou (or someone pretending to be you) just set up a profile at ".Settings::$name."\r\n\r\n"
                       ."In order to make sure this was really you, please verify your account here:\r\n\r\n"
                       .Settings::$baseurl."validate.php?token=".$token."\r\n\r\n"
                       ."If you did not sign up for an account, just ignore this, and the profile will not be seen or used and you will not recieve any more mail.\r\n\r\n"
                       ."See you soon,\r\nYour friendly ".Settings::$organization." date-matching robot";
            $headers = 'From: '.Settings::$envelopefrom.' <'.$mailfrom.'>' . "\r\n" .
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
        include("user-login.php");
    }
    if ($email == $profile['email'] and md5($_REQUEST['password']) == $profile['password'])
    {
        $_SESSION['id'] = $profile['id'];
    }
    else
    {
        include("user-login.php");
    }

}

$q = "SELECT * FROM `profile` WHERE `id` = ".$_SESSION['id'];
$result = mysql_query($q);
$profile = mysql_fetch_array($result);


$firstName = $profile['firstname'];
$lastName = $profile['lastname'];
$email = $profile['email'];
$bio = $profile['bio'];
$profileImage = "http://www.gravatar.com/avatar/".md5(strtolower(trim($email)))."?r=x&d=404";
$valid = $profile['validated'];
$paid = $profile['paid'];

function hasTakenQuiz()
{
    return false;
}

function showMatches($limit)
{
    //echo("<h3>Your dating matches</h2>");
    //echo("<p>Not Implemented</p>");
    //echo("<h3>Your friendship matches</h2>");
    //echo("<p>Not Implemented</p>");
    require_once("report.php");
    getTopDates($_SESSION['id'], 10); 
}

function showCountdown()
{
    if (Settings::isPollOpen())
    {
        echo("<p>We're still finding you more results. Keep checking back for better results.</p>"); //TODO: make cool countdown slider thinger or timer or something.
    }
}

function showQuiz()
{
    echo("<h2>Quiz</h2><p>Not Implemented</p>");
}

?><!doctype html>
<html>
<head>
    <link rel="stylesheet" href="css/style.css" media="screen" />
    <link rel="stylesheet" href="css/print.css" media="print" />
    <script type="text/javascript" src="js/jquery-1.6.3.min.js"></script>
</head>
<body>
    <div class="padded bodywrap">
        <div class="content">
        <a href="http://gravatar.com"><img src="<?php echo($profileImage);?>" class="stackright" alt="Set your picture!"/></a>
                <h1><?php echo($firstName . " " . $lastName); ?></h1>
                <?php echo($bio); ?>
            <br style="clear:both">
            <hr>
        <?php if ($valid == null)
        { 
        ?><h2 class="error">Identity Validation Pending</h2><p>Your profile won't be seen by others until you validate your email address. All you need to do is follow the link we sent you. This keeps people from pretending to be you.</p><?php
        }?>
        <h2>Your Profile</h2>
        <form action="update-profile.php" method="post">
            <p>My name is <?php echo($firstName." ".$lastName);?> and I am a <select>  <option value ="10">Man</option>  <option value ="01">Woman<option></select>, who is looking for a good time with <select>  <option value ="10">a Man</option>  <option value ="01">a Woman</option>  <option value ="11">a Man or a Woman</option>  <option value ="00">some new pals</option></select>.</p>
            <p>People can send me mail at <?php echo($email);?> or my campus box <input type="number" class="short register-field" required="required" /> and call me at <input pattern="^(?:(?:\+?1\s*(?:[.-]\s*)?)?(?:\(\s*([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9])\s*\)|([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9]))\s*(?:[.-]\s*)?)?([2-9]1[02-9]|[2-9][02-9]1|[2-9][02-9]{2})\s*(?:[.-]\s*)?([0-9]{4})(?:\s*(?:#|x\.?|ext\.?|extension)\s*(\d+))?$" class="register-field"/>.</p>
            <p>My friends would say <?php echo($firstName); ?> <input name="bio" required="required" class="long register-field">.</p>
            <input type="submit"/>
        </form>
        <?php
        if (!hasTakenQuiz() and Settings::isPollOpen())
        {
            showQuiz();
        }
        ?><h2>Matches</h2><?php
        if (!$paid)
        {
        ?><p>To see your matches, please donate $1 to a <?php echo(Settings::$organization);?> representative.</p><?php
        }
        elseif ($paid and hasTakenQuiz())
        {
            showMatches(10);
            showCountdown();
        }
        ?>
        </div>
    </div>
</body>
</html>
