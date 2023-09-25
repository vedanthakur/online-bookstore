<?php
if (isset($_POST['book_ids'])) {
  session_start();
  $bookIds = $_POST['book_ids'];
  $totalAmount = $_POST['total_amount'];
  $quantity = $_POST['quantity'];
  $orderDate = date('Y-m-d');

  // Retrieve the book ID and quantity from the AJAX request

  require_once 'dbh.inc.php';
    $mysqli = new mysqli('localhost', 'root', '', 'online-bookstore');
    if ($mysqli === null) {
        die('Error: Could not connect to the database.');
    }

    try {
        
        $stmt = $mysqli->prepare("INSERT INTO `orders`(`user_id`, `book_ids`, `quantity`, `order_date`, `total_amount`) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("isssi", $_SESSION['user_id'], $bookIds, $quantity, $orderDate, $totalAmount);
        $stmt->execute();

        // Close the statement.
        $stmt->close();

        $sql = "UPDATE `cart` SET `status`=? WHERE `user_id` = ?";
        $statement = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($statement, $sql)) {
            // The SQL statement failed to prepare
            echo "error";
            exit();
        }

        $status = "Placed order";

        mysqli_stmt_bind_param($statement, "si", $status, $_SESSION['user_id']);

        $result = mysqli_stmt_execute($statement);
        mysqli_stmt_close($statement);

        // Check if the query was successful
        if ($result) {
            echo "success";
        } else {
            echo "error";
        }

        } catch (mysqli_sql_exception $e) {
        // Handle the exception.
        if ($e->getCode() === 1062) {
            // The unique order row constraint was violated.
            echo "The order could not be placed because the same order already exists.";
        } else {
            // Some other error occurred.
            echo "An error occurred while placing the order: " . $e->getMessage();
        }
    }
        mysqli_close($conn);
} else {
  // Provide an error response to the AJAX request
  echo "error";
}
?>