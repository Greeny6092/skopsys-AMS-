<?php include('../../database.php');?>

<?php
$t=$_POST['t'];
if($t=='1')
{
$code=$_POST["code"];
$sql = "select * from cusmaster where cuscode='".$code."'";
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
	 $sql = "select * from cusmaster where cuscode like '%".$l."%'  or  companyname like '%".$l."%'  or tds like '%".$l."%'  or gstno like '%".$l."%'  or daddress like '%".$l."%'  or city like '%".$l."%'  or pincode like '%".$l."%'  or mobile like '%".$l."%'  or email like '%".$l."%'  or paytype like '%".$l."%'  or  status like '%".$l."%'  " ;
	$result = $conn->query($sql);
	//echo $sql;
	$i=1;
	if ($result->num_rows > 0){ ?>
  <table class="table table-striped table-hover table-bordered ">
    <thead class="thead-dark">
      <th>Customer Code</th>
      <th>Customer Name</th>
      <th>TDS</th>
      <th>GST No</th>
      <th style="text-overflow: ellipsis;">Delivery Address</th>
      <th>City</th>
      <th>Pincode</th>
      <th>Mobile No</th>
      <th>Email</th>
      <th>Payment Type</th>
      <th>Status</th>
    </thead>
    <tbody>
<?php
	while($row = $result->fetch_assoc()){
	 echo "<tr onclick=\"req('".$row['cuscode']."');to();\"><td>".$row["cuscode"]."</td><td>".$row["companyname"]."</td><td>".$row["tds"]."</td><td>".$row["gstno"]."</td><td>".$row["daddress"]."</td><td>".$row["city"]."</td><td>".$row["pincode"]."</td><td>".$row["mobile"]."</td><td>".$row["email"]."</td><td>".$row["paytype"]."</td><td>".$row["status"]."</td></tr>";
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