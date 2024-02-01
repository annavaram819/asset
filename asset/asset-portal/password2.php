
  <!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <link rel="icon" href="../images/icon.png">
  <title>PBR Visvodaya Institute of Technology and Science Asset portal</title>
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
   <h1>PBR Visvodaya Institute of Technology and Science</h1>
    <h2>Asset Management Portal</h2>
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
           $con=mysqli_connect("localhost","root","","asset");
           $con->query("UPDATE login set password='$p2' where user like'%$name%'");
           $sql=$con->query("SELECT password from login where user like '%$name%'");
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
    <p>Copyrights &copy PBR Visvodaya Institute of Technology and Science @ 2024</p>
  </footer>
</body>
</html>
