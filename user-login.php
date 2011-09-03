<?php require_once("config.php"); ?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css/style.css" media="screen">
    </head>
    <body>
        <div class="padded bodywrap">
            <h1><?php echo(Settings::$name); ?></h1>
            <p>A service from the <?php echo(Settings::$organization); ?> to help you find a date (or a friend).</p>
            <div class="content">
                <h2>Want to sign up?</h2>
                <form id="form" name="login" action="indexproc.php">
                    <input name="email" id="email" type="email" placeholder="first.last" required="required" />@<?php echo(Settings::$validEmailDomain); ?><br>
                    <input type="submit" id="submit" value="sign up" />
                </form>
                <h2>Already Registered?</h2>
                <form id="form" name="login" action="dashboard.php">
                    <input name="email" id="email" type="email" placeholder="first.last" required="required" />@<?php echo(Settings::$validEmailDomain); ?><br>
                    <input name="password" type="password" required="required" placeholder="password" />
                    <input type="submit" id="submit" value="sign in" />
                </form>
            </div>
        </div>
    <body>
</html>
