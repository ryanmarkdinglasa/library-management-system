<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$firstname = trim($_POST['firstname']);
		$lastname = trim($_POST['lastname']);
		$contactno=trim($_POST['contactno']);
		$email=trim($_POST['email']);
		$photo='';
		$options = [
			'cost' => 12,
		];
		$password = "12345";
		$hash = password_hash($password, PASSWORD_BCRYPT, $options);
		$faculty_id=trim($_POST['faculty_id']);
		$check_studentid="SELECT `student_id` FROM `students` WHERE `student_id`='".$faculty_id."'";
		$check_facultyid="SELECT `faculty_id` FROM `faculty` WHERE `faculty_id`='".$faculty_id."'";
		//check if the username is already taken
		$result1 = $conn->query($check_studentid);
		$result2 = $conn->query($check_facultyid);
		$row1= $conn->num_rows;
		$row2= $conn->num_rows;
		if ($result1 || $result2) {
			$row1 = $result1->num_rows;
			$row2 = $result2->num_rows;
				if ($row2 > 0 || $row1 > 0) {
					$_SESSION['error'] = 'The ID Number is already taken!';
				}
		}
		if (!isset($_SESSION['error'])) {
			$sql = "INSERT INTO `faculty` (faculty_id,password, firstname, lastname,contactno, email, photo, created_on) VALUES ('$faculty_id','$hash', '$firstname', '$lastname','$contactno','$email', '$photo',  NOW())";
			if($conn->query($sql)){
				$_SESSION['success'] = 'Faculty added successfully';
			}
			else{
				$_SESSION['error'] = $conn->error;
			}
		}
	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: faculty.php');
?>