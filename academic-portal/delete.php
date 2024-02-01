<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <link rel="icon" href="../images/icon.png">
  <title>NITPY Academic portal</title>
  <link rel="stylesheet" href="../styles.css">
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <?php  
  echo"<div class='main-head'>";
    echo"<img src='../images/icon.png' alt='NITPY' class='main-logo'>";
    session_start();
       $con=mysqli_connect("localhost","kishore","Kishore@016","login");
       $name=$_SESSION['user'];
       $password=$_SESSION['password'];
  $_SESSION['name']=$name;
  $_SESSION['password']=$password;
    $sql1=$con->query("SELECT name from academic where mail like'%$name%'");
    $data1=$sql1->fetch_array();
    echo"<p class='hod-name'>Welcome $data1[0] <br><br> <a href='password.php'>Reset Password</a><br> <br> <a href='logout.php'>Logout</a> </p>";
    echo"<h1>NATIONAL INSTITUTE OF TECHNOLOGY PUDUCHERRY</h1>";
    echo"<h2>Academic Portal</h2>";
  echo"</div>";
  echo"<ul class=navbar>";
    echo"<a class='nav-item student-item' href='index1.php'>Home</a>";
    echo"<a class='nav-item student-item' href='course_allocation.php'>Course</a>";
    echo"<li class='nav-item curriculum'>Student";
      echo"<div class='dropdown-content curriculum-content'>";
        echo"<a href='add.php'>Student</a>";
      echo"</div>";
    echo"</li>";
    echo"<a class='nav-item student-item' href='publish_results.html'> Results</a>";
  echo"</ul>";
  echo"<div class='course-registration-form-div'>";
  echo"<form class='course-registration-form' action='test1.php' method ='post'>";
  echo"<label for='cars'>Enter ROLL_NO:</label>";
      echo"<input type='text' name='user_id'><br><br>";
      echo"<input type='submit' name='submit' value='Delete'>";
    echo"</form>";
    ?>
  <footer class="footer">
    <p>Copyrights &copy NIT Puducherry @ 2021</p>
  </footer>
</body>

</html>