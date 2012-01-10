<?php require_once("config.php"); ?>
<!doctype html>
<html>
    <head>
        <link rel="stylesheet" href="css/style.css"/>
	<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css" />
	<script type="text/javascript" src="js/jquery-1.5.1.min.js"></script>
	<script type="text/javascript" src="js/jquery.validationEngine-en.js" charset="utf-8"></script>
	<script type="text/javascript" src="js/jquery.validationEngine.js" charset="utf-8"></script>


<!--        <script type="text/javascript" src="js/index.js"></script>-->
    </head>
    <body>
        <div class="padded bodywrap">
            <h1>Welcome to <?php echo(Settings::$name); ?> (Instant Version)!</h1>
            <p>A service from the <?php echo(Settings::$organization); ?> to help you find a Valentine (or a new friend)</p>
            <div class="content">
                <h2>Here's how it works:</h2>
                    <p><b>1:</b> Enter your email address and take the quiz.</p>
		    <p><b>2:</b> Verify your identity by clicking the link in your email. This makes it so that others can be matched to you (totally free!).</p>
                    <p><b>3:</b> Make a small donation (as little as $1) to the <?php echo(Settings::$organization);?> to get instant access to your constantly updating matches.</p>
                <h2>Ready to try?</h2>
                    <form id="form" name="login" action="instantproc.php" method="post">
		        <input type="hidden" value="1" id="instant" />
		        <input type="hidden" name="isNewUser" value="yes"/>
                        <table><tr>
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
                        </tr></table>
                        <input type="submit" id="submit" value="Sign Me Up!"/>
                    </form>
		    <div id="loading"></div>
            </div>
        </div>
    </body>
</html>
