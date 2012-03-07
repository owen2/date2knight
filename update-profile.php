<?php 
require_once("config.php");
require_once('functions.php');

if (!isset($_SESSION))
    session_start();

if (!isset($_SESSION['id']))
    header("location: index.php");

$db = db_connect();
$stmt = $db->stmt_init();
$box = $_REQUEST['box'];
$phone = $_REQUEST['phone'];
$gender_mask = $_REQUEST['gender'];
$seeks_mask = $_REQUEST['seeks'];
$bio = $_REQUEST['bio'];
$id = $_SESSION['id'];

$sql = "UPDATE profile SET box=?,phone=?,gender=?,seeks=?,bio=? WHERE id=?";
if ($stmt->prepare($sql)) {
    $stmt->bind_param('isiisi',$box,$phone,$gender_mask,$seeks_mask,$bio,$id);
    $stmt->execute();
    $stmt->close();
}
$db->close();
if(!isset($_REQUEST['instant'])) {
    header("location: dashboard.php");
}
?>
