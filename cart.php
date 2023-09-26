<!DOCTYPE html>
<html>

<head>
    <title>Cart</title>
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
        if (isset($_SESSION["role"])) {
            if ($_SESSION["role"] !== "User") {
                header("location: index.php?notAuthorized");    
            }    
        } else {
            header("location: login.php?notLoggedIn");
        }
    ?>
  <main>
        <?php
            $showButton = true;
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
                WHERE `cart`.`user_id` = '$user_id'
                AND `cart`.`status` = 'In cart'";

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
                        echo '<p class="bookIds">' . $row["book_id"] . '</p>';
                        echo '<p class="price" id="p'. $row["cart_id"].'">' . $row["price"] . '</p>';
                        echo '<p>Quantity in stock: '. $row["quantity"] . '</p>';
                        echo '<input type="number" class="quantity" name="quantity" id="'. $row["cart_id"].'" onchange="calculatePrice('. $row["price"].','. $row["cart_id"].')" placeholder="Quantity" min="0" max="'. $row["quantity"] .'" value="1">';
                        echo '<button class="remove" onclick="deleteThis('.$row["cart_id"].')">Remove from Cart</button>';
                        echo '</div>'; // Close card div
                      }
                    } else {
                        echo "No elements found in the table.";
                        $showButton = false;
                    }
                    echo '</div><br>';  // Close card div
                    if ($showButton) {
                        echo '<button class="order-now" onclick="orderNow()">Order Now of total Rs.<span id="total"></button>';
                    }
                    
                // Close the database connection
                mysqli_close($conn);
            }
        ?>
    </main>
</body>
</html>