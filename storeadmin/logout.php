<?php
session_start();
 ?>

 <!DOCTYPE html>
 <html>

 <title>WebShop</title>
 <body>
 <?php include_once("header.php"); ?>
 <h1>Sign out</h1>



 <form action="index.php">
   <input type="submit" value="Sign out">

 </form>

 <?php
 //remove all session variables

 session_unset();

 //Destroy session

 session_destroy();
  ?>


 </body>
 </html>
