<?

require_once("config.php");

if (!isset($_SESSION))
   session_start();
   
$heading = 'Profile Saved Successfully!';
$body = "We sent you an email to make sure it's really you. Please click the link in the message so we can start including you in the results.";
session_destroy();

?>
<!doctype html>
<html>
    <head>
        <link rel="stylesheet" href="css/style.css"/>
    </head>
    <body>
        <div class="padded bodywrap">
            <h1><?php echo $heading; ?></h1>          
            <h2>How do I get myself in the matches pool?</h2>
            <p class="content"><?php echo $body; ?> </p>
            <h2>How do I get my own matches?</h2>
            <p class="content">We worked really hard to make this service for you, please donate to the <?php echo(Settings::$organization);?> and we'll give you instant access to your matches! </p>
            <p class="content">You can view your results and change your answers at <a href="<?php echo(Settings::$baseurl); ?>"><?php echo(Settings::$baseurl); ?></a> with the password you chose earlier. Have a lot of fun!</p>       
        </div>
        <a href="instant.php">[Reset]</a>
    </body>
</html>
