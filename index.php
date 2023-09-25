<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="main.css">
    <link rel="stylesheet" type="text/css" href="card.css">
    <title>Home</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
        $(".add-to-cart").on("click", function() {
            var bookId = $(this).attr("id");
            // alert(bookId);
            var quantity = 1; // Set the default quantity to 1
            addToCart(bookId, quantity);
        });

        function addToCart(bookId, quantity) {
            // Send the bookId and quantity to the server-side script using AJAX
            $.ajax({
                url: "includes/add_to_cart.inc.php",
                type: "POST",
                data: { bookId: bookId, quantity: quantity },
                success: function(response) {
                // Check the response from the server
                if (response === "success") {
                    // The book was added to the cart successfully
                    // alert("Book added to cart!");
                    document.getElementById(bookId).innerHTML = "Book added to cart!";
                } else {
                    // The book failed to be added to the cart
                    // alert("Already added to cart!");
                    document.getElementById(bookId).innerHTML = "Already added to cart!";
                }
                },
                error: function(xhr, status, error) {
                console.log(xhr.responseText);
                alert("Failed to add book to cart. Please try again.");
                }
            });
        }

    });

</script>
</head>

<body>
    <?php
        include 'header.php';
        if (!isset($_SESSION["email"])) {
            header("location: index.php?error=notloggedin");
            exit();
        }
    ?>
    <main>
        <?php
            if (isset($_SESSION["name"])) {
                echo '<h1>' . 'Welcome ' . strtok($_SESSION["name"], " ") . '</h1>';
            
                require_once 'includes/dbh.inc.php';

                // Check if the connection was successful
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // SQL query to fetch all elements from the table
                $sql = "SELECT * FROM `books`";

                // Execute the query
                $result = mysqli_query($conn, $sql);

                // Check if there are any rows returned
                if (mysqli_num_rows($result) > 0) {
                    echo '<div class="card-container">';
                    // Loop through each row and display the elements
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="card">';
                        
                        if ($row["image"]) {
                            echo '<span><img src="data:image/jpeg;base64,' . base64_encode($row["image"]) . '" alt="Image"></span>';
                        }

                        echo '<h3>' . $row["title"] . '</h3>';
                        echo '<p>' . $row["price"] . '</p>';

                        echo '<button class="add-to-cart" id="'. $row["book_id"] .'">Add to Cart</button>';
                                
                        echo '</div>'; // Close card div
                    }
                } else {
                    echo "No elements found in the table.";
                }

                // Close the database connection
                mysqli_close($conn);
            }
        ?>
         <?php
      
    ?>
    </main>
    
</body>

</html>
