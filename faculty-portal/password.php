  <!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <link rel="icon" href="../images/icon.png">
  <title>NITPY Faculty portal</title>
  <link rel="stylesheet" href="../styles.css">
</head>

<body>
  <div class="main-head">
    <img src="icon.png" alt="NITPY" class="main-logo">
  <?php
  $con=mysqli_connect("localhost","kishore","Kishore@016","login");
  session_start();
  $name=$_SESSION['name'];
  $password=$_SESSION['password'];
  $_SESSION['name']=$name;
  $_SESSION['password']=$password;
    $sql1=$con->query("SELECT name from faculty where mail like'%$name%'");
    $data1=$sql1->fetch_array();
    echo"<p class='hod-name'>Welcome $data1[0] <br><br> <a href='password.php'>Reset Password</a><br> <br> <a href='logout.php'>Logout</a> </p>";
    echo"<h1>NATIONAL INSTITUTE OF TECHNOLOGY PUDUCHERRY</h1>";
    echo"<h2>Faculty Portal</h2>";
  echo"</div>";
  echo"<ul class='navbar'>";
  echo"<li class='nav-item curriculum'>Home";
      echo"<div class='dropdown-content curriculum-content'>";
        echo"<a href='index1.php'>Home</a>";
      echo"</div>";
    echo"</li>";
    $sql=$con->query("SELECT course_code from course_creation where faculty_name like '%$data1[0]%'");
    $i=0;
    while($data=$sql->fetch_array())
    {
    echo"<li class='nav-item curriculum'>".$data['course_code']."";
    $subject=$data['course_code'];
      echo"<div class='dropdown-content curriculum-content'>";
        echo"<a href='configure.php?subject=$subject'>Course_configuration</a>";
        echo"<a>Attendence</a>";
        echo"<a>Marks</a>";
        echo"<a>Grade Configuration</a>";
        echo"<a>Grade sheet</a>";
      echo"</div>";
    echo"</li>";
    $i++;
  }
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
