<?php
include 'includes/session.php';

if(isset($_POST['add'])){
    $student = trim($_POST['student']);
    $returnDate = trim($_POST['returnDate']);
    $sql = "SELECT * FROM students WHERE student_id = '$student'";
    $dateToday=date('Y-m-d');
    $query = $conn->query($sql);
    if($query->num_rows < 1){
        if(!isset($_SESSION['error'])){
            $_SESSION['error'] = array();
        }
        $_SESSION['error'][] = 'Student not found';
    }   
    else{
        if($returnDate < $dateToday){
            if(!isset($_SESSION['error'])){
                $_SESSION['error'] = array();
            }
            $_SESSION['error'][] = 'Invalid date, please try again.';
        }
        else{ 
            $row = $query->fetch_assoc();
            $student_id = $row['id'];
            $added = 0;
            foreach($_POST['isbn'] as $isbn){
                if(!empty($isbn)){
                    $sql = "SELECT * FROM books WHERE isbn = '$isbn' AND status != 1";
                    $query = $conn->query($sql);
                    if($query->num_rows > 0){
                        $brow = $query->fetch_assoc();
                        $bid = $brow['id'];
                        $quantity = $brow['quantity'];
                        if ($quantity > 0) {
                            $sql = "INSERT INTO borrow (student_id, book_id, date_borrow,returnDate) VALUES ('$student_id', '$bid', NOW(),'$returnDate')";
                            if($conn->query($sql)){
                                $added++;
                                $quantity--;
                                if ($quantity == 0) {
                                    $sql = "UPDATE books SET status = 1, quantity = '$quantity' WHERE id = '$bid'";
                                } else {
                                    $sql = "UPDATE books SET quantity = '$quantity' WHERE id = '$bid'";
                                }
                                $conn->query($sql);
                            }
                            else{
                                if(!isset($_SESSION['error'])){
                                    $_SESSION['error'] = array();
                                }
                                $_SESSION['error'][] = $conn->error;
                            }
                        } else {
                            if(!isset($_SESSION['error'])){
                                $_SESSION['error'] = array();
                            }
                            $_SESSION['error'][] = 'Book with ISBN - '.$isbn.' unavailable';
                        }
                    }
                    else{
                        if(!isset($_SESSION['error'])){
                            $_SESSION['error'] = array();
                        }
                        $_SESSION['error'][] = 'Book with ISBN - '.$isbn.' unavailable';
                    }
                }
            }
            if($added > 0){
                $book = ($added == 1) ? 'Book' : 'Books';
                $_SESSION['success'] = $added.' '.$book.' successfully borrowed';
            }
        }
    }
}   
else{
    $_SESSION['error'] = 'Fill up add form first';
}
header('location: borrow.php');

?>