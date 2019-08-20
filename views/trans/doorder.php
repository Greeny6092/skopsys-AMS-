<?php include('../../database.php');
$tcode=$_POST['tcode'];
//echo $tcode;
$cuscode=$_POST['cuscode'];
$odate=$_POST['odate'];
$remarks=$_POST['remarks'];
$serial=$_POST['serial'];
//$costpm=$_POST['costpm'];
//echo $costpm;
$noi=number_format($_POST['noi']);
//echo $noi;
$typ=$_POST["typ"];
$serial[0]=" ";
$serial=trim($serial," ");
$serial=explode("$",$serial);
//$costpm[0]=" ";
//$costpm=trim($costpm," ");
//$costpm=explode("$",$costpm);
if($typ=="save")
{
	a:
	$code='TRN'.date('Y').date('m').rand(1000,9999);

	$sql = "select * from enterorder where tcode='".$code."'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0)
	{
		goto a;
	}
	foreach($serial as $ser)
	{	//echo "check2";
		$sql = "INSERT INTO enterorder (tcode,cuscode,odate,remarks,serial) VALUES('".$code."','".$cuscode."','".$odate."','".$remarks."','".$ser."')";
		//echo $ser,$cost;
		$result = $conn->query($sql);
	}
		if ($result === TRUE) {
		echo "1";
    }
	else
		echo "Error: " . $sql . "<br>" . $conn->error;
	b:;
}
if($typ=="update")
{
	foreach($serial as $ser)
	{	//echo "check2";
		$sql = "update enterorder set flag='0' where tcode='".$tcode."'";
		$result = $conn->query($sql);
		$sql = "DELETE from enterorder where serial='".$ser."'";
		$result = $conn->query($sql);
		$sql = "INSERT INTO enterorder (tcode,cuscode,odate,remarks,serial) VALUES('".$tcode."','".$cuscode."','".$odate."','".$remarks."','".$ser."')";
		//echo $ser,$cost;
		$result = $conn->query($sql);
	}
		if ($result === TRUE) {
		echo "2";
		}
	else
		echo "Error: " . $sql . "<br>" . $conn->error;
}

?>
