<?php
	$mysql_hostname = "localhost";
	$mysql_user = "root";
	$mysql_password = "root";
	$mysql_database = "blog";

	$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Opps något gick fel ...");
	mysql_select_db($mysql_database, $bd) or die("Opps något gick fel ...");
?>
