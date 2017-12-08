<?php session_start(); ?>
<!DOCTYPE html>
<html>

<title>WebShop</title>
<body>


<!--The header links links -->
<?php include_once("header.php") ?>


<h1> Shopping Cart  </h1>

<?php
//remove one from cart
require "connectsql.php";
if(isset($_GET['removeone']))
{
  $uid = $_SESSION['user'];
  $removeid = $_GET['removeone'];
  $sql_remove = "DELETE FROM cart WHERE userID='$uid' AND
  productID = '$removeid'";

   if($connect->query($sql_remove)==TRUE){
     //echo "product removed";
   }else{
     echo "Error: ". $sql . "<br>" . $connect->error;
   }
}


 ?>


<?php
//if edited add
//add all cart id fields
//make sure to only increment/subtract if <cart and >0
require "connectsql.php";

if(isset($_GET['id']))
{
  $idval = $_GET['id'];
  $uid = $_SESSION['user'];
  $pid = $_GET['prodid'];
  $quant = $_GET['prodq'];
  $dataq = 0;

  //get product quantity

  $sqlc = "SELECT quantity FROM products WHERE id = '$pid'";

  //get prod for database
  $resultc = $connect->query($sqlc);

  if($resultc->num_rows >0)
  {
    while($row=$resultc->fetch_assoc())
    {
      //$GLOBALS['dquant'] = $row['quantity'];
      $dataq = $row['quantity'];
    }
  }else
  {
    echo "Out of stock!";
  }



  if($quant<=$dataq && $quant>=0)
  {

      if($idval==1)
      {
        $sql_update = "UPDATE cart SET quantity=(quantity + '$idval') WHERE
        cart.userID = '$uid' AND cart.productID = '$pid' ";
        $connect->query($sql_update);

      }
      else if($idval==-1)
      {
        $sql_update1 = "UPDATE cart SET quantity=(quantity + '$idval') WHERE
        cart.userID = '$uid' AND cart.productID = '$pid' ";
        $connect->query($sql_update1);

      }
  }
  else
  {
    echo "Out of stock!";
    echo "<br>";
  }
}




 ?>



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
    $_SESSION['total']=0;
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

$oneplus = 1;
$NOToneplus= -1;

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
      echo "<a href='cart.php?prodq=". $prodQ ."&prodid=".$prodID ."&id=" . $oneplus ."'><strong> + </strong></a>";
      echo " | ";
      echo "<a href='cart.php?prodq=". $prodQ ."&prodid=".$prodID ."&id=" . $NOToneplus ."'><strong> - </strong></a>";
      echo " ...";
      echo "<a href='cart.php?removeone=". $prodID ."'> <strong>Remove</strong></a>";
      echo "<br>";

    }
  }else
  {
    echo "Cart Empty.";
  }

  //print total
  echo "<br>";
}
 ?>

 <form action="checkout.php">
   <input type="submit" name="check" value="checkout">
 </form>

 <br>

 <form action="cart.php">
   <input type="submit" name="remove" value="Remove All">
 </form>
<br>



</body>
</html>
