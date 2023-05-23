<?php
	include 'includes/session.php';

	if(isset($_GET['return'])){
		$return = $_GET['return'];
	}
	else{
		$return = 'home.php';
	}

	if(isset($_POST['save'])){
		$curr_password = $_POST['curr_password'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$photo = $_FILES['photo']['name'];
		if(password_verify($curr_password, $user['password'])){
			$file=$_FILES['photo'];
			if(!empty($photo)){
				move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$photo);
				$filename = $photo;	
				if ($_FILES['photo']['error'] == 0) {
					$allowed = array("image/jpeg", "image/png");
					$file_type = $_FILES['photo']['type'];
					if (!in_array($file_type, $allowed)) {
						$_SESSION['error'] = 'The file selected is not an image!!';
						header('location: home.php');
						exit();
					}
					// continue with uploading process
				}
			}
			else{
				$filename = $user['photo'];
			}
			
			if($password == $user['password']){
				$password = $user['password'];
			}
			else{
				$password = password_hash($password, PASSWORD_DEFAULT);
			}

			$sql = "UPDATE `admin` SET `username` = '$username', `password` = '$password', `firstname` = '$firstname', `lastname` = '$lastname', `photo` = '$filename' WHERE `id` = '".$user['id']."'";
			if($conn->query($sql)){
				$_SESSION['success'] = 'Admin profile updated successfully';
			}
			else{
				if($return == 'borrow.php' OR $return == 'return.php'){
					if(!isset($_SESSION['error'])){
						$_SESSION['error'] = array();
					}
					$_SESSION['error'][] = $conn->error;
				}
				else{
					$_SESSION['error'] = $conn->error;
				}
				
			}
			
		}
		else{
			if($return == 'borrow.php' OR $return == 'return.php'){
				if(!isset($_SESSION['error'])){
					$_SESSION['error'] = array();
				}
				$_SESSION['error'][] = 'Incorrect password';
			}
			else{
				$_SESSION['error'] = 'Incorrect password';
			}

		}
	}
	else{
		if($return == 'borrow.php' OR $return == 'return.php'){
			if(!isset($_SESSION['error'])){
				$_SESSION['error'] = array();
			}
			$_SESSION['error'][] = 'Fill up required details first';
		}
		else{
			$_SESSION['error'] = 'Fill up required details first';
		}
		
	}

	header('location:'.$return);

?>