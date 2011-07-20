<?php error_reporting(E_ALL);
ini_set('display_errors', '1');
include('functions.php');    

if ($_REQUEST['seeksmale'] == 'on')
    $_REQUEST['seeksmale'] = 1;
else $_REQUEST['seeksmale'] = 0;
if ($_REQUEST['seeksfemale'] == 'on')
    $_REQUEST['seeksfemale'] = 1;
else $_REQUEST['seeksfemale'] = 0;

$db = db_connect();
$stmt = $db->stmt_init();
if ($stmt->prepare("DELETE FROM `queue` WHERE `token`=?"))
{
    $stmt->bind_param('s',$_REQUEST['token']);
    $stmt->execute();
}

if ($stmt->prepare("INSERT INTO `responses` (`name`,`box`,`phone`,`email`,`gender`,`seeksmale`,`seeksfemale`,`paid`,`1`,`2`, `3`, `4`, `5`, `6`, `7`, `8`, `9`, `10`, `11`, `12`, `13`, `14`, `15`, `16`, `17`, `18`, `19`, `20`, `21`, `22`, `23`, `24`, `25`) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)"))
{
    $paid = "s";
    $stmt->bind_param('sissssssiiiiiiiiiiiiiiiiiiiiiiiii',$_REQUEST['name'],$_REQUEST['box'],$_REQUEST['phone'],$_REQUEST['email'],$_REQUEST['gender'],$_REQUEST['seeksmale'],$_REQUEST['seeksfemale'],$paid,$_REQUEST['1'],$_REQUEST['2'],$_REQUEST['3'],$_REQUEST['4'],$_REQUEST['5'],$_REQUEST['6'],$_REQUEST['7'],$_REQUEST['8'],$_REQUEST['9'],$_REQUEST['10'],$_REQUEST['11'],$_REQUEST['12'],$_REQUEST['13'],$_REQUEST['14'],$_REQUEST['15'],$_REQUEST['16'],$_REQUEST['17'],$_REQUEST['18'],$_REQUEST['19'],$_REQUEST['20'],$_REQUEST['21'],$_REQUEST['22'],$_REQUEST['23'],$_REQUEST['24'],$_REQUEST['25']);
    $stmt->execute();
    if ($stmt->insert_id >= 0)
    {
	$stmt->close();
	$db->close();
	header("Location: saved.php");
    }
    else{
	$stmt->close();
	$db->close();
	die("Something went wrong");
    }
}
$db->close();
?>
