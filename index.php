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
      <img src="images/icon.png" alt="NITPY" class="main-logo">
      <h1>NATIONAL INSTITUTE OF TECHNOLOGY PUDUCHERRY</h1>
      <h2>Login Portal</h2>
    </div>
    <form class="login-form" method="post" action="test.php">
      <label for="login_category">CATEGORY:</label>
      <select name="login_category[]">
        <option value="student">student</option>
      <option value="hod">hod</option>
      <option value='academic'>academic</option>
        <option value='class_advisor'>class_advisor</option>
        <option value='faculty'>faculty</option>
      </select><br><br>
      <input type="submit" value="submit" name="submit">
    </form>
    <footer class="footer">
      <p>Copyrights &copy NIT Puducherry @ 2021</p>
    </footer>
  </body>
</html>
