<?php
	include 'includes/session.php';
	if(isset($_POST['add'])){
		$isbn = $_POST['isbn'];
		$title = $_POST['title'];
		$category = $_POST['category'];
		$author = $_POST['author'];
		$publisher = $_POST['publisher'];
		$quantity= trim($_POST['quantity']);
		$pub_date = $_POST['pub_date'];
		$check_isbn="SELECT isbn FROM `books` WHERE `isbn`='".$isbn."'";
		//$conn1->query($check_isbn);
		$result = $conn->query($check_isbn);
		$row= $conn->num_rows;
		if ($result) {
		$row = $result->num_rows;
		if ($row > 0) {
			$_SESSION['error'] = 'The ISBN is already taken!';
		} else {
			$sql = "INSERT INTO books (isbn, category_id, title, author, publisher,quantity, publish_date) VALUES ('$isbn', '$category', '$title', '$author', '$publisher','$quantity', '$pub_date')";
			if ($conn->query($sql)) {
				$_SESSION['success'] = 'Book added successfully';
			} else {
				$_SESSION['error'] = $conn->error;
			}
		}
	}
}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}
	header('location: book.php');

?>