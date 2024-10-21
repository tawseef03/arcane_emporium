<?php
require_once("../db/DB_connect1.php"); 


// connect to the database

$errors = array(); 

// REGISTER USER
if (isset($_POST['Additem'])) {


// Create the Table in MySQL Databases
$sql = "CREATE TABLE IF NOT EXISTS products(
    product_id  VARCHAR(30) NOT NULL PRIMARY KEY,
    product_name VARCHAR(30) NOT NULL,
    product_desc VARCHAR(30) NOT NULL,
    product_qty INT(8),
    product_price DECIMAL(5)
    
)";
if(mysqli_query($db, $sql)){
    echo "Table created successfully.";


  // receive all input values from the form
  
  $prodId = mysqli_real_escape_string($db, $_POST['productId']);
  $prodName = mysqli_real_escape_string($db, $_POST['productName']);
  $prodDesc = mysqli_real_escape_string($db, $_POST['productDesc']);
  $prodQty = mysqli_real_escape_string($db, $_POST['productQty']);
  $prodPric = mysqli_real_escape_string($db, $_POST['productPrice']);

 

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
 
  $user_check_query = "SELECT * FROM products WHERE product_id='$prodId' OR product_name='$prodName' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['product_id'] === $prodId) {
      array_push($errors, "Product Id already exists");
    }

    if ($user['product_name'] === $prodName) {
      array_push($errors, "Product Name already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	

  	$query = "INSERT INTO products (product_id, product_name, product_desc, product_qty,product_price) VALUES ('$prodId', '$prodName','$prodDesc','$prodQty','$prodPric')";
  	
    mysqli_query($db, $query);
  	
  	header('location: ../html/addItems.html');
  }
}
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
}

// ... 