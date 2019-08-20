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
		//$res.=$row['vencode'][0].$row['vencode'][1]." ";
		$temp=$row['vencode'][0].$row['vencode'][1];
		$sql2="select a.vencode from promaster as a,enterorder as b where b.tcode='".$tcode."' and a.serial=b.serial and a.vencode='".$row['vencode']."'";
		$result2=$conn->query($sql2);
		
		$temp=$temp.$result2->num_rows;
		$res.=$temp." ";
		
	}
$sql3="select * from enterorder where tcode='".$tcode."'";
$result3=$conn->query($sql3);
$row3=$result3->fetch_assoc();
$tem=$row3['cuscode'];
if($tem[0]=='C'&&$tem[1]=='U'&&$tem[2]=='S')
{
	$sql4="select * from cusmaster where cuscode='".$row3['cuscode']."'";
	$result4=$conn->query($sql4);
	$row4=$result4->fetch_assoc();
	$gst=$row4['gstno'];
	$companyname=$row4['companyname'];
}
else	
{
	$sql4="select * from venmaster where vencode='".$row3['cuscode']."'";
	$result4=$conn->query($sql4);
	$row4=$result4->fetch_assoc();
	$gst=$row4['gstno'];
	$companyname=$row4['vendorname'];
}

$sql5="select effdate from trans where tcode='".$tcode."'";
$result5=$conn->query($sql5);
$row5=$result5->fetch_assoc();
$out=$procat."&".$ser."&".$prodesc."&".$res."&".$companyname."&".$gst."&".changedateformat($row5['effdate']);
echo $out;
?>
