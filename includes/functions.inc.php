<?php

function emptyInputSignup($name, $email, $password, $passagain, $mobile, $address){
    $result;
    if(empty($name) || empty($email) || empty($password) || empty($passagain) || empty($mobile) || empty($address)){
         $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function invalidEmail($email){
    $result;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
         $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function passwordMatch($password, $passagain) {
    $result;
    if($password !== $passagain) {
         $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function emailExists($conn, $email) {
    $sql = "SELECT * FROM `users` WHERE email = ?";
    $statement = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($statement, $sql)) {
        header("location: ../signup.php?error=emailalreadyexits");
        exit();
    }

    mysqli_stmt_bind_param($statement, "s", $email);
    mysqli_stmt_execute($statement);

    $resultData = mysqli_stmt_get_result($statement);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    }
    else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($statement);
}

function createUser($conn, $name, $email, $password, $mobile, $address) {
    $sql = "INSERT INTO `users` (`name`, `email`, `password`, `mobile`, `address`) VALUES (?, ?, ?, ?, ?);";
    $statement = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($statement, $sql)) {
        header("location: ../signup.php?error=statementfailed");
        exit();
    }

    $hashPassword = password_hash($password, PASSWORD_DEFAULT); 
    // password is hashed so cannot be read by database directly

    mysqli_stmt_bind_param($statement, "sssss", $name, $email, $hashPassword, $mobile, $address);
    // ssss means 4 pices of data as string
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);
    header("location: ../signup.php?error=none");
    exit();
}

function emptyInputLogin($email, $password) {
    $result;
    if(empty($email) || empty($password)){
         $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function loginUser($conn, $email, $password) {
    $emailExists = emailExists($conn, $email);

    if ($emailExists === false) {
        header("location: ../login.php?error=wronglogin");
        exit();
    }

    $hashPassword = $emailExists["password"];

    $checkPassword = password_verify($password, $hashPassword);

    if($checkPassword === false){
        header("location: ../login.php?error=wronglogin");
        exit();
    }
    else if($checkPassword === true){
        session_start();
        $_SESSION["email"] = $emailExists["email"];
        $_SESSION["user_id"] = $emailExists["user_id"];
        $_SESSION["name"] = $emailExists["name"];
        $_SESSION["mobile"] = $emailExists["mobile"];
        $_SESSION["address"] = $emailExists["address"];
        header("location: ../index.php");
        exit();
    }
}

// services
function addBook($conn, $title, $author, $description, $image, $publicationDate, $price, $quantity) {
     // Check if a file was uploaded
     if (!empty($_FILES['image']['tmp_name'])) {
        $file = $_FILES['image']['tmp_name'];
        $imageData = file_get_contents($file);
    } else {
        $imageData = null;
    }

    $sql = "INSERT INTO `books` (`title`, `author`, `description`, `image`, `publicationDate`, `price`, `quantity`) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $statement = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($statement, $sql)) {
        header("location: ../book.php?error=statementfailed");
        exit();
    }

    mysqli_stmt_bind_param($statement, "ssssssb", $title, $author, $description, $imageData, $publicationDate, $price, $quantity);

    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);
    header("location: ../book.php?error=none");
    exit();
}


?>