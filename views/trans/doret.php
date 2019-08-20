<?php
include '../../database.php';
if(isset($_POST['noi']))
	$noi=$_POST['noi'];
if(isset($_POST['serial']))
	$serial=$_POST['serial'];
if(isset($_POST['noi']))
	$status=$_POST['status'];
if(isset($_POST['typ']))
	$typ=$_POST['typ'];
$tcode=[];
if ($typ == "ret") {
  $serial[0]=" ";
  $serial=trim($serial," ");
  //echo $serial."<br><br>";
  $serial=explode("$",$serial);
  foreach($serial as $ser){
    $sql = "select tcode from enterorder where serial='".$ser."'";
    $result3=$conn->query($sql);
    $row = $result3->fetch_assoc();
    array_push($tcode,$row['tcode']);
    $sql = "UPDATE promaster set status='".$status."' where serial='".$ser."'";
    $result1=$conn->query($sql);
    $sql = "DELETE from enterorder where serial='".$ser."'";
    $result2=$conn->query($sql);
  }
  //here
  array_unique($tcode);
  //print_r($tcode);
  $sql = "select tcode from enterorder";
  $result=$conn->query($sql);
  while($row = $result->fetch_assoc()){
    foreach ($tcode as $tc) {
      if($tc===$row['tcode']){
        $tcode = array_diff($tcode,$tc);
        //echo "enter <br>";
      }
    }
  }
  //print_r($tcode);
  $dcno=[];
  foreach ($tcode as $t) {
    $sql = "select dcno from trans where tcode='".$t."'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    array_push($dcno,$row['dcno']);
    $sql = "delete from trans where tcode='".$t."'";
    //echo "<br> ".$sql;
    $conn->query($sql);
    echo $conn->error;
    $sql = "delete from rep where tcode='".$t."'";
    //echo "<br> ".$sql;
    $conn->query($sql);
    echo $conn->error;
  }

  foreach ($dcno as $d) {
    $sql = "delete from invoice where dcno='".$d."'";
    //echo "<br> ".$sql;
    $conn->query($sql);
    echo $conn->error;
  }

  if ($result1===true && $result2 === true) {
    if ($status=="ACTIVE" || $status == "REPAIR") {
      echo "1";
    }
    else if ($status=="SCRAP") {
      echo "2";
    }

  }
  else {
    echo $conn->error;
  }
}
if($typ === "inc")
{
	if($_POST['paytype']!="3")
	{
		$cuscode=$_POST['cuscode'];
		
		$ven="";
		
		{
		$sql="select * from enterorder where cuscode='".$cuscode."' and flag='1'";
		$result=$conn->query($sql);
		$sc="";
		while($row=$result->fetch_assoc())
		{
			$sc.="$".$row['serial'];}
		//echo "sl : ".$sql;
		$sc=explode("$", $sc);
		$n=count($sc);
		
		for($i=1;$i<$n;$i++)
		{
		$sql="select * from promaster where serial='".$sc[$i]."'";	
		$result=$conn->query($sql);
		$row=$result->fetch_assoc();
		$ven.="$".$row['vencode'][0].$row['vencode'][1];
		}
		}
		$sc=explode("$",$ven);
		$sp=array_unique($sc);
		$n=count($sp);
		//print_r($n);
		$counts = array_count_values($sc);
		//print_r($sp);
		//print_r($counts);
		$ch=0;
		foreach($sp as $i)//$i=1;$i<$n;$i++)
		{
			if($ch==0)
			{
				$ch=1;
				continue;
			}
		 echo $i.$counts[$i]." ";			
		}
		//echo 'hello'.$ven;
		//print_r($);
			
		$year=date('Y');
		$month=date('m');
		$sql1="select * from incount";
		$result1=$conn->query($sql1);
		$row1=$result1->fetch_assoc();
		$in="IN".$year.$month;
		
		if(($row1['count']+1)>999)
			$in.=($row1['count']+1);
		else
		if(($row1['count']+1)>99)
			$in.="0".($row1['count']+1);
		else
		if(($row1['count']+1)>9)
			$in.="00".($row1['count']+1);
		else	
			$in.="000".($row1['count']+1);
		echo "$".$in;
	}
	else
	{
		//$cuscode=$_POST['cuscode'];
		$dcno=$_POST['dcno'];
		$sql0="select * from trans where dcno='".$dcno."'";
		$result0=$conn->query($sql0);
		$row0=$result0->fetch_assoc();
		$ven="";
		
		{
		$sql="select * from enterorder where tcode='".$row0['tcode']."' and flag='1'";
		$result=$conn->query($sql);
		$sc="";
		while($row=$result->fetch_assoc())
		{
			$sc.="$".$row['serial'];}
		//echo "sl : ".$sql;
		$sc=explode("$", $sc);
		$n=count($sc);
		
		for($i=1;$i<$n;$i++)
		{
		$sql="select * from promaster where serial='".$sc[$i]."'";	
		$result=$conn->query($sql);
		$row=$result->fetch_assoc();
		$ven.="$".$row['vencode'][0].$row['vencode'][1];
		}
		}
		$sc=explode("$",$ven);
		$sp=array_unique($sc);
		$n=count($sp);
		$counts = array_count_values($sc);
		for($i=1;$i<$n;$i++)
		{
		 echo $sp[$i].$counts[$sp[$i]]." ";	
		}
		//echo 'hello'.$ven;
		//print_r($);
			
		$year=date('Y');
		$month=date('m');
		$sql1="select * from incount";
		$result1=$conn->query($sql1);
		$row1=$result1->fetch_assoc();
		$in="IN".$year.$month;
		
		if(($row1['count']+1)>999)
			$in.=($row1['count']+1);
		else
		if(($row1['count']+1)>99)
			$in.="0".($row1['count']+1);
		else
		if(($row1['count']+1)>9)
			$in.="00".($row1['count']+1);
		else	
			$in.="000".($row1['count']+1);
		echo "$".$in;
	}
}
?>
