<?php session_start(); ?>
<!DOCTYPE html>
<html>

<title>WebShop</title>
<body>


<!--The header links links -->
<?php



include_once("header.php") ?>


<h1> Shopping Cart  </h1>

<?php


 echo "ID sent from store: ". $_GET['id'];

if(!isset($_SESSION['items']))
{
  $_SESSION['items']= array();
}

//set up arrays with id quant and total
// 
// if(isset($_GET['id']))
// {
//   $id = intval($_GET['id']);
// }


  ?>

<!--
Create session variable for user.
Every click stores and sets
if already set -> var++



  -->

</body>
</html>
