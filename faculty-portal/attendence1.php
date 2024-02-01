<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <link rel="icon" href="../images/icon.png">
  <title>NITPY Faculty portal</title>
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
$con=mysqli_connect("localhost","kishore","Kishore@016","login");
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
      echo"<div class='dropdown-content curriculum-content'>";
      $subject=$data['course_code'];
        echo"<a href='configure.php?subject=$subject'>Course_configuration</a>";
        echo"<a href='attendence.php?subject=$subject'>Attendence</a>";
        echo"<a href='marks-add.php?subject=$subject'>Marks</a>";
        echo"<a href='grade.php?subject=$subject'>Grade Configuration</a>";
        echo"<a href='sheet.php?subject=$subject'>Grade sheet</a>";
      echo"</div>";
    echo"</li>";
    $i++;
  }
  echo"</ul>";
  ?>
  <?php
if(isset($_POST['submit']))
{
  $subject=$_SESSION['subject'];
  $_SESSION['subject']=$subject;
$con=mysqli_connect("localhost","kishore","Kishore@016","login");
  $i=0;
  $sql=$con->query("SELECT flag from course_creation where course_code like '$subject'");
  $data=$sql->fetch_array();
  if($data['flag']==1)
  {
echo"<table class='marks-add-table'>";
      echo"<tr>";
        echo"<th>Roll No</th>";
        echo"<th>Attendence %</th>";
      echo"</tr>";
      $sql=$con->query("SELECT DISTINCT roll FROM $subject order by roll ");
    $i=0;
    while($data1=$sql->fetch_array())
    {
      echo"<tr>";
        echo"<td>";
         echo $data1['roll'];
         $roll=$data1['roll'];
        echo"</td>";
        $sql1=$con->query("SELECT attendence from $subject where roll like '%$roll%'");
        $data2=$sql1->fetch_array();
        echo"<td>".$data2['attendence']."</td>";
      echo"</tr>";
      $i++;
    }
    echo"</table>";
  }
  else
  {
  $sql=$con->query("SELECT DISTINCT roll FROM ".$subject." order by roll ");
    while($data1=$sql->fetch_array())
    {
      $attendence=$_POST['marks'.$i.''];
      $roll=$data1['roll'];
        $sql1=$con->query("UPDATE $subject SET attendence=$attendence where roll like '%$roll%'");
      $i++;
    }
    echo"<form class='marks-add-table-form' method='post' action='attendence1.php'>";
    echo"<table class='marks-add-table'>";
      echo"<tr>";
        echo"<th>Roll No</th>";
        echo"<th>Attendence %</th>";
      echo"</tr>";
      $sql=$con->query("SELECT DISTINCT roll FROM $subject order by roll ");
    $i=0;
    while($data1=$sql->fetch_array())
    {
      echo"<tr>";
        echo"<td>";
         echo $data1['roll'];
         $roll=$data1['roll'];
        echo"</td>";
        $sql1=$con->query("SELECT attendence from $subject where roll like '%$roll%'");
        $data2=$sql1->fetch_array();
        echo"<td> <input type='number' name='marks".$i."'value=".$data2['attendence']."></td>";
      echo"</tr>";
      $i++;
    }
    echo"</table>";
    echo "<br>";
    echo" <input type='submit' name='submit' value='Submit'>";
  echo"</form>";
}
}
?>
  <footer class="footer">
    <p>Copyrights &copy NIT Puducherry @ 2021</p>
  </footer>
</body>
</html>
