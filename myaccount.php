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


</body>
</html>
