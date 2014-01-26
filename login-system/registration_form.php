<!DOCTYPE HTML>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" href="../styles.css" type="text/css"/>
	<!-- <script type="text/javascript" src="../javascript/javascript.js"></script> -->
	<title>Registrera dig:</title>
</head>
<body>
	<div id="container">
		<h1>Plan | Örestad Linux</h1>
		<h4>Registreringsformulär:</h4>
		<form id="form1" name="form1" method="post" action="../login-system/registration_script.php">
			Användarnamn:
			<input type="text" name="txtUser" id="txtUser"/>
			Lösenord:
			<input type="password" name="txtPassword" id="txtPassword"/>
			<input type="submit" name="btnRegister" id="btnRegister" value="Registrera dig"/>
		</form>
		<div id="dotted-line"></div>
		<br/>
		<input type="button" onclick="popup()" value="info">
	</div>
</body>
</html>
