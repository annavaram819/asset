<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link rel="icon" href="../images/icon.png">
  <title>NITPY HOD portal</title>
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
    <?php
    session_start();
  $name=$_SESSION['name'];
  $password=$_SESSION['password'];
  $_SESSION['name']=$name;
  $_SESSION['password']=$password;
  $_SESSION['user']=$name;
  $_SESSION['p']=$password;
  $con=mysqli_connect("localhost","kishore","Kishore@016","login");
    $sql1=$con->query("SELECT name,dept FROM hod where mail like'%$name%'");
    $data1=$sql1->fetch_array();
    $_SESSION['department']=$data1['dept'];
    echo"<p class='hod-name'>Welcome $data1[0] <br> <a href='password.php'>Reset Password</a> <br> <a href='logout.php'>Logout</a> </p>";
    echo"<h1>NATIONAL INSTITUTE OF TECHNOLOGY PUDUCHERRY</h1>";
    echo"<h2>HOD Portal</h2>";
  echo"</div>";
  echo"<ul class='navbar'>";
   echo"<li class='nav-item curriculum'>Home";
      echo"<div class='dropdown-content curriculum-content'>";
        echo"<a href='index1.php'>Home</a>";
      echo"</div>";
    echo"</li>";
    echo"<li class='nav-item curriculum'>Course";
      echo"<div class='dropdown-content curriculum-content'>";
        echo"<a href='course_allocation.php'>Course_creation</a>";
      echo"</div>";
    echo"</li>";
    echo"<li class='nav-item curriculum'>Student";
      echo"<div class='dropdown-content curriculum-content'>";
        echo"<a href='add.php'>Student</a>";
      echo"</div>";
    echo"</li>";
    echo"<li class='nav-item curriculum'>PAC";
      echo"<div class='dropdown-content curriculum-content'>";
        echo"<a href='pac.php'>PAC</a>";
      echo"</div>";
    echo"</li>";
    echo"<li class='nav-item PAC'>Revoke";
      echo"<div class='dropdown-content PAC-content'>";
        echo"<a href='revoke.php'>Revoke</a>";
      echo"</div>";
    echo"</li>";
 echo"</ul>";
?>
  <?php
 if (isset($_POST['submit']))
{
  $programe=$_SESSION['programe'];
  $year=$_SESSION['year'];
  $department=$_SESSION['department'];
  $_SESSION['programe']=$programe;
  $_SESSION['year']=$year;
  $_SESSION['department']=$department;
 $con=mysqli_connect("localhost","kishore","Kishore@016","login");
  $sql=$con->query("UPDATE hod_table set flag='1' where department like '$department' and programe like '$programe' and year like '$year'");
  if($sql)
  {
    echo "<div class='no-course'>PAC IS SUBMITED</div><hr>";
  }
}
  ?>

  <footer class="footer">
    <p>Copyrights &copy NIT Puducherry @ 2021</p>
  </footer>
</body>
</html>
