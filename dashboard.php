<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once("config.php");
require_once("connect.php");
require_once("quizlib.php");

if (!isset($_SESSION))
    session_start();

// If new user signing up
if (isset($_REQUEST['isNewUser']) and isset($_REQUEST['email']) and isset($_REQUEST['password']) and isset($_REQUEST['password-check']) and ($_REQUEST['password'] == $_REQUEST['password-check']))
{
    //Check to see if there is a * valid * user already

    $q = "SELECT * FROM `profile` WHERE `email` = '".$_REQUEST['email']."' and `validated` =1";
    $result = mysql_query($q);
    if (mysql_num_rows($result) > 0) {
	// valid user alread exists
	header("Location: index.php?error=User already exists");
	die();
    }else{ // We can create as many unvalidated users as we want for a particular email address
        $emailFrags = explode('.',$_REQUEST['email']);
        $first = ucfirst($emailFrags[0]);
        $last = explode("@",ucfirst($emailFrags[1]));
        $last = $last[0];
	
	// If we are restricting domains
	// restrict domains...
	$frags = explode('@',$_REQUEST['email']);
	$domain = $frags[1];
	if ((Settings::$restrictDomain) && Settings::$validEmailDomain !=  $domain) {
	    header("Location: index.php?error=Enter valid domain: " . Settings::$validEmailDomain);
	    die('Domain Error');
	}
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
        header("Location: index.php?error=Username not found");
    }
    if ($email == $profile['email'] and md5($_REQUEST['password']) == $profile['password'])
    {
        $_SESSION['id'] = $profile['id'];
    }
    else
    {
        header("Location: index.php?error=Incorrect username or password");
    }

}

//If not authenticated, bail!
if (!isset($_SESSION['id']))
{
    header('location: index.php?error=Authentication Error!');
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

?><!doctype html>
<html>
<head>
    <link rel="stylesheet" href="css/style.css" media="screen" />
    <link rel="stylesheet" href="css/print.css" media="print" />
    <script src="http://cdn.jquerytools.org/1.2.5/full/jquery.tools.min.js"></script>  
</head>
<body>
    <div class="padded bodywrap">
        <div class="content">
        <a href="http://gravatar.com"><img src="<?php echo($profileImage);?>" class="stackright" alt="Set your picture!"/></a>
                <h1><?php echo($firstName . " " . $lastName); ?></h1>
                <?php echo($bio); ?>
		<span class="stackright"><a href="killsession.php">logout</a></span>
            <br style="clear:both">
            <hr>
        <?php 
        include("./dashlets/validation.php");
        include("./dashlets/profile.php");   
        include("./dashlets/quiz.php");
        include("./dashlets/matches.php");
        include("./dashlets/poll-status.php");
        ?>
        </div>
    </div>
</body>
</html>
