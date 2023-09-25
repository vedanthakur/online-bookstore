<!DOCTYPE html>
<html>

<head>
    <title>Order</title>
    <link rel="stylesheet" type="text/css" href="main.css">
    <link rel="stylesheet" type="text/css" href="card.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const priceElements = document.querySelectorAll('.price');
            sum = 0;
            priceElements.forEach((priceElement) => {
                sum += parseInt(priceElement.textContent);
            });
            document.getElementById("total").innerHTML = sum;
        });

        
        function deleteThis(id) {
            var form = document.createElement("form");
            form.method = "POST";
            form.action = "includes/delete_order_item.inc.php";

            var input = document.createElement("input");
            input.type = "hidden";
            input.name = "delete_id";
            input.value = id;

            form.appendChild(input);

            document.body.appendChild(form);
            form.submit();
        }

    </script>

</head>

<body>
    <?php
        include "header.php";
        if (isset($_SESSION["role"])) {
            if ($_SESSION["role"] !== "Admin") {
                header("location: index.php?notAuthorized");    
            }    
        } else {
            header("location: login.php?notLoggedIn");
        }
    ?>
  <main>
        <?php
            if (isset($_SESSION["name"])) {
                echo '<h1>Orders</h1>';
            
                require_once 'includes/dbh.inc.php';

                // Check if the connection was successful
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                $user_id = $_SESSION["user_id"];

                // SQL query to fetch all elements from the table
                $sql = "SELECT * FROM `orders`
                JOIN `users` ON `orders`.`user_id` = `orders`.`user_id`
                JOIN `books` ON `orders`.`book_ids` = `books`.`book_id`
                ORDER BY `orders`.`order_id`";

                

                // Execute the query
                $result = mysqli_query($conn, $sql);

                // Check if there are any rows returned
                if (mysqli_num_rows($result) > 0) {
                    echo '<div class="card-container">';
                    // Loop through each row and display the elements
                    while ($row = mysqli_fetch_assoc($result)) {
                        $bookIds = explode(' ', $row['book_ids']);
                        echo '<div class="card">';
                        
                        foreach ($bookIds as $bookId) {
                        
                        // // user_id	book_id	quantity	
                        //     // echo $bookId . '<br>';

                            $sql1 = "SELECT * FROM `books` WHERE book_id = '$bookId'";
                            $result1 = mysqli_query($conn, $sql1);
                            if (mysqli_num_rows($result1) > 0) {
                                // Loop through each row and display the elements
                                while ($row1 = mysqli_fetch_assoc($result1)) {
                                    if ($row["image"]) {
                                        echo '<span><img src="data:image/jpeg;base64,' . base64_encode($row1["image"]) . '" alt="Image" max-width="30"></span>';
                                    }
                                    echo '<p>'. $row1["title"] . '</p><br>';
                                }
                            }
                        }
                        echo '<p>Order ID:' . $row["order_id"] . '</p>';
                        echo '<p>Orders by ' . $row["name"] . '</p>';
                        echo '<p>Address: ' . $row["address"] . '</p>';
                        echo '<p>User ID: ' . $row["user_id"] . '</p>';
                        echo '<p>Book IDs" ' . $row["book_ids"] . '</p>';                        
                        echo '<p>Quantities: ' . $row["quantity"] . '</p>';
                        echo '<p>Ordered date: ' . $row["order_date"] . '</p>';
                        echo '<p>Total amount: ' . $row["total_amount"] . '</p>';
                        echo '<p>Status: ' . $row["status"] . '</p>';
                        echo '<button class="remove" onclick="deleteThis('.$row["order_id"].')">Delevert and Delete now</button>';
                        //echo '<button class="remove" onclick="deleteThis('.$row["cart_id"].')">Remove from Cart</button>';
                        echo '</div>'; // Close card div
                      }
                    } else {
                      echo "No elements found in the table.";
                    }
                    echo '</div><br>';  // Close card div
                    
                // Close the database connection
                mysqli_close($conn);
            }
        ?>
    </main>
</body>
</html>