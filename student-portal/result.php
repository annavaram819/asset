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
$roll=$_SESSION['user'];
$con=mysqli_connect("localhost","kishore","Kishore@016","login");
$sql=$con->query("SELECT DISTINCT department, programe, year from course_registration where roll like '$roll'");
$data=$sql->fetch_array();
$department=$data['department'];
$programe=$data['programe'];
$year=$data['year'];
$sql1=$con->query("SELECT flag1 FROM hod_table where department like '$department' and programe like '$programe' and year like '$year'");
$data1=$sql1->fetch_array();
if($data1['flag1']=='1')
{
echo"<div class='results-div'>";
  echo"<table class='results-table'>";
    echo"<tr>";
      echo"<th>Subject Code</th>";
      echo"<th>Subject Name</th>";
      echo"<th>Credits</th>";
      echo"<th>Grade</th>";
    echo"</tr>";
    $sql2=$con->query("SELECT DISTINCT course_code from course_registration where department like '$department' and programe like '$programe' and year like '$year'");
     $p=0;
      $x=0;
    $y=0;
    while($data2=$sql2->fetch_array())
   {
    echo"<tr>";
      echo"<td>".$data2['course_code']."</td>";
      $course=$data2['course_code'];
      $sql3=$con->query("SELECT course_title,credits from course_creation where course_code like '$course'");
      $data3=$sql3->fetch_array();
      echo"<td>".$data3['course_title']."</td>";
      echo"<td>".$data3['credits']."</td>";
  $credit=$data3['credits'];
      $sql4=$con->query("SELECT DISTINCT course_code FROM course_registration WHERE roll like '$roll'");
       while($data4=$sql4->fetch_array())
       {
        $course1=$data4['course_code'];
        if($course==$course1)
        {
          $sql6=$con->query("SELECT grade from $course where roll like '$roll'");
          $data6=$sql6->fetch_array();
          if($data6['grade']=='S')
          {
            echo"<td>".$data6['grade']."</td>";
            $y=$y+$credit;
            $x=$x+(10*$credit);
          }
          if($data6['grade']=='A')
          {
            echo"<td>".$data6['grade']."</td>";
            $y=$y+$credit;
            $x=$x+(9*$credit);
          }
          if($data6['grade']=='B')
          {
            echo"<td>".$data6['grade']."</td>";
            $y=$y+$credit;
            $x=$x+(8*$credit);
          }
          if($data6['grade']=='C')
          {
            echo"<td>".$data6['grade']."</td>";
            $y=$y+$credit;
            $x=$x+(7*$credit);
          }
          if($data6['grade']=='D')
          {
            echo"<td>".$data6['grade']."</td>";
            $y=$y+$credit;
            $x=$x+(6*$credit);
          }
          if($data6['grade']=='E')
          {
            echo"<td>".$data6['grade']."</td>";
            $y=$y+$credit;
            $x=$x+(5*$credit);
          }
          else if($data6['grade']=='F'||$data6['grade']=='U'||$data6['grade']=='Z'||$data6['grade']=='W')
          {
               $p=1;
               echo"<td>".$data6['grade']."</td>";
          }
        }
       }
    echo"</tr>";
  }
  if($p==1)
  {
     $y=0;
  }
    echo"<tr>";
    if($y!=0)
    {
      $s=$x/$y;
      echo"<td colspan='4'>GPA: ".round($s,2)."</td>";
    }
    else if($y==0)
    {
      echo"<td colspan='4'>GPA: - </td>";
    }
    echo"</tr>";
  echo"</table>";
  echo"<table class='key-table'>";
    echo"<tr>";
      echo"<th>S</th>";
      echo"<th>A</th>";
      echo"<th>B</th>";
      echo"<th>C</th>";
      echo"<th>D</th>";
      echo"<th>E</th>";
      echo"<th>F</th>";
      echo"<th>Z</th>";
      echo"<th>W</th>";
      echo"<th>U</th>";
    echo"</tr>";
    echo"<tr>";
      echo"<td>10</td>";
      echo"<td>9</td>";
      echo"<td>8</td>";
      echo"<td>7</td>";
      echo"<td>6</td>";
      echo"<td>5</td>";
      echo"<td>Fail</td>";
      echo"<td>Absent</td>";
      echo"<td>Withdrawn</td>";
      echo"<td>Prevented</td>";
    echo"</tr>";

  echo"</table>";
echo"</div>";
}
else
{
  echo"<div class='no-course'>Results are yet to be declared.</div><hr>";
}
 ?>
  <footer class="footer">
    <p>Copyrights &copy NIT Puducherry @ 2021</p>
  </footer>
</body>
</html>
