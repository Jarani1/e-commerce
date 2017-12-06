
<!DOCTYPE html>
<html>

<title>WebShop</title>
<body>
<!--The header links links -->
<?php include_once("header.php") ?>

<h1>ALL ORDERS</h1>

<?php
require "../connectsql.php";
$sql_orders = "SELECT * FROM orders";

$result = $connect->query($sql_orders);

if($result->num_rows >0)
{
  while($row=$result->fetch_assoc())
  {
    echo "OrderID: ".$row["id"]. " - userID: ". $row["userID"]. " - Price: ".
    $row["price"]. " - DATE: ". $row["date"];
    echo "<br>";
  }
}else
{
  echo "Inventory is empty.";
}


 ?>

 <h2>full order details</h2>
enter id to get full details
 <form action="add.php" method="post">
   <br>Product ID:<br>
   <input type="text" name="id" required="required">
   <br><br>
   <input type="submit" name="full" value="Enter">
   <br>
 </form>
 <br>




</body>
</html>
