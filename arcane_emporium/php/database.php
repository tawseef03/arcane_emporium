<?php

//access Arcane Emporium database

$hostname= "localhost";
$username="root";
$dbname ="arcaneemporium";
$password= "";

//$mysqli = new mysqli($hostname, $username, $password,$dbname);

$mysqli = new mysqli($hostname, $username, $password, $dbname);

// Check connection
if($mysqli->connect_errno){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}

return $mysqli;