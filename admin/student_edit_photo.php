<?php
	include 'includes/session.php';
	if(isset($_POST['upload'])){
		$id = $_POST['id'];
		$filename = $_FILES['photo']['name'];
		$file=$_FILES['photo'];
		$mime = getimagesize($file['tmp_name']);
		if ($mime === false){
			$_SESSION['error'] = 'The file selected is too big for an image!';
			header('location: student.php');
			exit();
		}
		if ($_FILES['photo']['error'] == 0) {
			$allowed = array("image/jpeg", "image/png");
			$file_type = $_FILES['photo']['type'];
			if (!in_array($file_type, $allowed)) {
				$_SESSION['error'] = 'The file selected is not an image!!';
				header('location: student.php');
				exit();
			}
			// continue with uploading process
		}
		if(empty($filename)){
			$_SESSION['error'] = 'No file selected!';
			header('location: student.php');
			exit();
		}
		move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);	
		$sql = "UPDATE `students` SET `photo` = '".$filename."' WHERE `id` = '".$id."' ";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Student photo updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Select student to update photo first';
	}

	header('location: student.php');
?>