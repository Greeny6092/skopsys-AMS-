
<?php
include '../../database.php';
$t=$_POST['t'];
if($t=='1')
{
	$sql=$_POST['sql'];
	//echo $sql;
	if ($conn->query($sql) === TRUE) {
		echo "1";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}
?>
