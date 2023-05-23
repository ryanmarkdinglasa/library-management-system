<?php
	include 'includes/session.php';
	if(isset($_GET['id'])){
		$id= trim($_GET['id']);
		$sql = "DELETE FROM `post` WHERE `id`= '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Post deleted successfully';
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