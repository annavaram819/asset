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
  $con=mysqli_connect("localhost","kishore","Kishore@016","login");
    $sql1=$con->query("SELECT name,dept FROM hod where mail like'%$name%'");
    $data1=$sql1->fetch_array();
    echo"<p class='hod-name'>Welcome $data1[0] <br> <a href='password.php'>Reset Password</a> <br> <a href='logout.php'>Logout</a> </p>";

    echo"<h1>NATIONAL INSTITUTE OF TECHNOLOGY PUDUCHERRY</h1>";
    echo"<h2>HOD Course registration Portal</h2>";
  echo"</div>";
  echo"<ul class='navbar'>";
   echo"<li class='nav-item curriculum'>Home";
      echo"<div class='dropdown-content curriculum-content'>";
        echo"<a href='index1.php'>Home</a>";
      echo"</div>";
    echo"</li>";
    echo"<li class='nav-item curriculum'>Curriculum";
      echo"<div class='dropdown-content curriculum-content'>";
        echo"<a href='#'>Add/Update</a>";
        echo"<a href='#'>Delete</a>";
        echo"<a href='#'>View</a>";
      echo"</div>";
    echo"</li>";

    echo"<li class='nav-item faculty'>Faculty";
      echo"<div class='dropdown-content faculty-content'>";
        echo"<a href='faculty_add.html'>Add/Update</a>";
        echo"<a href='faculty_delete.html'>Delete/View</a>";
      echo"</div>";
    echo"</li>";
    echo"<li class='nav-item specialization'>Programs and Specialization";
      echo"<div class='dropdown-content specialization-content'>";
        echo"<a href='#'>Add/Update</a>";
        echo"<a href='#'>Delete</a>";
        echo"<a href='#'>View</a>";
      echo"</div>";
    echo"</li>";
    echo"<li class='nav-item semester'>Semester";
      echo"<div class='dropdown-content semester-content'>";
        echo"<a href='#'>Add</a>";
        echo"<a href='#'>Configure</a>";
        echo"<a href='#'>Delete</a>";
        echo"<a href='#'>View</a>";
      echo"</div>";
    echo"</li>";
    echo"<li class='nav-item registration'>Course Registration";
      echo"<div class='dropdown-content registration-content'>";
        echo"<a href='disable.php'>Disable</a>";
        echo"<a href='#'>View</a>";
      echo"</div>";
    echo"</li>";
    echo"<li class='nav-item gradesheet'>Gradesheet";
      echo"<div class='dropdown-content gradesheet-content'>";
        echo"<a href='#'>View</a>";
        echo"<a href='#'>Revoke</a>";
        echo"<a href='#'>Print</a>";
      echo"</div>";
    echo"</li>";
    echo"<li class='nav-item PAC'>PAC Sheet";
      echo"<div class='dropdown-content PAC-content'>";
        echo"<a href='PAC_sheet.html'>View</a>";
        echo"<a href='#'>Submit</a>";
        echo"<a href='#'>Print</a>";
      echo"</div>";
    echo"</li>";
 echo"</ul>";
 ?>
 <?php
if($_SERVER["REQUEST_METHOD"] == "POST")
 {
 if(empty($_POST['login_category'])||empty($_POST['login_category1']))
{
  header("location:registration.php");
}
else
{
  $batch=$_POST['login_category'];
  $sem=$_POST['login_category1'];
  $con1=mysqli_connect("localhost","kishore","Kishore@016","$batch[0]");
  $sql2=$con1->query(" SELECT id from $data1[1] where semester like '%$sem[0]%'");
  $data2=$sql2->fetch_array();
  if($data2[0]==0)
  {
    $sql3=$con1->query("UPDATE $data1[1] set id='1' where semester like '%$sem[0]%'");
    if($sql3)
    {
      echo"Course registration enabled for the semester $sem[0] of the department $data1[1]";
    }
  }
  else
  {
    echo"Course registration  cannot enabled for the semester $sem[0] of the department $data1[1] due to already enabled";
  }
}
}
?>
  <footer class="footer">
    <p>Copyrights &copy NIT Puducherry @ 2021</p>
  </footer>
</body>
</html>