<!DOCTYPE html>
<html>

<title>WebShop</title>
<body>

<?php include_once("header.php"); ?>

<h1>Monitor product comments</h1>

<!--
 show current items.
 Have form wheru you can type and remove
 update page


  -->
<!-- php remove block if form pressed -->
<?php

require "../connectsql.php";

if(isset($_POST['remove']))
{
  $sql = "DELETE FROM products_comment WHERE commentid = '$_POST[id]'";

   if($connect->query($sql)==TRUE){
     echo "comment removed";
   }else{
     echo "Error: ". $sql . "<br>" . $connect->error;
   }
}
$connect->close();

 ?>





<br>

<h2>Current Comments</h2>
<?php
require "../connectsql.php";

$sql = "SELECT * FROM products_comment";
$result = $connect->query($sql);

if($result->num_rows >0)
{
  while($row=$result->fetch_assoc())
  {
    echo "-----------------------------------------------"."<br>";
    echo "<strong>id:</strong> ".$row["commentid"]. "
    <strong> name: </strong>".$row['name']
    ."<br>";
    echo $row['comment'];
    echo "<br>";
  }
}else
{
  echo "No comments.";
}

 ?>

 <h4>To remove a comment enter the "id" and press remove</h4>

 <!-- form -->


 <form action="admincomments.php" method="post">
   <br>ID:<br>
   <input type="text" name="id" required="required">
   <br><br>
   <input type="submit" name="remove" value="Remove">
   <br>
 </form>
 <br>
 <form action="inventory.php">
   <input type="submit" value="back">

 </form>







</body>
</html>
