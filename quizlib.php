<?php

require_once("connect.php");

function quizTable()
{?>
    <table width=100%><?php
    $q ="SELECT `id`,`text`,`lefttext`,`righttext` FROM `question` WHERE `enable`=1 ORDER BY rand();";
    $q_result = mysql_query($q);
    while($question = mysql_fetch_array($q_result))
	{
	    $q = "SELECT * from `response` WHERE `profile_id` = ". $_SESSION['id'] ." AND `question_id` =  " . $question['id'];
	    $a_result = mysql_query($q);
	    if ($a_result)
	    {
	        $answer = mysql_fetch_array($a_result);
	        if (isset($answer['answer']))
	            $previous_answer = $answer['answer'];
            else
                $previous_answer=5;            
        }
        else
            die(mysql_error());
	    ?>
	    
        <tr><td colspan="3" class="question"><?php echo($question['text']);?></td></tr><?php ?>
		<tr><td class="centered"><?php echo($question['lefttext']);?></td><td><input id="<?php echo($question['id']);?>" name="question_<?php echo($question['id']);?>" type="range" class="slider" min="0" max="10" value="<?php echo($previous_answer); ?>"/></td><td class="centered"><?php echo($question['righttext']);?></td></tr>
        <tr><td colspan="3"><hr></td></tr>
		    <?php
   }
    ?>
    </table>
    <script>
        $(":range").rangeinput();
    </script> <?php 
} ?>
