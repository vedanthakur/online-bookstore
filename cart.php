<!DOCTYPE html>
<html>
<head>
  <title>Add to Cart</title>
</head>
<body>
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
