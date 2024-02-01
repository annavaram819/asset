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
  echo"Adding Assets to the ".$department."";
?>
<h3> File format should be (Year,Asset_Name,Quantity,Inventory_No,Block,Floor,Room,Remark)</h3>
  <div class="course-registration-form-div">
    <form enctype='multipart/form-data' class="course-registration-form"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <label for="upload">Upload: </label>
      <input type="file" name="file"><br>
      <input type="submit" name="submit" value="Submit">
    </form>
  </div>
  <?php
  if(isset($_POST['submit']))
  {
  $con=mysqli_connect("localhost","root","","asset");
if($con)
{
 $file=$_FILES['file']['tmp_name'];
 $handle=fopen($file,"r");
 while(($cont=fgetcsv($handle)))
 {
  $query1=$con->query("INSERT INTO asset_details (year,asset_name,quantity,inventory_no,block,floor,room,current_department,remarks) values ('$cont[0]','$cont[1]','$cont[2]','$cont[3]','$cont[4]','$cont[5]','$cont[6]','$department','$cont[7]')") ;
}
 fclose($handle);
 $query=$con->query("SELECT * from asset_details where current_department like '$department'");
if(!empty($query))
{
     echo"<table style='width:100%'>";
  echo"<tr >";
  echo"<td>Year Of Purchase</td>";
    echo"<td>Asset Details</td>";
    echo"<td>Quantity</td>";
    echo"<td>Inventory No</td>";
    echo"<td>Block</td>";
    echo"<td>Floor</td>";
    echo"<td>Room</td>";
    echo"<td>Department</td>";
    echo"<td>Remarks</td>";
  echo"</tr>";
  while($data=$query->fetch_array())
  {
    echo"<tr>";
    echo"<td>".$data['year']."</td>";
    echo"<td>".$data['asset_name']."</td>";
    echo"<td>".$data['quantity']."</td>";
    echo"<td>".$data['inventory_no']."</td>";
    echo"<td>".$data['block']."</td>";
    echo"<td>".$data['floor']."</td>";
    echo"<td>".$data['room']."</td>";
    echo"<td>".$data['current_department']."</td>";
    echo"<td>".$data['remarks']."</td>";
    echo"</tr>";
  }
echo"</table>";
  }
}
else{
  echo"connection failed";
}
}
?>
  <footer class="footer">
    <p>Copyrights &copy PBR Visvodaya Institute of Technology and Science @ 2024</p>
  </footer>
</body>
</html>
