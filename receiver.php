<?php
    $user = "root";
    $password = "root";
    $host = "localhost";
    $connection = mysql_connect($host, $user, $password) or die("Kunde inte ansluta till databasen: " . mysql_error());

    $db = "plan";
    $database = mysql_select_db($db, $connection) or die("Kunde inte ansluta till databasen: " . mysql_error());
    $result = mysql_query($query, $connection) or print("Kan inte lägga till data i databasen" . mysql_error());


    $jsondata = file_get_contents("php://input");

     mysql_query("INSERT INTO receivedjson (data) VALUES ('".$jsondata."')") or die("Fel -".mysql_error());
?>
