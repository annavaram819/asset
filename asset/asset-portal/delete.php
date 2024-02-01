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
  if(isset($_POST['but_delete']))
  {
         $department=$_SESSION['department'];
         $_SESSION['department']=$department;
  }
  else {
  $department=$_GET['department'];
  $_SESSION['department']=$department;
}
  ?>
<div class='container'>

  <!-- Form -->
  <form method='post' action='delete1.php'>
    <input type='submit' value='Delete All' name='delete1'><br><br>
  </form>
  <form method='post' action='delete.php'>
    <input type='submit' value='Delete' name='but_delete'><br><br>

    <!-- Record list -->
    <table border='1' id='recordsTable' style='border-collapse: collapse;' >
      <tr style='background: whitesmoke;'>
        <th>S_No</th>
        <th>Year</th>
        <th>Asset Name</th>
        <th>Quantity</th>
        <th>Inventory No</th>
        <th>Block</th>
        <th>Floor</th>
        <th>Room</th>
        <th>Remarks</th>
        <th>Select</th>
     </tr>

     <?php
     $query = "SELECT * FROM asset_details where current_department like '$department'";
     $result = mysqli_query($con,$query);
     while($row = mysqli_fetch_array($result) ){
       $id = $row['s_no'];
        $year = $row['year'];
        $asset = $row['asset_name'];
        $quantity = $row['quantity'];
        $inventory = $row['inventory_no'];
        $block = $row['block'];
        $floor = $row['floor'];
        $room = $row['room'];
        $remarks = $row['remarks'];
     ?>
     <tr id='tr_<?= $id ?>'>
       <td><?= $id ?></td>
         <td><?= $year ?></td>
        <td><?= $asset ?></td>
        <td><?= $quantity ?></td>
        <td><?= $inventory ?></td>
        <td><?= $block ?></td>
        <td><?= $floor ?></td>
        <td><?= $room ?></td>
        <td><?= $remarks ?></td>

        <!-- Checkbox -->
        <td><input type='checkbox' name='delete[]' value='<?= $id ?>' ></td>

    </tr>
    <?php
    }
    ?>
   </table>
 </form>
</div>
<?php
if(isset($_POST['but_delete'])){

  if(isset($_POST['delete'])){
    foreach($_POST['delete'] as $deleteid){
$sql2=$con->query("DELETE FROM asset_details where s_no like '$deleteid'");
    }
  }

}
 ?>
  <footer class="footer">
    <p>Copyrights &copy PBR Visvodaya Institute of Technology and Science @ 2024</p>
  </footer>
</body>
</html>