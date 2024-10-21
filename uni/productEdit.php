<?php
include("../db/DB_connect1.php"); 
global $id;

?>




<?xml version="1.0" encoding="iso-8859-1"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="styles.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: white;
	font-weight: bold;
}
a:link {
	
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	
}
a:hover {
	text-decoration: none;
	
}
a:active {
	text-decoration: none;
	}
.style2 {
	color: #530000;
	font-weight: bold;
	font-style: italic;
	font-family: Arial, Helvetica, sans-serif;
}
.style4 {
	color: #FFFFFF;
	font-family: Arial, Helvetica, sans-serif;
}
.style5 {
	color: #990134;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.style7 {color: #530000; font-family: Arial, Helvetica, sans-serif;}
body {
	background-color: white;
}
.tablestyle{   
    border-spacing: 0px;   
    border-collapse: collapse; 
    border-bottom:dotted  1px #8D8D8D;
    border-left:dotted  1px #8D8D8D;
    border-top:dotted  1px #8D8D8D;
    border-right:dotted  1px #8D8D8D;

}   
.tablestyle2{   
    border-spacing: 0px;   
    border-collapse: collapse; 
    border-bottom:dotted  1px #8D8D8D;
    border-left:dotted  1px #8D8D8D;
    border-right:dotted  1px #8D8D8D;

}   

-->
</style>

<title>Product Details </title></head>
<body>


<?php

?>

<h2>
<?php

if (isset($_GET['productid']) || isset($_POST['Update'])){
$id =$_GET['productid'];

$i=1;
$stat ="SELECT *  FROM products  WHERE product_id  LIKE '%$id%'";
$result = mysqli_query($db, $stat);
 $number = $result->num_rows;
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
?>

<FORM  METHOD='POST' ACTION='productEdit.php?productid=<?php echo $id; ?>' NAME='Form'><B></B> <BR>
<table border=0 align="center"  class="tablestyle2" cellspacing="1">
<tr bgcolor='#6A83DB'>
 <TH colspan=2  align = "center" ><font size ="3" color="white">Product <?php echo $id ?> Information </font></TH>
      
</tr>
<tr class='odd'> <td width="150 px"><b><font size ="3">Product ID</font></b></td>
<TD><INPUT TYPE='TEXT' NAME='productid' VALUE='<?php echo $row['product_id'] ?>' SIZE='55' MAXLENGTH='155' readonly>
</TD>
</TR>
<TR class='even'><TD><B><font size ="3">Product Name </font></B></TD>
<TD><INPUT TYPE='TEXT' NAME='productname' VALUE='<?php echo $row['product_name'] ?>' SIZE='55'  MAXLENGTH='60'>
</TD>
</TR>
<TR class='odd'><TD><B><font size ="3">Product Description</font></B></TD>
<TD><INPUT TYPE='TEXT' NAME='poductdesc' VALUE='<?php echo $row['product_desc'] ?>' SIZE='55' MAXLENGTH='155'>
</TD>
</TR>
 <TR class='odd'><TD><B><font size ="3">Product Quantity</font></B></TD>
<TD><INPUT TYPE='TEXT' NAME='poductQty' VALUE='<?php echo $row['product_qty'] ?>' SIZE='55' MAXLENGTH='155'>
</TD>
</TR>
<TR class='odd'><TD><B><font size ="3">Product Price</font></B></TD>
<TD><INPUT TYPE='TEXT' NAME='poductprice' VALUE='<?php echo $row['product_price'] ?>' SIZE='55' MAXLENGTH='155'>
</TD>
</TR>

<TR>
<TD colspan=2  align = "center" >
 <P align="center"><B> </B><INPUT TYPE='SUBMIT' NAME='Update' VALUE='Update' SIZE='0'  MAXLENGTH='0'> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp<input type='button' onClick='window.close()' value='Close'></p>
</TD>
</TR>

</table>
<div valign="bottom">
<br>

</FORM></CENTER>
<?php
}//else 
    // {
    if(isset($_POST['Update'])) { 

      $productid=$_POST['productid'];
	 $productname=$_POST['productname'];
      $productdesc=$_POST['poductdesc'];
      $productQty=$_POST['poductQty'];
	 $productprice=$_POST['poductprice'];
    
	 
     $query = "UPDATE products SET product_id='$productid', product_name='$productname', product_desc='$productdesc', product_qty='$productQty', product_price='$productprice'  WHERE product_id='$productid'";
	
$result = mysqli_query($db, $query);

    
if ($result) {
    
          $found=true;
 

        }
  else
         { $found=false; }
  

   if ($found==true)
    {
    echo "<p align='center'><font  size='2' color='red'> The Recorde is successfully Updated !!</font><br></p>";
   
    }
    else
    {
      echo "<p align='center'><font  size='2' color='red'> Sorry, The Recorde isn't Updated !!</font><br></p>";
       
    }
   }
//}
?>
</body>
</html>