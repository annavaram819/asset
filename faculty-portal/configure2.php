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
  <div class="course-registration-form-div">
    <form class="course-registration-form"  method="post" action="configure2.php">
      <label for="subject">Please enter Subject name here: </label>
      <input type="text" name="subject" value="<?php echo $_POST['subject'] ;?>"><br>
      <label for="upload">Enter no of Assesments: </label>
      <input type="number" name="number"><br>
      <input type="submit" name="submit1" value="Submit">
    </form>
  </div>

<?php
if(isset($_POST['submit']))
{
  $subject=$_POST['subject'];
  $_SESSION['subject']=$subject;
  $num=$_POST['number'];
  $_SESSION['number']=$num;
 $con=mysqli_connect("localhost","kishore","Kishore@016","login");
  $p=$con->query("SHOW TABLE like '%$subject%'");
  if(!empty($p))
  {
    echo "<div class='no-course'>You can't do course configuration again.</div><hr>";
  }
  else
  {
  $i=1;
  if(empty($num))
  {
    echo"<div class='no-course'>Empty values can't be accepted.</div><hr>";
  }
  else
  {
    echo"<div class='course-registration-form-div'>
    <form class='course-registration-form'  method='post' action='configure1.php'>";
  while($i<=$num)
  {
      echo"<label for='upload'>Enter Assesment$i Max marks </label>
      <input type='number' name='number$i'><br><br>";
      $i++;
  }
  echo"<input type='submit' name='submit2' value='Submit'>";
    echo"</form>";
  echo"</div>";
}
}
}
else if(isset($_POST['submit1']))
{
  $subject=$_POST['subject'];
  $_SESSION['subject']=$subject;
  $num=$_POST['number'];
  $_SESSION['number']=$num;
 $con=mysqli_connect("localhost","kishore","Kishore@016","login");
  $p=$con->query("SHOW TABLE like '%$subject%'");
  if(!empty($p))
  {
    echo "<div class='no-course'>You can't do course configuration again</div><hr>";
  }
  else
  {
  $i=1;
  if(empty($num))
  {
    echo"<div class='no-course'>Empty values can't be accepted</div><hr>";
  }
  else
  {
    echo"<div class='course-registration-form-div'>
    <form class='course-registration-form'  method='post' action='configure1.php'>";
  while($i<=$num)
  {
      echo"<label for='upload'>Enter Assesment$i Max marks </label>
      <input type='number' name='number$i'><br><br>";
      $i++;
  }
  echo"<input type='submit' name='submit2' value='Submit'>";
    echo"</form>";
  echo"</div>";
}
}
}
 ?>
  <footer class="footer">
    <p>Copyrights &copy NIT Puducherry @ 2021</p>
  </footer>
</body>
</html>
