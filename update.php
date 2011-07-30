<?php require_once("auth.php");?>
<!doctype html>
<html>
<head>
<link rel="stylesheet" href="css/style.css"/>
</head>
<body>
<div class="padded bodywrap">
<h1>Upgrading Date2Knight!</h1>
<div class="content">
<?php exec("git init"); ?>
<?php passthru("git pull");//This will pull from where you cloned date2knight from. You may have to reconfigure git if this doesn't work. ?>
</div>
<h2>Upgrade process finished!</h2>
</div>
</html>
