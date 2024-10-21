<?php

//access MySQL database via csclamp

   $hostname= "localhost";
   $username="asadik";  /* username and yourdatabase name are the same */
   $dbname ="asadik";
   $password= "**********";

//access MySQL database via XAMPP

$hostname= "localhost";
$username="root";
$dbname ="itdatabase";
$password= "";

//$mysqli = new mysqli($hostname, $username, $password,$dbname);

$db = mysqli_connect($hostname, $username, $password, $dbname);

// Check connection
if($db === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
?>
