<?php
	$host = 'localhost';
	$user = 'root';
	$password = 'root';
	$database = 'blog';

	$conn = mysql_connect($host,$user,$password) or die('Server Informationen är inte korrekt');
	mysql_select_db($database,$conn) or die('Databas Informationen är inte korrekt');

	$userName = mysql_real_escape_string($_POST['txtUser']);

	$password = mysql_real_escape_string($_POST['txtPassword']);

	$password = md5(mysql_real_escape_string ($password));

	if(isset($_POST['btnRegister']))
	{
		$query = "insert into tbladmin(admin_usr_name,admin_pwd)values('$userName','$password')";
		$res = mysql_query($query);
		header('location: ../login-system/success_register.php');
	}
?>
