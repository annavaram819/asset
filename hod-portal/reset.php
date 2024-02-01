<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <link rel="icon" href="../images/icon.png">
  <title>NITPY Academic portal</title>
  <link rel="stylesheet" href="../styles.css">
  <link rel="stylesheet" href="styles.css">
  <script type="text/javascript">
        function preventBack() { window.history.forward(); }
        setTimeout("preventBack()", 0);
        window.onunload = function () { null };
    </script>
</head>

<body>
  <?php  
  echo"<div class='main-head'>";
    echo"<img src='../images/icon.png' alt='NITPY' class='main-logo'>";
    session_start();
       $con=mysqli_connect("localhost","kishore","Kishore@016","login");
       $name=$_SESSION['user'];
       $password=$_SESSION['password'];
  $_SESSION['name']=$name;
  $_SESSION['password']=$password;
    $sql1=$con->query("SELECT name from hod where mail like'%$name%'");
    $data1=$sql1->fetch_array();
    echo"<p class='hod-name'>Welcome $data1[0] <br><br> <a href='password.php'>Reset Password</a><br> <br> <a href='logout.php'>Logout</a> </p>";
    echo"<h1>NATIONAL INSTITUTE OF TECHNOLOGY PUDUCHERRY</h1>";
    echo"<h2>HOD Portal</h2>";
  echo"</div>";
  echo"<ul class=navbar>";
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
  echo"</ul>";
  ?>
  <h3> File format should be (name,roll,course_code,year,department,programe)</h3>
  <div class="course-registration-form-div">
    <form enctype='multipart/form-data' class="course-registration-form"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <label for="upload">Upload: </label>
      <input type="file" name="file"><br>
      <input type="submit" name="submit" value="Submit">
    </form>
  </div>
  <ul class=navbar>
  <div class="course-registration-form-div">
    <form class="course-registration-form"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <label for='cars'>PROGRAME:</label>
      <input type='text' name='programe'>
      <br><br>
      <label for='cars'>DEPARTMENT:</label>
      <input type='text' name='department'>
      <br><br>
    <label for='cars'>COURSE_CODE:</label>
      <input type='text' name='course_code'><br><br>
      <label for='cars'>YEAR:</label>
      <input type='text' name='year'><br><br>
      <input type="submit" name="submit1" value="Filter">
    </form>
  </div>
