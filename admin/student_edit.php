<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$firstname = trim($_POST['firstname']);
		$lastname = trim($_POST['lastname']);
		$course = trim($_POST['course']);
		$email=trim($_POST['email']);
		$contactno=trim($_POST['contactno']);
		$sql = "UPDATE students SET firstname = '$firstname', lastname = '$lastname',contactno='$contactno',email='$email', course_id = '$course' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Student updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:student.php');

?>