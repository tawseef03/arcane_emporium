<?php

    //Establish connection to the database and fetch user info
    $mysqli = require __DIR__ . "/database.php";

    $sql = sprintf("SELECT * FROM users
                       WHERE username = '%s'",
                       $mysqli->real_escape_string($_POST["luser"]));
    
    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();

    if ($user) {
        
        //Verifies user password
        if (password_verify($_POST["lpass"], $user["password"])) {
            
            session_start();

            session_regenerate_id();

            $_SESSION["user_id"] = $user["id"];
            
            //Checks if the user logging in is an admin or not(0 for user, 1 for admin)
            if ($user["type"] == 0) {
            
            header("Location: shop.php");
            exit;

            } else {

                header("Location: ../html/adminpage.html");
                exit;

            }
        } else {

            die("Username or password is incorrect.");
    
        }
    } 