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
    $subject=$data['course_code'];
      echo"<div class='dropdown-content curriculum-content'>";
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
$subject=$_GET['subject'];
$con=mysqli_connect("localhost","kishore","Kishore@016","login");
$sql=$con->query("SELECT flag FROM course_creation where course_code like '$subject'");
$data=$sql->fetch_array();
if($data['flag']=='1')
{
  echo "<div class='no-course'>You already submitted the Grades</div><hr>";
}
else
{
  $p=$con->query("SELECT 1 FROM $subject");
  if($p!==false)
  {
    $sql2=$con->query("SELECT count(column_name)as count from information_schema.columns WHERE table_name like '$subject'");
    $data2=$sql2->fetch_array();
    $j=($data2[0]-4)/2;
    $sql3=$con->query("SELECT roll FROM course_registration where course_code like '%$subject%'");
    while($data3=$sql3->fetch_array())
    {
      $roll=$data3['roll'];
      $sql4=$con->query("INSERT INTO $subject (roll) values ('$roll')");
    }
    echo"<div class='no-course'>You Already Configured the Course</div><hr>";
    echo"<br>";
    for($k=1;$k<=$j;$k++)
    {
      echo"ASSESMENT$k  ASSIGNED MARKS ARE ";
      $sql=$con->query("SELECT DISTINCT assesment".$k."marks FROM $subject ");
      $data=$sql->fetch_array();
      echo$data[0];
      echo"<br>";
    }
  }
  else
  {
echo"<div class='course-registration-form-div'>
    <form class='course-registration-form'  method='post' action='configure2.php'>
      <label for='subject'> Subject Name is shown here: </label>
      <input type='text' name='subject' value=$subject><br>
      <label for='upload'>Enter no of Assesments: </label>
      <input type='number' name='number'><br>
      <input type='submit' name='submit' value='Submit'>
    </form>
  </div>";
}
}
  ?>
  <footer class="footer">
    <p>Copyrights &copy NIT Puducherry @ 2021</p>
  </footer>
</body>
</html>
