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
<form action="inventory.php">
  <input type="submit" value="back">

</form>


<!-- Current items??  -->


</body>
</html>

<?php
// Add item to database
require "../connectsql.php";

if(isset($_POST['add']))
{
  //if already exist just add quantity
  //UPDATE `products` SET `quantity` = '5' WHERE `products`.`id` = 11;



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
