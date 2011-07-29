<?php error_reporting(E_ALL);
ini_set('display_errors', '1');
include("functions.php");
$name = "Test User";
$email = "spam@colorfullimo.com";

$db = db_connect();
$stmt = $db->stmt_init();
if ($stmt->prepare("SELECT `username` FROM `queue` WHERE `token`=?"))
{
    $stmt->bind_param('s',$_GET['token']);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($username);
    if ($stmt->num_rows < 1)
    {
	die('<font color="red">Your unique code was not found. Please try again.</font>');
    }
    $stmt->fetch();
    $stmt->free_result();
    $email = $username . '@wartburg.edu';
    $nameFrag = explode('.',$username);
    $name = ucfirst($nameFrag[0]) . ' ' . ucfirst($nameFrag[1]);

}
?>

<!doctype html>
<html>
    <head>
        <link rel="stylesheet" href="css/style.css"/>
	<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css" />

        <script src="http://cdn.jquerytools.org/1.2.5/full/jquery.tools.min.js"></script>   
	<script type="text/javascript" src="js/jquery.validationEngine-en.js" charset="utf-8"></script>
	<script type="text/javascript" src="js/jquery.validationEngine.js" charset="utf-8"></script>
<script type="text/javascript" src="js/jquery.maskedinput-1.3.min.js"></script>
        <script type="text/javascript" src="js/quiz.js"></script> 
    </head>
    <body>

        <div class="bodywrap">
            <br>
            <h1>Date2Knight Survey</h1>
            <form id="quiz" action="capturedata.php" method="post" >
            <input type="hidden" name="token" value="<?php echo($_GET['token']);?>" />
            <table width=100%>
    <?php
    if ($stmt->prepare("SELECT `id`,`text`,`lefttext`,`righttext` FROM `questions` ORDER BY rand();"))
    {
	$stmt->execute();
	$stmt->bind_result($id,$text,$lefttext,$righttext);
	while($stmt->fetch())
	{
	    ?>
	               <tr><td colspan="3" class="question"><?php echo($text);?></td></tr><?php ?>
		<tr><td class="centered"><?php echo($lefttext);?></td><td><input id="<?php echo($id);?>" name="<?php echo($id);?>" type="range" class="slider" min="0" max="10" value="5"/></td><td class="centered"><?php echo($righttext);?></td></tr>
                    <tr><td colspan="3"><hr></td></tr>
											    
		    <?php
       }
	$stmt->close();
    }
    $db->close();
    ?>

		    </table>
		    <table class="padded content">
                <tr>
                    <th colspan=2>Contact Info</th>
                </tr>
                <tr>
                    <td> Full Name:</td><td><?php echo($name);?><input type="hidden" name="name" value="<?php echo($name); ?>"/></td>
                </tr>
                <tr>
                    <td>Email Address:</td>
                    <td> <?php echo($email);?><input type="hidden" name="email" value="<?php echo($email); ?>"/></td>                
                </tr>
                <tr>
                    <td>Send my results to box:</td>
                    <td style="width:300px"><input name="box" id="box" class="validate[required]" /><span class="error"></span></td>
                </tr>
                <tr>
                    <td>Public phone number:</td>
                    <td style="width:300px"><input name="phone" id="phone" class="validate[required]" /><span class="error"></span></td>
                </tr>
                
                <tr>
                    <th colspan="2">Sexual Orientation</th>
                </tr>
                <tr>
                    <td>Are you female or male?</td>
                    <td><input type="radio" name="gender" value="f"/>Female<input type="radio" name="gender" value="m"/>Male</td>
                </tr>
                <tr>
                    <td>Interested in men?</td><td><input type="checkbox" name="seeksmale"/>Match me with men. </td>
                </tr>
                <tr>
                    <td>Interested in women?</td><td><input type="checkbox" name="seeksfemale" />Match me with women.</td>
                </tr>
                <tr>
                    <td>Not looking for dates?</td><td><input type="checkbox" name="seeksfemale" />Exclude me from love matches, I only want friend matches.</td>
                </tr>
		    </table>
		    <input class="hugebutton" type="submit" value="Next &raquo;"></input>
		    <input type="submit" id="hiddenSubmit" style="display: none;" />
		    </form>
		    <script>
            $(":range").rangeinput();
            </script>
            <br>
	    </div>
    </body>
</html>
