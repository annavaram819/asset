<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <link rel="icon" href="../images/icon.png">
  <title>NITPY Student portal</title>
  <link rel="stylesheet" href="../styles.css">
</head>

<body>
  <div class="main-head">
    <img src="icon.png" alt="NITPY" class="main-logo">
  <?php
  session_start();
  $name=$_SESSION['user'];
      $password=$_SESSION['p'];
      $_SESSION['user']=$name;
      $_SESSION['p']=$password;
     $con=mysqli_connect("localhost","kishore","Kishore@016","login");
  $sql1=$con->query("SELECT name from student where roll like '%$name%'");
  $data1=$sql1->fetch_array();
  echo"<p class='hod-name'>Welcome $data1[0] <br><br><a href='logout.php'>Logout</a> </p>";
    echo"<h1>NATIONAL INSTITUTE OF TECHNOLOGY PUDUCHERRY</h1>";
    echo"<h2>Student Portal</h2>";
  echo"</div>";
    echo"<ul class='navbar'>";
  echo"<a class='nav-item student-item' href='index1.php'>Home</a>";
    echo"<a class='nav-item student-item' href='course_registration.php'>Course Registration</a>";
    echo"<a class='nav-item student-item' href='view_courses.html'>View Courses</a>";
    echo"<a class='nav-item student-item' href='marks_aatendence.html'>View marks and Attendence</a>";
  echo"</ul>";
     echo"<div class='login-form-div'>
     <form class='login-form' method='post' action='password2.php'>
      <label for='cars'>Enter old password</label>
      <input type='password' name='password1'><br><br>
      <label for='cars'>Enter new passowrd</label>
      <input type='password' name='password2'><br><br>
      <label for='cars'>Re enter new password</label>
      <input type='password' name='password3'><br><br>
      </select><br><br>
      <input type='submit' value='Reset' name='submit'>
    </form>
    </div>";
?>
<footer class="footer">
    <p>Copyrights &copy NIT Puducherry @ 2021</p>
  </footer>
</body>
</html>
