
<?php
session_start();

// Check if they have admin session "cookies"
if(!isset($_SESSION["admin"]))
{
  $_SESSION["test"]="hello from other side";
  header("LOCATION: admin_login.php");
  exit();
}
//connect to db
require "../connectsql.php";

// if they have them make sure they're in the datbase
// Someone could've forged session cookies that's why we make sure
// That they're in the database here aswell
$adminID = $_SESSION["id"];
$admin = $_SESSION["admin"];
$adminpass = $_SESSION["adminpass"];

//Query database


$sql = "SELECT * FROM admin WHERE id='$adminID'
AND username = '$admin' AND password='$adminpass'";

//store result
$result = $connect->query($sql);


//check returned rows
if(!($result->num_rows >0))
{
  //user doesn't exist
  exit();
}

 ?>



<!DOCTYPE html>
<html>

<title>WebShop</title>
<body>
<!--The header links links -->
<?php include_once("header.php") ?>

<h1> ADMIN ZONE</h1>




</body>
</html>
