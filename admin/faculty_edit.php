<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$firstname = trim($_POST['firstname']);
		$lastname = trim($_POST['lastname']);
		$course = trim($_POST['course']);
		$email=trim($_POST['email']);
		$contactNo=trim($_POST['contactNo']);

		$sql = "UPDATE `faculty` SET `firstname` = '$firstname', `lastname` = '$lastname',`contactNo`='$contactNo',`email`='$email' WHERE `faculty_id` = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Faculty updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:faculty.php');

?>