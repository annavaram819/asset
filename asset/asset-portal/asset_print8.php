<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>PBR Visvodaya Institute of Technology and Science Asset Management</title>
  <link rel="icon" href="../icon.png">
  <link rel="stylesheet" href="../styles.css">
</head>

<body>
  <div class="main-head">
    <img src="../icon.png" alt="NITPY" class="main-logo">
    <h1>PBR Visvodaya Institute of Technology and Science</h1>
    <h2>Assets</h2>
  </div>
  <table class="assets-view-table">
    <tr>
      <th rowspan="2">S No.</th>
      <th rowspan="2">Asset Description</th>
      <th rowspan="2">Inventory No.</th>
      <th rowspan="2">TotalQuantity</th>
      <th colspan="2">Current Location</th>
      <th rowspan="2">Current Department</th>
    </tr>
    <tr>
      <th>Floor</th>
      <th>Room</th>
    </tr>
  <?php
  session_start();
  $inventory=$_SESSION['inventory'];
  $item=$_SESSION['item'];
  $department=$_SESSION['department'];
  $_SESSION['department']=$department;
    $con=mysqli_connect("localhost","root","","asset");
    $sql=$con->query("SELECT * FROM asset_details where current_department like '$department' and asset_name like '$item' and current_department like '$department'");
    if (mysqli_num_rows($sql) > 0)
    {
    $i=1;
    while($data=$sql->fetch_array())
    {
    echo"<tr>";
      echo"<td>".$i."</td>";
      echo"<td>".$data['asset_name']."</td>";
      echo"<td>".$data['inventory_no']."</td>";
      echo"<td>".$data['quantity']."</td>";
      echo"<td>".$data['floor']."</td>";
      echo"<td>".$data['room']."</td>";
      echo"<td>".$data['current_department']."</td>";
    echo"</tr>";
    $i++;
  }
}
    ?>
  </table>

  <h3>The Purpose of transfer of Item/Asset/Equipment:</h3>
  <p>Whether the Director approved the transfer: Yes/No</p>
  <p>If yes, please attach the approved letter.</p>

  <p>The Asset transfer to</p>
  <p>......................</p>
  <p class="para-right">department &amp; location of the Asset after transfer is</p>

  <p>As per NITPY central stores rules once the Asset is transferred, the whole responsibility over that
    Item/Asset/Equipment is final user (or) Acquired department.</p>

  <div class="flex-display-container center-aligner">
    <div class="containers">
      <h3>Indenter</h3>
    </div>
    <div class="containers">
      <h3>HoD/Section Head</h3>
      <h3>(Transferring department)</h3>
    </div>
    <div class="containers">
      <h3>HoD/Section Head</h3>
      <h3>((Acquiring department)</h3>
    </div>

  </div>
  <hr>
  <h3 class="center-aligner">***To be filled by Central Stores***</h3>
  <p>1. The transfer of Item/Asset/Equipment is updated in Institute stock Register..........................................................
    Volume No……………. Page No…………….. On (date).</p>
  <p>2. Physical Verification is done on…………………….(date) location of the item is found at ………………….
    (After the successful transfer of Asset)</p>
  <div class="flex-display-container center-aligner">
    <div class="containers">
      <h3>Jr.Assistant,</h3>
      <h3>Central Stores</h3>
    </div>
    <div class="containers">
      <h3>Memeber,</h3>
      <h3>Central Stores</h3>
    </div>
    <div class="containers">
      <h3>Faculty i/c,</h3>
      <h3>Central Stores</h3>
    </div>

  </div>
  <footer class="footer">
    <p>Copyrights &copy PBR Visvodaya Institute of Technology and Science @ 2024</p>
  </footer>

</body>

</html>
