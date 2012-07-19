<?php

require_once("config.php");
require_once("connect.php");

function quizTable()
{?>
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
        $(":range").rangeinput(); alert("DING");
    </script> <?php 
} mysql_error();?>
