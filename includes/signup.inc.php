<?php
if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passagain = $_POST["passagain"];
    $mobile = $_POST["mobile"];
    $address = $_POST["address"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputSignup($name, $email, $password, $passagain, $mobile, $address) !== false) {
        header("location: ../signup.php?error=emptyinput");
        exit();
    }
    if (invalidEmail($email) !== false) {
        header("location: ../signup.php?error=invalidemail");
        exit();
    }
    if (passwordMatch($password, $passagain)  !== false) {
        header("location: ../signup.php?error=nomatchpassword");
        exit();
    }
    if (emailExists($conn, $email)  !== false) {
        header("location: ../signup.php?error=emailtaken");
        exit();
    }
    
    
    createUser($conn, $name, $email, $password, $mobile, $address);
}
else {
    header("location: ../signup.php");
    exit();
}
?>