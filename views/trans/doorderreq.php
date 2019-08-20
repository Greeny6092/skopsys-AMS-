<?php include('../../database.php');?>

<?php
$t=$_POST['t'];
if($t=='1')
{
	$h='';
$code=$_POST["v"];
$sql = "select distinct tcode,cuscode,odate,remarks from enterorder where tcode='".$code."'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	#echo $row[""].'$'.$row[1].'$'.$row[2].'$'.$row[3].'$'.$row[4].'$'.$row[5].'$'.$row[6].'$'.$row[7].'$'.$row[8].'$'.$row[9].'$'.$row[10];
	foreach($row as $data)
	{
		 echo $data."$";
	}
	//echo $_POST['se'];
	if ($_POST['se']=='1') {
		//echo "in1";
		$sql="select * from cusmaster where cuscode='".$_POST['code']."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		echo $row['companyname'];
	}
	if ($_POST['se']=='2') {
		//echo "in2";
		$sql="select * from venmaster where vencode='".$_POST['code']."'";
		//echo $sql;
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		echo $row['vendorname'];
		//echo $conn->error;
	}
}


if($t=='2')
{
	?>

	<?php
	$l=$_POST['l'];
	 $sql = "select distinct tcode,a.cuscode,b.companyname,odate,remarks from enterorder as a,cusmaster as b where a.cuscode=b.cuscode and tcode like '%".$l."%' or a.cuscode=b.cuscode and a.cuscode like '%".$l."%' or a.cuscode=b.cuscode and b.companyname like '%".$l."%' or a.cuscode=b.cuscode and odate like '%".$l."%' or a.cuscode=b.cuscode and remarks like '%".$l."%'";
	$result = $conn->query($sql);
	$i=1;
	//echo $sql;
	if ($result->num_rows > 0){ ?>
  <table class="table table-striped table-hover table-bordered ">
    <thead class="thead-dark">
      <th>Transaction code</th>
      <th>Customer Name</th>
      <th>Customer Code</th>
      <th>Order Date</th>
      <th>Remarks</th>
    </thead>
    <tbody>
	<?php
	while($row = $result->fetch_assoc()){
	 echo "<tr onclick=\"req('".$row['tcode']."');to();\"><td>".$row["tcode"]."</td><td>".$row["companyname"]."</td><td>".$row["cuscode"]."</td><td>".$row["odate"]."</td><td>".$row["remarks"]."</td></tr>";
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
