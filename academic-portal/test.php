
<script type="text/javascript">
        function preventBack() { window.history.forward(); }
        setTimeout("preventBack()", 0);
        window.onunload = function () { null };
    </script><?php
$con=mysqli_connect("localhost","root","","login");
if($con)
{
 $file=$_FILES['file']['tmp_name'];
 $handle=fopen($file,"r");
 while(($cont=fgetcsv($handle)))
 {
	$query1=$con->query("INSERT INTO student (name,roll,programe,department,batch,mail,phone) values ('$cont[1]','$cont[0]','$cont[2]','$cont[3]','$cont[4]','$cont[5]','$cont[6]')") ;
 }
 fclose($handle);
 echo"<br><br>
          Uploaded sucessesfully
          <br>
            <form method='post' action='index.php'>
        <input type='submit' name='goto' value='goto'/>
          </form>";
}
else{
	echo"connection failed";
}
?>
