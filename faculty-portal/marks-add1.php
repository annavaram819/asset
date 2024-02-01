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
  $subject=$_SESSION['subject'];
$con=mysqli_connect("localhost","kishore","Kishore@016","login");
  $p=$con->query("SELECT 1 FROM $subject");
  if($p==false)
  {
    echo"<div class='no-course'>You have to configure the course first</div><hr>";
    echo"<br>";
  }
  else
  {
    $sql2=$con->query("SELECT count(column_name)as count from information_schema.columns WHERE table_name like '$subject'");
    $data2=$sql2->fetch_array();
    $j=($data2[0]-4)/2;
    $_SESSION['p']=$j;
    for($k=1;$k<=$j;$k++)
    {
      echo"ASSESMENT$k ASSIGNED MARKS ARE ";
      $sql=$con->query("SELECT DISTINCT assesment".$k."marks FROM $subject ");
      $data=$sql->fetch_array();
      echo$data[0];
      echo"<br>";
    }
  echo"<h3> Adding marks for the course $subject </h3>";
  echo"<div class='select-assessment-form-div'>";
   echo" <form class='select-assessment-form' action='marks-add1.php' method='post'>";
      echo"<label for='assessment'>Choose Assessment: </label>";
      echo"<select name='assessment'>";
    for($k=1;$k<=$j;$k++)
      {
       echo" <option value='assesment".$k."'>Assessment $k</option>";
     }
            echo"  </select><br><br>";
     echo" <input type='submit' name='submit' value='Submit'>";
  echo"  </form>";
 echo" </div>";
}
 ?>
