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
    echo"<p class='hod-name'>Welcome $data1[0] <br> <a href='password.php'>Reset Password</a> <br> <a href='logout.php'>Logout</a> </p>";
$dept2=$data1['dept'];
$_SESSION['dept']=$dept2;
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
    echo"<li class='nav-item PAC'>PAC";
      echo"<div class='dropdown-content PAC-content'>";
        echo"<a href='pac.php'>View</a>";
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
$mail=$_SESSION['user'];
echo"<div class='select-assessment-form-div'>";
echo"<form class='select-assessment-form' action='revoke.php' method='post'>";
    echo"<label for='year'>Select Programe </label>";
    echo"<select name='programe'>";
  $con=mysqli_connect("localhost","kishore","Kishore@016","login");
    $sql=$con->query("SELECT dept from hod where mail like '$mail'");
    $data=$sql->fetch_array();
    $department=$data['dept'];
    $_SESSION['department']=$department;
    $sql1=$con->query("SELECT distinct programe from course_registration where department like '$department'");
    while($data1=$sql1->fetch_array())
    {
      $programe=$data1['programe'];
      echo"<option value='$programe'>".$programe."</option>";
    }
           echo"        </select><br><br>";
      echo"<input type='submit' name='submit1' value='Submit'>";
   echo"</form>";
 echo"</div>";
 if(isset($_POST['submit1']))
 {
  $department=$_SESSION['department'];
$_SESSION['department']=$department;
$programe=$_POST['programe'];
$_SESSION['programe']=$programe;
if($programe=='btech')
{
  echo"<div class='select-assessment-form-div'>";
echo"<form class='select-assessment-form' action='revoke1.php' method='post'>";
    echo"<label for='year'>Select Year: </label>";
    echo"<select name='year'>";
      echo"<option value='1'>1</option>";
      echo"<option value='2'>2</option>";
      echo"<option value='3'>3</option>";
      echo"<option value='4'>4</option>";
           echo"        </select><br><br>";
      echo"<input type='submit' name='submit1' value='Submit'>";
   echo"</form>";
 echo"</div>";
}
else if($programe=='mtech')
{
  echo"<div class='select-assessment-form-div'>";
  echo"<form class='select-assessment-form' action='revoke1.php' method='post'>";
    echo"<label for='year'>Select Year: </label>";
    echo"<select name='year'>";
      echo"<option value='1'>1</option>";
      echo"<option value='2'>2</option>";
           echo"        </select><br><br>";
      echo"<input type='submit' name='submit1' value='Submit'>";
   echo"</form>";
 echo"</div>";
 }
}
 ?>
  <footer class="footer">
    <p>Copyrights &copy NIT Puducherry @ 2021</p>
  </footer>
</body>
</html>
