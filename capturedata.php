<?php error_reporting(E_ALL);
ini_set('display_errors', '1');
include('functions.php');    

$paid = 0;
$seeks = 0;
if (isset($_REQUEST['seeksmale']) && $_REQUEST['seeksmale'] == 'on')
    $seeks |= 1;
if (isset($_REQUEST['seeksfemale']) && $_REQUEST['seeksfemale'] == 'on')
    $seeks |= 2;

if ($_REQUEST['gender'] == 'm')
    $gender = 1;
else
    $gender = 2;
$nameFrags = explode(" ",$_REQUEST['name']);
$firstname = $nameFrags[0];
$lastname = $nameFrags[1];
$db = db_connect();
$stmt = $db->stmt_init();
if ($stmt->prepare("DELETE FROM `queue` WHERE `token`=?"))
{
    $stmt->bind_param('s',$_REQUEST['token']);
    $stmt->execute();
}
$id = 'flag';
if ($stmt->prepare("SELECT `id` FROM `profile` WHERE `email`=?"))
{
    $stmt->bind_param('s',$_REQUEST['email']);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id);
    if ($stmt->num_rows > 0)
    {
	$stmt->fetch();
    }
    $stmt->free_result();
}
if ($id == 'flag') // New user profile
{
    if ($stmt->prepare("INSERT INTO `profile` (`firstname`,`lastname`,`box`,`phone`,`email`,`gender`,`seeks`,`paid`) VALUES(?,?,?,?,?,?,?,?)"))
    {
	$stmt->bind_param('ssissiii',$firstname,$lastname,$_REQUEST['box'],$_REQUEST['phone'],$_REQUEST['email'],$gender,$seeks,$paid);
	$stmt->execute();
	if ($stmt->insert_id < 0){
	    $stmt->close();
	    $db->close();
	    die("Something went wrong");
	}
	$id = $stmt->insert_id;
    }
}else
{
    if ($stmt->prepare("UPDATE `profile` SET `firstname`=?,`lastname`=?,`box`=?,`phone`=?,`gender`=?,`seeks`=?,`paid`=? WHERE `id`=?"))
    {
	$stmt->bind_param('ssisiiii',$firstname,$lastname,$_REQUEST['box'],$_REQUEST['phone'],$gender,$seeks,$paid,$id);
	$stmt->execute();

    }


}
// First delete previous answers if any
if ($stmt->prepare("DELETE FROM `response` WHERE `profile_id`=?"))
{
    $stmt->bind_param('i',$id);
    $stmt->execute();
}
// insert question answers
if ($stmt->prepare("INSERT INTO `response` (`profile_id`,`question_id`,`answer`) VALUES (?,?,?)"))
{
    $stmt->bind_param('iii',$id,$question,$answer);
    foreach($_REQUEST as $key => $value)
    {
	$pos = strpos($key,'question_');
	
	if($pos === false) {
	    continue;
	}
	else {
	    $questionFrag = explode('_',$key);
	    $question = intval($questionFrag[1]);
	    $answer = intval($value);
	    $stmt->execute();
	}
    }
    $stmt->close();
    $db->close();
    header("Location: saved.php");

}
$db->close(); // Just in case
?>
