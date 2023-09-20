<!DOCTYPE html>
<html>

<head>
    <title>Add Book</title>
    <link rel="stylesheet" type="text/css" href="main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php
        include "header.php";
        if (!isset($_SESSION["email"])) {
            header("location: index.php?error=notloggedin");
            exit();
        }
    ?>
  <h1>Add to Cart</h1>
  <form action="add_to_cart.php" method="POST">
    <label for="user-id">User ID:</label>
    <input type="text" id="user-id" name="user-id" required><br><br>
    
    <label for="book-id">Book ID:</label>
    <input type="text" id="book-id" name="book-id" required><br><br>
    
    <label for="quantity">Quantity:</label>
    <input type="number" id="quantity" name="quantity" min="1" required><br><br>
    
    <input type="submit" value="Add to Cart">
  </form>
</body>
</html>
