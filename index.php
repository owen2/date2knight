<?php error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<!doctype html>
<html>
    <head>
        <link rel="stylesheet" href="style.css"/>
        <script type="text/javascript">
        function validateForm()
        {
        var x=document.forms["login"]["email"].value
        var y=document.forms["login"]["password"].value
        if (x==null || x=="" || y == null || y == "")
          {
          alert("You missed a spot.");
          return false;
          }
        }
        </script>
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
                    <p>Enter your wartburg email and password:</p>
                    <form name="login" action="quiz.php" method="post" onsubmit="return validateForm()">
                        <input name="email" type="email" placeholder="@wartburg.edu" />
                        <input name="password" type="password" placeholder="password" />
                        <input type="submit" value="Login"/>
                    </form>
                    <!--Developers can bypass this page, use <a href="quiz.php">link</a>.-->
            </div>
        </div>
