<?php
if (isset($_POST["submit"])) {
    $title = $_POST["title"];
    $author = $_POST["author"];
    $description = $_POST["description"];
    $image = $_POST["image"];
    $publicationDate = $_POST["publicationDate"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    addBook($conn, $title, $author, $description, $image, $publicationDate, $price, $quantity);
}
else {
    header("location: ../book.php");
    exit();
}


?>