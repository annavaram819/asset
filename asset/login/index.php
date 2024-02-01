<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="icon" href="../images/icon.png">
    <title>PBR Visvodaya Institute of Technology and Science Asset Management System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles.css">
    <script type="text/javascript">
          function preventBack() { window.history.forward(); }
          setTimeout("preventBack()", 0);
          window.onunload = function () { null };
      </script>
  </head>
  <body>
    <div class="main-head">
      <img src="icon.png" alt="NITPY" class="main-logo">
      <h1>PBR Visvodaya Institute of Technology and Science</h1>
      <h2>Asset Management System</h2>
    </div>
    <div class="login-form-div">
    <form class="login-form" method="post" action="index.php">
      <label for="cars">USER ID:</label>
      <input type="text" name="user_id"><br><br>
      <label for="cars">PASSWORD:</label>
      <input type="password" name="password"><br><br>
      <input type="submit" value="Submit" name="submit">
    </form>
    </div>
    <?php
 if($_SERVER["REQUEST_METHOD"] == "POST")
 {
  session_start();
  if(empty($_POST['user_id'])&&empty($_POST['password']))
  {
header("location: /asset/login/index.php");
  }
else if(empty($_POST['user_id'])&&!empty($_POST['password']))
  {
header("location: /asset/login/index.php");
  }
else if(!empty($_POST['user_id'])&&empty($_POST['password']))
  {
header("location: /asset/login/index.php");
  }
  else
  {
  $user=$_POST['user_id'];
  $password=$_POST['password'];
$con=mysqli_connect("localhost","root","","asset");
$sql=$con->query("SELECT user,password from login where user like '$user' and password like'$password'");
$data=$sql->fetch_array();
if($data!=NULL)
{
  $sql1=$con->query("SELECT id from login where user like '$user' and password like '$password'");
  $data1=$sql1->fetch_array();
  if($data1['id']==0)
  {
  $sql=$con->query("UPDATE login set id='1' where user like '$user' and password like '$password'");
  $_SESSION['user']=$user;
  $_SESSION['password']=$password;
    header('location: /asset/asset-portal/index.php');
  }
  else
  {
    header('location: /asset/login/index.php');
  }
}
else
{
  header("location: /asset/login/index.php");
}
 }
 }
 ?>
    <footer class="footer">
      <p>Copyrights &copy PBR Visvodaya Institute of Technology and Science @ 2024</p>
    </footer>
  </body>
</html>
