<?php
require_once('auth.php');
require_once('functions.php');

$db = db_connect();
$stmt = $db->stmt_init();
if ($stmt->prepare("DELETE FROM question WHERE id=?"))
{
    $stmt->bind_param('i',$_REQUEST['id']);
    $stmt->execute();
    $stmt->close();
}
$db->close();
?>
