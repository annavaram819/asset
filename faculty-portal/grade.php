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
  $name=$_SESSION['user'];
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
  <?php
  $subject=$_GET['subject'];
  $_SESSION['subject']=$subject;
  $sql=$con->query("SELECT flag from course_creation where course_code like '$subject'");
  $data=$sql->fetch_array();
  if($data['flag']==1)
  {
    echo"<table>";
    echo"<tr>";
    echo"<th>Grade</th>";
echo"<th>From</th>";
       echo"    <th>To</th>";
        echo" </tr>";
        $sql2=$con->query("SELECT* FROM ".$subject."configure");
        while($data2=$sql2->fetch_array())
        {
          echo"    <tr>";
       echo"    <th>".$data2['grade']."</th>";
        echo"   <th>".$data2['mfrom']."</th>";
       echo"    <th>".$data2['mto']."</th>";
        echo" </tr>";
        }
        echo "</table";
  }
  else
  {
  $sql=$con->query("SELECT 1 FROM ".$subject."");
  if($sql==false)
  {
    echo"<div class='no-course'>You have to configure the course first</div><hr>";
    echo"<br>";
  }
  else
  {
  $sql1=$con->query("CREATE TABLE ".$subject."configure (grade varchar(255) primary key,mfrom int(255),mto int(10),flag int(10))");
  $sql2=$con->query("ALTER TABLE ".$subject."configure ALTER mfrom SET DEFAULT '0',alter mto set default '0',alter flag set default '0'");
  $sql3=$con->query("INSERT into ".$subject."configure (grade) values ('S')");
  $sql3=$con->query("INSERT into ".$subject."configure (grade) values ('A')");
  $sql3=$con->query("INSERT into ".$subject."configure (grade) values ('B')");
  $sql3=$con->query("INSERT into ".$subject."configure (grade) values ('C')");
  $sql3=$con->query("INSERT into ".$subject."configure (grade) values ('D')");
  $sql3=$con->query("INSERT into ".$subject."configure (grade) values ('E')");
  echo" <div class='grade-configuration-table-form-div'>";
   echo"  <form class='grade-configuration-table-form' method='post' action='grade1.php'>";
    echo"   <table class='grade-configuration-table'>";
     echo"    <tr>";
       echo"    <th>Grade</th>";
        echo"   <th>From</th>";
       echo"    <th>To</th>";
        echo" </tr>";
       echo"  <tr>";
        echo"   <td>S</td>";
        $sql3=$con->query("SELECT mfrom,mto FROM ".$subject."configure WHERE grade ='S' ");
        $data=$sql3->fetch_array();
        echo"<td><input type='number' name='S-grade-from' value=".$data['mfrom']."></td>";
        echo"<td><input type='number' name='S-grade-to' value=".$data['mto']."></td>";
        echo" </tr>";
        echo"  <tr>";
        echo"   <td>A</td>";
        $sql3=$con->query("SELECT mfrom,mto FROM ".$subject."configure where grade ='A'");
        $data=$sql3->fetch_array();
        echo"   <td><input type='number' name='A-grade-from' value=".$data['mfrom']."></td>";
        echo"   <td><input type='number' name='A-grade-to'value=".$data['mto']."></td>";
        echo" </tr>";
        echo" <tr>";
        echo"   <td>B</td>";
        $sql3=$con->query("SELECT mfrom,mto FROM ".$subject."configure where grade ='B'");
        $data=$sql3->fetch_array();
         echo"  <td><input type='number' name='B-grade-from' value=".$data['mfrom']."></td>";
         echo"  <td><input type='number' name='B-grade-to'value=".$data['mto']."></td>";
        echo" </tr>";
        echo" <tr>";
         echo"  <td>C</td>";
               $sql3=$con->query("SELECT mfrom,mto FROM ".$subject."configure where grade ='C'");
        $data=$sql3->fetch_array();
           echo"<td><input type='number' name='C-grade-from'value=".$data['mfrom']."></td>";
          echo" <td><input type='number' name='C-grade-to'value=".$data['mto']."></td>";
       echo"  </tr>";
       echo"  <tr>";
      echo"     <td>D</td>";
            $sql3=$con->query("SELECT mfrom,mto FROM ".$subject."configure where grade ='D'");
        $data=$sql3->fetch_array();
       echo"    <td><input type='number' name='D-grade-from'value=".$data['mfrom']."></td>";
       echo"    <td><input type='number' name='D-grade-to'value=".$data['mto']."></td>";
      echo"   </tr>";
        echo" <tr>";
          echo" <td>E</td>";
                $sql3=$con->query("SELECT mfrom,mto FROM ".$subject."configure where grade ='E'");
        $data=$sql3->fetch_array();
        echo"   <td><input type='number' name='E-grade-from'value=".$data['mfrom']."></td>";
        echo"   <td><input type='number' name='E-grade-to'value=".$data['mto']."></td>";
       echo"  </tr>";
    echo"   </table>";
      echo" <input type='submit'>";
     echo"</form>";
  echo"</div>";
}
}
  ?>
  <footer class="footer">
    <p>Copyrights &copy NIT Puducherry @ 2021</p>
  </footer>
</body>

</html>
