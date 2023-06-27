<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
    <?php
        include 'header.php';
        if (isset($_SESSION["email"])) {
            header("location: index.php?error=alreadyloggedin");
            exit();
        }
    ?>
    <main>
        <form action="includes/login.inc.php" method="post">
            <h1>Log in</h1>
            <input type="text" name="email" placeholder="Enter email">
            <input type="password" name="password" placeholder="Enter password">
            <button type="submit" name="submit">Sign in</button>
        </form>
        <?php
        if(isset($_GET["error"])){
                $errorMessage = "";
                if ($_GET["error"] == "emptyinput") {
                    $errorMessage = "Please, fill all the input fields.";
                }
                if ($_GET["error"] == "wronglogin") {
                    $errorMessage = "Wrong email or password" ;
                }
                echo $errorMessage;
            }
        ?>
    </main>
</body>
</html>