<?php

session_start();

//Establish connection to the database
$mysqli = require __DIR__ . "/database.php"

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Control</title>
    <link rel="stylesheet" href="../css/adminpage.css">
</head>
<body>
    
    <header>
        <div class="header">Admin Dashboard</div>
    </header>

    <div class="container">
        <h2>List of Users</h2>
        
        <table class="table">
            <thead>    
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            //Fetch all users from the database
            $rows = mysqli_query($mysqli, "SELECT * FROM users ORDER BY id ASC")
            ?>

            <!---Access each user information one by one and display in the html form--->
            <?php foreach ($rows as $row) : ?>               

                <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo $row["username"]; ?></td>
                    <td><?php echo $row["email"]; ?></td>
                    <td>
                        <a class="edit" href='../php/adminuseredit.php?id=<?php echo $row["id"]?>'>Edit</a>
                        <a class="delete" href='../php/adminuserdelete.php?id=<?php echo $row["id"]?>'>Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <br><br>
        <a class="btn" href="adminaddusers.php" role="button">Add New User</a><br><br>
        <a class="btn" href="../html/adminpage.html" role="button">Back To Admin Panel</a>
    </div>
</body>
</html>