<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Profile</title>
</head>
<body>
    <?php
        include "header.php";
        if (!isset($_SESSION["email"])) {
            header("location: index.php?error=alreadyloggedin");
            exit();
        }
        else {
            echo '<main>';
            echo '<h1>' . $_SESSION["name"] . '</h1>';
            echo '<p>Email: ' .$_SESSION["email"];
            echo '<p>User ID: ' .$_SESSION["user_id"]. '</p>';
            echo '<p>Mobile: ' .$_SESSION["mobile"]. '</p>';
            echo '<p>Address: ' .$_SESSION["address"]. '</p>';
            echo '<p>Role: ' .$_SESSION["role"]. '</p>';
            echo '</main>';
        }
    ?>
</body>
</html>