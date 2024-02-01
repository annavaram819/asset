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
      $name=$_SESSION['name'];
      $password=$_SESSION['password'];
      $_SESSION['user']=$name;
      $_SESSION['p']=$password;
   $con=mysqli_connect("localhost","kishore","Kishore@016","login");
  $sql1=$con->query("SELECT name from student where roll like '%$name%'");
  $data1=$sql1->fetch_array();
  echo"<p class='hod-name'>Welcome $data1[0] <br><a href='password.php'> Reset Password</a><br><a href='logout.php'>Logout</a> </p>";
    echo"<h1>NATIONAL INSTITUTE OF TECHNOLOGY PUDUCHERRY</h1>";
    echo"<h2>Student Portal</h2>";
  echo"</div>";
  echo"<ul class='navbar'>";
  echo"<li class='nav-item curriculum'>Home";
      echo"<div class='dropdown-content curriculum-content'>";
        echo"<a href='index1.php'>Home</a>";
      echo"</div>";
    echo"</li>";
$sql=$con->query("SELECT course_code from course_registration where roll like '$name'");
    $i=0;
    while($data=$sql->fetch_array())
    {
    echo"<li class='nav-item curriculum'>".$data['course_code']."";
    $subject=$data['course_code'];
      echo"<div class='dropdown-content curriculum-content'>";
        echo"<a href='attendence.php?subject=$subject'>View</a>";
      echo"</div>";
    echo"</li>";
    $i++;
  }
    echo"<li class='nav-item curriculum'>Result";
      echo"<div class='dropdown-content curriculum-content'>";
        echo"<a href='result.php'>Result</a>";
      echo"</div>";
    echo"</li>";
  echo"</ul>";
?>
<?php
$subject=$_SESSION['subject'];
$roll=$_SESSION['user'];
$con=mysqli_connect("localhost","kishore","Kishore@016","login");
  $con4=$con->query("SELECT 1 from ".$subject."configure");
if($con4!==false)
{
  echo "<div class='no-course'>You don't have permissin to view your attendence.</div><hr>";
}
else
{
  $p=$con->query("SELECT 1 FROM $subject");
  if($p==false)
  {
    echo"<div class='no-course'>Course configuration has not been done by the faculty yet.</div><hr>";
    echo"<br>";
  }
  else
  {
    $sql2=$con->query("SELECT count(column_name)as count from information_schema.columns WHERE table_name like '$subject'");
    $data2=$sql2->fetch_array();
    $j=($data2[0]-4)/2;
    $_SESSION['p']=$j;
    for($k=1;$k<=$j;$k++)
    {
      echo"ASSESMENT$k ASSIGNED MARKS ARE ";
      $sql=$con->query("SELECT DISTINCT assesment".$k."marks FROM $subject ");
      $data=$sql->fetch_array();
      echo$data[0];
      echo"<br>";
    }
  echo"<div class='select-assessment-form-div'>";
   echo" <form class='select-assessment-form' action='marks1.php' method='post'>";
      echo"<label for='assessment'>Choose Assessment: </label>";
      echo"<select name='assessment'>";
    for($k=1;$k<=$j;$k++)
      {
       echo" <option value='assesment".$k."'>Assessment $k</option>";
     }
            echo"  </select><br><br>";
     echo" <input type='submit' name='submit' value='Submit'>";
  echo"  </form>";
 echo" </div>";
}
}
 ?>
 <?php
if(isset($_POST['submit']))
{
  $assesment=$_POST['assessment'];
  $_SESSION['assesment']=$assesment;
  $q=$_SESSION['p'];
  $con=mysqli_connect("localhost","kishore","Kishore@016","login");
  $subject=$_SESSION['subject'];
  $_SESSION['subject']=$subject;
  echo"<h3>";
 echo"".$assesment."Marks are shown here ";
  echo"</h3>";
  echo"<table class='marks-add-table'>";
      echo"<tr>";
     echo"   <th>Roll No</th>";
    echo"    <th>Marks</th>";
    echo"  </tr>";
    $sql5=$con->query("SELECT $assesment as assesment from $subject where roll like '$roll'");
    $data5=$sql5->fetch_array();
    echo"<tr>";
     echo"   <th>".$roll."</th>";
    echo"    <th>".$data5['assesment']."</th>";
    echo"  </tr>";
    echo"</table>";
}
  ?>
  <footer class="footer">
    <p>Copyrights &copy NIT Puducherry @ 2021</p>
  </footer>
</body>

</html>
