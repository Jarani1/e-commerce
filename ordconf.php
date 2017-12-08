<?php session_start() ?>
<!DOCTYPE html>
<html>

<title>WebShop</title>
<body>




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
  //  SELECT orders.id, orders.userID, orders_products.productID,
  //  orders_products.quantity, orders.price,
  //  orders.date FROM orders INNER JOIN
  //  orders_products ON orders_products.id = orders.id;
  //THE QUERY OF CHAMPIONS

  //Remove items from respective databases and put in orders
  //if pressed and quant < then cart say out of order 2 late
  //some1 else bought before you
  //remove from prod
  //UPDATE `products` SET `quantity` = '0' WHERE `products`.`id` = 11;

  //create order
  $userID = $_SESSION['user'];
  $price = $_SESSION['price'];
  $date = date("Y-m-d");

  $sqlorder = "INSERT INTO orders (userID, price, date) VALUES
  ('$userID','$price','$date')";

  if($connect->query($sqlorder)==TRUE)
  {
    $last_id = $connect->insert_id;
    echo "Last id = ". $last_id;
    echo "<br>";
  }else
  {
    echo "Error: ". $sqlorder . "<br>" . $connect->error;
  }


  foreach ($_SESSION['products_arr'] as $key => $value)
  {
    echo "Key= " . $key . ", Value= " . $value;
    echo "<br>";
    $sql_order_details = "INSERT INTO orders_products(id,productID,quantity)
    VALUES ('$last_id','$key','$value')";
    $connect->query($sql_order_details);

    //- quant from database
    //hopefully this arithmatic stuff works
    //it worked lol
    $sql_update = "UPDATE products SET quantity=(quantity - '$value')
     WHERE products.id = $key";
    $connect->query($sql_update);

    //empty user cart

    $sql_cart = "DELETE FROM cart WHERE userID = '$userID'";
    $connect->query($sql_cart);

    //store order at my account
    //well they are stored just call them with userID

    //store at admin orders
    //just call them wtf


  }



}

 ?>


<h1> ORDER CONFIRMED! </h1>


<form action="store.php">
  <input type="submit" value="back">

</form>

</body>
</html>
