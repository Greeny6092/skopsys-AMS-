<?php include('../../database.php');?>

<?php
$t=$_POST['t'];
if($t=='1')
{
$code=$_POST["code"];
$sql = "select * from promaster where serial='".$code."'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	#echo $row[""].'$'.$row[1].'$'.$row[2].'$'.$row[3].'$'.$row[4].'$'.$row[5].'$'.$row[6].'$'.$row[7].'$'.$row[8].'$'.$row[9].'$'.$row[10];
	foreach($row as $data)
	{
		echo $data."$";
	}

}
if ($t=="nam") {
	
	$sql = "select vendorname from venmaster where vencode='".$_POST['code']."'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	echo $conn->error;
	echo $row['vendorname'];
}
if($t=='2')
{$l=$_POST['l'];
	?>
	<?php
    $sql = "select * from promaster where procode like '%".$l."%' or prodcatname like '%".$l."%' or prodesc like '%".$l."%' or proconfig like '%".$l."%' or serial like '%".$l."%' or sgst like '%".$l."%' or cgst like '%".$l."%' or igst like '%".$l."%' or hsncode like '%".$l."%' or saccode like '%".$l."%' or vtype like '%".$l."%' or status like '%".$l."%' ";
    $result = $conn->query($sql);

    echo $conn->error;
    if ($result->num_rows > 0){
?>
<table class="table table-striped table-hover table-bordered ">
  <thead class="thead-dark">
      <th>Product Code</th>
      <th>Product Category</th>
      <th>Product Description</th>
      <th>Product Configuration</th>
	  <th>Serial No.</th>
      <th>SGST</th>
      <th>CGST</th>
      <th>IGST</th>
      <th>HSN Code</th>
      <th>SAC Code</th>
      <th>Vendor Type</th>
      <th>Status</th>
    </thead>
    <tbody>
      <?php while($row = $result->fetch_assoc()){ ?>
        <tr onclick="req('<?php echo $row["serial"]; ?>')">
          <td><?php echo $row["procode"]; ?></td>
          <td><?php echo $row["prodcatname"]; ?></td>
          <td><?php echo $row["prodesc"]; ?></td>
          <td><?php echo $row["proconfig"]; ?></td>
		      <td><?php echo $row["serial"]; ?></td>
          <td><?php echo $row["sgst"]; ?></td>
          <td><?php echo $row["cgst"]; ?></td>
          <td><?php echo $row["igst"]; ?></td>
          <td><?php echo $row["hsncode"]; ?></td>
          <td><?php echo $row["saccode"]; ?></td>
          <td><?php echo $row["vtype"]; ?></td>
          <td><?php echo $row["status"]; ?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
  <?php


        }
        else{
          echo "<h1> No Records Found</h1>";
        }
  ?>

<?php
}


?>
