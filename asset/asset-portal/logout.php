<?php  
session_start();  
$name=$_SESSION['name'];
$con=mysqli_connect("localhost","root","","asset");
  $sql=$con->query("UPDATE login set id='0' where user like '$name'");
session_destroy();  
header("Location: /asset/login/index.php");
?>  