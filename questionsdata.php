<?
require_once('auth.php');
require_once('connect.php');

$page = 1;
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

$sql = "SELECT count(*) FROM question $searchSql";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);
$total = $row[0];

$pageStart = ($page-1)*$rp;
$limitSql = "limit $pageStart, $rp";
$data = array();
$data["page"] = $page;
$data["total"] = $total;
$data["rows"] = array();

$sql = "SELECT lefttext,text,righttext,enable,id FROM question $searchSql $sortSql $limitSql";
$result = mysql_query($sql);
while($row = mysql_fetch_assoc($result))
{
    if ($row['enable'] == 0)
	$row['enable'] = 'No';
    else
	$row['enable'] = "Yes";
    $data["rows"][] = array("id" => $row['id'],
			    "cell" => array($row['lefttext'],$row['text'],$row['righttext'],$row['enable']));
}
    echo json_encode($data);	





?>
