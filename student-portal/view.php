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
<?php
$con=mysqli_connect("localhost","kishore","Kishore@016","login");
$subject=$_GET['subject'];
$name=$_SESSION['name'];
$_SESSION['user']=$name;
$sql2=$con->query("SELECT 1 from $subject");
if($sql2==false)
{
  echo"<div class='no-course'>Course is not configured yet</div><hr>";
}
else
{
  $sql3=$con->query("SELECT 1 from ".$subject."configure");
    if($sql3==false)
    {
      echo"<table>";
    echo"<tr>";
    echo"<th>Subject</th>";
echo"<th>Attendence %</th>";
      $sql2=$con->query("SELECT count(column_name)as count from information_schema.columns WHERE table_name like '$subject'");
    $data2=$sql2->fetch_array();
    $j=($data2[0]-4)/2;
    for($k=1;$k<=$j;$k++)
    {
      echo"<th>Assesment$k marks</th>";
    }
    echo"</tr>";
    echo"<tr>";
    echo"<th>".$subject."</th>";
    $sql4=$con->query("SELECT attendence FROM $subject where roll like '$name'");
    $data4=$sql4->fetch_array();
echo"<th>".$data4['attendence']."</th>";
    for($k=1;$k<=$j;$k++)
    {
      $sql3=$con->query("SELECT assesment$k as assesment from $subject where roll like '$name'");
      $data3=$sql3->fetch_array();
echo"<th>".$data3['assesment']."</th>";
    }
        echo" </tr>";
        echo "</table";
    }
    else
    {
$sql2=$con->query("SELECT DISTINCT flag from ".$subject."configure");
$data2=$sql2->fetch_array();
if($data2['flag']=='1')
{
  echo "<div class='no-course'>You Don't have permission to visit your marks</div><hr>";
}
else
{
  echo"<table>";
    echo"<tr>";
    echo"<th>Subject</th>";
echo"<th>Attendence %</th>";
      $sql2=$con->query("SELECT count(column_name)as count from information_schema.columns WHERE table_name like '$subject'");
    $data2=$sql2->fetch_array();
    $j=($data2[0]-4)/2;
    for($k=1;$k<=$j;$k++)
    {
      echo"<th>Assesment$k marks</th>";
    }
    echo"</tr>";
    echo"<tr>";
    echo"<th>".$subject."</th>";
    $sql4=$con->query("SELECT attendence FROM $subject where roll like '$name'");
    $data4=$sql4->fetch_array();
echo"<th>".$data4['attendence']."</th>";
    for($k=1;$k<=$j;$k++)
    {
      $sql3=$con->query("SELECT assesment$k as assesment from $subject where roll like '$name'");
      $data3=$sql3->fetch_array();
echo"<th>".$data3['assesment']."</th>";
    }
        echo" </tr>";
        echo "</table";
}
}
}
 ?>
  <footer class="footer">
    <p>Copyrights &copy NIT Puducherry @ 2021</p>
  </footer>
</body>

</html>
