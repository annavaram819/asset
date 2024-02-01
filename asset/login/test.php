d  <!DOCTYPE html>
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
      <h1>PBR Visvodaya Institute of Technology and Science</h1>
   <?php
 if($_SERVER["REQUEST_METHOD"] == "POST")
 {
  session_start();
  if(empty($_POST['user_id'])&&empty($_POST['password']))
  {
header("location: /login/index.php");
  }
else if(empty($_POST['user_id'])&&!empty($_POST['password']))
  {
header("location: /login/index.php");
  }
else if(!empty($_POST['user_id'])&&empty($_POST['password']))
  {
header("location: /login/index.php");
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
    header('location: /asset-portal/index.php');
  }
  else
  {
    header('location: /asset/login/index.php');
  }
}
else
{
  header("location: /login/index.php");
}
 }
 }
 ?>
  <footer class="footer">
      <p>Copyrights &copy PBR Visvodaya Institute of Technology and Science @ 2024</p>
    </footer>
  </body>
</html>
