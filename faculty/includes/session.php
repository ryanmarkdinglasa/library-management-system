<?php
	include 'includes/conn.php';
	session_start();

	if(isset($_SESSION['faculty'])){
		$sql = "SELECT * FROM `faculty` WHERE id = '".$_SESSION['faculty']."'";
		$query = $conn->query($sql);
		$faculty = $query->fetch_assoc();
	}

?>