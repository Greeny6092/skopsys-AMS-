<?php include '../../database.php';
if($_POST['o']==1)
{
	if(isset($_POST['cuscode']))
	{
		//echo "cuscode";
		$cuscode=$_POST['cuscode'];
		$sql="select * from cusmaster where cuscode='".$cuscode."'";
	}
	else
	{   //echo "cusname";
		$cusname=$_POST['cusname'];
		$sql="select * from cusmaster where companyname='".$cusname."'";
	}
	$result=$conn->query($sql);
	if($result->num_rows>0)
	{
		$row=$result->fetch_assoc();
		echo $row['companyname']."$".$row['cuscode'];
	}
	else
		echo "No Result Found";

}
else if($_POST['o']==2)
{
	$filo=$_POST['filoption'];
	$cuscode=$_POST['cuscode'];
	$prodcatname=$_POST['prodcatname'];
	$status=$_POST['status'];
	$serial=$_POST['serial'];
	//echo "filo is ".$filo." cuscode is ".$cuscode."prodcatname is ".$prodcatname." status is ".$status;
	if($filo=="1000")
		$sql="select a.prodcatname,a.serial,a.status,a.procode from promaster as a,enterorder as b where a.serial=b.serial and b.cuscode='".$cuscode."'";
	if($filo=="0100")
		$sql="select * from promaster where prodcatname='".$prodcatname."'";
	if($filo=="0010")
		$sql="select * from promaster where status='".$status."'";
	if($filo=="1100")
		$sql="select a.prodcatname,a.serial,a.status,a.procode from promaster as a,enterorder as b where a.serial=b.serial and b.cuscode='".$cuscode."' and a.prodcatname='".$prodcatname."'";
	if($filo=="0110")
		$sql="select * from promaster where prodcatname='".$prodcatname."'";
	if($filo=="1010")
		$sql="select a.prodcatname,a.serial,a.status,a.procode from promaster as a,enterorder as b where a.serial=b.serial and b.cuscode='".$cuscode."' and a.status='".$status."'";
	if($filo=="1110")
		$sql="select a.prodcatname,a.serial,a.status,a.procode from promaster as a,enterorder as b where a.serial=b.serial and b.cuscode='".$cuscode."' and a.status='".$status."' and a.prodcatname='".$prodcatname."'";
	if($filo=="0001")
		$sql="select prodcatname,serial,status,procode from promaster where serial='".$serial."'";		
	if($filo=="0000")
		$sql="select prodcatname,serial,status,procode from promaster";
	$result=$conn->query($sql);
	if($result->num_rows>0)
	{
	while($row=$result->fetch_assoc())
		echo "<tr><td>".$row['prodcatname']."</td><td>".$row['serial']."</td><td>".$row['procode']."</td><td>".$row['status']."</td><td><button data-toggle='modal' data-target='#address' class='btn btn-success' onclick=\"pass('".$row['serial']."')\">view</td></tr>";
	}
	else{ l1:
		echo "<tr><td colspan='4'><center>No record found</center></td></tr>";
	}
}

else if($_POST['o']==3)
{
	$serial=$_POST['s'];
	$sql="select * from promaster where serial='".$serial."'";
	$result=$conn->query($sql);
	$row=$result->fetch_assoc();
	echo $row['prodesc']."&".$row['status']."&";
	$sts=$row['status'];
	$sql2="select * from enterorder where serial='".$serial."'";
	$result=$conn->query($sql2);
	$row=$result->fetch_assoc();
	$cus=$row["cuscode"];
	
	if($sts=='ACTIVE')
	{echo "Skopsys&Skopsys Address&Self Number&";}
if($sts=='RENTAL')
	{
		$sql3="select * from cusmaster where cuscode='".$cus."'";
		$result=$conn->query($sql3);
		$row=$result->fetch_assoc();
		echo $row['companyname']."&".$row['baddress']."&".$row['mobile']."&";
	}
if($sts=='SERVICE')
	{
		$sql4="select * from venmaster where vencode='".$cus."'";
		$result=$conn->query($sql4);
		$row=$result->fetch_assoc();
		echo $row['vendorname']."&".$row['address1']."&".$row['mobile']."&";
	}
if($sts=='SCRAP')
	{echo "-------&-------&--------";}
	
if($sts=='RETURNING')
{
	$cud=$cus[0].$cus[1].$cus[2];
	if($cud==='cus')
	{
		$sql3="select * from cusmaster where cuscode='".$cus."'";
		$result=$conn->query($sql3);
		$row=$result->fetch_assoc();
		echo $row['companyname']."&".$row['baddress']."&".$row['mobile']."&";
	}
    else{
		$sql4="select * from venmaster where vencode='".$cus."'";
		$result=$conn->query($sql4);
		$row=$result->fetch_assoc();
		echo $row['vendorname']."&".$row['address1']."&".$row['mobile']."&";
	}
}	
	
}

?>
