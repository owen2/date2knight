<?
require_once('functions.php');

$db = db_connect();
$stmt = $db->stmt_init();
if ($stmt->prepare("UPDATE profile SET validated='true' WHERE validated=?"))
{
    $stmt->bind_param('i',$_GET['token']);
    $stmt->execute();
    $stmt->close();
}
$db->close();
header('Location: saved.php');
?>
