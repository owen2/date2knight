<?
require_once("auth.php"); // starts session
require_once("connect.php");

$page = 1; // The current page
$sortname = 'id'; // Sort column
$sortorder = 'asc'; // Sort order
$qtype = ''; // Search column
$query = ''; // Search string
// Get posted data
if (isset($_POST['page'])) {
        $page = mysql_real_escape_string($_POST['page']);
}
if (isset($_POST['sortname'])) {
        $sortname = mysql_real_escape_string($_POST['sortname']);
}
if (isset($_POST['sortorder'])) {
        $sortorder = mysql_real_escape_string($_POST['sortorder']);
}
if (isset($_POST['qtype'])) {
        $qtype = mysql_real_escape_string($_POST['qtype']);
}
if (isset($_POST['query'])) {
        $query = mysql_real_escape_string($_POST['query']);
}
if (isset($_POST['rp'])) {
        $rp = mysql_real_escape_string($_POST['rp']);
}
// Setup sort and search SQL using posted dat
$sortSql = "order by $sortname $sortorder";
$searchSql = ($qtype != '' && $query != '') ? "where $qtype = '$query'" : '';

if (strlen($searchSql) == 0)
    $searchSql = "where validated='1'";
else
    $searchSql .= " AND validated='1'";
$sql = "SELECT COUNT(*) from profile $searchSql";

$result = mysql_query($sql);
$row = mysql_fetch_array($result);
$total = $row[0];

$pageStart = ($page-1)*$rp;
$limitSql = "limit $pageStart, $rp";
$data = array();
$data["page"] = $page;
$data["total"] = $total;
$data["rows"] = array();

$sql = "SELECT * FROM `profile` $searchSql $sortSql $limitSql";
$result = mysql_query($sql);
while($row = mysql_fetch_assoc($result))
{
    if ($row['paid'] == 0)
	$row['paid'] = 'No';
    else
	$row['paid'] = "Yes";
    $data["rows"][] = array("id" => $row['id'],
			    "cell" => array($row['firstname'],$row['lastname'],$row['box'],$row['paid']));
}
    echo json_encode($data);	

?>

