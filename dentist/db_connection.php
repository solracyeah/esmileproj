<?php
$server = "localhost";
$username = "root"; 
$password = "";     
$database = "esmile_db";

$database=mysqli_connect($server, $username, $password, $database);
	if($database===false)
	{
		die("conenction error");
	}


?>