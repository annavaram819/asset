
  <!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <link rel="icon" href="../images/icon.png">
  <title>NITPY Academic portal</title>
  <link rel="stylesheet" href="../styles.css">
</head>

<body>
  <div class="main-head">
    <img src="icon.png" alt="NITPY" class="main-logo">
   <h1>NATIONAL INSTITUTE OF TECHNOLOGY PUDUCHERRY</h1>
    <h2>Academic Portal</h2>
  </div>
  <?php
if($_SERVER["REQUEST_METHOD"] == "POST")
    {
      $p1=$_POST['password1'];
      $p2=$_POST['password2'];
      $p3=$_POST['password3'];
      session_start();
$name=$_SESSION['user'];
$password=$_SESSION['p'];
$_SERVER['name']=$name;
$_SESSION['password']=$password;
if(empty($p1)||empty($p2)||empty($p3))
      {
        echo "<div class='no-course'>Entry cannot be empty
          <br><br>
          Click on goto to home
            <form method='post' action='index.php'>
        <input type='submit' name='goto' value='GoTo'/>
          </form>
          </div><hr>";

      }
      else
      {
      if($p1==$password)
      {
         if($p2==$p3)
         {
           $con=mysqli_connect("localhost","kishore","Kishore@016","login");
           $con->query("UPDATE academic set phone='$p2' where mail like'%$name%'");
           $sql=$con->query("SELECT phone from academic where mail like '%$name%'");
           $data=$sql->fetch_array();
           if($data[0]!=$password)
           {
            echo"<div class='no-course'>Changing password done suceessfully
            <br><br>
            Click on goto to login again
            <form method='post' action='login.php'>
        <input type='submit' name='goto' value='goto'/>
          </form></div><hr>";
           }
         }
         else
         {
            echo"<div class='no-course'>New and confirmation passwords are not matching
            <br><br>
            Click on goto to Home again
            <form method='post' action='index1.php'>
        <input type='submit' name='goto' value='goto'/>
          </form></div><hr>";
         }
      }
      else
      {
         echo"<div class='no-course'>Current password is not matching.
           <br><br>
            Click on goto to Home again
       <form method='post' action='index1.php'>
        <input type='submit' name='goto' value='goto'/>
          </form></div><hr>";
    }
}
}
 ?>
 <footer class="footer">
    <p>Copyrights &copy NIT Puducherry @ 2021</p>
  </footer>
</body>
</html>
