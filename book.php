<!DOCTYPE html>
<html>
<head>
  <title>Add Book</title>
</head>
<body>
  <h1>Add Book</h1>
  <form action="add_book.php" method="POST">
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" required><br><br>
    
    <label for="author">Author:</label>
    <input type="text" id="author" name="author" required><br><br>
    
    <label for="description">Description:</label><br>
    <textarea id="description" name="description" rows="4" cols="50" required></textarea><br><br>
    
    <label for="publication-date">Publication Date:</label>
    <input type="date" id="publication-date" name="publication-date" required><br><br>
    
    <label for="price">Price:</label>
    <input type="number" id="price" name="price" min="0" step="0.01" required><br><br>
    
    <label for="quantity">Quantity in Stock:</label>
    <input type="number" id="quantity" name="quantity" min="0" required><br><br>
    
    <input type="submit" value="Add Book">
  </form>
</body>
</html>
