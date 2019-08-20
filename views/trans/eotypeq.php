<?php include('../../database.php');

/*if($_POST['t']=='1')
{
$sql = "SELECT cuscode FROM cusmaster WHERE companyname='".$_POST["v"]."'";
	$result = $conn->query($sql);
	//echo $sql;
	if($result->num_rows>0){
	while($row = $result->fetch_assoc()) {
        echo $row['cuscode']."$";
	//	$throwing.=$row['code']."$";
    }
	}
	else
		echo $conn->error;
}*/
if($_POST['t']=='2')
{
	$v = $_POST['v'];
	$sql = "SELECT * FROM promaster where serial='".$v."'";
	//echo $sql;
	$result = $conn->query($sql);
	//$row = $result->fetch_assoc();

	if($result->num_rows>0){
	while($row = $result->fetch_assoc()) {
				if($row['status']=="ACTIVE")
					echo $row['prodesc'];
				else
					echo $row['status'];

	//	$throwing.=$row['code']."$";
    }
	}
	else
		echo "-1";
}
if($_POST['t']=='9')
{
	$v = $_POST['v'];
	$sql = "SELECT * FROM promaster where serial='".$v."'";
	//echo $sql;
	$result = $conn->query($sql);
	//$row = $result->fetch_assoc();

	if($result->num_rows>0){
	while($row = $result->fetch_assoc()) {
					echo $row['prodesc'];
    }
	}
	else
		echo $conn->error;
}
if($_POST['t']=='3'){
	$v = $_POST['v'];
	$sql = "SELECT * FROM enterorder where tcode='".$v."'";
	$result = $conn->query($sql);

  echo $result->num_rows;

}
if($_POST['t']=='4')
{
	$sql = "SELECT serial FROM enterorder WHERE tcode='".$_POST["v"]."'";
	$result = $conn->query($sql);
	//echo $sql;
	if($result->num_rows>0){
	while($row = $result->fetch_assoc()) {
        echo $row['serial']."$";
	//	$throwing.=$row['code']."$";
    }
	}
	else
		echo $conn->error;
}
if($_POST['t']=='5')
{
	$v = $_POST['v'];
	$sql = "SELECT * FROM enterorder where serial='".$v."'";
	//echo $sql;
	$result = $conn->query($sql);
	//$row = $result->fetch_assoc();

	if($result->num_rows>0){
	while($row = $result->fetch_assoc()) {
				echo $row['costpm'];
	//	$throwing.=$row['code']."$";
    }
	}
	else
		echo $conn->error;
}
if($_POST['t']=='6')
{
	$v = $_POST['v'];
	$sql = "update promaster set status='ACTIVE' WHERE serial='".$v."'";
	//echo $sql;
	$result = $conn->query($sql);


	$sql = "DELETE FROM enterorder where serial='".$v."'";
	//echo $sql;
	$result = $conn->query($sql);
	if($result===true)
		echo 1;
	else
		echo $conn->error;
}
?>
