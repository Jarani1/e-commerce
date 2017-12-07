<?php session_start();
if(isset($_GET['id']))
{
  $_SESSION['prodIDrate']=$_GET['id'];
}

 ?>

<!DOCTYPE html>
<html>

<title>WebShop</title>
<body>


<!--The header links links -->
<?php



include_once("header.php") ?>


<h1> Product rating & comments </h1>

<!--

<br><br><br>
 <form action="comments.php" id="usrform">
   Name: <input type="text" name="usrname">
   <input type="submit">
 </form>
 <br>
 <textarea rows="4" cols="50" name="comment" form="usrform">
 Enter text here...</textarea>
<br>
<br> -->

<?php
//save the fucking id
//update the fucking register
//we have to initialize here

//RATE&COMMENT
require "connectsql.php";

if(!isset($_SESSION['commid']))
{
  $_SESSION['commid']=0;
}

if(isset($_GET['id']))
{
  //lol
  $_SESSION['commid']=$_GET['id'];
}


if(isset($_GET['comment']))
{
  $textinput=$_GET['comment'];
  $cid = $_SESSION['commid'];
  $name = $_GET['usrname'];
  $sql_comment="INSERT INTO products_comment(id,name,comment)
  VALUES ('$cid','$name','$textinput')";
  if($connect->query($sql_comment)==TRUE)
  {
    //echo "yasss";
  }
  else {
    //echo "fuck";
  }
}



if(isset($_GET['value']))
{
  $val = $_GET['value'];
  $id = $_SESSION['commid'];
  if($val==5)
  {
    $sql_insert_5="INSERT INTO products_rating(id,rating)
    VALUES ('$id','$val')";

    if($connect->query($sql_insert_5)==TRUE)
    {
      // echo "WHat's the fucking problem"."<br>";
      // echo "id: ".$id;
      // echo "<br>";
    }
  }
  else if($val==4)
  {
    $sql_insert_4="INSERT INTO products_rating(id,rating)
    VALUES ('$id','$val')";

    if($connect->query($sql_insert_4)==TRUE)
    {
      echo "WHat's the fucking problem"."<br>";
      echo "id: ".$id;
      echo "<br>";
    }
  }
  else if($val==3)
  {
    $sql_insert_3="INSERT INTO products_rating(id,rating)
    VALUES ('$id','$val')";

    if($connect->query($sql_insert_3)==TRUE)
    {
      echo "WHat's the fucking problem"."<br>";
      echo "id: ".$id;
      echo "<br>";
    }
  }
  else if($val==2)
  {
    $sql_insert_2="INSERT INTO products_rating(id,rating)
    VALUES ('$id','$val')";

    if($connect->query($sql_insert_2)==TRUE)
    {
      echo "WHat's the fucking problem"."<br>";
      echo "id: ".$id;
      echo "<br>";
    }
  }
  else if($val==1)
  {
    $sql_insert_1="INSERT INTO products_rating(id,rating)
    VALUES ('$id','$val')";

    if($connect->query($sql_insert_1)==TRUE)
    {
      echo "WHat's the fucking problem"."<br>";
      echo "id: ".$id;
      echo "<br>";
    }
  }

}

 ?>




  <?php
  //load all comments
  //asci art

  require "connectsql.php";


  $iddd = $_SESSION['prodIDrate'];
  $sql_get = "SELECT * FROM products_comment WHERE id='$iddd'";

  $result = $connect->query($sql_get);
  if($result->num_rows >0)
  {
    while($row=$result->fetch_assoc())
    {
      echo "------------------------------------------"."<br>";
      echo "<strong>NAME: </strong>".$row['name']."<br>";
      echo $row['comment']."<br>";
      echo "<br>";


    }
  }

   ?>


<!--
We need a bunch of hrefs for value of rating

only rate once

we need a form for comments thats loaded

Now we need to have a place to display current rating

init all prods in details








  -->
<?php
//get average rating
require "connectsql.php";

$id = $_SESSION['commid'];
$sql_rating = "SELECT AVG(rating) FROM products_rating WHERE id='$id'";
$result = $connect->query($sql_rating);
if($result->num_rows >0)
{
  while($row=$result->fetch_assoc())
  {
    echo "<strong>Product Rating: </strange>".$row['AVG(rating)'];
  }
}

 ?>

  <br><br><br>
   <form action="comments.php" id="usrform">
     Name: <input type="text" name="usrname">
     <input type="submit">
   </form>
   <br>
   <textarea rows="4" cols="50" name="comment" form="usrform">
   Enter text here...</textarea>
  <br>
  <br>

  <?php
  $one = 1;
  $two = 2;
  $three = 3;
  $four = 4;
  $five = 5;
  echo "Choose rating for this product: ";
  echo "<a href='comments.php?value=" . $one ."'> 1 </a>";
  echo " - ";
  echo "<a href='comments.php?value=" . $two ."'> 2 </a>";
  echo " - ";
  echo "<a href='comments.php?value=" . $three ."'> 3 </a>";
  echo " - ";
  echo "<a href='comments.php?value=" . $four ."'> 4 </a>";
  echo " - ";
  echo "<a href='comments.php?value=" . $five ."'> 5 </a>";

   ?>

</body>
</html>
