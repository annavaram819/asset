<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link rel="icon" href="../images/icon.png">
  <title>NITPY Student portal</title>
  <link rel="stylesheet" href="../styles.css">
  <script type="text/javascript">
        function preventBack() { window.history.forward(); }
        setTimeout("preventBack()", 0);
        window.onunload = function () { null };
    </script>
</head>

<body>
  <div class="main-head">
    <img src="../images/icon.png" alt="NITPY" class="main-logo">
    <?php
    session_start();
  $name=$_SESSION["user"];
  $password=$_SESSION["password"];
$con=mysqli_connect("localhost","kishore","Kishore@016","login");
  $sql=$con->query("SELECT name,phone,department from student where roll like '%$name%'");
  $data=$sql->fetch_array();
  $_SESSION['name']=$name;
  $_SESSION['password']=$password;
  $_SESSION['user']=$name;
  $_SESSION['p']=$password;
if($data)
{
  echo"<p class='hod-name'>Welcome $data[0] <br><a href='password.php'> Reset Password</a><br><a href='logout.php'>Logout</a> </p>";
}
else
{
  header("location:logout.php");
}
    echo"<h1>NATIONAL INSTITUTE OF TECHNOLOGY PUDUCHERRY</h1>";
    echo"<h2>Student Portal</h2>";
  echo"</div>";
  echo"<ul class='navbar'>";
  echo"<li class='nav-item curriculum'>Home";
   echo"<div class='dropdown-content curriculum-content'>";
  echo"<a class='nav-item student-item' href='index1.php'>Home</a>";
  echo"</div>";
 echo "</li>";
  $sql1=$con->query("SELECT DISTINCT course_code from course_registration where roll like '$name'");
  while($data1=$sql1->fetch_array())
  {
    $subject=$data1['course_code'];
  echo"<li class='nav-item curriculum'>".$data1['course_code']."";
    echo"<div class='dropdown-content curriculum-content'>";
        echo"<a href='view.php?subject=$subject'>View</a>";
      echo"</div>";
      echo"</li>";
    }
    echo"<li class='nav-item curriculum'>Result";
   echo"<div class='dropdown-content curriculum-content'>";
  echo"<a class='nav-item student-item' href='result.php'>Result</a>";
  echo"</div>";
 echo "</li>";
  echo"</ul>";
?>
  <footer class="footer">
    <p>Copyrights &copy NIT Puducherry @ 2021</p>
  </footer>
</body>

</html>
