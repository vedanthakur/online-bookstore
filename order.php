<!DOCTYPE html>
<html>
<head>
  <title>Place Order</title>
</head>
<body>
  <h1>Place Order</h1>
  <form action="place_order.php" method="POST">
    <label for="user-id">User ID:</label>
    <input type="text" id="user-id" name="user-id" required><br><br>
    
    <label for="book-id">Book ID:</label>
    <input type="text" id="book-id" name="book-id" required><br><br>
    
    <label for="quantity">Quantity:</label>
    <input type="number" id="quantity" name="quantity" min="1" required><br><br>
    
    <input type="submit" value="Place Order">
  </form>
</body>
</html>
