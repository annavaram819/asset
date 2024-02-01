<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="icon" href="../images/icon.png">
    <title>NITPY Academic Management Software</title>
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
      <h1>NATIONAL INSTITUTE OF TECHNOLOGY PUDUCHERRY</h1>
      <h2>Login Portal</h2>
    </div>
    <div class="login-form-div">
    <form class="login-form" method="post" action="test.php">
      <label for="login_category">CATEGORY:</label>
      <select name="login_category[]">
        <option value="student">student</option>
      <option value="hod">hod</option>
      <option value='academic'>academic</option>
        <option value='faculty'>faculty</option>
      </select><br><br>
      <label for="cars">USER ID:</label>
      <input type="text" name="user_id"><br><br>
      <label for="cars">PASSWORD:</label>
      <input type="password" name="password"><br><br>
      <input type="submit" value="Submit" name="submit">
    </form>
    </div>
    <footer class="footer">
      <p>Copyrights &copy NIT Puducherry @ 2021</p>
    </footer>
  </body>
</html>
