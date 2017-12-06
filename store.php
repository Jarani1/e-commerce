<?php
session_start();
 ?>
<!DOCTYPE html>
<html>

<title>WebShop</title>
<body>


<!--The header links links -->
<?php include_once("header.php") ?>


<h1> Store </h1>



<?php
require "connectsql.php";

if(isset($_GET['id']))
{
  if(isset($_SESSION['user']))
  {

    //check if there is enough in database

    $userID = $_SESSION['user'];
    $productID = $_GET['id'];
    $_SESSION['match']=0;

    $sqlc = "SELECT quantity FROM products WHERE id = '$productID'";

    //get prod for database
    $resultc = $connect->query($sqlc);

    if($resultc->num_rows >0)
    {
      while($row=$resultc->fetch_assoc())
      {
        $GLOBALS['dquant'] = $row['quantity'];
      }
    }else
    {
      echo "Out of stock!";
    }

    //get user cart quant aswell

    $sqluser = "SELECT quantity FROM cart WHERE userID ='$userID'
    AND productID='$productID'";
    $resultuser = $connect->query($sqluser);
    if($resultuser->num_rows>0)
    {
      while($row=$resultuser->fetch_assoc())
      {
        $GLOBALS['uquant'] = $row['quantity'];
      }
    }else {
      //if not exist
      $GLOBALS['uquant'] = 0;
    }

    //client wants more than in database say no
    if($uquant>=$dquant)
    {
      echo "Out of stock!";
    }else
    //normal procedure
    {
      //check if productID is already in user cart
      $sql1= "SELECT productID FROM cart WHERE userID ='$userID'";


      $result = $connect->query($sql1);

      //handle returned rows if there are any lol
      if($result->num_rows>0)
      {
        while($row=$result->fetch_assoc())
        {
          //if already in cart incremnet
          if($row["productID"]==$productID)
          {
            // just increment existing item with 1 if not bigger than dquant
            //get the user cart
            $sql2 ="UPDATE cart SET quantity = quantity +1
             WHERE userID = '$userID' AND productID='$productID'";
             if($connect->query($sql2)==TRUE)
             {
               //set if matched
               $_SESSION['match']=1;
               echo "Item added to cart 0";
             }else{
               echo "Error: ". $sql . "<br>" . $connect->error;
             }
          }

        }
        // if it didn't get a match in loop
        if($_SESSION['match']==0)
        {
          $sql = "INSERT INTO cart (userID, productID, quantity) VALUES('$userID',
            '$productID',1)";
          if($connect->query($sql)==TRUE){
            echo "Item added to cart new 1";
          }else{
            echo "Error: ". $sql . "<br>" . $connect->error;
          }
        }


      }



      else
      {
        $sql = "INSERT INTO cart (userID, productID, quantity) VALUES('$userID',
          '$productID',1)";
        if($connect->query($sql)==TRUE){
          echo "Item added to cart new2";
        }else{
          echo "Error: ". $sql . "<br>" . $connect->error;
        }
      }
    }
  }
  else {
    echo "sign in, stupid ass bitch";
  }
}


 ?>


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
    echo "<a href='store.php?id=" . $row['id'] ."'> Add to cart</a>";
    echo " or read ";
    echo "<a href='comments.php?id=" . $row['id'] ."'> Comments </a>"; //real nice
    echo "<br>";
  }
}else
{
  echo "Inventory is empty.";
}

 ?>

</body>
</html>
