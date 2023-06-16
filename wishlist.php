<!DOCTYPE html>
<html>
<head>
  <title>Add to Wishlist</title>
</head>
<body>
  <h1>Add to Wishlist</h1>
  <form action="add_to_wishlist.php" method="POST">
    <label for="user-id">User ID:</label>
    <input type="text" id="user-id" name="user-id" required><br><br>
    
    <label for="book-id">Book ID:</label>
    <input type="text" id="book-id" name="book-id" required><br><br>
    
    <input type="submit" value="Add to Wishlist">
  </form>
</body>
</html>
