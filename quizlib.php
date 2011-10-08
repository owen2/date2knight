<?php

require_once("connect.php");

function quizTable(){?>
            <table width=100%><?php
    $q ="SELECT `id`,`text`,`lefttext`,`righttext` FROM `question` WHERE `enable`=1 ORDER BY rand();";
    $result = mysql_query($q);
    while($row = mysql_fetch_array($result))
	{
	    ?>
	               <tr><td colspan="3" class="question"><?php echo($row['text']);?></td></tr><?php ?>
		<tr><td class="centered"><?php echo($row['lefttext']);?></td><td><input id="<?php echo($row['id']);?>" name="question_<?php echo($row['id']);?>" type="range" class="slider" min="0" max="10" value="5"/></td><td class="centered"><?php echo($row['righttext']);?></td></tr>
                    <tr><td colspan="3"><hr></td></tr>
											    
		    <?php
   }
    
    ?>
            </table>
    	    <script>
                $(":range").rangeinput();
            </script> <?php } ?>
