<?php

//Establish connection to the database
$mysqli = require __DIR__ . '/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $id = $_GET["id"];

    //Fetches current user information
    $sql = "SELECT * FROM users WHERE id=$id";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("Location: ../php/adminusers.php");
        exit;
    }

    $username = $row["username"];
    $email = $row["email"];
    $password = $row["password"];
    } else {
    $id = $_GET["id"];

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    //Assigns new information of the user to the table
    do {
        $sql = "UPDATE users " .
               "SET username = '$username', email = '$email', password = '$password' " .
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
            document.location.href = 'adminusers.php';
        </script>
        ";

    } while (true);

}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Add User</title>
        <link rel="stylesheet" href="../css/adminpage.css">
    </head>
    <body class="item">

        <header>
            <div class="header">Admin Dashboard</div>
        </header>

        <form class="addform" method="post" autocomplete="off">
            <input type="hidden" value="<?php echo $id?>">
      
            <label for="username">Username : </label>
            <input class="itemname" type="text" name="username" id = "username" required value=""> <br>

            <label for="email">Email : </label>
            <input class="itemname" type="email" name="email" id = "email" required value=""> <br>

            <label for="password">Password : </label>
            <input class="itemname" type="password" name="password" id = "password" required value=""> <br>
    
            <button class="submit" type = "submit" name = "submit" href="adminusers.php">Submit</button>
        </form>
    
    </body>
</html> 