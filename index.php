<?php
	session_start();
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link type="text/css" rel="stylesheet" href="../styles.css" />
	<!-- <script type="text/javascript" src="../js/javascript.js"></script> -->
	<title>Örestad Linux</title>
</head>
<body>
	<div id="container">
		<div id="head_title">Örestad Linux</div>
		<div id="date"><?php echo date("m/d/y");?></div>
		<div id="text_under_head_title"><h4>Inloggning för medlemmar</h4></div>
		<form id="form1" name="form1" method="post" action="login-system/login.php">
			<br/>
			<div id="anv">
				Användarnamn:
				<input type="text" name="username" id="username" />
				</div>
			<div id="los">
				Lösenord:
				<input type="password" name="password" id="password" />
			</div>
			<input type="submit" name="btnSubmit" id="btnSubmit" value="Logga in" />
		</form>
		<br/>
		<div id="dotted-line"><hr></div>
		<br/>
		<div id="registration">
			<a href="login-system/registration_form.php">Registrera dig</a>
			<input type="button" onclick="popup()" value="Info">
		</div>
	</div>
</body>
</html>
