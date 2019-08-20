<?php include('../../database.php');?>

<?php
$code=$_POST["code"];
$sql = "select * from peripheral where code='".$code."'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	#echo $row[""].'$'.$row[1].'$'.$row[2].'$'.$row[3].'$'.$row[4].'$'.$row[5].'$'.$row[6].'$'.$row[7].'$'.$row[8].'$'.$row[9].'$'.$row[10];
	foreach($row as $data)
	{
		echo $data."$";
	}
?>




