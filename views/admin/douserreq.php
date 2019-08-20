<?php include('../../database.php');?>

<?php
$code=$_POST["code"];
$sql = "select * from cusmaster where cuscode='".$code."'";
	$result = $conn->query($sql);
	#echo $conn->error;
	if ($result->num_rows > 0)
	{
	$row = $result->fetch_assoc();
	echo $row['companyname'].'&'.$row['permission'];
	}
	else
	{
		$sql = "select * from emp_master where empcode='".$code."'";
	$result = $conn->query($sql);
	echo $conn->error;
	$row = $result->fetch_assoc();
	echo $row['firstname'].'&'.$row['permission'];
	}
?>