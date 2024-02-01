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
echo"<form class='login-form' method='post' action='registration1.php'>
      <label for='login_category'>Select Batch:</label>
      <select name='login_category[]'>
        <option value='2018-2022'>2018-2022</option>
      </select><br><br>
      <label for='login_category'>Select Semester:</label>
      <select name='login_category1[]'>
        <option value='1'>1</option>
        <option value='2'>2</option>
        <option value='3'>3</option>
        <option value='4'>4</option>
        <option value='5'>5</option>
        <option value='6'>6</option>
        <option value='7'>7</option>
        <option value='8'>8</option>
      </select><br><br>
      <input type='submit' value='Enable' name='submit'>
    </form>";
 ?>
  <footer class="footer">
    <p>Copyrights &copy NIT Puducherry @ 2021</p>
  </footer>
</body>
</html>