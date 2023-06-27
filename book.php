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
    <h1>Add Book</h1>
    <form action="includes/book.inc.php" method="POST" enctype="multipart/form-data">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>

        <label for="author">Author:</label>
        <input type="text" id="author" name="author" required>

        <label for="description">Description:</label><br>
        <textarea id="description" name="description" rows="4" cols="50" required></textarea><br><br>

        <label for="image">Image:</label>
        <input type="file" id="image" name="image">

        <label for="publicationDate">Publication Date:</label>
        <input type="date" id="publicationDate" name="publicationDate" required>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" min="0" step="0.01" required>

        <label for="quantity">Quantity in Stock:</label>
        <input type="number" id="quantity" name="quantity" min="0" required>

        <input type="submit" name="submit" value="Add Book">
    </form>
</body>

</html>