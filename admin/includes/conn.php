<?php
	$conn = new mysqli('localhost', 'root', '', 'dblms');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
?>