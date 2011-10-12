<?php
require_once('auth.php');
require_once('functions.php');
$id = $_REQUEST['id'];
$right = $_REQUEST['right'];
$question = $_REQUEST['question'];
$left = $_REQUEST['left'];

$db = db_connect();
$stmt = $db->stmt_init();
if ($stmt->prepare("UPDATE question SET `lefttext`=?,`text`=?,`righttext`=? WHERE id=?"))
{
    $stmt->bind_param('sssi',$left,$question,$right,$id);
    $stmt->execute();
    $stmt->close();
}
$db->close();
?>
