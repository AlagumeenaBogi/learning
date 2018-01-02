<?php 
$mysql_host = "localhost";
$mysql_user_name = "root";
$mysql_user_password ="";

$link_global = mysql_connect($mysql_host, $mysql_user_name, $mysql_user_password) or die("cannot connect to  Database Connection");
mysql_select_db("test", $link_global) or die("cannot connect to  Database Selection!");
?>