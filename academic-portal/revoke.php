<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <link rel="icon" href="../images/icon.png">
  <title>NITPY Academic portal</title>
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
$con=mysqli_connect("localhost","kishore","Kishore@016","login");
      session_start();
      $name=$_SESSION['name'];
      $password=$_SESSION['password'];
  $_SESSION['name']=$name;
  $_SESSION['password']=$password;
    $sql1=$con->query("SELECT name from academic where mail like'%$name%'");
    $data1=$sql1->fetch_array();
   echo "<p class='hod-name'>Welcome $data1[0] <br><br> <a href='password.php'>Reset Password</a><br> <br> <a href='logout.php'>Logout</a> </p>";
    echo"<h1>NATIONAL INSTITUTE OF TECHNOLOGY PUDUCHERRY</h1>";
    echo"<h2>Academic Portal</h2>";
  echo"</div>";
  echo"<ul class='navbar'>";
   echo"<li class='nav-item curriculum'>Home";
      echo"<div class='dropdown-content curriculum-content'>";
        echo"<a href='index1.php'>Home</a>";
      echo"</div>";
    echo"</li>";
    echo"<li class='nav-item semester'>Results";
       $sql2=$con->query("SELECT distinct programe from course_registration");
      echo"<div class='dropdown-content semester-content'>";
  while($data2=$sql2->fetch_array())
      {
        $programe=$data2['programe'];
        echo"<a href='result.php?programe=$programe'>".$data2['programe']."</a>";
      }
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
$con=mysqli_connect("localhost","kishore","Kishore@016","login");
$sql=$con->query("SELECT distinct programe from course_registration");
while($data=$sql->fetch_array())
{

}
echo"<div class='select-assessment-form-div'>";
echo"<form class='select-assessment-form' action='revoke.php' method='post'>";
    echo"<label for='year'>Select Programe </label>";
    echo"<select name='programe'>";
    $sql1=$con->query("SELECT distinct programe from course_registration");
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
$programe=$_POST['programe'];
$_SESSION['programe']=$programe;
 echo"<div class='select-assessment-form-div'>";
echo"<form class='select-assessment-form' action='revoke.php' method='post'>";
    echo"<label for='year'>Select Year: </label>";
    echo"<select name='year'>";
$sql2=$con->query("SELECT distinct year from course_registration where programe like '$programe'");
while($data2=$sql2->fetch_array())
{
  $year=$data2['year'];
echo"<option value='$year'>".$year."</option>";
}
echo"        </select><br><br>";
      echo"<input type='submit' name='submit2' value='Submit'>";
   echo"</form>";
 echo"</div>";
}
else if(isset($_POST['submit2']))
{
  $programe=$_SESSION['programe'];
$_SESSION['programe']=$programe;
$year=$_POST['year'];
$_SESSION['year']=$year;
 echo"<div class='select-assessment-form-div'>";
echo"<form class='select-assessment-form' action='revoke1.php' method='post'>";
    echo"<label for='department'>Select Department: </label>";
    echo"<select name='department'>";
$sql3=$con->query("SELECT distinct department from course_registration where programe like '$programe' and year like'$year'");
while($data3=$sql3->fetch_array())
{
  $department=$data3['department'];
echo"<option value='$department'>".$department."</option>";
}
echo"        </select><br><br>";
      echo"<input type='submit' name='submit1' value='Submit'>";
   echo"</form>";
 echo"</div>";
}
 ?>
  <footer class="footer">
    <p>Copyrights &copy NIT Puducherry @ 2021</p>
  </footer>
</body>
</html>
