<?php
include 'includes/session.php';

if(isset($_POST['add'])){
	$student = $_POST['student'];
		
	$sql = "SELECT * FROM students WHERE student_id = '$student'";
	$query = $conn->query($sql);
	if($query->num_rows < 1){
		if(!isset($_SESSION['error'])){
			$_SESSION['error'] = array();
		}
		$_SESSION['error'][] = 'Student not found';
	}
	else{
		$row = $query->fetch_assoc();
		$student_id = $row['id'];

		$return = 0;
		foreach($_POST['isbn'] as $isbn){
			if(!empty($isbn)){
				$sql = "SELECT * FROM books WHERE isbn = '$isbn'";
				$query = $conn->query($sql);
				if($query->num_rows > 0){
					$brow = $query->fetch_assoc();
					$bid = $brow['id'];
					$sql = "SELECT * FROM borrow WHERE student_id = '$student_id' AND book_id = '$bid' AND status = 0";
					$query = $conn->query($sql);
					if($query->num_rows > 0){
						$borrow = $query->fetch_assoc();
						$borrow_id = $borrow['id'];
						$penalty = 0.0;
						$return_date = new DateTime();
						$return_date = $return_date->format('Y-m-d');
						if ($return_date > $borrow['returnDate']) {
							$borrow_date = new DateTime($borrow['returnDate']);
							$interval = $borrow_date->diff(new DateTime($return_date));
							$days_passed = (int) $interval->format('%a');
							$penalty = $days_passed * 100;
						}
						$sql = "INSERT INTO returns (student_id, book_id, date_return, penalty) VALUES ('$student_id', '$bid', NOW(), $penalty)";
						if($conn->query($sql)){
							$return++;
							$sql = "UPDATE books SET quantity = quantity + 1, status = CASE WHEN quantity = 0 THEN 1 ELSE 0 END WHERE id = '$bid'";
							$conn->query($sql);
							$sql = "UPDATE borrow SET status = 1 WHERE id = '$borrow_id'";
							$conn->query($sql);
						}
						else{
							if(!isset($_SESSION['error'])){
								$_SESSION['error'] = array();
							}
							$_SESSION['error'][] = $conn->error;
						}
					}
					else{
						if(!isset($_SESSION['error'])){
							$_SESSION['error'] = array();
						}
						$_SESSION['error'][] = 'Borrow details not found: ISBN - '.$isbn.', Student ID: '.$student;
					}
				}
				else{
					if(!isset($_SESSION['error'])){
						$_SESSION['error'] = array();
					}
					$_SESSION['error'][] = 'Book not found: ISBN - '.$isbn;
				}
			}
		}

		if($return > 0){
			$book = ($return == 1) ? 'Book' : 'Books';
			$_SESSION['success'] = $return.' '.$book.' successfully returned';
		}
	}
}	
else{
	$_SESSION['error'] = 'Fill up add form first';
}

header('location: return.php');

?>