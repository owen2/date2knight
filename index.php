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
            <h1>Welcome to Date2Knight!</h1>
            <p>A service from the Wartburg Computer Club to help you find a Valentine (or a new friend)</p>
            <div class="content">
                <h2>Here's how it works:</h2>
                    <p>Step one: Take our survey and tell us about yourself.</p>
                    <p>Step two: Order your top date and friend matches for $2.</p>
                    <p>Step three: Find a date or a new friend.</p>
                <h2>Let's get started!</h2>
                    <p>Enter your wartburg email address:</p>
                    <form id="form" name="login">
                        <input name="email" id="email" class="validate[required]" type="email" placeholder="@wartburg.edu" />@wartburg.edu
                            
                        <input type="submit" id="submit" value="Continue"/>
                    </form>
		    <div id="loading"></div>
            </div>
        </div>
    </body>
</html>
