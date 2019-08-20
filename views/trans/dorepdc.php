<?php
include '../../database.php';
if(isset($_POST['typ']))
$typ=$_POST['typ'];

if ($typ==="setting") {
	$cuscode = $_POST['cuscode'];
	$rep = $_POST['rep'];

	$sql = "select * from enterorder,promaster,rep where enterorder.serial=promaster.serial and (enterorder.serial=rep.serialin or enterorder.serial=rep.serialout) and enterorder.cuscode='".$cuscode."' and status='".$rep."' and rep.flag3='0'";
	//echo $sql;
	$result = $conn->query($sql);
	//$row = $result->fetch_assoc();
	if($result->num_rows>0){
		while($row = $result->fetch_assoc())
		{
					echo "$".$row["serial"];
		}
	}
	else if($result->num_rows==0){
			echo "NO ITEMS$";
	}
	else {
		echo $conn->error;
	}
}
if ($typ==="save") {
  $year=date('Y').date('Y')+1;
	//echo $year."<br>";
	$month=date('m');
	//echo $month."<br>";
	if($month<4)
		{
			$year=(date('Y')-1).date('Y');
			//echo $year."<br>";
		}
	$code="DC".date('Y').$month;

		$sql ="select * from dccount where year='".$year."'";
		$result = $conn->query($sql);

		if ($result->num_rows == 0){
			$sql = "INSERT INTO dccount(`year`) values('".$year."')";
			$result=$conn->query($sql);
			//echo "new inserted <br>";

		}
			//echo $year."<br>";
			$sql ="select * from dccount where year='".$year."'";
			$result = $conn->query($sql);
			//echo $conn->error;
			$row=$result->fetch_assoc();
			$count=$row['count'];
			//echo "<br>current count is ".$count."<br>";
			$count++;
			//echo "incremented count is ".$count."<br>";
			$conn->query("update dccount set count=".$count." where year='".$year."'");
			//echo $conn->error;
			$code.=$count;

      $sql = "INSERT INTO `repdc` (`dcno`, `cuscode`, `dctype`, `dcdate`, `serial`) VALUES ('".$code."', '".$_POST['cuscode']."', '".$_POST['dctype']."', '".$_POST['dcdate']."', '".$_POST['serial']."')";
      $result = $conn->query($sql);
      if($result==true){
        echo "1";
      }else {
        echo $conn->error;
      }
}
if($typ=="req")
{
	//$descs="";
	//$date="";
	//$source="";
	$dcno=$_POST["dcno"];
	//echo $dcno;
	$sql="select * from repdc where dcno='".$dcno."'";
	//echo $sql;
	$result=$conn->query($sql);
	$row=$result->fetch_assoc();
	//$date=$row['dcdate'];
	echo $conn->error;
	echo $row['dcdate']."&".$row['serial'];
	//echo $date;
	//$serial=$row['serial'];
	//echo $serial;
	//$serial[0]=" ";
	//$serial=trim($serial," ");
	//echo $serial;
	//$serial=explode("$",$serial);
	//echo $serial;
	//foreach($serial as $ser)
	//{
		//$sql1="select prodcatname,prodesc from promaster where serial='".$ser."'";
		//echo $sql1;
		//$result1=$conn->query($sql1);

		//$row1=$result1.fetch_assoc();
		//$descs.="$".$row1['prodcatname']."-".$row1['serial']."-".$row1['prodesc'];
	//}
	$sql="select * from cusmaster where cuscode='".$row['cuscode']."'";
	$result=$conn->query($sql);
	//echo $sql2;
	$row=$result->fetch_assoc();
	echo $conn->error;
	echo "&".$row['baddress']."&".$row['daddress']."&".$row['companyname']."&".$row['gstno']."&";
    
	$sql="select * from repdc where dcno='".$dcno."'";
	$result=$conn->query($sql);
	$row=$result->fetch_assoc();
	$sc=$row['serial'];
	$sc=explode("$", $sc);
	$n=count($sc);
	$ven="";
	for($i=1;$i<$n;$i++)
	{
	$sql="select * from promaster where serial='".$sc[$i]."'";	
	$result=$conn->query($sql);
	$row=$result->fetch_assoc();
	$ven.="$".$row['vencode'][0].$row['vencode'][1];
	}
	$sc=explode("$",$ven);
	$sp=array_unique($sc);
	$n=count($sc);
	$counts = array_count_values($sc);
	for($i=1;$i<$n;$i++)
	{
	 echo $sp[$i].$counts[$sp[$i]]." ";	
	}
}
if ($typ==="send") {
	//echo "enter";
	$serial=$_POST['serial'];
	//echo $serial;
	$serial[0]=" ";
	$serial=trim($serial," ");
	//echo $serial;
	$serial=explode("$",$serial);
	//print_r($serial);
	$descs="";
	foreach($serial as $ser)
	{
		$sql="select prodcatname,prodesc,serial from promaster where serial='".$ser."'";
		//echo $sql;
	 	$result=$conn->query($sql);
		$row=$result->fetch_assoc();
		$descs.="$".$row['prodcatname']."-".$row['serial']."-".$row['prodesc'];
	}
	echo $descs;
}
 ?>
