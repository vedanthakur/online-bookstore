<?php
if (isset($_POST["delete_id"])) {
    $delete_id  = $_POST["delete_id"];
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    function delete_order($conn, $delete_id) {
        $sql = "DELETE FROM orders WHERE `orders`.`order_id` = ?";
        $statement = mysqli_stmt_init($conn);
        
        if (!mysqli_stmt_prepare($statement, $sql)) {
            // echo '<h1>Error: Failed to delete</h1>';
            header("location: ../order.php?error=statementfailed");
            exit();
        }
        
        mysqli_stmt_bind_param($statement, "i", $delete_id);
        $result = mysqli_stmt_execute($statement);
        mysqli_stmt_close($statement);
        // echo '<h1>Item Deleted</h1>';
        if ($result) {
            header("location: ../order.php?error=none".$delete_id);
        }
        exit();
    }
    delete_order($conn, $delete_id);
}

?>