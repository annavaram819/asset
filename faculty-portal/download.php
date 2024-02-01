<?php  
$subject=$_GET['subject'];
$_SESSION['subject']=$subject;
$con = mysqli_connect("localhost", "kishore", "Kishore@016", "login"); 
$output = '';
 $sql2=$con->query("SELECT count(column_name)as count from information_schema.columns WHERE table_name like '$subject'");
    $data2=$sql2->fetch_array();
    $j=($data2[0]-4)/2;
$tablename = "applicant_details";
$ar = array();
    $q = "SELECT column_name
FROM information_schema.columns
WHERE  table_name like '$subject'";

  $re = mysqli_query($con,$q);                 // obatin the column names of table
  while($row = mysqli_fetch_assoc($re)){
    foreach($row as $cname => $cvalue){
        array_push($ar, $cvalue);
    }
}
if(isset($_POST['download'])){

$query =$con->query("SELECT * FROM $subject order by roll"); // Get data from Database from demo table
 
 
    $delimiter = ",";
    $filename = $subject . ".csv"; // Create file name
     
    //create a file pointer
    $f = fopen('php://memory', 'w'); 
     
    //set column headers
    $fields = $ar;
    fputcsv($f, $fields, $delimiter);
     
    //output each row of the data, format line as csv and write to file pointer
    while($row =$query->fetch_array()){
        $n = array();
        for($x=0; $x<count($ar); $x++)
        {
          array_push($n, $row[$ar[$x]]);
        }

        $lineData = $n;
        fputcsv($f, $lineData, $delimiter);
    }
     
    //move back to beginning of file
    fseek($f, 0);
     
    //set headers to download file rather than displayed
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
     
    //output all remaining data on a file pointer
    fpassthru($f);
 
 }
?>