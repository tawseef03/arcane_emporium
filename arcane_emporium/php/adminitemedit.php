<?php

//Establish connection to the database
$mysqli = require __DIR__ . '/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $id = $_GET["id"];

    //Fetches current item information
    $sql = "SELECT * FROM items WHERE id=$id";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("Location: ../php/adminitems.php");
        exit;
    }

    $name = $row["name"];
    $description = $row["description"];
    $price = $row["price"];
} else {
    $id = $_GET["id"];

    $name = $_POST["name"];
    $description = $_POST["description"];
    $price = $_POST["price"];

    //Assigns new information of the item to the table
    do {
        $sql = "UPDATE items " .
               "SET name = '$name', description = '$description', price = '$price' " .
               "WHERE id = $id";

        $result = $mysqli->query($sql);

        if (!$result) {
            echo "Invalid query: " . $mysqli->error;
            break;
        }

        echo
        "
        <script>
            alert('Successfully Updated');
            document.location.href = 'adminitems.php';
        </script>
        ";

    } while (true);

}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Edit Item</title>
        <link rel="stylesheet" href="../css/adminpage.css">
    </head>
    <body class="item">

        <header>
            <div class="header">Admin Dashboard</div>
        </header>

        <form class="addform" method="post" autocomplete="off" enctype="multipart/form-data">
            <input type="hidden" value="<?php echo $id?>">
      
            <label for="name">Name : </label>
            <input class="itemname" type="text" name="name" id = "name" required value=""> <br>

            <label for="description">Description : </label>
            <textarea class="itemdesc" type="text" name="description" id = "discription" required value="" rows="4" cols="50"></textarea> <br>

            <label for="price">Price : </label>
            <input class="itemname" type="text" name="price" id = "price" required value=""> <br>
    
            <button class="submit" type = "submit" name = "submit" href="adminitems.php">Submit</button>
        </form>
    
  </body>
</html> 