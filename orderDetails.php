<!DOCTYPE html>
<html>
<head>
  <title>Add Order Details</title>
</head>
<body>
  <h1>Add Order Details</h1>
  <form action="add_order_details.php" method="POST">
    <label for="order-id">Order ID:</label>
    <input type="text" id="order-id" name="order-id" required><br><br>
    
    <label for="book-id">Book ID:</label>
    <input type="text" id="book-id" name="book-id" required><br><br>
    
    <label for="quantity">Quantity:</label>
    <input type="number" id="quantity" name="quantity" min="1" required><br><br>
    
    <input type="submit" value="Add Order Details">
  </form>
</body>
</html>
