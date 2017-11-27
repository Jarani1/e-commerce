<!DOCTYPE html>
<html>

<title>WebShop</title>
<body>

<?php include_once("header.php"); ?>

<h1>Remove Item</h1>

<!--
 show current items.
 Have form wheru you can type and remove
 update page


  -->
<!-- php remove block if form pressed -->
<?php

require "../connectsql.php";

if(isset($_POST['remove']))
{
  $sql = "DELETE FROM products WHERE id = '$_POST[id]'";

   if($connect->query($sql)==TRUE){
     echo "product removed";
   }else{
     echo "Error: ". $sql . "<br>" . $connect->error;
   }
}
$connect->close();

 ?>





<br>

<h2>Current Items</h2>
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

 <h4>To remove an item enter the "id" and press remove</h4>

 <!-- form -->


 <form action="remove.php" method="post">
   <br>ID:<br>
   <input type="text" name="id" required="required">
   <br><br>
   <input type="submit" name="remove" value="Remove">
   <br>
 </form>
 <br>
 <form action="inventory.php">
   <input type="submit" value="back">

 </form>







</body>
</html>
