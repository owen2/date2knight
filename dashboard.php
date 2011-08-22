<?php

require_once("config.php");
require_once("connect.php");

if (!isset($_SESSION))
   session_start();

$_SESSION['id'] = 1;

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
    return false;
}

function showMatches($limit)
{
    echo("<h3>Your dating matches</h2>");
    echo("<p>Not Implemented</p>");
    echo("<h3>Your friendship matches</h2>");
    echo("<p>Not Implemented</p>");
}

function showCountdown()
{
    if (Settings::isPollOpen())
    {
        echo("<p>We're still finding you more results. Keep checking back for better results.</p>");
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
        if (!hasTakenQuiz())
        {
            showQuiz();
        }
        ?><h2>Matches</h2><?php
        if (!$paid)
        {
        ?><p>To see your matches, please donate $1 to a <?php echo(Settings::$organization);?> representative.</p><?php
        }
        else
        {
            showMatches(10);
            showCountdown();
        }
        ?>
        </div>
    </div>
</body>
</html>
