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



Another block right here add the you know array stack up the cart stuff
ya dig

So make array check GET and add
if exist increment

 -->
 <?php
 if(!(isset($_SESSION['count'])))
 {
   $_SESSION['count']=0;
 }

  ?>

<?php
require "connectsql.php";

if(isset($_GET['id']))
{
  if(isset($_SESSION['user']))
  {

    //check if there is enough in database

    $userID = $_SESSION['user'];
    $productID = $_GET['id'];
    $_SESSION['count']=$_SESSION['count']+1;

    $sqlc = "SELECT quantity FROM products WHERE id = '$productID'";


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
    //client wants more than in database say no
    if($_SESSION['count']>$dquant)
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
            //get the user cart quant 
            $sql2 ="UPDATE cart SET quantity = quantity +1
             WHERE userID = 'testo'";
             if($connect->query($sql2)==TRUE)
             {
               echo "Item added to cart";
             }else{
               echo "Error: ". $sql . "<br>" . $connect->error;
             }
          }
          //if no add new entry
          else
          {
            $sql = "INSERT INTO cart (userID, productID, quantity) VALUES('$userID',
              '$productID',1)";
            if($connect->query($sql)==TRUE){
              echo "Item added to cart";
            }else{
              echo "Error: ". $sql . "<br>" . $connect->error;
            }
          }
        }
      }else
      {
        $sql = "INSERT INTO cart (userID, productID, quantity) VALUES('$userID',
          '$productID',1)";
        if($connect->query($sql)==TRUE){
          echo "Item added to cart";
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
    echo "<a href='store.php?id=" . $row['id'] ."'> Add to cart</a>"; //real nice

  }
}else
{
  echo "Inventory is empty.";
}

 ?>

</body>
</html>
