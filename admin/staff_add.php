<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$username = $_POST['username'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$options = [
			'cost' => 12,
		];
		$password = "12345";
		$hash = password_hash($password, PASSWORD_BCRYPT, $options);
		$photo='';
		$check_isbn="SELECT `username` FROM `admin` WHERE `username`='".$username."'";
		//check if the username is already taken
		$result = $conn->query($check_isbn);
		$row= $conn->num_rows;
		if ($result) {
			$row = $result->num_rows;
			if ($row > 0) {
				$_SESSION['error'] = 'The username is already taken!';
			}
		}
		//add staff if no error
		if (!isset($_SESSION['error'])) {
			// insert the student data into the database
			$sql = "INSERT INTO admin (`username`, `password`, `firstname`, `lastname`, `photo`, `created_on`) VALUES ('$username', '$hash', '$firstname', '$lastname', '$photo', NOW())";
			if($conn->query($sql)){
				$_SESSION['success'] = 'Staff added successfully';
			}
			else{
				$_SESSION['error'] = $conn->error;
			}
		}
	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: staff.php');
?>