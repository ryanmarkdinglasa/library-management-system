<?php
	include 'includes/session.php';
	if(isset($_POST['post'])){
		$context = trim($_POST['context']);
		$title = trim($_POST['title']);
		$admin = $_SESSION['admin'];
		$datetime = date('Y-m-d H:i:s');
		$sql = "INSERT INTO `post` (`title`,`description`,`posted_by`,`created`) VALUES ('$title', '$context','$admin','$datetime')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Post created successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}
	header('location: home.php');
?>