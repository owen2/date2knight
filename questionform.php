<?php
require_once("auth.php");
require_once('functions.php');
if (isset($_REQUEST['id']))
{
    $db = db_connect();
    $stmt = $db->stmt_init();
    if ($stmt->prepare("SELECT righttext,`text`,lefttext FROM question WHERE id=?"))
    {
	$stmt->bind_param('i',$_REQUEST['id']);
	$stmt->execute();
	$stmt->bind_result($right,$question,$left);
	$stmt->fetch();
	$stmt->close();
    }
    $db->close();
}
?>
<table border="0">
<tr>
  <th>Left Text</th>
  <th>Question</th>
  <th>Right Text</th>
</tr>
<tr>
    <td><textarea id="left"><?php echo($left); ?></textarea></td>
    <td><textarea id="question"><?php echo($question); ?></textarea></td>
    <td><textarea id="right"><?php echo($right); ?></textarea></td>
</tr>
</table>
<br />
<?php
    if (isset($_REQUEST['id']))
    {
	$id = $_REQUEST['id'];
?>
<input type="hidden" value="<?php echo($id); ?>" id="questionId" />
<input type="button" value="Submit" id="save" onclick="save()" />
<?php
    }else{
?>
<input type="button" value="Submit" id="save" onclick="insert()" />
<?php
	    }
?>
<input type="button" value="Cancel" id="cancel" onclick="cancel()" />
<br />
