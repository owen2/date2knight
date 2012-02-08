<?php
    //error_reporting(E_ALL);
    //ini_set('display_errors', '1');

    require_once("auth.php");
    require_once("connect.php");
require_once('reportlib.php');
?>
<!doctype html>
<head>
    <link rel="stylesheet" href="css/style.css" media="screen" />
<link rel="stylesheet" href="css/print.css" />
</head>
<body>
<div class="padded bodywrap content">
<?php
    $result = mysql_query("SELECT id FROM `profile` WHERE paid=1");
	    while($person = mysql_fetch_array($result))
	    {
	        printReport($person[0]);
	    }
    ?>
</div>
</body>
</html>