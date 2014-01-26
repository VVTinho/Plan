<?php
	$host = 'localhost';
	$user = 'root';
	$password = 'root';
	$db = 'blog';

	$link = mysql_connect($host,$user,$password) or die('Error in Server information');

 	mysql_select_db($db,$link) or die('Can not Select Databasse');

	$userName = mysql_real_escape_string($_POST['username']);
	$password = md5(mysql_real_escape_string($_POST['password']));

	$query = "select * from tbladmin where admin_usr_name='$userName' and admin_pwd='$password'";

	$res = mysql_query($query);

	$rows = mysql_num_rows($res);

	if($rows==1) {

		session_start();

		//$_SESSION['userName']  =  $row['admin_usr_name'];
		//$_SESSION['password'];
		header("location: ../planen.php");
	}
	else {

		echo 'Data Does Not Match <br/> Re-Enter UserName and Password';
	}
?>
