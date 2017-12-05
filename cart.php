<?php session_start(); ?>
<!DOCTYPE html>
<html>

<title>WebShop</title>
<body>


<!--The header links links -->
<?php include_once("header.php") ?>


<h1> Shopping Cart  </h1>


<?php
require "connectsql.php";
//$_GET['req']
if(isset($_GET['remove']))
{
  //empty cart
  $userID = $_SESSION['user'];
  $sql = "DELETE FROM cart WHERE userID ='$userID'";
  if($connect->query($sql)==TRUE)
  {
    echo "Cart Empty";
  }else
  {
    echo "Error: ". $sql . "<br>" . $connect->error;
  }
}

 ?>
<!--
Display cart
  -->
<?php


require "connectsql.php";
if(isset($_SESSION['user']) && !(isset($_GET['remove'])))
{
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

    }
  }else
  {
    echo "Cart Empty.";
  }
}
 ?>

 <form action="cart.php">
   <input type="submit" name="remove" value="Remove All">
 </form>
<br>
<form action="checkout.php">
  <input type="submit" name="check" value="checkout">
</form>


</body>
</html>
