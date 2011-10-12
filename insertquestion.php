<?php
require_once('auth.php');
require_once('functions.php');
$right = $_REQUEST['right'];
$question = $_REQUEST['question'];
$left = $_REQUEST['left'];

$db = db_connect();
$stmt = $db->stmt_init();
if ($stmt->prepare("INSERT INTO question (`lefttext`,`text`,`righttext`) VALUES(?,?,?)"))
{
    $stmt->bind_param('sss',$left,$question,$right);
    $stmt->execute();
    $stmt->close();
}
$db->close();
?>
