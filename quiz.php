<?php error_reporting(E_ALL);
ini_set('display_errors', '1');

$name = "Test User";
$email = "spam@colorfullimo.com";

$ds=ldap_connect("dmc1.wartburg.edu");
if (!$ds)
{
    ?><h1>Could not connect to LDAP!!!</h1><?php
    //exit(1);
}
$r=ldap_bind($ds, $_POST['email'], $_POST['password']); // Use provided email and password for first bind. Password not stored. ldap_bind will hash the password before sending.
//Test stuff
//$r=True;
////////////
if ($r)
{
    $sr=ldap_search($ds, "ou=user_accounts,dc=wartburg,dc=edu","mail=". $_POST['email']);  
    $info = ldap_get_entries($ds, $sr);
    ldap_close($ds);
    $name = $info[0]['givenname'][0] . ' '. $info[0]['sn'][0];
    $email = $info[0]['mail'][0];
    //print_r($info[0]);
}
else
{
    ?><h1>Sorry, we couldn't verify your username and password. The results of this survey will NOT be saved.</h1><a href="index.php">Try Again</a>
<?php
    //exit(1);
}
?>
<!doctype html>
<html>
    <head>
        <link rel="stylesheet" href="css/style.css"/>
        <script src="http://cdn.jquerytools.org/1.2.5/full/jquery.tools.min.js"></script>   
    </head>
    <body>
        <script type="text/javascript" src="js/quiz.js"></script> 
        <div class="bodywrap">
            <br>
            <h1>Date2Knight Survey</h1>
            <form id="quiz" action="scripts/capturedata.php" method="post" >
            <table width=100%>
		    <?php
				 require_once("scripts/connect.php");
			    $result = mysql_query("SELECT * FROM `questions` ORDER BY rand();");
			    mysql_error();
			
                while ($row = mysql_fetch_array($result))
                {
                    ?>
                    <tr><td colspan="3" class="question"><?php echo($row['text']);?></td></tr>
                    <tr><td class="centered"><?php echo($row['lefttext']);?></td><td><input id="<?php echo($row['id']); ?>" name="<?php echo($row['id']); ?>" type="range" class="slider" min="0" max="10" value="5"/></td><td class="centered"><?php echo($row['righttext']);?></td></tr>
                    <tr><td colspan="3"><hr></td></tr>
                    <?php
                }
		    ?>
		    </table>
		    <table class="padded content">
                <tr>
                    <td colspan=2> <h2>Contact Info: (Will be shown on results)</h2></td>
                </tr>
                <tr>
                    <td> Full Name:</td><td><?php echo($name);?><input type="hidden" name="name" value="<?php echo($name); ?>"/></td>
                </tr>
                <tr>
                    <td>Email Address:</td>
                    <td> <?php echo($email);?><input type="hidden" name="email" value="<?php echo($email); ?>"/></td>                
                </tr>
                <tr>
                    <td>Box Number:</td>
                    <td style="width:300px"><input name="box" placeholder="1337" required="required"/><span class="error"></span></td>
                </tr>
                <tr>
                    <td>Phone Number:</td>
                    <td style="width:300px"><input name="phone" placeholder="(555)876-5309" required="required"/><span class="error"></span></td>
                </tr>
                <tr>
                    <td>Are you female or male?</td>
                    <td><input type="radio" name="gender" value="f"/>Female<input type="radio" name="gender" value="m"/>Male</td>
                </tr>
                <tr>
                    <td>Interested in men?</td><td><input type="checkbox" name="seeksmale"/>I like men.</td></tr>
                    <tr><td>Interested in women?</td><td><input type="checkbox" name="seeksfemale" />I like women.</td></tr>
		    </table>
		    <input class="hugebutton" type="submit" value="Next &raquo;"></input>
		    </form>
		    <script>
            $(":range").rangeinput();
            </script>
            <br>
	    </div>
    </body>
</html>
