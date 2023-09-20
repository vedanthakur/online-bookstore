<!DOCTYPE html>
<html>

<head>
    <title>Add Book</title>
    <link rel="stylesheet" type="text/css" href="main.css">
    <link rel="stylesheet" type="text/css" href="card.css">
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
  <main>
        <?php
            if (isset($_SESSION["name"])) {
                echo '<h1>' . 'Cart of ' . strtok($_SESSION["name"], " ") . '</h1>';
            
                require_once 'includes/dbh.inc.php';

                // Check if the connection was successful
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                $user_id = $_SESSION["user_id"];

                // SQL query to fetch all elements from the table
                $sql = "SELECT * FROM `cart`
                JOIN `books` ON `cart`.`book_id` = `books`.`book_id`
                WHERE `cart`.`user_id` = $user_id";

                // Execute the query
                $result = mysqli_query($conn, $sql);

                // Check if there are any rows returned
                if (mysqli_num_rows($result) > 0) {
                    echo '<div class="card-container">';
                    // Loop through each row and display the elements
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="card">';
                        
                        if ($row["image"]) {
                            echo '<span><img src="data:image/jpeg;base64,' . base64_encode($row["image"]) . '" alt="Image" width="100px"></span>';
                        }
                        // user_id	book_id	quantity	
                        echo '<p>' . $row["title"] . '</p>';
                        echo '<p>Quantity in stock: '. $row["quantity"] . '</p>';
                        echo '<input type="number" name="" id="" placeholder="Quantity" max="'. $row["quantity"] .'">';
                        
                        echo '</div>'; // Close card div
                      }
                    } else {
                      echo "No elements found in the table.";
                    }
                    echo '<button class="add-to-cart">Order Now</button>';
                    
                // Close the database connection
                mysqli_close($conn);
            }
        ?>
         <?php
      
    ?>
    </main>
    
</body>

</html>
