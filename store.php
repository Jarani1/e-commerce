
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

 new notes: extract name
 put in variables.
 link name.
 press and it goes to shopping cart.
 then press cart and therE boiii


UPDATE::

Set all in store when clicked the array is updated
You still stay on the page. When you go to cart the array
is loaded in. And everything and it's quant is loaded out



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
    $row["category"];
    echo "<a href='cart.php?id=" . $row['id'] ."'> Add to cart</a>"; //real nice

  }
}else
{
  echo "Inventory is empty.";
}

 ?>

</body>
</html>