<?php
if(isset($_POST['submit']))
{
  $assesment=$_POST['assessment'];
  $_SESSION['assesment']=$assesment;
  $q=$_SESSION['p'];
  $con=mysqli_connect("localhost","kishore","Kishore@016","login");
  $subject=$_SESSION['subject'];
  $_SESSION['subject']=$subject;
  echo"<h3>";
 echo"".$assesment." Marks are shown here ";
  echo"</h3>";
  $sql=$con->query("SELECT flag from course_creation where course_code like '$subject'");
  $data=$sql->fetch_array();
  if($data['flag']==1)
  {
    echo"<table class='marks-add-table'>";
echo"<tr>";
     echo"   <th>Roll No</th>";
    echo"    <th>Marks</th>";
    echo"  </tr>";
    $sql2=$con->query("SELECT count(column_name)as count from information_schema.columns WHERE table_name like '$subject'");
    $data2=$sql2->fetch_array();
    $j=($data2[0]-4)/2;
    $sql=$con->query("SELECT DISTINCT roll FROM $subject order by roll ");
    $i=0;
    while($data=$sql->fetch_array())
    {
    echo"  <tr>";
    echo" <td>";
     echo $data['roll'];
    echo"</td>";
    $roll=$data['roll'];
    $sql1=$con->query("SELECT $assesment from $subject where roll like  '$roll'");
    $data1=$sql1->fetch_array();
      echo"<td>".$data1[$assesment]."</td>";
    echo"  </tr>";
    $i++;
}
    echo"</table>";
  }
  else
  {
 echo" <form class='marks-add-table-form' method='post'action='marks-add1.php' >";
    echo"<table class='marks-add-table'>";
      echo"<tr>";
     echo"   <th>Roll No</th>";
    echo"   <th>Status</th>";
    echo"    <th>Marks</th>";
    echo"  </tr>";
    $sql2=$con->query("SELECT count(column_name)as count from information_schema.columns WHERE table_name like '$subject'");
    $data2=$sql2->fetch_array();
    $j=($data2[0]-4)/2;
    if($assesment=='assesment'.$q.'')
    {
    $sql=$con->query("SELECT DISTINCT roll FROM $subject order by roll ");
    $i=0;
    while($data=$sql->fetch_array())
    {
    echo"  <tr>";
    echo" <td>";
     echo $data['roll'];
    echo"</td>";
    $roll=$data['roll'];
    echo"<td> <select name='status".$i."'>";
         echo" <option  value='Pass'>Pass</option>";
    echo"  <option  value='Fail'> Fail</option>";
    echo"  <option  value='Z'> Z</option>";
    echo"  <option  value='U'> U</option>";
    echo"  <option  value='W'>W</option>";
    echo"  </select> </td>";
    $sql1=$con->query("SELECT $assesment from $subject where roll like  '$roll'");
    $data1=$sql1->fetch_array();
      echo"<td> <input type='number' name='marks".$i."' value=".$data1[$assesment]." ></td>";
    echo"  </tr>";
    $i++;
}

}
  else
  {

     $sql=$con->query("SELECT DISTINCT roll FROM $subject order by roll ");
    $i=0;
    while($data=$sql->fetch_array())
    {
    echo"  <tr>";
    echo" <td>";
     echo $data['roll'];
    echo"</td>";
    $roll=$data['roll'];
    echo"<td> <select name='status".$i."'>";
         echo" <option  value='Present'>Present</option>";
    echo"  <option  value='Absent'> Absent</option>";
    echo"  </select> </td>";
    $sql1=$con->query("SELECT $assesment from $subject where roll like  '$roll'");
    $data1=$sql1->fetch_array();
      echo"<td> <input type='number' name='marks".$i."' value=".$data1[$assesment]." ></td>";
    echo"  </tr>";
    $i++;
  }
}
   echo" </table>";
    echo"  </select><br><br>";
     echo" <input type='submit' name='submit1' value='Submit'>";
  echo"</form>";
}
}
?>
<?php
if(isset($_POST['submit1']))
{
  $con=mysqli_connect("localhost","kishore","Kishore@016","login");
  $assesment=$_SESSION['assesment'];
  $subject=$_SESSION['subject'];
  $sql=$con->query("SELECT DISTINCT roll FROM $subject order by roll ");
    $i=0;
    while($data=$sql->fetch_array())
    {
      $roll=$data['roll'];
    $mark=$_POST['marks'.$i.''];
    $status=$_POST['status'.$i.''];
    if($status=='Present')
    {
    $sql1=$con->query("UPDATE $subject SET $assesment=$mark where roll like '$roll'");
    }
    else if($status=='Absent')
    {
    $sql1=$con->query("UPDATE $subject SET $assesment='0' where roll like '$roll'");
    }
    else if($status=='Pass')
    {
    $sql1=$con->query("UPDATE $subject SET $assesment='$mark' where roll like '$roll'");
    }
    else if($status=='Fail')
    {
    $sql1=$con->query("UPDATE $subject SET grade='F' where roll like '$roll'");
        $sql1=$con->query("UPDATE $subject SET $assesment='$mark' where roll like '$roll'");
    }
    else if($status=='Z')
    {
    $sql1=$con->query("UPDATE $subject SET grade='Z' where roll like '$roll'");
    $sql1=$con->query("UPDATE $subject SET $assesment='0' where roll like '$roll'");
    }
    else if($status=='U')
    {
    $sql1=$con->query("UPDATE $subject SET grade='U' where roll like '$roll'");
    $sql1=$con->query("UPDATE $subject SET $assesment='0' where roll like '$roll'");
    }
    else if($status=='W')
    {
    $sql1=$con->query("UPDATE $subject SET grade='W' where roll like '$roll'");
    $sql1=$con->query("UPDATE $subject SET $assesment='0' where roll like '$roll'");
    }
    $i++;
  }
  echo" <form class='marks-add-table-form' method='post' action ='marks-add1.php'>";
    echo"<table class='marks-add-table'>";
      echo"<tr>";
     echo"   <th>Roll No</th>";
    echo"   <th>Status</th>";
    echo"    <th>Marks</th>";
    echo"  </tr>";
    $sql=$con->query("SELECT DISTINCT roll FROM $subject order by roll ");
    $i=0;
    while($data=$sql->fetch_array())
    {
    echo"  <tr>";
    echo" <td>";
     echo $data['roll'];
    echo"</td>";
    $roll=$data['roll'];
    echo"<td> <select name='status".$i."'>";
         echo" <option  value='Present'>Present</option>";
    echo"  <option  value='Absent'> Absent</option>";
      echo"  </select> </td>";
    $sql1=$con->query("SELECT $assesment from $subject where roll like  '$roll'");
    $data1=$sql1->fetch_array();
      echo"<td> <input type='number' name='marks".$i."' value=".$data1[$assesment]." ></td>";
    echo"  </tr>";
    $i++;
  }
   echo" </table>";
    echo"  </select><br><br>";
     echo" <input type='submit' name='submit1' value='Submit'>";
  echo"</form>";
}
?>
  <footer class="footer">
    <p>Copyrights &copy NIT Puducherry @ 2021</p>
  </footer>
</body>

</html>
