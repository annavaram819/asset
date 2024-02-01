<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link rel="icon" href="../asset/images/icon.png">
  <title>PBR Visvodaya Institute of Technology and Science Asset portal</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
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
  $con=mysqli_connect("localhost","root","","asset");
      session_start();
      $name=$_SESSION['name'];
      $password=$_SESSION['password'];
  $_SESSION['name']=$name;
  $_SESSION['password']=$password;
    $sql1=$con->query("SELECT department from login where user like'$name'");
    $data1=$sql1->fetch_array();
   echo "<p class='hod-name'>Welcome HOD-".$data1[0]." <br><br> <a href='password.php'>Reset Password</a><br> <br> <a href='logout.php'>Logout</a> </p>";
    echo"<h1>PBR Visvodaya Institute of Technology and Science</h1>";
    echo"<h2>Asset Management Portal</h2>";
  echo"</div>";
  echo"<ul class='navbar'>";
   echo"<li class='nav-item curriculum'>Home";
      echo"<div class='dropdown-content curriculum-content'>";
        echo"<a href='index1.php'>Home</a>";
      echo"</div>";
    echo"</li>";
     echo"<li class='nav-item curriculum'>Asset View";
      echo"<div class='dropdown-content curriculum-content'>";
        echo"<a href='view.php'>All Assets</a>";
        echo"<a href='view2.php'>Excess Items</a>";
        echo"<a href='view1.php'>Damaged Items</a>";
      echo"</div>";
    echo"</li>";
        echo"<li class='nav-item curriculum'>Asset Add";
      echo"<div class='dropdown-content curriculum-content'>";
        echo"<a href='add.php?department=CSE'>CSE</a>";
        echo"<a href='add.php?department=ECE'>ECE</a>";
        echo"<a href='add.php?department=EEE'>EEE</a>";
        echo"<a href='add.php?department=MECH'>MECH</a>";
        echo"<a href='add.php?department=CIVIL'>CIVIL</a>";
      echo"</div>";
    echo"</li>";
    echo"<li class='nav-item curriculum'>Asset Update";
      echo"<div class='dropdown-content curriculum-content'>";
        echo"<a href='update.php?department=CSE'>CSE</a>";
        echo"<a href='update.php?department=ECE'>ECE</a>";
        echo"<a href='update.php?department=EEE'>EEE</a>";
        echo"<a href='update.php?department=MECH'>MECH</a>";
        echo"<a href='update.php?department=CIVIL'>CIVIL</a>";
      echo"</div>";
    echo"</li>";
    echo"<li class='nav-item curriculum'>Asset Delete";
      echo"<div class='dropdown-content curriculum-content'>";
        echo"<a href='delete.php?department=CSE'>CSE</a>";
        echo"<a href='delete.php?department=ECE'>ECE</a>";
        echo"<a href='delete.php?department=EEE'>EEE</a>";
        echo"<a href='delete.php?department=MECH'>MECH</a>";
        echo"<a href='delete.php?department=CIVIL'>CIVIL</a>";
      echo"</div>";
    echo"</li>";
  echo"</ul>";
$department=$_SESSION['department'];
if(isset($_POST['submit']))
{
  if($_POST['year']==NULL)
  {
    $year="N.A";
  }
  else{
  $year=$_POST['year'];
}
if($_POST['item']==NULL)
  {
    $item="N.A";
  }
  else{
  $item=$_POST['item'];
}
  if($_POST['quantity']==NULL)
  {
    $quantity="N.A";
  }
  else{
  $quantity=$_POST['quantity'];
}
if($_POST['inventory']==NULL)
  {
    $inventory="N.A";
  }
  else{
  $inventory=$_POST['inventory'];
}
  $block=$_POST['block'];
  $floor=$_POST['floor'];
  $room=$_POST['Room'];
  if($_POST['remark']==NULL)
  {
    $remark="N.A";
  }
  else{
  $remark=$_POST['remark'];
}
$sql1=$con->query("SELECT * from asset_details where current_department like '$department'");
$num=mysqli_num_rows($sql1);
$sql2=$con->query("INSERT into asset_details (year,asset_name,inventory_no,quantity,block,floor,room,current_department,remarks) values('$year','$item','$inventory','$quantity','$block','$floor','$room','$department','$remark')");
$sql3=$con->query("SELECT * from asset_details where current_department like '$department'");
$num1=mysqli_num_rows($sql3);
if($num<$num1)
{
  echo"Data added Sucessesfully";
}
else
{
  echo"data is not added kindly check the details once and fill again";
}
}
?>
  <footer class="footer">
    <p>Copyrights &copy PBR Visvodaya Institute of Technology and Science @ 2024</p>
  </footer>
</body>
</html>
