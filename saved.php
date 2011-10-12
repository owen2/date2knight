<?
if (!isset($_SESSION))
   session_start();
if (isset($_SESSION['instant']))
{
    $heading = 'Dont forget to validate!';
    $body = 'You have been sent an email with a link to validate your responses.  Your responses will not be count until they have been validated.';
    unset($_SESSION['instant']);
}else
{
    $heading = 'Thank You!';
    $body = "Your answers have been saved. You can now order your matches and others will see you in thier list of matches. If you pre-purchase your results now, we'll send them to your campus box as soon as we as all the surveys are in. Thank you for supporting the Wartburg Computer Club and the Wartburg College LAN Society! We hope you find someone special or a new friend. ";

}

?>
<!doctype html>
<html>
    <head>
        <link rel="stylesheet" href="css/style.css"/>
    </head>
    <body>
        <div class="padded bodywrap">
            <h1><?php echo $heading; ?></h1>
            <p class="content"><?php echo $body; ?> </p>
            <h2>How do I get the results?</h2>
            <p class="content">Get your $2 to a Computer Club Member or watch for our table in the student center. You will recieve your results in your campus mailbox just before Valentine's Day.</p>
        </div>
    </body>
</html>
