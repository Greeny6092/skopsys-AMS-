<?php include('../../database.php');?>

<?php
$t=$_POST['t'];
if($t=='1')
{
$code=$_POST["code"];
$sql = "select * from venmaster where vencode='".$code."'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	
	foreach($row as $data)
	{
	echo $data."$";
	}
}

if($t=='2')
{
	$l=$_POST['l'];
	?>
	
	<?php
	$sql = "select * from venmaster where vencode like '%".$l."%' or vendorname like '%".$l."%' or address1 like '%".$l."%' or city like '%".$l."%' or pincode like '%".$l."%' or mobile like '%".$l."%' or status like '%".$l."%'" ;
	$result = $conn->query($sql);
	//$i=1;
	if ($result->num_rows > 0){
?>
<table class="table table-striped table-hover table-bordered ">
  <thead class="thead-dark">
      <th>Vendor Id</th>
      <th>Vendor Name</th>
      <th>Address</th>
      <th>City</th>
      <th>Pincode</th>
      <th>Mobile No</th>
      <th>Status</th>
    </thead>
    <tbody>
	
	
<?php
	while($row = $result->fetch_assoc()){
	 echo "<tr onclick=\"req('".$row['vencode']."');to();\"><td>".$row["vencode"]."</td><td>".$row["vendorname"]."</td><td>".$row["address1"]."</td><td>".$row["city"]."</td><td>".$row["pincode"]."</td><td>".$row["mobile"]."</td><td>".$row["status"]."</td></tr>";
	}
    ?>
    </tbody>
  </table>
  <?php }
	else{
		echo "<h1> No Records Found</h1>";
	}
	?>
	
	
<?php	
}
	
?>