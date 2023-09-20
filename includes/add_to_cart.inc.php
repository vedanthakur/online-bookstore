<?php
if (isset($_POST['bookId'])) {
  session_start();

  // Retrieve the book ID and quantity from the AJAX request
  $bookId = $_POST['bookId'];
  $quantity = $_POST['quantity'];

  require_once 'dbh.inc.php';

  $sql = "INSERT INTO `cart`(`user_id`, `book_id`, `quantity`) VALUES (?, ?, ?)";
  $statement = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($statement, $sql)) {
    // The SQL statement failed to prepare
    echo "error";
    exit();
  }

  // Bind the variables to the SQL statement
  mysqli_stmt_bind_param($statement, "iii", $_SESSION['user-id'], $bookId, $quantity);

  // Execute the SQL statement
  $result = mysqli_stmt_execute($statement);
  mysqli_stmt_close($statement);

  // Check if the query was successful
  if ($result) {
    // Provide a success response to the AJAX request
    echo "success";
  } else {
    // Provide an error response to the AJAX request
    echo "error";
  }

  mysqli_close($conn);
} else {
  // Provide an error response to the AJAX request
  echo "error";
}
?>