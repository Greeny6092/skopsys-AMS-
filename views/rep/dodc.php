<?php
include('../../database.php');

$serial=$_POST['serial'];
// $serial."<br>";
$ser =$serial;
$serial[0]=" ";
$serial=trim($serial," ");
//echo $serial."<br><br>";
$serial=explode("$",$serial);
$procat="";
$prodesc="";
$out="";
//print_r($serial);
//echo "<br>";
foreach($serial as $seri)
{
	$sql="select * from promaster where serial='".$seri."'";
	//echo $sql."<br>";
	$result=$conn->query($sql);
	$row=$result->fetch_assoc();
	if($result == true){
		//echo $row['procatname'];
		$procat.="$".$row['prodcatname'];
		$prodesc.="$".$row['prodesc'];
	}
	else
		echo $conn->error;
}

	$tcode = $_POST['tcode'];
	$sql="select distinct a.vencode from promaster as a,enterorder as b where b.tcode='".$tcode."' and a.serial=b.serial";
	//echo $sql;
	$result=$conn->query($sql);
	$res="";
	while($row=$result->fetch_assoc())
	{
		$res.=$row['vencode'][0].$row['vencode'][0]." ";
	}

$out=$procat."&".$ser."&".$prodesc."&".$res;
echo $out;
?>
