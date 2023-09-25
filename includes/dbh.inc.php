<?php

$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "online-bookstore";

$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);


if (!$conn) {
    die("Connection failed: " . mysql_connect_error());
}

?>