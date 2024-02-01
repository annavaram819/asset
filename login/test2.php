<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="icon" href="images/icon.png">
    <title>NITPY Academic Management Software</title>
    <link rel="stylesheet" href="styles.css">
  </head>
  <body>
    <div class="main-head">
      <img src="icon.png" alt="NITPY" class="main-logo">
      <h1>NATIONAL INSTITUTE OF TECHNOLOGY PUDUCHERRY</h1>
      <h2>student Login Portal</h2>
    </div>
 <?php
 if($_SERVER["REQUEST_METHOD"] == "POST")
 {
  $set1=$_POST["login_category"];
  echo $set1[0];
    if($set1[0]=='hod')
    {
      header("location: hod-portal/index.php");
    }
    else if($set1[0]=='faculty')
    {
      header("location: faculty-portal/index.php");
    }
    else if($set1[0]=='academic')
    {
      header("location: academic-portal/index.php");
    }
 }
 ?>
  <footer class="footer">
      <p>Copyrights &copy NIT Puducherry @ 2021</p>
    </footer>
  </body>
</html>