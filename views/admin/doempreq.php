<?php include('../../database.php');?>

<?php
$t=$_POST['t'];
if($t=='1'){
$code=$_POST["code"];
$sql = "select * from emp_master where empcode='".$code."'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	#echo $row[""].'$'.$row[1].'$'.$row[2].'$'.$row[3].'$'.$row[4].'$'.$row[5].'$'.$row[6].'$'.$row[7].'$'.$row[8].'$'.$row[9].'$'.$row[10];
	foreach($row as $data)
	{
	echo $data."$";}

}

if($t=='2')
{
	?>
	
	<?php
	$l=$_POST['l'];
	//echo $l;
	 $sql = "select empcode,firstname,lastname,dept,email,mobile,status from emp_master where empcode like '%".$l."%' or firstname like '%".$l."%' or lastname like '%".$l."%' or dept like '%".$l."%' or email like '%".$l."%' or mobile like '%".$l."%' or status like '%".$l."%' ";
	$result = $conn->query($sql);
	$i=1;
	if ($result->num_rows > 0){ ?>
  <table class="table table-striped table-hover table-bordered ">
    <thead class="thead-dark">
      <th>S/No</th>
      <th>Employee Code</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Departments</th>
      <th>Email</th>
      <th>Mobile No</th>
      <th>Status</th>
    </thead>
    <tbody>
	<?php
	while($row = $result->fetch_assoc()){
	 echo "<tr onclick=\"req('".$row['empcode']."');to();\"><td>1</td><td>".$row["empcode"]."</td><td>".$row["firstname"]."</td><td>".$row["lastname"]."</td><td>".$row["dept"]."</td><td>".$row["email"]."</td><td>".$row["mobile"]."</td><td>".$row["status"]."</td></tr>";
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