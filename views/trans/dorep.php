<?php
include '../../database.php';
if(isset($_POST['typ']))
$typ=$_POST['typ'];

if($typ === "1"){
$cuscode=$_POST['cuscode'];
//echo "cuscode is ".$cuscode."<br>";
$sql="select tcode from enterorder where cuscode='".$cuscode."' group by tcode";
//echo $sql;
//echo "query is ".$sql."<br>";
$result=$conn->query($sql);
if($result->num_rows>0)
{
while($row = $result->fetch_assoc())
{
		echo $row['tcode']."$";

}
}else
{
  echo " $";
	echo $conn->error;
}
}
if($typ==="set"){
		$sql = "select * from enterorder,promaster where enterorder.serial=promaster.serial and cuscode='".$_POST['cuscode']."' and status!='returning'";
		//echo $sql;
		$result = $conn->query($sql);
		//$row = $result->fetch_assoc();
		if($result->num_rows>0){
			while($row = $result->fetch_assoc())
			{
						echo "$".$row["serial"];
			}
		}
		else {
				echo $conn->error;
		}
}
if($typ==="setout"){
		$sql = "select prodcatname from promaster where serial='".$_POST['serial']."'";
		//echo $sql;
		$result = $conn->query($sql);
		//$row = $result->fetch_assoc();
    $row = $result->fetch_assoc();

    $sql = "select serial from promaster where prodcatname='".$row['prodcatname']."' and status='active'";
		//echo $sql;
		$result = $conn->query($sql);

		if($result->num_rows>0){
			while($row = $result->fetch_assoc())
			{
						echo "$".$row["serial"];
			}
		}
		else {
				echo $conn->error;
		}
}
if ($typ=="save") {

  $sql = "insert into rep(cuscode,tcode,serialin,serialout) values('".$_POST['cuscode']."','".$_POST['tcode']."','".$_POST['serialin']."','".$_POST['serialout']."')";
  //echo $sql;
  $result1 = $conn->query($sql);

  $sql = "update promaster set status='REPOUT' where serial='".$_POST['serialout']."'";
  $result2 = $conn->query($sql);

  $sql = "update promaster set status='REPIN' where serial='".$_POST['serialin']."'";
  $result3 = $conn->query($sql);

	$sql = "insert into enterorder(tcode,cuscode,odate,remarks,serial,costpm,flag) select tcode,cuscode,odate,remarks,'".$_POST['serialout']."',costpm,flag from enterorder where serial='".$_POST['serialin']."'";
  $result4 = $conn->query($sql);

  if ($result1==true && $result2==true && $result3==true && $result4==true) {
    echo "1";
  }
  else{
    echo $conn->error;
  }
}
if ($typ === "pass") {
	$sql = "update promaster set status='RENTAL' where serial='".$_POST['serialout']."'";
	$result1 = $conn->query($sql);

	$sql = "update rep set flag='1' where slno='".$_POST['slno']."'";
	$result2 = $conn->query($sql);

	$sql = "select * from repdc where cuscode='".$_POST['cuscode']."' and dctype='REPOUT'";
	$result = $conn->query($sql);
	$row=$result->fetch_assoc();
	$serial=$row["serial"];

	$serial[0]=" ";
	$serial=trim($serial," ");
	$serial=explode("$",$serial);

	#print_r( $serial);
	#echo $_POST['serialout'];
	#if(!isset($_POST["avoiderror"]))
	#{
		$serial = array_diff( $serial , $_POST['serialout'] );
	#}
	$ser="";
	if ($serial!="") {
		for ($i=0; $i < len($serial); $i++) {
			$ser.="$".$serial[i];
		}
	}
	else{
		$sql = "update repdc set flag=1 where cuscode='".$_POST['cuscode']."' and dctype='REPOUT'";
		$result3 = $conn->query($sql);
	}

	//echo $serial;

	if ($result1==true && $result2==true && $result3==true) {
   echo "1";
  }
	else{
    echo $conn->error;
  }
}


if($typ==='check')
{
	$a=$_POST['a'];

	$sql = "SELECT * from promaster where serial='".$a."'";
$result = $conn->query($sql);

$row = $result->fetch_assoc();
echo $row['prodcatname'];
//echo $sql;
}

 ?>
