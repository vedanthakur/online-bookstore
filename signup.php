<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="main.css">
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
            <form action="includes/signup.inc.php" method="post">
                <h1>Sign up</h1>
                <input type="text" name="name" placeholder="Enter full name">
                <input type="text" name="email" placeholder="Enter email">
                <input type="password" name="password" placeholder="Enter password">
                <input type="password" name="passagain" placeholder="Enter password again">
                <input type="tel" name="mobile" placeholder="Enter mobile no.">
                <input type="tel" name="address" placeholder="Enter address">
                <button type="submit" name="submit">Sign up</button>
            </form>
        <?php
            if(isset($_GET["error"])){
                $errorMessage = "";
                if ($_GET["error"] == "emptyinput") {
                    $errorMessage = "Please, fill all the input fields.";
                }
                if ($_GET["error"] == "invalidemail") {
                    $errorMessage = "Please type valid email.";
                }
                if ($_GET["error"] == "nomatchpassword") {
                    $errorMessage = "Passwords do not match.";
                }
                if ($_GET["error"] == "emailtaken") {
                    $errorMessage = "This email already exists.";
                }
                if ($_GET["error"] == "statementfailed") {
                    $errorMessage = "Something went wrong."; 
                }
                echo "<p>" . $errorMessage . "</p>";
            }
        ?>
    </main>
</body>
</html>