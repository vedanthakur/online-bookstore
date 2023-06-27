<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="main.css">
    <title>Home</title>
    <style>
        .card {
            width: 200px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin: 10px;
            float: left;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .card img {
            width: 100%;
            height: auto;
        }

        .card h3 {
            margin-top: 10px;
            font-size: 18px;
            text-align: center;
        }

        .card p {
            margin-top: 5px;
            text-align: center;
        }
        
        .add-to-cart {
            display: block;
            width: 100%;
            padding: 8px 0;
            text-align: center;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .add-to-cart:hover {
            background-color: darkgreen;
        }
  </style>
</head>

<body>
    <?php
        include 'header.php';
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
                            echo '<span><img width="100px" src="data:image/jpeg;base64,' . base64_encode($row["image"]) . '" alt="Image"></span>';
                        }

                        echo '<h3>' . $row["title"] . '</h3>';
                        echo '<p>' . $row["price"] . '</p>';
                        echo '<button class="add-to-cart" name="'. $row["book_id"] .'">Add to Cart</button>';
                                
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