<?php include('../../database.php');
//echo "entered";
if($_POST['t']=="1")
{
//echo "t is 1";
$dcno=$_POST['dcno'];
$cuscode=$_POST['cuscode'];
$tcode=$_POST['tcode'];
$dcdate=$_POST['dcdate'];
$intype=$_POST['intype'];
$range=$_POST['rang'];
$dctype=$_POST['dctype'];
$orderby=$_POST['orderby'];
$orderno=$_POST['orderno'];
$daddress=$_POST['daddress'];
$baddress=$_POST['baddress'];
$serials=$_POST['serials'];
$source=$_POST['source'];
$scount=$_POST['scount'];
$cdate=date('d')."/".date('m')."/".date('Y');
if(isset($_POST['effdate']))
$effdate=$_POST['effdate'];
else
	$effdate='0000-00-00';
//echo "got the data"."<br>".$dcno;
//echo "success ".$source;
if($cuscode[0]=='C'&&$cuscode[1]=='U'&&$cuscode[2]=='S')
{
	$sql="select companyname from cusmaster where cuscode='".$cuscode."'";
	$result=$conn->query($sql);
	$row=$result->fetch_assoc();
	$companyname=$row['companyname'];
}
else
{
	$sql="select vendorname from venmaster where vencode='".$cuscode."'";
	$result=$conn->query($sql);
	$row=$result->fetch_assoc();
	$companyname=$row['vendorname'];
}


$sql="select * from dc where dcno='".$dcno."' order by slno DESC";
//echo $sql."<br>";
$result=$conn->query($sql);
if($result->num_rows>0)
{
//echo "row count greater than 0;";
$row=$result->fetch_assoc();
	if(($cuscode==$row['cuscode'])&&($tcode==$row['tcode'])&&($dcdate==$row['dcdate'])&&($intype==$row['intype'])&&($range==$row['rang'])&&($dctype==$row['dctype'])&&($orderby==$row['orderby'])&&($orderno==$row['orderno'])&&($daddress==$row['daddress'])&&($baddress==$row['baddress'])&&($serials==$row['serials'])&&($companyname==$row['companyname'])&&($scount==$row['scount'])&&($source==$row['source'])&&($effdate==$row['effdate']))
	{
		echo "No changes detected with previous DC";
		//echo "0";
	}
	else
	{
		$sql="insert into dc(dcno,cuscode,tcode,dcdate,intype,rang,dctype,orderby,orderno,daddress,baddress,serials,cdate,source,companyname,scount,effdate) values('".$dcno."','".$cuscode."','".$tcode."','".$dcdate."','".$intype."','".$range."','".$dctype."','".$orderby."','".$orderno."','".$daddress."','".$baddress."','".$serials."','".$cdate."','".$source."','".$companyname."','".$scount."','".$effdate."')";
		$conn->query($sql);
		echo "0";
	}
}
else
	{
		$sql="insert into dc(dcno,cuscode,tcode,dcdate,intype,rang,dctype,orderby,orderno,daddress,baddress,serials,cdate,source,companyname,scount,effdate) values('".$dcno."','".$cuscode."','".$tcode."','".$dcdate."','".$intype."','".$range."','".$dctype."','".$orderby."','".$orderno."','".$daddress."','".$baddress."','".$serials."','".$cdate."','".$source."','".$companyname."','".$scount."','".$effdate."')";
		$conn->query($sql);
		echo "0";
	}
}
else if($_POST['t']=="2")
{
	$billno=$_POST['billno'];
	$instart=$_POST['indate'];
	$inend=$_POST['inend'];
	$source=$_POST['source'];
	$dcno=$_POST['dcno'];
	$orderno=$_POST['orderno'];
	$orderby=$_POST['orderby'];
	$baddress=$_POST['baddress'];
	$slno=$_POST['slno'];
	$desc=$_POST['desc'];
	$hsnsac=$_POST['hsnsac'];
	$qty=$_POST['qty'];
	$rate=$_POST['rate'];
	$amount=$_POST['amount'];
	$gst=$_POST['gst'];
	$subtotal=$_POST['subtotal'];
	$tcharge=$_POST['tcharge'];
	$discount=$_POST['discount'];
	$scost=$_POST['scost'];
	$sgst=$_POST['sgst'];
	$cgst=$_POST['cgst'];
	$igst=$_POST['igst'];
	$summary=$_POST['summary'];
	$total=$_POST['total'];
	$cuscode=$_POST['cuscode'];
	$dcnos=$_POST['dcnos'];
	$companyname=$_POST['companyname'];
	$paytype=$_POST['paytype'];
$sql="insert into invoices(billno,instart,inend,dcno,orderno,source,baddress,prodesc,hsnsac,qty,rate,amount,subtotal,discount,tcharge,gstno,summary,slno,scost,sgst,cgst,igst,total,orderby,cuscode,companyname) values('".$billno."','".$instart."','".$inend."','".$dcno."','".$orderno."','".$source."','".$baddress."','".$desc."','".$hsnsac."','".$qty."','".$rate."','".$amount."','".$subtotal."','".$discount."','".$tcharge."','".$gst."','".$summary."','".$slno."','".$scost."','".$sgst."','".$cgst."','".$igst."','".$total."','".$orderby."','".$cuscode."','".$companyname."')";
//echo $sql;
if ($conn->query($sql) === TRUE) 
{
	if($paytype=="1")
	{
		echo '0';
		$sql="select * from incount";
		$result=$conn->query($sql);
		$row=$result->fetch_assoc();
		$sql1="update incount set count='".((int)$row['count']+1)."'";
		$conn->query($sql1);
		$sql2="update cusmaster set indate='".date('Y-m-d', strtotime($instart. ' + 1 months'))."' where cuscode='".$cuscode."'";
		$conn->query($sql2);
		$dcnos=explode("$",$dcnos);
		for($i=1;$i<count($dcnos);$i++)
		{
			$sql3="update trans set effdate='".date('Y-m-d', strtotime($instart. ' + 1 months'))."' where dcno='".$dcnos[$i]."' and intype!='DAILY' and dctype='rental'";		
			$conn->query($sql3);
		}
		$sql4="select * from cusmaster where cuscode='".$cuscode."'";
		$result4=$conn->query($sql4);
		$row4=$result4->fetch_assoc();
		$tot = intval($row4['balance'])+intval($total);
		$sql5="update cusmaster set balance='".$tot."' where cuscode='".$cuscode."'";
		$conn->query($sql5);
		$conn->error;
		
			
			
		
	}
	else if($paytype=="2")
	{
		echo '0';
		$sql="select * from incount";
		$result=$conn->query($sql);
		$row=$result->fetch_assoc();
		$sql1="update incount set count='".((int)$row['count']+1)."'";
		$conn->query($sql1);
		$sql2="update cusmaster set indate='".date('Y-m-d', strtotime($inend. ' + 1 months'))."' where cuscode='".$cuscode."'";
		$conn->query($sql2);
		$dcnos=explode("$",$dcnos);
		for($i=1;$i<count($dcnos);$i++)
		{
			$sql3="update trans set effdate='".date('Y-m-d', strtotime($inend. ' + 1 days'))."' where dcno='".$dcnos[$i]."' and intype!='DAILY' and dctype='rental'";		
			$conn->query($sql3);
		}	
		$sql4="select * from cusmaster where cuscode='".$cuscode."'";
		$result4=$conn->query($sql4);
		$row4=$result4->fetch_assoc();
		$tot = intval($row4['balance'])+intval($total);
		$sql5="update cusmaster set balance='".$tot."' where cuscode='".$cuscode."'";
		$conn->query($sql5);
		$conn->error;
		
	}
	else
	{
		echo "0";
		$sql="select * from incount";
		$result=$conn->query($sql);
		$row=$result->fetch_assoc();
		$sql1="update incount set count='".((int)$row['count']+1)."'";
		$conn->query($sql1);
		$dcnos=explode("$",$dcnos);
		$sql2="update trans set effdate='0000-00-00' where dcno='".$dcnos[1]."'";
		$conn->query($sql2);
		$sql4="select * from cusmaster where cuscode='".$cuscode."'";
		$result4=$conn->query($sql4);
		$row4=$result4->fetch_assoc();
		$tot = intval($row4['balance'])+intval($total);
		$sql5="update cusmaster set balance='".$tot."' where cuscode='".$cuscode."'";
		$conn->query($sql5);
		$conn->error;
		
	}
}
 else
{
    echo "Error: " . $sql . "<br>" . $conn->error;
}

}
?>
