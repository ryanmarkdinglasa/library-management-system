<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];
		$sql = "DELETE FROM `faculty` WHERE `faculty_id` = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Faculty deleted successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Select item to delete first';
	}

	header('location: faculty.php');
	
?>