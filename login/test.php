  <!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="icon" href="images/icon.png">
    <title>NITPY Academic Management Software</title>
    <link rel="stylesheet" href="../styles.css">
        <script language="javascript"type="text/javascript">
      window.history.forward();
    </script>
  </head>
  <body>
    <div class="main-head">
      <img src="icon.png" alt="NITPY" class="main-logo">
      <h1>NATIONAL INSTITUTE OF TECHNOLOGY PUDUCHERRY</h1>
   <?php
 if($_SERVER["REQUEST_METHOD"] == "POST")
 {
  session_start();
  if(empty($_POST['user_id'])||empty($_POST['password']))
  {
header("location:index.php");
  }
  else
  {
  $set=$_POST["login_category"];
  $user=$_POST['user_id'];
  $password=$_POST['password'];
  if($set[0]=='student')
 {
$con=mysqli_connect("localhost","kishore","Kishore@016","login");
$sql=$con->query("SELECT roll,phone from $set[0] where roll like '$user' and phone like'$password'");
$data=$sql->fetch_array();
if($data)
{
  $_SESSION['user']=$user;
  $_SESSION['password']=$password;
    header('location: /final-year1-main/student-portal/index.php');
}
else
{
  header("location:index.php");
}
}
 else if($set[0]=='hod')
 {
  $con=mysqli_connect("localhost","kishore","Kishore@016","login");
$sql=$con->query("SELECT mail,phone from $set[0] where mail like '%$user%' and phone like'%$password%'");
$data=$sql->fetch_array();
if($data)
{
    $_SESSION['user']=$user;
    $_SESSION['password']=$password;
    header('location: /final-year1-main/hod-portal/index.php');
  }
  else
{
  header("location:index.php");
}
 }
  else if($set[0]=='faculty')
 {
    $con=mysqli_connect("localhost","kishore","Kishore@016","login");
$sql=$con->query("SELECT mail,phone from $set[0] where mail like '%$user%' and phone like'%$password%'");
$data=$sql->fetch_array();
if($data)
{
    $_SESSION['user']=$user;
    $_SESSION['password']=$password;
    header('location: /final-year1-main/faculty-portal/index.php');
  }
  else
{
  header("location:index.php");
}
 }
  else if($set[0]=='academic')
 {
    $con=mysqli_connect("localhost","kishore","Kishore@016","login");
$sql=$con->query("SELECT mail,phone from $set[0] where mail like '%$user%' and phone like'%$password%'");
$data=$sql->fetch_array();
if($data)
{
    $_SESSION['user']=$user;
    $_SESSION['password']=$password;
    header('location: /final-year1-main/academic-portal/index.php');
  }
  else
{
  header("location:index.php");
}
 }
 }
}
 ?>
  <footer class="footer">
      <p>Copyrights &copy NIT Puducherry @ 2021</p>
    </footer>
  </body>
</html>
