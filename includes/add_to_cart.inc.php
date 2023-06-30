<?php
    session_start();
    // Retrieve the book ID from the AJAX request
    $bookId = $_POST['bookId'];
    $userId = $_SESSION["user-id"];
    $quantity = $_POST['quantity'];

    require_once 'dbh.inc.php';

    $query = "INSERT INTO `cart` (`book_id`, `user_id`, `quantity`) VALUES (?, ?, ?)";

    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "sss", $bookId, $userId, $quantity);
    $result = mysqli_stmt_execute($stmt);


    // Check if the query was successful
    if ($result) {
    // Provide a success response to the AJAX request
    echo "success";
    } else {
    // Provide an error response to the AJAX request
    echo "error";
    }
?>
