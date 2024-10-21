<?php

//Establishes connection to the database
$mysqli = require __DIR__ . '/database.php';

//Checks if the form is submitted
if(isset($_POST["submit"])){

    //Information assigned to variables
    $name = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $type = 0;

    //Variables submitted to the user table
    $query = "INSERT INTO users (type, username, email, password) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($mysqli, $query);
    mysqli_stmt_bind_param($stmt, "isss", $type, $name, $email, $password);
    mysqli_stmt_execute($stmt);
    echo
    "
    <script>
        alert('Successfully Added');
        document.location.href = 'adminusers.php';
    </script>
    ";
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
      
      <label for="username">Username : </label>
      <input class="itemname" type="text" name="username" id = "username" required value=""> <br>

      <label for="email">Email : </label>
      <input class="itemname" type="email" name="email" id = "email" required value=""> <br>

      <label for="password">Password : </label>
      <input class="itemname" type="password" name="password" id = "password" required value=""> <br>
    
      <button class="submit" type = "submit" name = "submit" href="adminitems.php">Submit</button>
    </form>
    
  </body>
</html> 