

<!DOCTYPE html>
<html>

<title>WebShop</title>
<body>


<!--The header links links -->
<?php include_once("header.php") ?>


<h1> Register </h1>


<?php
require "connectsql.php";


#Run if reg pressed

if(isset($_POST['register'])){
  $sql = "INSERT INTO users (username,password,email,rank)
   VALUES('$_POST[username]','$_POST[password]','$_POST[email]',1)";
   if($connect->query($sql)==TRUE){
     echo "New user created sucessfully";
   }else{
     echo "Error: ". $sql . "<br>" . $connect->error;
   }
}
$connect->close();

 ?>


<div id="txt">Please register below</div>

<form action="register.php" method="post">
	Username:<br>
  <input type="text" name="username" required="required">
  <br>Password:<br>
  <input type="password" name="password" required="required">
  <br>Email:<br>
  <input type="text" name="email" required="required">
  <br><br>
  <input type="submit" name="register" value="Register">
  <br>
</form>


</body>
</html>
