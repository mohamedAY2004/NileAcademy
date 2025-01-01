<?php

	$Host = 'localhost';
	$username = 'root';
	$password = '';
	$DB = 'nileacademy';
	$port = 3307;  // specify the port number
	$conn = mysqli_connect($Host, $username, $password, $DB, $port) or die(mysqli_error());
	

?>