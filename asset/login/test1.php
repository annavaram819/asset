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
  $con=mysqli_connect("localhost","root","Kishore@016","login");
if($con)
{
  $value='';
 $file=$_FILES['file']['tmp_name'];
 $handle=fopen($file,"r");
 $value1=00;
 while(($cont=fgetcsv($handle)))
 {
  $query1=$con->query("INSERT INTO faculty (name,mail,phone,dept) values ('$cont[0]','$cont[2]','$cont[1]','$cont[3]')") ;
}
 fclose($handle);
}
}
?>