<?php
session_start();
 ?>

 <!DOCTYPE html>
 <html>

 <title>WebShop</title>
 <body>
 <?php include_once("header.php"); ?>
 <h1>Sign out</h1>



 <form method="post" action="logout.php">
   <input type="submit" value="Sign out">

 </form>

 <?php
 if ($_SERVER['REQUEST_METHOD'] == 'POST')
 {
   //remove all session variables
   session_unset();
   //Destroy session
   session_destroy();

   echo "Signed out!";

   header("LOCATION: ../index.php");

 }
  ?>


 </body>
 </html>
