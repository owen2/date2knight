<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once("config.php");
require_once("quizlib.php");

$email = $_REQUEST['email'];
$profileImage = "http://www.gravatar.com/avatar/".md5(strtolower(trim($email)))."?r=x&d=mm";

?><!doctype html>
<html>
<head>
    <link rel="stylesheet" href="css/style.css" />
    <script src="js/jquery.tools.min.js"></script>  
</head>
<body>
    <div class="bodywrap">
    <img src="<?php echo($profileImage);?>" class="stackright login-container" alt=""/>
        <div class="padded content">
                <h1>Choose Wisely</h1>
                <p>Slide left or right to choose your stance on each topic or stay near the middle to indicate indecision or apathy. </p>
            <br style="clear:both">
            <hr>
        <table width=100%><?php
    $q ="SELECT `id`,`text`,`lefttext`,`righttext` FROM `question` WHERE `enable`=1 ORDER BY rand();";
    $q_result = mysql_query($q);
    while($question = mysql_fetch_array($q_result))
	{?>
        <tr><td colspan="3" class="question"><?php echo($question['text']);?></td></tr><?php ?>
		<tr><td class="centered"><?php echo($question['lefttext']);?></td><td><input id="<?php echo($question['id']);?>" name="question_<?php echo($question['id']);?>" type="range" class="slider" min="0" max="10" value="5"/></td><td class="centered"><?php echo($question['righttext']);?></td></tr>
        <tr><td colspan="3"><hr></td></tr>
		    <?php
   } 
    ?>
    </table>
    <script>
        $(".slider").rangeinput();
    </script> 
        </div>
    </div>
</body>
</html>
