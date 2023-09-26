<?php
    session_start();
?>

<nav>
    <ul>
        <li><a href="index.php">Home</a></li>
        <?php
            if (isset($_SESSION["role"])) {

                echo '<li><a href="profile.php">Profile</a></li>';
                echo '<li><a href="includes/logout.inc.php">Log out</a></li>';
                if ($_SESSION["role"] == "Admin") {
                    echo '<li><a href="book.php">Add Book</a></li>';
                    echo '<li><a href="order.php">Orders</a></li>';
                } elseif ($_SESSION["role"] == "User") {
                    echo '<li><a href="cart.php">Cart</a></li>';
                }
            }
            else {
                echo '<li><a href="signup.php">Sign up</a></li>';
                echo '<li><a href="login.php">Log in</a></li>';
            }
        ?>
    </ul>
</nav>