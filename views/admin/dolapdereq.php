<?php include('../../database.php');?>

<?php
$code=$_POST["code"];
$sql = "select * from pclap where code='".$code."'";
	//echo $sql;
	$result = $conn->query($sql);
	if($conn->query($sql)==false)
		echo $conn->error;
	else
	{
		//echo $result->fetch_assoc();
		$row = $result->fetch_assoc();
	foreach($row as $data)
	{
		echo $data."$";
	}
}
?>
