<?php

//Establishes connection to the database
$mysqli = require __DIR__ . '/database.php';

//Checks if the form is submitted
if(isset($_POST["submit"])){

  //Information assigned to variables
  $name = $_POST["name"];
  $description = $_POST["description"];
  $price = $_POST["price"];
  if($_FILES["image"]["error"] == 4){
    echo
    "<script> alert('Image Does Not Exist'); </script>"
    ;
  } else {
    $fileName = $_FILES["image"]["name"];
    $fileSize = $_FILES["image"]["size"];
    $tmpName = $_FILES["image"]["tmp_name"];
    
    //Checks if the image is in the proper format and size
    $validImageExtension = ['jpg', 'jpeg', 'png'];
    $imageExtension = explode('.', $fileName);
    $imageExtension = strtolower(end($imageExtension));
    if ( !in_array($imageExtension, $validImageExtension) ){
      echo
      "
      <script>
        alert('Invalid Image Extension');
      </script>
      ";
    }
    else if($fileSize > 1000000){
      echo
      "
      <script>
        alert('Image Size Is Too Large');
      </script>
      ";
    }
    else{
      $newImageName = uniqid();
      $newImageName .= '.' . $imageExtension;

      //Image is moved to the designated folder
      move_uploaded_file($tmpName, '../img/' . $newImageName);

      //Information added to the table
      $query = "INSERT INTO items (name, description, price, image) VALUES (?, ?, ?, ?)";
      $stmt = mysqli_prepare($mysqli, $query);
      mysqli_stmt_bind_param($stmt, "ssis", $name, $description, $price, $newImageName);
      mysqli_stmt_execute($stmt);
      echo
      "
      <script>
        alert('Successfully Added');
        document.location.href = 'adminitems.php';
      </script>
      ";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Add Item</title>
    <link rel="stylesheet" href="../css/adminpage.css">
  </head>
  <body class="item">

      <header>
        <div class="header">Admin Dashboard</div>
      </header>

    <form class="addform" method="post" autocomplete="off" enctype="multipart/form-data">
      
      <label for="name">Name : </label>
      <input class="itemname" type="text" name="name" id = "name" required value=""> <br>

      <label for="description">Description : </label>
      <textarea class="itemdesc" type="text" name="description" id = "discription" required value="" rows="4" cols="50"></textarea> <br>

      <label for="price">Price : </label>
      <input class="itemname" type="text" name="price" id = "price" required value=""> <br>
    
      <label for="image">Image : </label>
      <input type="file" name="image" id = "image" accept=".jpg, .jpeg, .png" value=""> <br> <br>
    
      <button class="submit" type = "submit" name = "submit" href="adminitems.php">Submit</button>
    </form>
    
  </body>
</html> 