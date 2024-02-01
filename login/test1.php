   <!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="icon" href="images/icon.png">
    <title>NITPY Academic Management Software</title>
    <link rel="stylesheet" href="styles.css">
  </head>
  <body>
    <div class="main-head">
      <img src="icon.png" alt="NITPY" class="main-logo">
      <h1>NATIONAL INSTITUTE OF TECHNOLOGY PUDUCHERRY</h1>
      <h2>student Login Portal</h2>
    </div>
 <?php
 if($_SERVER["REQUEST_METHOD"] == "POST")
 {
  $set1=$_POST["login_category"];
  $name=$_POST["user_id"];
  $password=$_POST["password"];
  $con=mysqli_connect("localhost","kishore","Kishore@016","$set1[0]");
  $sql=$con->query("SELECT roll,mobile from student where (roll like '%$name%' and mobile like '%$password%')");
  $data=$sql->fetch_array();
    if($data)
  {
    $_SESSION['username']=$name;
   header("location: student-portal/index.php");
  }
  else
  {
    header("location: index.php");
    exit();
  }
 }
 ?>
  <footer class="footer">
      <p>Copyrights &copy NIT Puducherry @ 2021</p>
    </footer>
  </body>
</html>