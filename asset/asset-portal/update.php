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
  if(isset($_POST['submit']))
  {
    $department=$_SESSION['department'];
    $_SESSION['department']=$department;
    echo"   <div class='course-registration-form-div'>";
      echo"<form class='course-registration-form'  method='post' action='update.php'>";
        echo"<label for='cars'>DEPARTMENT:  ".$department."</label>";
        echo"<br><br>";
        echo"<label for='cars'>Item Name:</label>";
          echo"<input type='text' name='item'><br><br>";
      echo"<label for='cars'>Inventory No:</label>";
        echo"<input type='text' name='inventory'><br><br>";
        echo"<input type='submit' name='submit' value='Filter'>";
      echo"</form>";
    echo"</div>";
      if(empty($_POST['inventory'])&&empty($_POST['item']))
      {
        $sql2=$con->query("SELECT * from asset_details where current_department like '$department'");
        echo"<table class='assets-view-table'>
          <tr>
            <th rowspan='2'>S No</th>
            <th rowspan='2'>Asset Description</th>
            <th rowspan='2'>Inventory No.</th>
            <th rowspan='2'>TotalQuantity</th>
            <th colspan='2'>Current Location</th>
            <th rowspan='2'>Current Department</th>
            <th rowspan='2'></th>
          </tr>
          <tr>
            <th>Floor</th>
            <th>Room</th>
          </tr>";
          if (mysqli_num_rows($sql2) > 0)
          {
          while($data=$sql2->fetch_array())
          {
            $s_no=$data['s_no'];
          echo"<tr>";
            echo"<td>".$data['s_no']."</td>";
            echo"<td>".$data['asset_name']."</td>";
            echo"<td>".$data['inventory_no']."</td>";
            echo"<td>".$data['quantity']."</td>";
            echo"<td>".$data['floor']."</td>";
            echo"<td>".$data['room']."</td>";
            echo"<td>".$data['current_department']."</td>";
            echo"<td><a href='update1.php?s_no=$s_no'>
  <button>Update</button>
</a></td>";
          echo"</tr>";
        }
      }
        echo"</table>";
      }
      else if(empty($_POST['inventory'])&& !empty($_POST['item']))
      {
        $asset=$_POST['item'];
        $sql2=$con->query("SELECT * from asset_details where current_department like '$department' and asset_name like '$asset'");
        echo"<table class='assets-view-table'>
          <tr>
            <th rowspan='2'>S No</th>
            <th rowspan='2'>Asset Description</th>
            <th rowspan='2'>Inventory No.</th>
            <th rowspan='2'>TotalQuantity</th>
            <th colspan='2'>Current Location</th>
            <th rowspan='2'>Current Department</th>
            <th rowspan='2'></th>
          </tr>
          <tr>
            <th>Floor</th>
            <th>Room</th>
          </tr>";
          while($data=$sql2->fetch_array())
          {
            $s_no=$data['s_no'];
          echo"<tr>";
            echo"<td>".$data['s_no']."</td>";
            echo"<td>".$data['asset_name']."</td>";
            echo"<td>".$data['inventory_no']."</td>";
            echo"<td>".$data['quantity']."</td>";
            echo"<td>".$data['floor']."</td>";
            echo"<td>".$data['room']."</td>";
            echo"<td>".$data['current_department']."</td>";
            echo"<td><a href='update1.php?s_no=$s_no'>
  <button>Update</button>
</a></td>";
          echo"</tr>";
        }
        echo"</table>";
      }
      else if(!empty($_POST['inventory'])&&empty($_POST['item']))
      {
        $asset=$_POST['inventory'];
        $sql2=$con->query("SELECT * from asset_details where current_department like '$department' and inventory_no like '$asset'");
        echo"<table class='assets-view-table'>
          <tr>
            <th rowspan='2'>S No</th>
            <th rowspan='2'>Asset Description</th>
            <th rowspan='2'>Inventory No.</th>
            <th rowspan='2'>TotalQuantity</th>
            <th colspan='2'>Current Location</th>
            <th rowspan='2'>Current Department</th>
            <th rowspan='2'></th>
          </tr>
          <tr>
            <th>Floor</th>
            <th>Room</th>
          </tr>";
          while($data=$sql2->fetch_array())
          {
            $s_no=$data['s_no'];
          echo"<tr>";
            echo"<td>".$data['s_no']."</td>";
            echo"<td>".$data['asset_name']."</td>";
            echo"<td>".$data['inventory_no']."</td>";
            echo"<td>".$data['quantity']."</td>";
            echo"<td>".$data['floor']."</td>";
            echo"<td>".$data['room']."</td>";
            echo"<td>".$data['current_department']."</td>";
            echo"<td><a href='update1.php?s_no=$s_no'>
  <button>Update</button>
</a></td>";
          echo"</tr>";
        }
        echo"</table>";
      }
      else if(!empty($_POST['inventory'])&& !empty($_POST['item']))
      {
        $asset=$_POST['item'];
        $inventory=$_POST['inventory'];
        $sql2=$con->query("SELECT * from asset_details where current_department like '$department' and asset_name like '$asset' and inventory_no like '$inventory'");
        echo"<table class='assets-view-table'>
          <tr>
            <th rowspan='2'>S No</th>
            <th rowspan='2'>Asset Description</th>
            <th rowspan='2'>Inventory No.</th>
            <th rowspan='2'>TotalQuantity</th>
            <th colspan='2'>Current Location</th>
            <th rowspan='2'>Current Department</th>
            <th rowspan='2'></th>
          </tr>
          <tr>
            <th>Floor</th>
            <th>Room</th>
          </tr>";
          while($data=$sql2->fetch_array())
          {
            $s_no=$data['s_no'];
          echo"<tr>";
            echo"<td>".$data['s_no']."</td>";
            echo"<td>".$data['asset_name']."</td>";
            echo"<td>".$data['inventory_no']."</td>";
            echo"<td>".$data['quantity']."</td>";
            echo"<td>".$data['floor']."</td>";
            echo"<td>".$data['room']."</td>";
            echo"<td>".$data['current_department']."</td>";
            echo"<td><a href='update1.php?s_no=$s_no'>
  <button>Update</button>
</a></td>";
          echo"</tr>";
        }
        echo"</table>";
      }
    }
  else {
  $department=$_GET['department'];
  $_SESSION['department']=$department;
  echo"   <div class='course-registration-form-div'>";
    echo"<form class='course-registration-form'  method='post' action='update.php'>";
      echo"<label for='cars'>DEPARTMENT:  ".$department."</label>";
      echo"<br><br>";
      echo"<label for='cars'>Item Name:</label>";
        echo"<input type='text' name='item'><br><br>";
    echo"<label for='cars'>Inventory No:</label>";
      echo"<input type='text' name='inventory'><br><br>";
      echo"<input type='submit' name='submit' value='Filter'>";
    echo"</form>";
  echo"</div>";
  $sql2=$con->query("SELECT * from asset_details where current_department like '$department'");
  echo"<table class='assets-view-table'>
    <tr>
      <th rowspan='2'>S No</th>
      <th rowspan='2'>Asset Description</th>
      <th rowspan='2'>Inventory No.</th>
      <th rowspan='2'>TotalQuantity</th>
      <th colspan='2'>Current Location</th>
      <th rowspan='2'>Current Department</th>
      <th rowspan='2'></th>
    </tr>
    <tr>
      <th>Floor</th>
      <th>Room</th>
    </tr>";
    while($data=$sql2->fetch_array())
    {
      $s_no=$data['s_no'];
    echo"<tr>";
      echo"<td>".$data['s_no']."</td>";
      echo"<td>".$data['asset_name']."</td>";
      echo"<td>".$data['inventory_no']."</td>";
      echo"<td>".$data['quantity']."</td>";
      echo"<td>".$data['floor']."</td>";
      echo"<td>".$data['room']."</td>";
      echo"<td>".$data['current_department']."</td>";
      echo"<td><a href='update1.php?s_no=$s_no'>
<button>Update</button>
</a></td>";
    echo"</tr>";
  }
  echo"</table>";
}
?>
  <footer class="footer">
    <p>Copyrights &copy PBR Visvodaya Institute of Technology and Science @ 2024</p>
  </footer>
</body>
</html>
