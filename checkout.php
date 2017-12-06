
<?php session_start(); ?>
<!DOCTYPE html>
<html>

<title>WebShop</title>
<body>


<!--The header links links -->
<?php



include_once("header.php") ?>


<h1> CheckOUT </h1>


<?php
require "connectsql.php";
//$_GET['req']
if(isset($_GET['order']))
{
  echo date("Y-m-d");
  echo "<br>";
  echo "<br>";
  //do a whole lotta shit
  //These orders has to register somewhere
  //THE QUERY OF CHAMPIONS
  //SELECT orders.id, orders.userID, orders_products.productID,
  //orders_products.quantity, orders.price,
  // orders.date FROM orders INNER JOIN
  //orders_products ON orders_products.id = orders.id;
  //THE QUERY OF CHAMPIONS

  //Remove items from respective databases and put in orders
  //if pressed and quant < then cart say out of order 2 late
  //some1 else bought before you
  //remove from prod
  //UPDATE `products` SET `quantity` = '0' WHERE `products`.`id` = 11;

  //create order
  $userID = $_SESSION['user'];
  // $price =

  // $sqlorder = "INSERT INTO orders (userID, price, 'date') VALUES
  // ()"




}

 ?>



<?php

require "connectsql.php";
$totprice=0;
$userID = $_SESSION['user'];
//everyrow that has this user id in cart print it.
//get prodID save then get price

$sql = "SELECT * FROM cart WHERE userID ='$userID'";
$result = $connect->query($sql);

if($result->num_rows >0)
{
  while($row=$result->fetch_assoc())
  {
    //In the loop we take the ID and query it to products for name
    //Do we care about price?
    $prodID = $row['productID'];
    $prodQ = $row['quantity'];
    global $prodname, $prodprice;
    $sql1 = "SELECT * FROM products WHERE id = '$prodID'";
    $result1 = $connect->query($sql1);
    if($result1->num_rows>0)
    {
      while($row=$result1->fetch_assoc())
      {
        //get price from prodID

        $GLOBALS['prodname'] = $row['name'];
        $GLOBALS['prodprice'] = $row['price'];
        // $prodname = $row['name'];
        // $prodprice = $row['price'];
      }
    }
    //multiply quant with price
    $qprice = $prodprice * $prodQ;
    echo "Name: ".$prodname." - quantity: ".$prodQ
    . " - total: ". $qprice."$" ;
    echo "<br>";
    $totprice = $totprice + $qprice;


  }
  if(!isset($GLOBALS['price']))
  {
    $GLOBALS['price'] = $totprice;
    echo "<br>";
    echo "TOTAL PRICE - ". $GLOBALS['price'];
  }
}else
{
  echo "Cart Empty.";
}


 ?>
 <br>
 <form action="checkout.php">
   <input type="submit" name="order" value="order">
 </form>


</body>
</html>
