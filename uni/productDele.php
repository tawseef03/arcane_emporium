<?php 
include("../db/DB_connect1.php"); 

if (isset($_GET['productid'])) {

	$prodID =$_GET['productid'];
	$sql= "DELETE FROM products WHERE product_id='$prodID'";
	if (mysqli_query($db, $sql)) {
         print "<script>";
                   print "alert('The record is successfully deleted');";
                  
                   print " window.close();";
                 print "</script>";
       }

     } else {
              echo "Error deleting record: " . mysqli_error($conn);
            }
	

?>

