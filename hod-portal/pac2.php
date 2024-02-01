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
    $_SESSION['department']=$data1['dept'];
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
?>
<?php
$department=$_SESSION['department'];
$programe=$_SESSION['programe'];
$year=$_POST['year'];
$_SESSION['year']=$year;
  $_SESSION['programe']=$programe;
  $_SESSION['department']=$department;
  $x=0;
$con=mysqli_connect("localhost","kishore","Kishore@016","login");
  $sqll=$con->query("SELECT distinct course_code from course_registration where department like '$department' and programe like '$programe' and year like '$year'");
 $dataa=$sqll->fetch_array();
 {
    if($dataa==NULL)
    {
      $x=1;
    }
 }
 if($x==1)
 {
  echo"<div class='no-course'>FOR THIS DEPARTMENT NO SUBJECT IS REGISTERED</div><hr>";
 }
 else
 {
if($programe=='btech')
{
  echo"<div class='select-assessment-form-div'>";
echo"<form class='select-assessment-form' action='pac2.php' method='post'>";
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
  echo"<form class='select-assessment-form' action='pac2.php' method='post'>";
    echo"<label for='year'>Select Year: </label>";
    echo"<select name='year'>";
      echo"<option value='1'>1</option>";
      echo"<option value='2'>2</option>";
           echo"        </select><br><br>";
      echo"<input type='submit' name='submit1' value='Submit'>";
   echo"</form>";
 echo"</div>";
}
 if(isset($_POST['submit1']))
{
  $programe=$_SESSION['programe'];
  $year=$_POST['year'];
  $department=$_SESSION['department'];
  $_SESSION['programe']=$programe;
  $_SESSION['year']=$year;
  $_SESSION['department']=$department;
  $z=0;
$con=mysqli_connect("localhost","kishore","Kishore@016","login");
  $sqll=$con->query("SELECT distinct course_code from course_registration where department like '$department' and programe like '$programe' and year like '$year'");
 while($dataa=$sqll->fetch_array())
 {
  $subject=$dataa['course_code'];
    $sqll1=$con->query("SELECT flag from course_creation where course_code like '$subject'");
    $dataa1=$sqll1->fetch_array();
    if($dataa1['flag']==0)
    {
      $z=1;
      break;
    }
 }
 if($z==1)
 {
  echo"<div class='no-course'>All Subject Grades didn't submited yet</div><hr>";
 }
 else
 {
  echo"<table class='pac-sheet-table' >";
     echo"<tr >";
     echo"<th rowspan='2'style='text-align:center'>Roll</th>";
  $sql=$con->query("SELECT distinct course_code from course_registration where programe like '$programe' and year like '$year' and department like '$department'");
  while($dat=$sql->fetch_array())
  {
    echo"<th colspan='2' style='text-align:center'>".$dat['course_code']."</th>";
  }
  echo"<th rowspan='2' style='text-align:center'>GPA</th>";
  echo"</tr>";
  echo"<tr>";
  $sql=$con->query("SELECT distinct course_code from course_registration where programe like '$programe' and year like '$year' and department like '$department'");
  while($dat=$sql->fetch_array())
  {
    echo"<td style='text-align:center'>Marks</td>";
    echo"<td style='text-align:center'>Grade</td>";
  }
  echo"</tr>";
   $sql2=$con->query("SELECT distinct roll from student where department like '$department' and programe like '$programe' and year like '$year'");
    while($data2=$sql2->fetch_array())
    {
      $sum=0;
   $cont=0;
   $y=0;
      echo"<tr>";
      echo"<th style='text-align:center'>".$data2['roll']."</th>";
      $roll=$data2['roll'];
      $sql3=$con->query("SELECT distinct course_code from course_registration where programe like '$programe' and year like '$year' and department like '$department'");
      while($data3=$sql3->fetch_array())
      {
        $count=count($data3);
        for($i=0;$i<$count;$i++)
        {
           if($i%2==0)
           {
            $subject=$data3['course_code'];
            $sql8=$con->query("SELECT 1 from $subject");
            if($sql8)
            {
            $sql4=$con->query("SELECT total,grade from ".$subject." where roll like '$roll'");
            $data4=$sql4->fetch_array();
            if($data4!=null)
           {
            echo"<td style='text-align:center'>".$data4['total']."</td>";
            echo"<td style='text-align:center'>".$data4['grade']."</td>";
            $sql6=$con->query("SELECT credits from course_creation where course_code like '$subject'");
            $data6=$sql6->fetch_array();
            if($data4['grade']=='S')
            {
              $cont=$cont+$data6['credits'];
              $sum=$sum+10*$data6['credits'];
            }
            else if($data4['grade']=='A')
            {
              $cont=$cont+$data6['credits'];
              $sum=$sum+9*$data6['credits'];
            }
           else if($data4['grade']=='B')
            {
              $cont=$cont+$data6['credits'];
              $sum=$sum+8*$data6['credits'];
            }
           else if($data4['grade']=='C')
            {
              $cont=$cont+$data6['credits'];
              $sum=$sum+7*$data6['credits'];
            }
           else if($data4['grade']=='D')
            {
              $cont=$cont+$data6['credits'];
              $sum=$sum+6*$data6['credits'];
            }
           else if($data4['grade']=='E')
            {
              $cont=$cont+$data6['credits'];
              $sum=$sum+5*$data6['credits'];
            }
            else if($data4['grade']=='F'||$data4['grade']=='Z'||$data4['grade']=='U'||$data4['grade']=='W')
            {
              $y=1;
              $cont=0;
              break;
            }
           }
           else
           {
            echo"<td style='text-align:center'>"."</td>";
            echo"<td style='text-align:center'>"."</td>";
           }
           }
           else
         {
          echo"<td style='text-align:center'>"."</td>";
            echo"<td style='text-align:center'>"."</td>";
         }
         }
         }
        }
        if($y==1)
        {
          $cont=0;
        }
      if($cont!=0)
      {
      $x=$sum/$cont;
      echo"<th  style='text-align:center'>".round($x,2)."</th>";
    }
    else
    {
      echo"<th  style='text-align:center'>NA</th>";
     }
      echo"</tr>";
    }
  echo"</table>";
   $sql7=$con->query("SELECT flag from hod_table where programe like '$programe' and department like '$department' and year like '$year'");
$data7=$sql7->fetch_array();
if($data7['flag']=='0')
{
echo"<form class='select-assessment-form' action='pac1.php' method='post'>";
      echo"<input type='submit' name='submit' value='Submit'>";
   echo"</form>";
}
}
}
else
{
  echo "<div class='no-course'>FOR THIS SECTION NO COURSE IS REGISTERED</div><hr>";
}
}
  ?>

  <footer class="footer">
    <p>Copyrights &copy NIT Puducherry @ 2021</p>
  </footer>
</body>
</html>
