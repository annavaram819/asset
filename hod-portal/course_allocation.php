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
      <?php
      session_start();
      $con=mysqli_connect("localhost","kishore","Kishore@016","login");
       $name=$_SESSION['name'];
       $password=$_SESSION['password'];
  $_SESSION['name']=$name;
  $_SESSION['password']=$password;
    $sql1=$con->query("SELECT name,dept from hod where mail like'$name'");
    $data1=$sql1->fetch_array();
    $dept=$data1['dept'];
    $_SESSION['dept']=$dept;
  echo"<div class='main-head'>";
    echo"<img src='../images/icon.png' alt='NITPY' class='main-logo'>";
    echo"<p class='hod-name'>Welcome $data1[0] <br><br> <a href='password.php'>Reset Password</a><br> <br> <a href='logout.php'>Logout</a> </p>";
    echo"<h1>NATIONAL INSTITUTE OF TECHNOLOGY PUDUCHERRY</h1>";
    echo"<h2>HOD Portal</h2>";
 echo" </div>";
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
    echo"<li class='nav-item PAC'>Revoke";
      echo"<div class='dropdown-content PAC-content'>";
        echo"<a href='revoke.php'>Revoke</a>";
      echo"</div>";
    echo"</li>";
  echo"</ul>";
  echo"<h3> File format should be (Course_code,department,programe,faculty_name,faculty_department)</h3>";
  echo"<h3> department :".$dept."</h3>";
  echo"<h3>Status 0 means Grades not submitted ,1 means submitted</h3>";
  ?>
  <hr>
  <div class="course-registration-form-div">
    <form enctype='multipart/form-data' class="course-registration-form"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <label for="upload">Upload: </label>
      <input type="file" name="file"><br>
      <input type="submit" name="submit" value="Submit">
    </form>
  </div>
  <hr>
  <div class="course-registration-form-div">
    <form class="course-registration-form"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <label for='cars'>PROGRAME:</label>
      <input type='text' name='programe'>
      <br><br>
    <label for='cars'>COURSE_CODE:</label>
      <input type='text' name='course_code'><br><br>
      <input type="submit" name="submit1" value="Filter">
    </form>
  </div>
  <?php
  $dept=$_SESSION['dept'];
  if(isset($_POST['submit']))
  {
  $con=mysqli_connect("localhost","kishore","Kishore@016","login");
if($con)
{
  $value='';
 $file=$_FILES['file']['tmp_name'];
 $handle=fopen($file,"r");
 $value1=00;
 while(($cont=fgetcsv($handle)))
 {
  $query1=$con->query("INSERT INTO course_creation (course_code,course_title,department,programe,faculty_name,faculty_department,flag,credits) values ('$cont[0]','$cont[1]','$cont[2]','$cont[3]','$cont[4]','$cont[5]','0','$cont[6]')") ;
}
 fclose($handle);
 $query=$con->query("SELECT * from course_creation where department like '$dept'");
if(!empty($query))
{
     echo"<table style='width:100%'>";
  echo"<tr >";
  echo"<th>Course_code</th>";
    echo"<th>Programe</th>";
    echo"<th>Faculty_name</th>";
    echo"<th>Faculty_department</th>";
    echo"<th>Status</th>";
  echo"</tr>";
  while($data=$query->fetch_array())
  {
    echo"<tr>";
    echo"<td>".$data['course_code']."</td>";
    echo"<td>".$data['programe']."</td>";
    echo"<td>".$data['faculty_name']."</td>";
    echo"<td>".$data['faculty_department']."</td>";
    echo"<td>".$data['flag']."</td>";
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
  $course=$_POST['course_code'];
if(empty($programe)&&empty($course))
{
echo"<table style='width:100%'>";
  echo"<tr>";
    echo"<td>Course_code</td>";
    echo"<td>Programe</td>";
    echo"<td>Faculty_name</td>";
    echo"<td>Faculty_department</td>";
echo"<td>Status</td>";
  echo"</tr>";
  $query=$con->query("SELECT * from course_creation where department like '$dept'");
  while($data=$query->fetch_array())
  {
    echo"<tr>";
    echo"<td>".$data['course_code']."</td>";
    echo"<td>".$data['programe']."</td>";
    echo"<td>".$data['faculty_name']."</td>";
    echo"<td>".$data['faculty_department']."</td>";
    echo"<td>".$data['flag']."</td>";
  echo"</tr>";
  }
echo"</table>";
}
else if(empty($programe)&&!empty($course))
{
  echo"<h3>Faculty is given by course ".$course."</h3>";
  echo"<table style='width:100%'>";
  echo"<tr >";
    echo"<td>Programe</td>";
   echo" <td>Faculty_name</td>";
    echo"<td>Faculty_department</td>";
    echo"<td>Status</td>";
  echo"</tr>";
  $query=$con->query("SELECT * from course_creation where course_code like '%$course%' and department like '$dept'");
  while($data=$query->fetch_array())
  {
    echo"<tr>";
    echo"<td>".$data['programe']."</td>";
    echo"<td>".$data['faculty_name']."</td>";
    echo"<td>".$data['faculty_department']."</td>";
     echo"<td>".$data['flag']."</td>";
  echo"</tr>";
  }
echo"</table>";
}
else if(!empty($programe)&&empty($course))
{
  echo"<h3>List of Faculty for the given programe of ".$programe."</h3>";
  echo"<table style='width:100%'>";
  echo"<tr >";
    echo"<td>Course_code</td>";
    echo"<td>Faculty_name</td>";
    echo"<td>Faculty_department</td>";
    echo"<td>Status</td>";
  echo"</tr>";
  $query=$con->query("SELECT * from course_creation where programe like '%$programe%' and department like '$dept'");
  while($data=$query->fetch_array())
  {
    echo"<tr>";
    echo"<td>".$data['course_code']."</td>";
    echo"<td>".$data['faculty_name']."</td>";
    echo"<td>".$data['faculty_department']."</td>";
     echo"<td>".$data['flag']."</td>";
  echo"</tr>";
  }
echo"</table>";
}
else if(!empty($programe)&&!empty($course))
{
  echo"<h3>Faculty for the given programe of ".$programe." ande  course of ".$course."</h3>";
  echo"<table style='width:100%'>";
  echo"<tr>";
    echo"<td>Faculty_name</td>";
    echo"<td>Faculty_department</td>";
     echo"<td>Status</td>";
  echo"</tr>";
  $query=$con->query("SELECT * from course_creation where programe like '%$programe%' and course_code like '%$course_code%' and department like '$dept'");
  while($data=$query->fetch_array())
  {
    echo"<tr>";
    echo"<td>".$data['faculty_name']."</td>";
    echo"<td>".$data['faculty_department']."</td>";
     echo"<td>".$data['flag']."</td>";
  echo"</tr>";
  }
echo"</table>";
}

}
else
{
  echo"<br>";
  $dept=$_SESSION['dept'];
  $query=$con->query("SELECT * from course_creation where department like '$dept'");
if(!empty($query))
{
     echo"<table style='width:100%'>";
  echo"<tr >";
  echo"<td>Course_code</td>";
    echo"<td>Programe</td>";
    echo"<td>Faculty_name</td>";
    echo"<td>Faculty_department</td>";
         echo"<td>Status</td>";
  echo"</tr>";
  while($data=$query->fetch_array())
  {
    echo"<tr>";
    echo"<td>".$data['course_code']."</td>";
    echo"<td>".$data['programe']."</td>";
    echo"<td>".$data['faculty_name']."</td>";
    echo"<td>".$data['faculty_department']."</td>";
        echo"<td>".$data['flag']."</td>";
    echo"</tr>";
  }
echo"</table>";
  }
  else
  {
    echo"No data is present";
  }
}
  ?>
  <footer class="footer">
    <p>Copyrights &copy NIT Puducherry @ 2021</p>
  </footer>
</body>

</html>
