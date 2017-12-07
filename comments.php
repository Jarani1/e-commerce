<?php session_start(); ?>

<!DOCTYPE html>
<html>

<title>WebShop</title>
<body>


<!--The header links links -->
<?php



include_once("header.php") ?>


<h1> Product rating </h1>


 <form action="/action_page.php" id="usrform">
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
 echo "sent product: ". $_GET['id'];
 echo "<br>";
 echo "Choose rating for product";
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




<!--
We need a bunch of hrefs for value of rating

only rate once

we need a form for comments thats loaded

Now we need to have a place to display current rating






  -->

</body>
</html>
