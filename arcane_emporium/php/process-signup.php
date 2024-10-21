<?php

//Assigning the type '0' (user) to everyone signing up by default
$type = '0';

//Verifies each submitted values
if (empty($_POST["suser"])) {
    die("Username required");
}

if ( ! filter_var($_POST["semail"], FILTER_VALIDATE_EMAIL)) {
    die("Valid email required");
}

if (strlen($_POST["spass"]) < 8) {
    die("Password must be at least 8 characters");
}

if ( ! preg_match("/[a-z]/i", $_POST["spass"])) {
    die("Password must contain at least one letter");
}

if ( ! preg_match("/[0-9]/", $_POST["spass"])) {
    die("Password must contain at least one number");
}

if ($_POST["spass"] !== $_POST["srepass"]) {
    die("Password must match");
}

//User password is hashed and stored in a variable
$password_hash = password_hash($_POST["spass"], PASSWORD_DEFAULT);

//Establish connection to the database and insert user info into the table
$mysqli = require __DIR__ . "/database.php";

$sql = "INSERT INTO users (type, username, email, password)
        VALUES (?, ?, ?, ?)";

$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("isss", $type, $_POST["suser"], $_POST["semail"], $password_hash);

if ($stmt->execute()) {

    //Takes the user back to the login page
    header("Location: ../html/loginsignup.html");
    exit;
    
} else {
    
    if ($mysqli->errno === 1062) {
        die("email already taken");
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}