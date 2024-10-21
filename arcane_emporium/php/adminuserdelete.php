<?php

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $mysqli = require __DIR__ . '/database.php';

    $sql = "DELETE FROM users WHERE id=$id";
    $mysqli->query($sql);
}

//Redirects admin to the user table
header("Location: ../php/adminusers.php");
exit;
?>