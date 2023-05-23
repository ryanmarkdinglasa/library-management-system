<?php
include 'includes/session.php';

if(isset($_POST['pay'])){
	$id = $_POST['id'];
	$amount = $_POST['amount'];
	$sql = "SELECT * FROM `returns` WHERE id = '$id'";
	$query = $conn->query($sql);
	if($query->num_rows < 1){
		if(!isset($_SESSION['error'])){
			$_SESSION['error'] = array();
		}
		$_SESSION['error'][] = 'Return Book not found';
	}
	else if($amount<0){
		$_SESSION['error'][] = 'Amount is negative';
	}
	else{
		$row = $query->fetch_assoc();
		$return_id = $row['id'];
		$penalty = $row['penalty'];
		$new_penalty = floatval($penalty - $amount); // fix: convert to float value
		if($new_penalty<0){
			$_SESSION['error'][] = 'Amount exceeds';
		}//negative amount
		else{
			$sql = "UPDATE `returns` SET `penalty`='$new_penalty' WHERE `id`='$return_id'";
			if($conn->query($sql)){
				$_SESSION['success'] = 'Penalty paid successfully';
			}
			else{
				if(!isset($_SESSION['error'])){
					$_SESSION['error'] = array();
				}
				$_SESSION['error'][] = $conn->error; // fix: add error message to array
			}
		}
	}
}	
else{
	$_SESSION['error'][] = 'Fill up the form first'; // fix: add error message to array
}

header('location: return.php');

?>
