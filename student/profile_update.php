<?php
	include 'includes/session.php';

	if(isset($_GET['return'])){
		$return = $_GET['return'];
	}
	else{
		$return = 'index.php';
	}

	if(isset($_POST['save'])){
		$id=$_POST['student_id'];
		$curr_password = $_POST['curr_password'];
		$password = $_POST['password'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		//$photo = $_FILES['photo']['name'];
		//
		$stmt1 = $conn->prepare("SELECT * FROM `students` WHERE `student_id` = ?");
		$stmt1->bind_param('s', $id);
		$stmt1->execute();
		$result1 = $stmt1->get_result();
		$row = $result1->fetch_assoc();
		//
		if(password_verify($curr_password, $row['password'])){

			if($password == ''){
				$password = $row['password'];
			}
			else{
				$password = password_hash($password, PASSWORD_DEFAULT);
			}

			$sql = "UPDATE `students` SET  `password` = '$password', `firstname` = '$firstname', `lastname` = '$lastname' WHERE `student_id` = '".$id."'";
			if($conn->query($sql)){
				$_SESSION['success'] = 'Profile updated successfully';
			}
			else{
				if($return == 'index.php' OR $return == 'transaction.php'){
					if(!isset($_SESSION['error'])){
						$_SESSION['error'] = array();
					}
					$_SESSION['error'] = $conn->error;
				}
				else{
					$_SESSION['error'] = $conn->error;
				}
				
			}
			
		}
		else{
			if($return == 'index.php' OR $return == 'transaction.php'){
				if(!isset($_SESSION['error'])){
					$_SESSION['error'] = array();
				}
				$_SESSION['error'] = 'Incorrect password!';
			}
			else{
				$_SESSION['error'] = 'Incorrect password';
			}

		}
	}
	else{
		if($return == 'index.php' OR $return == 'transaction.php'){
			if(!isset($_SESSION['error'])){
				$_SESSION['error'] = array();
			}
			$_SESSION['error'] = 'Fill up required details first!';
		}
		else{
			$_SESSION['error'] = 'Fill up required details first';
		}
		
	}

	header('location:'.$return);

?>