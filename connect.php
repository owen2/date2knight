<?php require_once("dbauth.php"); mysql_connect(DbAuth::$host, DbAuth::$user,DbAuth::$password);$sql="USE " . DbAuth::$db;mysql_query($sql);?>
