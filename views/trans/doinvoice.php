<?php include('../../database.php');
$cuscode=$_POST['cuscode'];
$paytype=$_POST['paytype'];
//$dcno=$_POST['dcno'];
if($paytype=="1" || $paytype=="2")
{
	$sql0="select * from trans where cuscode='".$cuscode."' and intype!='DAILY' and dctype!='testing' and dctype!='sales'";
	$result0=$conn->query($sql0);
	while($row0=$result0->fetch_assoc())
	{
	$dcno=$row0['dcno'];
	$sql="select  distinct a.prodesc,a.hsncode,a.saccode,d.companyname,d.baddress,a.prodcatname,b.costpm from promaster as a,enterorder as b,trans as c,cusmaster as d where c.tcode=b.tcode and b.serial=a.serial and b.cuscode=d.cuscode and c.dcno='".$dcno."'  order by b.costpm asc ";
	//echo $sql."<br>";
	//echo $sql."<br>";
	$result=$conn->query($sql);
	$add="";
	$desc="";
	$count="";
	$costpm="";
	$hsnsac="";
	//echo $conn->error."<br>";
	if($result->num_rows>0)
	{
		$row=$result->fetch_assoc();
		$add=$row['baddress'];
		//echo $row['baddress']."<br>";
		$desc=$row["prodcatname"]."-".$row['prodesc'];
		$hsnsac=$row['hsncode']."/".$row['saccode'];
		$costpm=$row['costpm'];
	while($row=$result->fetch_assoc())
	{
		$desc.="#".$row["prodcatname"]."-".$row['prodesc'];
		$hsnsac.="#".$row['hsncode']."/".$row['saccode'];
		$costpm.="$".$row['costpm'];
	}
	}
	//echo "add :".$add."<br>";
	//echo "descs :".$desc."<br>";
	$temp=explode("#",$desc);
	$c=explode("$",$costpm);
	$i=0;
	foreach($temp as $temp1)
	{
		$temp2=explode("-",$temp1);
		$sql="select  b.costpm,count(b.costpm) from promaster as a,enterorder as b,trans as c,cusmaster as d where c.tcode= b.tcode and b.serial=a.serial and b.cuscode=d.cuscode and c.dcno='".$dcno."' and a.prodesc='".$temp2[1]."' and b.costpm='".$c[$i]."' group by b.costpm order by b.costpm asc";
		//echo $sql."<br>";
		$result=$conn->query($sql);
		//$row=$result->fetch_assoc();
		//echo $conn->error;
		//$cost=0;
		$row=$result->fetch_assoc();
		//$costpm=$row['costpm'];
		$count.="$".$row['count(b.costpm)'];
		$i++;
	}
	//echo $sql."<br>";
	//$sql="select a.prodesc,count(a.prodesc) from promaster as a,enterorder as b,trans as c,cusmaster as d where c.tcode= b.tcode and b.serial=a.serial and b.cuscode=d.cuscode and c.dcno='".$dcno."' group by a.prodesc order by a.prodesc asc";
	/*$result=$conn->query($sql);
	if($result->num_rows>0)
	{
		$row=$result->fetch_assoc();
		$count=$row['count(a.prodesc)'];
	while($row=$result->fetch_assoc())
		$count.="$".$row['count(a.prodesc)'];
	}*/
	//echo "count :".$count."<br>";
	//$sql="select b.costpm,count(b.costpm) from promaster as a,enterorder as b,trans as c,cusmaster as d where c.tcode= b.tcode and b.serial=a.serial and b.cuscode=d.cuscode and c.dcno='".$dcno."' group by b.costpm";
	//echo $sql."<br>";
	$count[0]=" ";
	$count=trim($count," ");
	$sql="select a.statecode from cusmaster as a,trans as b where b.dcno='".$dcno."' and a.cuscode=b.cuscode";
	$result=$conn->query($sql);
	$row=$result->fetch_assoc();
	$gst=$row['statecode'];

	$sql3="select cuscode from trans where dcno='".$dcno."'";
	$result3=$conn->query($sql3);
	$row3=$result3->fetch_assoc();
	$sql4="select * from cusmaster where cuscode='".$row3['cuscode']."'";
	$result4=$conn->query($sql4);
	$row4=$result4->fetch_assoc();
	$sql5="select * from trans where dcno='".$dcno."'";
	$result5=$conn->query($sql5);
	$row5=$result5->fetch_assoc();
	echo $add."&".$desc."&".$count."&".$costpm."&".$gst."&".$hsnsac."&".$row4['gstno']."&".$row4['companyname']."&".$dcno."&".$row5['effdate']."~";
	}
}
else if($paytype=="3")
{
	$dcno=$_POST['dcno'];
	$sql="select  distinct a.prodesc,a.hsncode,a.saccode,d.companyname,d.baddress,a.prodcatname,b.costpm from promaster as a,enterorder as b,trans as c,cusmaster as d where c.tcode=b.tcode and b.serial=a.serial and b.cuscode=d.cuscode and c.dcno='".$dcno."' order by b.costpm asc ";
	//echo $sql."<br>";
	//echo $sql."<br>";
	$result=$conn->query($sql);
	$add="";
	$desc="";
	$count="";
	$costpm="";
	$hsnsac="";
	//echo $conn->error."<br>";
	if($result->num_rows>0)
	{
		$row=$result->fetch_assoc();
		$add=$row['baddress'];
		//echo $row['baddress']."<br>";
		$desc=$row["prodcatname"]."-".$row['prodesc'];
		$hsnsac=$row['hsncode']."/".$row['saccode'];
		$costpm=$row['costpm'];
	while($row=$result->fetch_assoc())
	{
		$desc.="#".$row["prodcatname"]."-".$row['prodesc'];
		$hsnsac.="#".$row['hsncode']."/".$row['saccode'];
		$costpm.="$".$row['costpm'];
	}
	}
	//echo "add :".$add."<br>";
	//echo "descs :".$desc."<br>";
	$temp=explode("#",$desc);
	$c=explode("$",$costpm);
	$i=0;
	foreach($temp as $temp1)
	{
		$temp2=explode("-",$temp1);
		$sql="select  b.costpm,count(b.costpm) from promaster as a,enterorder as b,trans as c,cusmaster as d where c.tcode= b.tcode and b.serial=a.serial and b.cuscode=d.cuscode and c.dcno='".$dcno."' and a.prodesc='".$temp2[1]."' and b.costpm='".$c[$i]."' group by b.costpm order by b.costpm asc";
		//echo $sql."<br>";
		$result=$conn->query($sql);
		//$row=$result->fetch_assoc();
		//echo $conn->error;
		//$cost=0;
		$row=$result->fetch_assoc();
		//$costpm=$row['costpm'];
		$count.="$".$row['count(b.costpm)'];
		$i++;
	}
	//echo $sql."<br>";
	//$sql="select a.prodesc,count(a.prodesc) from promaster as a,enterorder as b,trans as c,cusmaster as d where c.tcode= b.tcode and b.serial=a.serial and b.cuscode=d.cuscode and c.dcno='".$dcno."' group by a.prodesc order by a.prodesc asc";
	/*$result=$conn->query($sql);
	if($result->num_rows>0)
	{
		$row=$result->fetch_assoc();
		$count=$row['count(a.prodesc)'];
	while($row=$result->fetch_assoc())
		$count.="$".$row['count(a.prodesc)'];
	}*/
	//echo "count :".$count."<br>";
	//$sql="select b.costpm,count(b.costpm) from promaster as a,enterorder as b,trans as c,cusmaster as d where c.tcode= b.tcode and b.serial=a.serial and b.cuscode=d.cuscode and c.dcno='".$dcno."' group by b.costpm";
	//echo $sql."<br>";
	$count[0]=" ";
	$count=trim($count," ");
	$sql="select a.statecode from cusmaster as a,trans as b where b.dcno='".$dcno."' and a.cuscode=b.cuscode";
	$result=$conn->query($sql);
	$row=$result->fetch_assoc();
	$gst=$row['statecode'];

	$sql3="select cuscode from trans where dcno='".$dcno."'";
	$result3=$conn->query($sql3);
	$row3=$result3->fetch_assoc();
	$sql4="select * from cusmaster where cuscode='".$row3['cuscode']."'";
	$result4=$conn->query($sql4);
	$row4=$result4->fetch_assoc();
	$sql5="select * from trans where dcno='".$dcno."'";
	$result5=$conn->query($sql5);
	$row5=$result5->fetch_assoc();
	echo $add."&".$desc."&".$count."&".$costpm."&".$gst."&".$hsnsac."&".$row4['gstno']."&".$row4['companyname']."&".$dcno."&".$row5['effdate']."~";
}
else if($paytype=="4"){
	$dcno=$_POST['dcno'];
	$sql="select  distinct a.prodesc,a.hsncode,a.saccode,d.companyname,d.baddress,a.prodcatname,b.costpm from promaster as a,enterorder as b,trans as c,cusmaster as d where c.tcode=b.tcode and b.serial=a.serial and b.cuscode=d.cuscode and c.dcno='".$dcno."' order by b.costpm asc ";
	//echo $sql."<br>";
	//echo $sql."<br>";
	$result=$conn->query($sql);
	$add="";
	$desc="";
	$count="";
	$costpm="";
	$hsnsac="";
	//echo $conn->error."<br>";
	if($result->num_rows>0)
	{
		$row=$result->fetch_assoc();
		$add=$row['baddress'];
		//echo $row['baddress']."<br>";
		$desc=$row["prodcatname"]."-".$row['prodesc'];
		$hsnsac=$row['hsncode']."/".$row['saccode'];
		$costpm=$row['costpm'];
	while($row=$result->fetch_assoc())
	{
		$desc.="#".$row["prodcatname"]."-".$row['prodesc'];
		$hsnsac.="#".$row['hsncode']."/".$row['saccode'];
		$costpm.="$".$row['costpm'];
	}
	}
	//echo "add :".$add."<br>";
	//echo "descs :".$desc."<br>";
	$temp=explode("#",$desc);
	$c=explode("$",$costpm);
	$i=0;
	foreach($temp as $temp1)
	{
		$temp2=explode("-",$temp1);
		$sql="select  b.costpm,count(b.costpm) from promaster as a,enterorder as b,trans as c,cusmaster as d where c.tcode= b.tcode and b.serial=a.serial and b.cuscode=d.cuscode and c.dcno='".$dcno."' and a.prodesc='".$temp2[1]."' and b.costpm='".$c[$i]."' group by b.costpm order by b.costpm asc";
		//echo $sql."<br>";
		$result=$conn->query($sql);
		//$row=$result->fetch_assoc();
		//echo $conn->error;
		//$cost=0;
		$row=$result->fetch_assoc();
		//$costpm=$row['costpm'];
		$count.="$".$row['count(b.costpm)'];
		$i++;
	}
	//echo $sql."<br>";
	//$sql="select a.prodesc,count(a.prodesc) from promaster as a,enterorder as b,trans as c,cusmaster as d where c.tcode= b.tcode and b.serial=a.serial and b.cuscode=d.cuscode and c.dcno='".$dcno."' group by a.prodesc order by a.prodesc asc";
	/*$result=$conn->query($sql);
	if($result->num_rows>0)
	{
		$row=$result->fetch_assoc();
		$count=$row['count(a.prodesc)'];
	while($row=$result->fetch_assoc())
		$count.="$".$row['count(a.prodesc)'];
	}*/
	//echo "count :".$count."<br>";
	//$sql="select b.costpm,count(b.costpm) from promaster as a,enterorder as b,trans as c,cusmaster as d where c.tcode= b.tcode and b.serial=a.serial and b.cuscode=d.cuscode and c.dcno='".$dcno."' group by b.costpm";
	//echo $sql."<br>";
	$count[0]=" ";
	$count=trim($count," ");
	$sql="select a.statecode from cusmaster as a,trans as b where b.dcno='".$dcno."' and a.cuscode=b.cuscode";
	$result=$conn->query($sql);
	$row=$result->fetch_assoc();
	$gst=$row['statecode'];

	$sql3="select cuscode from trans where dcno='".$dcno."'";
	$result3=$conn->query($sql3);
	$row3=$result3->fetch_assoc();
	$sql4="select * from cusmaster where cuscode='".$row3['cuscode']."'";
	$result4=$conn->query($sql4);
	$row4=$result4->fetch_assoc();
	$sql5="select * from trans where dcno='".$dcno."'";
	$result5=$conn->query($sql5);
	$row5=$result5->fetch_assoc();
	echo $add."&".$desc."&".$count."&".$costpm."&".$gst."&".$hsnsac."&".$row4['gstno']."&".$row4['companyname']."&".$dcno."&".$row5['effdate']."~";
}
?>
