<?php require_once("config.php"); ?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css/style.css" media="screen">
    </head>
    <body>
        <div class="bodywrap">
            <div class="stackright login-container">
                <form action="dashboard.php" method="post">
                    login: <input name="email" type="email" required="required" placeholder="first.last@<?php echo(Settings::$validEmailDomain); ?>" /> <input name="password" type="password" required="required" placeholder="password"/> <input type="submit" value="go" />
                </form>
            </div>
            <br style="clear:both">

            <div class="padded content">
                <h1><?php echo(Settings::$name); ?></h1>
                <p>A service from the <?php echo(Settings::$organization); ?> to help you find a date (or a friend).</p>
                <h2>How it works:</h2>
                <ol>
                    <li>You answer some questions about yourself.</li>
                    <li>We add you to our magic database so that others can get matched to you.</li>
                    <li>If you make a small donation to the <?php echo(Settings::$organization); ?>, our monkeys and robots make a list of people you would get along with on a date or as buddies.</li>
                </ol>
                <h2>Create an account:</h2>
                <form id="form" name="login" action="dashboard.php" method="post">
                    <table class="register-container">
                        <tr>
                            <td>Email Address</td>
                            <td><input name="email" id="email" type="email" required="required" class="register-container register-field" value="@<?php echo(Settings::$validEmailDomain); ?>" /></td>
                        </tr>
                        <tr>
                            <td>Choose a Password</td>
                            <td><input type="password" name="password" required="required" class="register-field" /></td>
                        </tr>
                        <tr>
                            <td>Confirm Password</td>
                            <td><input type="password" name="password-check" required="required" class="register-field" /></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="submit" id="submit" value="sign me up!" /></td>
                        </tr>
                        <input type="hidden" name="isNewUser" value="true" />
                    </table>
                </form>
            </div>
        </div>
        <div class="fixed-corner">Powered by <a href="http://gitub.com/WartburgComputerClub/date2knight">Date 2 Knight</a> :: <a href="http://wartburg.edu">Wartburg College</a> <a href="http://mcsp.wartburg.edu">Computer Club</a></div>
    <body>
</html>
