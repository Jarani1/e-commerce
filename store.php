
<!DOCTYPE html>
<html>

<title>WebShop</title>
<body>


<!--The header links links -->
<?php include_once("header.php") ?>


<h1> Store </h1>

<!--

 Want a list. Want name and price .

 File for every item??????

 click = insta add to cart????



 -->


<h2>Current Items</h2>
<?php
require "connectsql.php";

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

</body>
</html>
