<?php
require_once('auth.php');
require_once('functions.php');

$db = db_connect();
$stmt = $db->stmt_init();

if ($stmt->prepare("UPDATE question SET enable=? WHERE id=?"))
{
    $stmt->bind_param('ii',intval($_REQUEST['enable']),intval($_REQUEST['id']));
    $stmt->execute();
    $stmt->close();
}
$db->close();
?>
