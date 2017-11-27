<?php
session_start();
//if alreadu connected no need to be here
if(isset($_SESSION["admin"]))
{
  header("LOACTION: index.php");
  exit();
}
 ?>




<!DOCTYPE html>
<html>

<title>WebShop</title>
<body>

<h1>Admin login</h1>



<form method="post" action="admin_login.php">
  <div class="container">
    <label><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required>
    <br>
    <label><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>
    <br>
    <input type="submit" value="login">

  </div>
</form>

<form action="../index.php">
  <input type="submit" value="cancel">

</form>

</body>
</html>

<?php
//connect to db
require "../connectsql.php";

//check the login
if(isset($_POST["uname"]) && isset($_POST["psw"]))
{
  $admin = $_POST["uname"];
  $adminpass= $_POST["psw"];
  //check if in database
  // $sql = mysql_query("SELECT id FROM admin WHERE
  //   username = 'test' AND password='test123'");

  $sql = "SELECT id FROM admin WHERE
  username = '$admin' AND password='$adminpass'";
  //send query
  $result = $connect->query($sql);

  //handle returned rows

  if($result->num_rows>0)
  {
    //get id value
    while($row = $result->fetch_assoc())
    {
      $id = $row["id"];
      echo $id;
    }

    //set session values
    $_SESSION["id"] = $id;
    $_SESSION["admin"] = $admin;
    $_SESSION["adminpass"] = $adminpass;
    header("LOCATION: index.php");

  }
  else
  {
    echo 'Wrong username or password, try again';
    exit();
  }
}


 ?>
