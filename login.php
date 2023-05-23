<?php
	include 'includes/session.php';
	error_reporting(E_ALL);
	if(isset($_POST['login'])){
		$idno = $_POST['username'];
		$pass = $_POST['password'];
		
		// Use prepared statements to protect against SQL injection
		$stmt1 = $conn->prepare("SELECT * FROM `students` WHERE `student_id` = ?");
		$stmt1->bind_param('s', $idno);
		$stmt1->execute();
		$result1 = $stmt1->get_result();
		
		$stmt2 = $conn->prepare("SELECT * FROM `faculty` WHERE `faculty_id` = ?");
		$stmt2->bind_param('s', $idno);
		$stmt2->execute();
		$result2 = $stmt2->get_result();
		
		if($result1->num_rows + $result2->num_rows != 1){
			// Protect against username enumeration by returning a generic error message
			$_SESSION['error'] = 'Invalid username or password';
			header('location: index.php');
			exit;
		}
		
		if($result1->num_rows == 1){
			$row = $result1->fetch_assoc();
			$user_type = 'student';
		}
		else{
			$row = $result2->fetch_assoc();
			$user_type = 'faculty';
		}
		
		if(password_verify($pass, $row['password'])){
			$_SESSION[$user_type] = $row['id'];
			header('location: ' . $user_type . '/index.php');
			exit;
		}
		else{
			// Use a generic error message to avoid username enumeration
			$_SESSION['error'] = 'Invalid username or password';
			header('location: index.php');
			exit;
		}
	}
	else{
		// Use a generic error message to avoid username enumeration
		$_SESSION['error'] = 'Invalid username or password';
		header('location: index.php');
		exit;
	}
?>
