<?php

$servername="localhost";
$username="root";
$password="albert123";
$dbname="ecommerce";

$connect = new mysqli($servername,$username,$password,$dbname);
if($connect->connect_error){
  die("connection failed". $connection->connect_error);
}else {

}




 ?>
