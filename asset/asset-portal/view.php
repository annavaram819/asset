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
    echo"<h2>All Assets</h2>";
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
    echo"   <div class='course-registration-form-div'>";
      echo"<form class='course-registration-form'  method='post' action='view.php'>";
        echo"<label for='cars'>DEPARTMENT: </label>";
        echo"<input type='text' name='department'><br><br>";
        echo"<label for='cars'>Item Name:</label>";
          echo"<input type='text' name='item'><br><br>";
      echo"<label for='cars'>Inventory No:</label>";
        echo"<input type='text' name='inventory'><br><br>";
        echo"<input type='submit' name='submit' value='Filter'>";
      echo"</form>";
    echo"</div>";
      if(empty($_POST['inventory'])&&empty($_POST['item'])&&empty($_POST['department']))
      {
        $sql2=$con->query("SELECT * from asset_details");
        echo"<table class='assets-view-table'>
          <tr>
            <th rowspan='2'>S No</th>
            <th rowspan='2'>Asset Description</th>
            <th rowspan='2'>Inventory No.</th>
            <th rowspan='2'>TotalQuantity</th>
            <th colspan='2'>Current Location</th>
            <th rowspan='2'>Current Department</th>
          </tr>
          <tr>
            <th>Floor</th>
            <th>Room</th>
          </tr>";
          $data2=$sql2->fetch_array();
          if($data2!==NULL)
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
          echo"</tr>";
        }
      }
        echo"</table>";
        echo"<form method=post action='asset_print.php' target='_blank'>
      <input type='submit' value='Print'>
      </form>";
      }
      else if(empty($_POST['inventory'])&&empty($_POST['item'])&&!empty($_POST['department']))
      {
        $department=$_POST['department'];
        $sql2=$con->query("SELECT * from asset_details where current_department like '$department'");
        echo"<table class='assets-view-table'>
          <tr>
            <th rowspan='2'>S No</th>
            <th rowspan='2'>Asset Description</th>
            <th rowspan='2'>Inventory No.</th>
            <th rowspan='2'>TotalQuantity</th>
            <th colspan='2'>Current Location</th>
            <th rowspan='2'>Current Department</th>
          </tr>
          <tr>
            <th>Floor</th>
            <th>Room</th>
          </tr>";
          $data2=$sql2->fetch_array();
          if($data2!==NULL)
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
          echo"</tr>";
        }
      }
        echo"</table>";
        echo"<form method=post action='asset_print6.php' target='_blank'>
      <input type='submit' value='Print'>
      </form>";
      }
      else if(empty($_POST['inventory'])&& !empty($_POST['item'])&& empty($_POST['department']))
      {
        $asset=$_POST['item'];
        $_SESSION['item']=$asset;
        $sql2=$con->query("SELECT * from asset_details where  asset_name like '$asset'");
        echo"<table class='assets-view-table'>
          <tr>
            <th rowspan='2'>S No</th>
            <th rowspan='2'>Asset Description</th>
            <th rowspan='2'>Inventory No.</th>
            <th rowspan='2'>TotalQuantity</th>
            <th colspan='2'>Current Location</th>
            <th rowspan='2'>Current Department</th>
          </tr>
          <tr>
            <th>Floor</th>
            <th>Room</th>
          </tr>";
          $data2=$sql2->fetch_array();
          if($data2!==NULL)
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
          echo"</tr>";
        }
              }
        echo"</table>";
        echo"<form method=post action='asset_print3.php' target='_blank'>
      <input type='submit' value='Print'>
      </form>";
      }
      else if(empty($_POST['inventory'])&&!empty($_POST['item'])&&!empty($_POST['department']))
      {
        $item=$_POST['item'];
        $_SESSION['item']=$item;
        $department=$_POST['department'];
        $_SESSION['department']=$department;
        $sql2=$con->query("SELECT * from asset_details where asset_name like '$item' and current_department like '$department'");
        echo"<table class='assets-view-table'>
          <tr>
            <th rowspan='2'>S No</th>
            <th rowspan='2'>Asset Description</th>
            <th rowspan='2'>Inventory No.</th>
            <th rowspan='2'>TotalQuantity</th>
            <th colspan='2'>Current Location</th>
            <th rowspan='2'>Current Department</th>
          </tr>
          <tr>
            <th>Floor</th>
            <th>Room</th>
          </tr>";
          $data2=$sql2->fetch_array();
          if($data2!==NULL)
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
          echo"</tr>";
        }
      }
        echo"</table>";
        echo"<form method=post action='asset_print7.php' target='_blank'>
      <input type='submit' value='Print'>
      </form>";
      }
      else if(!empty($_POST['inventory'])&&empty($_POST['item'])&&empty($_POST['department']))
      {
        $inventory=$_POST['inventory'];
        $_SESSION['inventory']=$inventory;
        $sql2=$con->query("SELECT * from asset_details where inventory_no like '$inventory'");
        echo"<table class='assets-view-table'>
          <tr>
            <th rowspan='2'>S No</th>
            <th rowspan='2'>Asset Description</th>
            <th rowspan='2'>Inventory No.</th>
            <th rowspan='2'>TotalQuantity</th>
            <th colspan='2'>Current Location</th>
            <th rowspan='2'>Current Department</th>
          </tr>
          <tr>
            <th>Floor</th>
            <th>Room</th>
          </tr>";
          $data2=$sql2->fetch_array();
          if($data2!==NULL)
          {
            while($data=$sql2->fetch_array())
            {
              echo "not_null";
              $s_no=$data['s_no'];
            echo"<tr>";
              echo"<td>".$data['s_no']."</td>";
              echo"<td>".$data['asset_name']."</td>";
              echo"<td>".$data['inventory_no']."</td>";
              echo"<td>".$data['quantity']."</td>";
              echo"<td>".$data['floor']."</td>";
              echo"<td>".$data['room']."</td>";
              echo"<td>".$data['current_department']."</td>";
            echo"</tr>";
            }
         }
        echo"</table>";
        echo"<form method=post action='asset_print4.php' target='_blank'>
      <input type='submit' value='Print'>
      </form>";
      }
    else if(!empty($_POST['inventory'])&&empty($_POST['item'])&&!empty($_POST['department']))
      {
        $inventory=$_POST['inventory'];
        $_SESSION['inventory']=$inventory;
        $department=$_POST['department'];
        $_SESSION['department']=$department;
        $sql2=$con->query("SELECT * from asset_details where inventory_no like '$inventory' and current_department like '$department'");
        echo"<table class='assets-view-table'>
          <tr>
            <th rowspan='2'>S No</th>
            <th rowspan='2'>Asset Description</th>
            <th rowspan='2'>Inventory No.</th>
            <th rowspan='2'>TotalQuantity</th>
            <th colspan='2'>Current Location</th>
            <th rowspan='2'>Current Department</th>
          </tr>
          <tr>
            <th>Floor</th>
            <th>Room</th>
          </tr>";
          $data2=$sql2->fetch_array();
          if($data2!==NULL)
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
          echo"</tr>";
        }
      }
        echo"</table>";
        echo"<form method=post action='asset_print9.php' target='_blank'>
      <input type='submit' value='Print'>
      </form>";
      }
      else if(!empty($_POST['inventory'])&& !empty($_POST['item'])&&empty($_POST['department']))
      {
        $asset=$_POST['item'];
        $inventory=$_POST['inventory'];
        $_SESSION['inventory']=$inventory;
        $_SESSION['item']=$asset;
        $sql2=$con->query("SELECT * from asset_details where asset_name like '$asset' and inventory_no like '$inventory'");
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
          $data2=$sql2->fetch_array();
          if($data2!==NULL)
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
          echo"</tr>";
        }
      }
        echo"</table>";
        echo"<form method=post action='asset_print5.php' target='_blank'>
      <input type='submit' value='Print'>
      </form>";
      }
    else if(!empty($_POST['inventory'])&&!empty($_POST['item'])&&!empty($_POST['department']))
      {
        $asset=$_POST['item'];
        $inventory=$_POST['inventory'];
        $_SESSION['inventory']=$inventory;
        $_SESSION['item']=$asset;
        $department=$_POST['department'];
        $_SESSION['department']=$department;
        $sql2=$con->query("SELECT * from asset_details where asset_name like '$asset' and inventory_no like '$inventory' and current_department like '$department'");
        echo"<table class='assets-view-table'>
          <tr>
            <th rowspan='2'>S No</th>
            <th rowspan='2'>Asset Description</th>
            <th rowspan='2'>Inventory No.</th>
            <th rowspan='2'>TotalQuantity</th>
            <th colspan='2'>Current Location</th>
            <th rowspan='2'>Current Department</th>
          </tr>
          <tr>
            <th>Floor</th>
            <th>Room</th>
          </tr>";
          $data2=$sql2->fetch_array();
          if($data2!==NULL)
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
          echo"</tr>";
        }
      }
        echo"</table>";
        echo"<form method=post action='asset_print8.php' target='_blank'>
      <input type='submit' value='Print'>
      </form>";
      }
    }
    else
     {
       echo"   <div class='course-registration-form-div'>";
         echo"<form class='course-registration-form'  method='post' action='view.php'>";
           echo"<label for='cars'>DEPARTMENT:  </label>";
           echo"<input type='text' name='department'><br><br>";
           echo"<label for='cars'>Item Name:</label>";
             echo"<input type='text' name='item'><br><br>";
         echo"<label for='cars'>Inventory No:</label>";
           echo"<input type='text' name='inventory'><br><br>";
           echo"<input type='submit' name='submit' value='Filter'>";
         echo"</form>";
       echo"</div>";
  echo"<table class='assets-view-table'>
    <tr>
      <th rowspan='2'>S No.</th>
      <th rowspan='2'>Asset Description</th>
      <th rowspan='2'>Inventory No.</th>
      <th rowspan='2'>TotalQuantity</th>
      <th colspan='2'>Current Location</th>
      <th rowspan='2'>Current Department</th>
    </tr>
    <tr>
      <th>Floor</th>
      <th>Room</th>
    </tr>";
    $con=mysqli_connect("localhost","root","","asset");
    $sql=$con->query("SELECT * FROM asset_details");
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
      echo"<td>".$data['floor']."</td>";
      echo"<td>".$data['room']."</td>";
      echo"<td>".$data['current_department']."</td>";
    echo"</tr>";
    $i++;
  }
}
  echo"</table>
  <form method=post action='asset_print.php' target='_blank'>
<input type='submit' value='Print'>
</form>";
}
?>
  <footer class="footer">
    <p>Copyrights &copy PBR Visvodaya Institute of Technology and Science @ 2024</p>
  </footer>
</body>
</html>
