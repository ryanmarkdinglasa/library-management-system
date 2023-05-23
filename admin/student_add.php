<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$firstname = trim($_POST['firstname']);
		$lastname = trim($_POST['lastname']);
		$course = trim($_POST['course']);
		$contactno=trim($_POST['contactno']);
		$email=trim($_POST['email']);
		$photo='';
		$options = [
			'cost' => 12,
		];
		$password = "12345";
		$hash = password_hash($password, PASSWORD_BCRYPT, $options);
		$student_id=trim($_POST['studid']);
		$check_studentid="SELECT `student_id` FROM `students` WHERE `student_id`='".$student_id."'";
		$check_facultyid="SELECT `faculty_id` FROM `faculty` WHERE `faculty_id`='".$student_id."'";
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
		//add student if no error
		if (!isset($_SESSION['error'])) {
			// insert the student data into the database
			$sql = "INSERT INTO students (student_id,password, firstname, lastname,contactno, email, photo, course_id, created_on) VALUES ('$student_id','$hash', '$firstname', '$lastname','$contactno','$email', '$photo', '$course',  NOW())";
			if($conn->query($sql)){
				$_SESSION['success'] = 'Student added successfully';
			}
			else{
				$_SESSION['error'] = $conn->error;
			}
		}
	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: student.php');
?>