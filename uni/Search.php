<!DOCTYPE HTML><html>
<head>
<title>Login Form</title>
<script language="JavaScript" type="text/JavaScript">
function validate(userForm) {

var div=document.getElementById("searchmsg");
div.style.color="red";
if(div.hasChildNodes())
{
div.removeChild(div.firstChild);
}
if(userForm.searchitem.value.length ==0) // #11
{
div.appendChild(document.createTextNode("Search field cannot be blank"));
userForm.searchitem.focus();
return false;
}
var div=document.getElementById("searchmsg");
div.style.color="red";
if(div.hasChildNodes())
{
div.removeChild(div.firstChild);
}
if(userForm.itemType.value.length ==0) // #11
{
div.appendChild(document.createTextNode("item Type cannot be blank"));
userForm.itemType.focus();
return false;
}


return true;
}

/* Pops up a window and outputs an HTML document  */

function ShowWindow(url)
{
   options = "width=630,height=400,resizable=yes,scrollbars=yes";
   
   w = window.open(url,'ProductInfos',options);
}

function ConfirmAction(message, url)
{
  if (confirm(message))
  {
	window.location = url;	
  } 
  else alert ('Cancelled');
}

</script>
</head>
<body>
<h1 align="center">Search for Items</h1>
    <br />
    <!-- Search form -->
    <div align="center">
    <form method="post"  action="Search.php" onsubmit="return validate(this);">
        <fieldset style="width:550px" align="center">
        <legend align="left"><b>Search for Items</b></legend>
               <div>
<br/>
                <label>Search:</label>
                <input type="text" name="searchitem"  size="24" />&nbsp;<select name="itemType">
                                                                  <option value="" name="item">    </option>
                                                                  <option value="productId">Product Id</option>
                                                                  <option value="productName">Product Name</option>
                                                                  </select> &nbsp;&nbsp;<input value="Search" type="submit" name="Search"/> <br/><span id="searchmsg"></span>
            </div>

           
       </fieldset>
       
    </form>

<?php
include("../db/DB_connect1.php"); 
if (isset($_POST['Search'])) {
  // receive all input values from the form
  
 $prodItem =  $_POST['searchitem'];
 $type = $_POST['itemType'];
  
   if ($type=="productId"){
      $sql="SELECT * FROM products WHERE product_id LIKE '%$prodItem%'";
    }else{
      $sql="SELECT * FROM products WHERE product_name LIKE '%$prodItem%'";
    }
 echo "<br/>";
 
$result = mysqli_query($db, $sql);
 $number = $result->num_rows;
  
echo "<h2 align='center'>Search Results  </h2>";
 if ($number==0){
    echo "<h3 align='center' style='background-color:red; width:250px'> No Results  </h3>";
 }else{

//$row = mysqli_fetch_assoc($result);

echo "<table border='1'style='width:650px' >";
// There is the table header 
echo" <tr style='background-color:powderblue;'>";
    echo "<th>Product Id</th>";
    echo "<th>Product Name</th>";
    echo "<th>Product Description</th>";
   echo "<th>Product Quantity</th>";
   echo "<th>Product Price</th>";
   echo "<th>Edit</th>";
   echo "<th>Delete</th>";

echo" </tr>";
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
// Here display all the recodes of SQL results
echo "<tr align='center'>";
  echo "<td>".$row['product_id']. "</td>";
  echo "<td>".$row['product_name']. "</td>";
echo "<td>".$row['product_desc']. "</td>";
echo "<td>".$row['product_qty']. "</td>";
  echo "<td>".$row['product_price']. "</td>";
  echo "<td align='center'><a href='#' onClick=ShowWindow('productEdit.php?productid=".$row['product_id']. "');>Edit</a></div></td>";
echo "<td align='center'><a href='#' onClick=ShowWindow('productDele.php?productid=".$row['product_id']. "');>Remove</a></div></td>";
 echo "</tr>";

}
echo "</table>";

}
}
?>
</div>

</body>
</html>