<?php 
require_once('connect.php');
require_once('reportlib.php');
// todo: check login
$id = $_REQUEST['id'];
?>
<!doctype html>
<head>
    <link rel="stylesheet" href="css/style.css" media="screen" />
<link rel="stylesheet" href="css/print.css" />
    </head>

    <body>
    <div class="padded bodywrap content">
    <?php printReport($id); ?>
    </div>
    </body>
</html>
