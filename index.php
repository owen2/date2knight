<?php require_once("config.php"); 
session_start();
if (isset($_SESSION['id'])) {
    header('Location: dashboard.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css/style.css" media="screen">
    </head>
    <body>
        <div id="splash-page" class="bodywrap">
            <div class="stackright padded login-container">
                <form action="dashboard.php" method="post">
                    Login: <input name="email" type="email" required="required" placeholder="Email Address" /> <input type="text" name="comment" style="display:none"/> <!--honeypot... don't use --><input type="submit" value="Try It" />
                </form>
            </div>
            
            <div class="padded content">
	      <div id="error">
		<?php
		   echo '<font color="red">';
		   if (isset($_GET['error'])) {
		       echo $_GET['error'];
		   }
		   echo '</font>';
		?>
	      </div>
	      <div>
                <h1><?php echo(Settings::$name); ?></h1>
                <p>A website by <?php echo(Settings::$organization); ?> to help you find a candidate who agrees with you.</p>
                <h2>How it works:</h2>
                <ol>
                    <li>We ask the candidates a few carefully crafted questions.</li>
                    <li>We ask you the same questions.</li>
                    <li>We calculate which candidates you are most aligned with.</li>
                </ol></div>
                
                <!--
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
                </form>-->
                <h2>Privacy</h2>
                <p>Your responses will be used to show you how well you are aligned to each candidate, and we will not expose your personal data. We may share an anonymous agregation of all responses. We will never share or store your email address.</p>
            </div>
        </div>
    </body>
</html>
