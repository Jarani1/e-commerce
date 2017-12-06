<!DOCTYPE html>
<html>

<title>WebShop</title>
<body>

<?php include_once("header.php"); ?>

<h1>Add Item</h1>

<form action="add.php" method="post">
  <br>Name:<br>
  <input type="text" name="name" required="required">
  <br>Price:<br>
  <input type="text" name="price" required="required">
  <br>Quantity:<br>
  <input type="text" name="quantity" required="required">
  <br>Category:<br>
  <input type="text" name="category" required="required">
  <br><br>
  <input type="submit" name="add" value="Add">
  <br>
</form>
<br>






<h1>Add existing item</h1>

<form action="add.php" method="post">
  <br>Product ID:<br>
  <input type="text" name="id" required="required">
  <br>Quantity:<br>
  <input type="text" name="quant" required="required">
  <br><br>
  <input type="submit" name="adde" value="Add">
  <br>
</form>
<br>

<!-- Current items??  -->

<h2>Current Items</h2>



<?php
require "../connectsql.php";

if(isset($_POST['adde']))
{
  $id = $_POST['id'];
  $quantity = $_POST['quant'];

  $sql_update = "UPDATE products SET quantity=(quantity + '$quantity') WHERE
  products.id = '$id' ";

  $connect->query($sql_update);
}


 ?>

<?php
// Add item to database
require "../connectsql.php";

if(isset($_POST['add']))
{

  $sql = "INSERT INTO products (quantity,name,price,category)
   VALUES('$_POST[quantity]','$_POST[name]','$_POST[price]','$_POST[category]')";
   if($connect->query($sql)==TRUE){
     echo "product added";
   }else{
     echo "Error: ". $sql . "<br>" . $connect->error;
   }
}
$connect->close();
 ?>
 <?php
 require "../connectsql.php";

 $sql = "SELECT * FROM products";
 $result = $connect->query($sql);

 if($result->num_rows >0)
 {
   while($row=$result->fetch_assoc())
   {
     echo "id: ".$row["id"]. " - Name: ". $row["name"]. " - Price: ".
     $row["price"]. " - Quantity: ". $row["quantity"]. " - Category: ".
     $row["category"]."<br>";
   }
 }else
 {
   echo "Inventory is empty.";
 }

  ?>
  <br><br>
  <form action="inventory.php">
    <input type="submit" value="back">

  </form>
 </body>
 </html>
