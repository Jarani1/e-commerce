<?php session_start(); ?>

<!DOCTYPE html>
<html>

<title>WebShop</title>
<body>


<!--The header links links -->
<?php



include_once("header.php") ?>


<h1> Account details </h1>

<h2>order history</h2>

<?php

require "connectsql.php";
//get order with ur id
$userID = $_SESSION['user'];

$sql_hist = "SELECT * FROM orders WHERE userID ='$userID'";

$result = $connect->query($sql_hist);

if($result->num_rows >0)
{
  while($row=$result->fetch_assoc())
  {
    echo "id: ".$row["id"]. " - Name: ". $row["userID"]. " - Price: ".
    $row["price"]."$". " - date: ". $row["date"];
    echo "<br>";
  }
}else
{
  echo "Inventory is empty.";
}


 ?>

 <h2>full order details</h2>
enter id to get full details
 <form action="myaccount.php" >
   <br>Product ID:<br>
   <input type="text" name="id" required="required">
   <br><br>
   <input type="submit" name="full" value="Enter">
   <br>
 </form>
 <br>

 <?php
 require "connectsql.php";
 if(isset($_GET['id']))
 {
   $order_ID =0;
   $total = 0;
   $date = "";
   //query of champions
   $orderID = $_GET['id'];
   $sql_full= "SELECT orders.id, orders.userID, orders_products.productID,
   orders_products.quantity, orders.price,
   orders.date FROM orders INNER JOIN
   orders_products ON orders_products.id = orders.id
   WHERE orders.id = '$orderID'";

   $result = $connect->query($sql_full);

   if($result->num_rows >0)
   {
     while($row=$result->fetch_assoc())
     {
       $order_ID = $row['id'];
       $total = $row['price'];
       $date=$row['date'];
       echo "user: ".$row['userID']."|". "productID: "
       .$row['productID']."|". "quantity: ".
       $row['quantity']. "|". "";
       echo "<br>";
     }
     echo "ORDER ID: ".$order_ID." TOTAL: ". $total."$". " DATE: ". $date;
   }else
   {
     echo "Inventory is empty.";
   }


 }


  ?>



</body>
</html>
