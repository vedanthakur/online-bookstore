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

        function orderNow() {
            const bookElement = document.querySelectorAll('.bookIds');
            bookIds = "";
            bookElement.forEach((bookElement) => {
                bookIds += (parseInt(bookElement.textContent) + " ");
            });

            const quantityElements = document.querySelectorAll('.quantity');
            quantities = "";
            quantityElements.forEach((quantityElements) => {
                quantities += (parseInt(quantityElements.value) + " ");
            });

            var form = document.createElement("form");
            form.method = "POST";
            form.action = "includes/order.php";

            var input = document.createElement("input");
            input.type = "hidden";
            input.name = "book_ids";
            input.value = bookIds;

            form.appendChild(input);

            var input2 = document.createElement("input");
            input2.type = "hidden";
            input2.name = "total_amount";
            input2.value = document.getElementById("total").textContent;

            form.appendChild(input2);

            var input3 = document.createElement("input");
            input3.type = "hidden";
            input3.name = "quantity";
            input3.value = quantities;

            form.appendChild(input3);

            document.body.appendChild(form);
            form.submit();
        }

        function deleteThis(id) {
            var form = document.createElement("form");
            form.method = "POST";
            form.action = "includes/delete_card_item.inc.php";

            var input = document.createElement("input");
            input.type = "hidden";
            input.name = "delete_id";
            input.value = id;

            form.appendChild(input);

            document.body.appendChild(form);
            form.submit();
        }

        function calculatePrice(price, id){
            quantity = document.getElementById(id).value;
            totalPrice = price * quantity;
            document.getElementById("p"+id).innerHTML = totalPrice;
            
            const priceElements = document.querySelectorAll('.price');
            sum = 0;
            priceElements.forEach((priceElement) => {
                sum += parseInt(priceElement.textContent);
            });
            document.getElementById("total").innerHTML = sum;
        }

    </script>

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
                        echo '<p>' . $row["user_id"] . '</p>';
                        echo '<p>' . $row["book_ids"] . '</p>';                        
                        echo '<p>' . $row["quantity"] . '</p>';
                        echo '<p>' . $row["order_date"] . '</p>';
                        echo '<p>' . $row["total_amount"] . '</p>';
                        echo '<p>' . $row["status"] . '</p>';
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