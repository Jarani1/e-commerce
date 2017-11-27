
<!DOCTYPE html>
<html>

<title>WebShop</title>
<body>

<?php include_once("header.php") ?>


<?php
session_start();

if(isset($_SESSION["user"]))
{
  echo "<br>";
  echo " Current user session: ". $_SESSION["user"]."<br>";
}

 ?>

<h1>login</h1>



<form method="post" action="login.php">
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


</body>
</html>

<?php
//connect to db
require "connectsql.php";


//session_start();

//check if already signed in or kill other session
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  if(isset($_SESSION["user"]))
  {
    echo "Someone is already signed in!";
    exit();
  }

}



//check the login
else if(isset($_POST["uname"]) && isset($_POST["psw"]))
{

  $user = $_POST["uname"];
  $userpass= $_POST["psw"];
  //check if in database
  // $sql = mysql_query("SELECT id FROM admin WHERE
  //   username = 'test' AND password='test123'");

  $sql = "SELECT password FROM users WHERE
  username = '$user'";
  //send query
  $result = $connect->query($sql);

  //handle returned rows

  if($result->num_rows>0)
  {
    while($row=$result->fetch_assoc())
    {
      if($row["password"]==$userpass)
      {
        //set session values
        $_SESSION["user"] = $user;
        $_SESSION["userpass"] = $userpass;
        echo "new session var: ". $_SESSION["user"]."<br>";
        echo "Signed in!";
      }
    }
  }
  else
  {
    echo 'Wrong username or password, try again';
    exit();
  }
}


 ?>
