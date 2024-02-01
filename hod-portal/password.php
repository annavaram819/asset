<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <link rel="icon" href="../images/icon.png">
  <title>NITPY HOD portal</title>
  <link rel="stylesheet" href="../styles.css">
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
$con=mysqli_connect("localhost","kishore","Kishore@016","login");
    $sql1=$con->query("SELECT name FROM hod where mail like'%$name%'");
    $data1=$sql1->fetch_array();
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
  $_SESSION['user']=$_SESSION['name'];
  $_SESSION['p']=$_SESSION['password'];
     echo"<div class='login-form-div'>
     <form class='login-form' method='post' action='password2.php'>
      <label for='cars'>Enter old password</label>
      <input type='password' name='password1'><br><br>
      <label for='cars'>Enter new passowrd</label>
      <input type='password' name='password2'><br><br>
      <label for='cars'>Re enter new password</label>
      <input type='password' name='password3'><br><br>
      </select><br><br>
      <input type='submit' value='submit' name='submit'>
    </form>
    </div>";
?>
<footer class="footer">
    <p>Copyrights &copy NIT Puducherry @ 2021</p>
  </footer>
</body>
</html>
