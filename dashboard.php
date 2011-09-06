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
        $q = "INSERT INTO `lovematch`.`profile` (`id`, `firstname`, `lastname`, `box`, `phone`, `email`, `password`, `gender`, `seeks`, `paid`, `bio`, `validated`) VALUES (NULL, '$first', '$last', NULL, NULL, '$email', '$hash', NULL, NULL, NULL, NULL, NULL);";
        $result = mysql_query($q);
        if ($result)
            die("Profile Created");
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
        //include("user-login.php");
        die(mysql_error());
    }
    if ($email == $profile['email'] and md5($_REQUEST['password']) == $profile['password'])
    {
        $_SESSION['id'] = $profile['id'];
    }
    else
    {
        //include("user-login.php");
        echo(md5($password));
        echo("<br>");
        echo($profile['password']);
        die(mysql_error());
    }

}

$q = "SELECT * FROM `profile` WHERE `id` = ".$_SESSION['id'];
$result = mysql_query($q);
$profile = mysql_fetch_array($result);


$firstName = $profile['firstname'];
$lastName = $profile['lastname'];
$email = $profile['email'];
$bio = $profile['bio'];
$profileImage = "http://www.gravatar.com/avatar/".md5(strtolower(trim($email)))."?r=x&d=mm";
$valid = $profile['validated'];
$paid = $profile['paid'];

function hasTakenQuiz()
{
    return true;
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
</head>
<body>
    <div class="padded bodywrap">
        <div class="content">
        <img src="<?php echo($profileImage);?>" class="stackright"/>
                <h1><?php echo($firstName . " " . $lastName); ?></h1>
                <?php echo($bio); ?>
            <br style="clear:both">
            <hr>
        <?php if ($valid != "true")
        { 
        ?><h2 class="error">Identity Validation Pending</h2><p>Your profile won't be seen by others until you validate your email address. All you need to do is follow the link we sent you. This keeps people from pretending to be you.</p><?php
        }
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
