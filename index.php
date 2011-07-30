<?php require_once("config.php"); ?>
<!doctype html>
<html>
    <head>
        <link rel="stylesheet" href="css/style.css"/>
	<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css" />
	<script type="text/javascript" src="js/jquery-1.5.1.min.js"></script>
	<script type="text/javascript" src="js/jquery.validationEngine-en.js" charset="utf-8"></script>
	<script type="text/javascript" src="js/jquery.validationEngine.js" charset="utf-8"></script>

        <script type="text/javascript" src="js/index.js"></script>
    </head>
    <body>
        <div class="padded bodywrap">
            <h1>Welcome to <?php echo(Settings::$name); ?>!</h1>
            <p>A service from the <?php echo(Settings::$organization); ?> to help you find a Valentine (or a new friend)</p>
            <div class="content">
                <h2>Here's how it works:</h2>
                    <p><b>1:</b> Sign in and tell us about yourself.</p>
                    <p><b>2:</b> Order your top matches.</p>
                    <p><b>3:</b> Check your email.</p>
                <h2>Ready to try?</h2>
                    <p>Tell us your email address:</p>
                    <form id="form" name="login">
                        <input name="email" id="email" class="validate[required]" type="email" placeholder="your.name" required="required" />@wartburg.edu
                        <input type="submit" id="submit" value="Submit"/>
                    </form>
		    <div id="loading"></div>
            </div>
        </div>
    </body>
</html>