</ul>
<?php
  if(isset($_POST['submit']))
  {
  $con=mysqli_connect("localhost","kishore","Kishore@016","login");
if($con)
{
  $value='';
 $file=$_FILES['file']['tmp_name'];
 $handle=fopen($file,"r");
 $value1=00;
 $query1=$con->query("TRUNCATE TABLE course_registration");
 while(($cont=fgetcsv($handle)))
 {
  $query1=$con->query("INSERT INTO course_registration (name,roll,course_code,year,department,programe) values ('$cont[0]','$cont[1]','$cont[2]','$cont[3]','$cont[4]','$cont[5]')") ;
}
 fclose($handle);
 $query=$con->query("SELECT * from course_registration");
if(!empty($query))
{
     echo"<table style='width:100%'>";
  echo"<tr >";
  echo"<td>Name</td>";
  echo"<td>Roll</td>";
  echo"<td>Course_code</td>";
  echo"<td>Year</td>";
    echo"<td>Department</td>";
    echo"<td>Programe</td>";
  echo"</tr>";
  while($data=$query->fetch_array())
  {
    echo"<tr>";
    echo"<td>.".$data['name']."</td>";
    echo"<td>.".$data['roll']."</td>";
    echo"<td>.".$data['course_code']."</td>";
    echo"<td>.".$data['year']."</td>";
    echo"<td>".$data['department']."</td>";
    echo"<td>".$data['programe']."</td>";
    echo"</tr>";
  }
echo"</table>";
  }
}
else{
  echo"connection failed";
}
}
else if(isset($_POST['submit1']))
{
  $programe=$_POST['programe'];
  $department=$_POST['department'];
  $course=$_POST['course_code'];
  $year=$_POST['year'];
if(empty($year)&&empty($programe)&&empty($department)&&empty($course))
{
echo"<table style='width:100%'>";
  echo"<tr>";
    echo"<td>Name</td>";
  echo"<td>Roll</td>";
  echo"<td>Course_code</td>";
  echo"<td>Year</td>";
    echo"<td>Department</td>";
    echo"<td>Programe</td>";
  echo"</tr>";
  $query=$con->query("SELECT * from course_registration");
  while($data=$query->fetch_array())
  {
    echo"<tr>";
    echo"<td>".$data['name']."</td>";
    echo"<td>".$data['roll']."</td>";
    echo"<td>".$data['course_code']."</td>";
    echo"<td>".$data['year']."</td>";
    echo"<td>".$data['department']."</td>";
    echo"<td>".$data['programe']."</td>";
  echo"</tr>";
  }
echo"</table>";
}
else if(empty($year)&&empty($programe)&&empty($department)&&!empty($course))
{
  echo"<table style='width:100%'>";
  echo"<tr >";
    echo"<td>Name</td>";
    echo"<td>Roll</td>";
    echo"<td>year</td>";
    echo"<td>Department</td>";
    echo"<td>Programe</td>";
  echo"</tr>";
  $query=$con->query("SELECT * from course_registration where course_code like '%$course%'");
  while($data=$query->fetch_array())
  {
    echo"<tr>";
    echo"<td>".$data['name']."</td>";
    echo"<td>".$data['roll']."</td>";
    echo"<td>".$data['year']."</td>";
    echo"<td>".$data['department']."</td>";
    echo"<td>".$data['programe']."</td>";
  echo"</tr>";
  }
echo"</table>";
}
else if(empty($year)&&empty($programe)&&!empty($department)&&empty($course))
{
  echo"<table style='width:100%'>";
  echo"<tr>";
  echo"<td>Name</td>";
  echo"<td>Roll</td>";
  echo"<td>Course_code</td>";
    echo"<td>Year</td>";
    echo"<td>Programe</td>";
  echo"</tr>";
  $query=$con->query("SELECT * from course_registration where department like '%$department%'");
  while($data=$query->fetch_array())
  {
    echo"<tr>";
    echo"<td>".$data['name']."</td>";
    echo"<td>".$data['roll']."</td>";
    echo"<td>".$data['course_code']."</td>";
    echo"<td>".$data['year']."</td>";
    echo"<td>".$data['programe']."</td>";
  echo"</tr>";
  }
echo"</table>";
}
else if(empty($year)&&empty($programe)&&!empty($department)&&!empty($course))
{
  echo"<table style='width:100%'>";
  echo"<tr >";
  echo"<td>Name</td>";
  echo"<td>Roll</td>";
  echo"<td>Year</td>";
    echo"<td>Programe</td>";
  echo"</tr>";
  $query=$con->query("SELECT * from course_registration where course_code like '%$course%' and department like '%$department%'");
  while($data=$query->fetch_array())
  {
    echo"<tr>";
    echo"<td>".$data['name']."</td>";
    echo"<td>".$data['roll']."</td>";
    echo"<td>".$data['year']."</td>";
    echo"<td>".$data['programe']."</td>";
  echo"</tr>";
  }
echo"</table>";
}
else if(empty($year)&&!empty($programe)&&empty($department)&&empty($course))
{
  echo"<table style='width:100%'>";
  echo"<tr >";
  echo"<td>Name</td>";
  echo"<td>Roll</td>";
  echo"<td>Course_code</td>";
    echo"<td>Year</td>";
    echo"<td>Department</td>";
  echo"</tr>";
  $query=$con->query("SELECT * from course_registration where programe like '%$programe%'");
  while($data=$query->fetch_array())
  {
    echo"<tr>";
    echo"<td>".$data['name']."</td>";
    echo"<td>".$data['roll']."</td>";
    echo"<td>".$data['course_code']."</td>";
    echo"<td>".$data['year']."</td>";
    echo"<td>".$data['department']."</td>";
  echo"</tr>";
  }
echo"</table>";
}
else if(empty($year)&&!empty($programe)&&empty($department)&&!empty($course))
{
  echo"<table style='width:100%'>";
  echo"<tr>";
  echo"<td>Name</td>";
  echo"<td>Roll</td>";
  echo"<td>Year</td>";
    echo"<td>Department</td>";
  echo"</tr>";
  $query=$con->query("SELECT * from course_registration where programe like '%$programe%' and course_code like '%$course_code%'");
  while($data=$query->fetch_array())
  {
    echo"<tr>";
    echo"<td>".$data['name']."</td>";
    echo"<td>".$data['roll']."</td>";
    echo"<td>".$data['year']."</td>";
    echo"<td>".$data['department']."</td>";
  echo"</tr>";
  }
echo"</table>";
}
else if(empty($year)&&!empty($programe)&&!empty($department)&&empty($course))
{
  echo"<table style='width:100%'>";
  echo"<tr >";
  echo"<td>Name</td>";
  echo"<td>Roll</td>";
  echo"<td>Course_code</td>";
    echo"<td>Year</td>";
  echo"</tr>";
  $query=$con->query("SELECT * from course_registration where programe like '%$programe%' and department like '%$department%'");
  while($data=$query->fetch_array())
  {
    echo"<tr>";
     echo"<td>".$data['name']."</td>";
      echo"<td>".$data['roll']."</td>";
       echo"<td>".$data['course_code']."</td>";
    echo"<td>".$data['year']."</td>";
  echo"</tr>";
  }
echo"</table>";
}
else if(empty($year)&&!empty($programe)&&!empty($department)&&!empty($course))
{
  echo"<table style='width:100%'>";
  echo"<tr>";
    echo"<td>Name</td>";
    echo"<td>Roll</td>";
    echo"<td>Year</td>";
  echo"</tr>";
  $query=$con->query("SELECT * from course_registration where course_code like '%$course%' and programe like '%$programe%' and department like '%$department%'");
  while($data=$query->fetch_array())
  {
    echo"<tr>";
    echo"<td>".$data['name']."</td>";
    echo"<td>".$data['roll']."</td>";
    echo"<td>".$data['year']."</td>";
  echo"</tr>";
  }
echo"</table>";
}
else if(!empty($year)&&empty($programe)&&empty($department)&&empty($course))
{
echo"<table style='width:100%'>";
  echo"<tr>";
  echo"<td>Name</td>";
  echo"<td>Roll</td>";
    echo"<td>Course_code</td>";
    echo"<td>Department</td>";
    echo"<td>Programe</td>";
  echo"</tr>";
  $query=$con->query("SELECT * from course_registration where year like '%$year%'");
  while($data=$query->fetch_array())
  {
    echo"<tr>";
    echo"<td>".$data['name']."</td>";
    echo"<td>".$data['roll']."</td>";
    echo"<td>".$data['course_code']."</td>";
    echo"<td>".$data['department']."</td>";
    echo"<td>".$data['programe']."</td>";
  echo"</tr>";
  }
echo"</table>";
}
else if(!empty($year)&&empty($programe)&&empty($department)&&!empty($course))
{
  echo"<table style='width:100%'>";
  echo"<tr >";
  echo"<td>Name</td>";
  echo"<td>Roll</td>";
    echo"<td>Department</td>";
    echo"<td>Programe</td>";
  echo"</tr>";
  $query=$con->query("SELECT * from course_registration where course_code like '%$course%' and year like '%$year%'");
  while($data=$query->fetch_array())
  {
    echo"<tr>";
    echo"<td>".$data['name']."</td>";
    echo"<td>".$data['roll']."</td>";
    echo"<td>".$data['department']."</td>";
    echo"<td>".$data['programe']."</td>";
  echo"</tr>";
  }
echo"</table>";
}
else if(!empty($year)&&empty($programe)&&!empty($department)&&empty($course))
{
  echo"<table style='width:100%'>";
  echo"<tr>";
  echo"<td>Name</td>";
  echo"<td>Roll</td>";
    echo"<td>Course_code</td>";
    echo"<td>Programe</td>";
  echo"</tr>";
  $query=$con->query("SELECT * from course_registration where department like '%$department%' and year like '%$year%'");
  while($data=$query->fetch_array())
  {
    echo"<tr>";
    echo"<td>".$data['name']."</td>";
    echo"<td>".$data['roll']."</td>";
    echo"<td>".$data['course_code']."</td>";
    echo"<td>".$data['programe']."</td>";
  echo"</tr>";
  }
echo"</table>";
}
else if(!empty($year)&&empty($programe)&&!empty($department)&&!empty($course))
{
  echo"<table style='width:100%'>";
  echo"<tr >";
  echo"<td>Name</td>";
  echo"<td>Roll</td>";
    echo"<td>Programe</td>";
  echo"</tr>";
  $query=$con->query("SELECT * from course_registration where course_code like '%$course%' and department like '%$department%' and year like '%$year%' and course_code like '%$course%'");
  while($data=$query->fetch_array())
  {
    echo"<tr>";
    echo"<td>".$data['name']."</td>";
    echo"<td>".$data['roll']."</td>";
    echo"<td>".$data['programe']."</td>";
  echo"</tr>";
  }
echo"</table>";
}
else if(!empty($year)&&!empty($programe)&&empty($department)&&empty($course))
{
  echo"<table style='width:100%'>";
  echo"<tr >";
  echo"<td>Name</td>";
  echo"<td>Roll</td>";
    echo"<td>Course_code</td>";
    echo"<td>Department</td>";
  echo"</tr>";
  $query=$con->query("SELECT * from course_registration where programe like '%$programe%' and year like '%$year%'");
  while($data=$query->fetch_array())
  {
    echo"<tr>";
    echo"<td>".$data['name']."</td>";
    echo"<td>".$data['roll']."</td>";
    echo"<td>".$data['course_code']."</td>";
    echo"<td>".$data['department']."</td>";
  echo"</tr>";
  }
echo"</table>";
}
else if(!empty($year)&&!empty($programe)&&empty($department)&&!empty($course))
{
  echo"<table style='width:100%'>";
  echo"<tr>";
    echo"<td>Name</td>";
    echo"<td>Roll</td>";
    echo"<td>Department</td>";
  echo"</tr>";
  $query=$con->query("SELECT * from course_registration where programe like '%$programe%' and course_code like '%$course_code%' and year like '%$year%'");
  while($data=$query->fetch_array())
  {
    echo"<tr>";
    echo"<td>".$data['name']."</td>";
    echo"<td>".$data['roll']."</td>";
    echo"<td>".$data['department']."</td>";
  echo"</tr>";
  }
echo"</table>";
}
else if(!empty($year)&&!empty($programe)&&!empty($department)&&empty($course))
{
  echo"<table style='width:100%'>";
  echo"<tr >";
   echo"<td>Name</td>";
    echo"<td>Roll</td>";
    echo"<td>Course_code</td>";
  echo"</tr>";
  $query=$con->query("SELECT * from course_registration where programe like '%$programe%' and department like '%$department%' and year like '%$year%'");
  while($data=$query->fetch_array())
  {
    echo"<tr>";
    echo"<td>".$data['name']."</td>";
    echo"<td>".$data['roll']."</td>";
    echo"<td>".$data['course_code']."</td>";
  echo"</tr>";
  }
echo"</table>";
}
else if(!empty($year)&&!empty($programe)&&!empty($department)&&!empty($course))
{
  echo"<table style='width:100%'>";
  echo"<tr>";
    echo"<td>Name</td>";
    echo"<td>Roll</td>";
  echo"</tr>";
  $query=$con->query("SELECT * from course_registration where course_code like '%$course%' and programe like '%$programe%' and department like '%$department%' and year like '%$year%'");
  while($data=$query->fetch_array())
  {
    echo"<tr>";
    echo"<td>".$data['name']."</td>";
    echo"<td>".$data['roll']."</td>";
  echo"</tr>";
  }
echo"</table>";
}
}
else
{
  echo"<br>";
  $query=$con->query("SELECT * from course_registration");
if(!empty($query))
{
     echo"<table style='width:100%'>";
  echo"<tr >";
  echo"<td>Name</td>";
  echo"<td>Roll</td>";
  echo"<td>Course_code</td>";
  echo"<td>Year</td>";
    echo"<td>Department</td>";
    echo"<td>Programe</td>";
  echo"</tr>";
  while($data=$query->fetch_array())
  {
    echo"<tr>";
    echo"<td>.".$data['name']."</td>";
    echo"<td>".$data['roll']."</td>";
    echo"<td>".$data['course_code']."</td>";
    echo"<td>.".$data['year']."</td>";
    echo"<td>".$data['department']."</td>";
    echo"<td>".$data['programe']."</td>";
    echo"</tr>";
  }
echo"</table>";
  }
  else
  {
    echo"no data is present";
  }
}
  ?>
  <footer class="footer">
    <p>Copyrights &copy NIT Puducherry @ 2021</p>
  </footer>
</body>

</html>