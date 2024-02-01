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
if(isset($_POST['submit2']))
{
  $subject=$_SESSION['subject'];
  echo"<br>";
  $num=$_SESSION['number'];
    echo"<br>";
$con=mysqli_connect("localhost","kishore","Kishore@016","login");
  $p=$con->query("SHOW TABLE like '%$subject%'");
  if(!empty($p))
  {
    echo "<div class='no-course'>You can't do course configuration again</div><hr>";
  }
  else
  {
    $i=1;
    $s=0;
    $p=[];
    while($i<=$num)
    {
      if($i>$num)
      {
        break;
      }
      $p[$i]=$_POST["number$i"];
      $s=$s+$p[$i];
      $i++;
    }
    if($s==100)
    {
    $sql2=$con->query("CREATE TABLE $subject (roll varchar(255) primary key, attendence int(255),grade varchar(255),total int (10))");
    $sql2=$con->query("ALTER TABLE $subject ALTER attendence SET DEFAULT '0'");
    $sql2=$con->query("ALTER TABLE $subject ALTER total SET DEFAULT '0'");
    $sql3=$con->query("ALTER TABLE $subject ALTER grade SET DEFAULT 'f'");
    for($j=1;$j<=$num;$j++)
    {
       $sql3=$con->query("ALTER TABLE $subject ADD assesment$j int(10) ");
       $sql3=$con->query("ALTER TABLE $subject ADD assesment".$j."marks int(10)");
       $sql3=$con->query("ALTER TABLE $subject ALTER assesment".$j."marks SET DEFAULT '$p[$j]'");
       $sql3=$con->query("ALTER TABLE $subject ALTER assesment$j SET DEFAULT '0'");
       if($j==$num&&$sql)
       {
        echo"<div class='no-course'>Course is configured.</div><hr>";
       }
    }
    $sql3=$con->query("SELECT roll FROM course_registration where course_code like '%$subject%'");
    while($data3=$sql3->fetch_array())
    {
      $roll=$data3['roll'];
      $sql4=$con->query("INSERT INTO $subject (roll) values ('$roll')");
    }
  }
  else
  {
    echo "<div class='no-course'>You must allot a total of 100 marks for the course.</div><hr>";
    echo"<br>";
  }
  }
}
 ?>
  <footer class="footer">
    <p>Copyrights &copy NIT Puducherry @ 2021</p>
  </footer>
</body>
</html>
