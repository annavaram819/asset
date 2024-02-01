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
  $s_no=$_GET['s_no'];
  $_SESSION['s_no']=$s_no;
  $sql=$con->query("SELECT * FROM asset_details where s_no like '$s_no'");
  $data=$sql->fetch_array();
  $s_no=$data['s_no'];
  $_SESSION['s_no']=$s_no;
  $name=$data['asset_name'];
  $year=$data['year'];
  $inventory=$data['inventory_no'];
  $quantity=$data['quantity'];
  $block=$data['block'];
  $floor=$data['floor'];
  $room=$data['room'];
  $remark=$data['remarks'];
  $department=$data['current_department'];
  echo" <div class='login-form-div'>
      <form class='login-form' method='post' action='update2.php'>
      <label for='cars'>S_NO: </label>
      <input type='text' name='item' value='$s_no'><br><br>
        <label for='cars'>Name Of Item:</label>
        <input type='text' name='item' value='$name'><br><br>
        <label for='cars'>Year Of Purchase:</label>
        <input type='year' name='year' value='$year'><br><br>
        <label for='cars'>Quantity:</label>
        <input type='number' name='quantity' value='$quantity'><br><br>
        <label for='cars'>Inventory No:</label>
        <input type='text' name='inventory' value='$inventory'><br><br>
        <label for='cars'>Department:</label>
        <input type='text' name='department' value='$department'><br><br>
        <label for='cars'>Block:</label>
        <input type='text' name='block' value='$block'><br><br>
        <label for='cars'>Floor:</label>
        <input type='text' name='floor' value='$floor'><br><br>
        <label for='cars'>Room:</label>
        <input type='text' name='Room' value='$room'><br><br>
        <label for=cars'>Remarks:</label>
        <input type='text' name='remark' value='$remark'><br><br>
        <input type='submit' value='Update' name='submit'>
      </form>
      </div>";
?>
  <footer class="footer">
    <p>Copyrights &copy PBR Visvodaya Institute of Technology and Science @ 2024</p>
  </footer>
</body>
</html>
