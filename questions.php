<?php
require_once("auth.php");
?>
<!doctype html>
<html>
    <head>
      <script type="text/javascript" src="js/jquery-1.5.1.min.js"></script>
      <script type="text/javascript" src="js/jquery-ui-1.8.13.custom.min.js"></script>
      <script type="text/javascript" src="js/flexigrid.pack.js"></script>
      <script type="text/javascript" src="js/questions.js"></script>
      <link rel="stylesheet" href="css/style.css" media="screen" />
      <link rel="stylesheet" href="css/print.css" media="print" />
      <link type="text/css" href="css/ui-darkness/jquery-ui-1.8.13.custom.css" rel="stylesheet" />
      <link rel="stylesheet" media="screen" href="flexstyle/flexigrid.pack.css" type="text/css" />      
      <style>
.flexigrid div.fbutton .add {
    background: url("flexstyle/images/add.png") no-repeat scroll left center transparent;
}
.flexigrid div.fbutton .delete {
    background: url("flexstyle/images/delete.png") no-repeat scroll left center transparent;
}
.flexigrid div.fbutton .edit {
    background: url("flexstyle/images/edit.png") no-repeat scroll left center transparent;
}
	div.ui-dialog{
 font-size:10px;
}
	</style>
    </head>
    <body>
        <div class="centered bodywrap">
	    <h1><?php echo Settings::$name; ?> Question Editor</h1>
	    <div id="flex" class="flexigrid"></div>
	    <div id="formspace"></div>
	    <br />
	    <a href="kiosk.php">[kiosk]</a> <a href="killsession.php">[logout]</a>
	</div>
	
    </body>
</html>
