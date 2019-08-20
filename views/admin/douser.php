<?php include('../../database.php');?>


<?php
$code=$_POST["code"];
$sql = "select * from cusmaster where cuscode='".$code."'";
	$result = $conn->query($sql);
	#echo $conn->error;
	if ($result->num_rows > 0)
	{
	$sql = "update cusmaster set permission='".$_POST['s']."' where cuscode='".$code."'";
	if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
	}
	}
	else
	{
	$sql = "update emp_master set permission='".$_POST['s']."' where empcode='".$code."'";
	if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
	}
	}
