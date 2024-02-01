<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>PBR Visvodaya Institute of Technology and Science Asset Management</title>
  <link rel="icon" href="../icon.png">
  <link rel="stylesheet" href="../styles.css">
  <script type="text/javascript">
      function preventBack() { window.history.forward(); }
      setTimeout("preventBack()", 0);
      window.onunload = function () { null };
  </script>
</head>

<body>
  <div class="main-head">
    <img src="../icon.png" alt="NITPY" class="main-logo">
  <?php
  session_start();
       $con=mysqli_connect("localhost","root","","asset");
       $name=$_SESSION['user'];
       $password=$_SESSION['password'];
  $_SESSION['name']=$name;
  $_SESSION['password']=$password;
    $sql1=$con->query("SELECT department from login where user like'$name'");
    $data1=$sql1->fetch_array();
   echo "<p class='hod-name'>Welcome HOD-".$data1[0]." <br><br> <a href='password.php'>Reset Password</a><br> <br> <a href='logout.php'>Logout</a> </p>";
    echo"<h1>PBR Visvodaya Institute of Technology and Science</h1>";
    echo"<h2>Excess Assets</h2>";
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
?>
  <table class="assets-view-table">
    <tr>
      <th rowspan="2">S No.</th>
      <th rowspan="2">Asset Description</th>
      <th rowspan="2">Inventory No.</th>
      <th rowspan="2">TotalQuantity</th>
      <th colspan="2">Current Location</th>
      <th rowspan="2">Current Department</th>
    </tr>
    <tr>
      <th>Floor</th>
      <th>Room</th>
    </tr>
  <?php
    $con=mysqli_connect("localhost","root","","asset");
    $sql=$con->query("SELECT * FROM excess_asset");
    if (mysqli_num_rows($sql) > 0)
    {
    $i=1;
    while($data=$sql->fetch_array())
    {
    echo"<tr>";
      echo"<td>".$i."</td>";
      echo"<td>".$data['asset_name']."</td>";
      echo"<td>".$data['inventory_no']."</td>";
      echo"<td>".$data['quantity']."</td>";
      echo"<td>".$data['current_department']."</td>";
      echo"<td>".$data['floor']."</td>";
      echo"<td>".$data['room']."</td>";
    echo"</tr>";
    $i++;
  }
}
    ?>
  </table>
  <form method=post action='asset_print2.php' target='_blank'>
<input type='submit' value='Print'>
</form>
  <footer class="footer">
    <p>Copyrights &copy PBR Visvodaya Institute of Technology and Science @ 2024</p>
  </footer>

</body>

</html>
