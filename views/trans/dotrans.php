<?php include('../../database.php');
//echo "h";
    if(isset($_POST['typ']))
	$typ=$_POST['typ'];
if(isset($_POST['cuscode']))
	$cuscode=$_POST['cuscode'];
if(isset($_POST['tcode']))
	$tcode=$_POST['tcode'];
if(isset($_POST['dcdate']))
	$dcdate=$_POST['dcdate'];
if(isset($_POST['intype']))
	$intype=$_POST['intype'];
if(isset($_POST['range']))
	$range=$_POST['range'];
if(isset($_POST['dctype']))
	$dctype=$_POST['dctype'];
if(isset($_POST['orderby']))
	$orderby=$_POST['orderby'];
if(isset($_POST['orderno']))
	$orderno=$_POST['orderno'];
if(isset($_POST['daddress']))
	$daddress=$_POST['daddress'];
if(isset($_POST['effdate']))
	$effdate=$_POST['effdate'];



if($typ === "1"){
$cuscode=$_POST['cuscode'];
//echo "cuscode is ".$cuscode."<br>";
$sql="select tcode from enterorder where cuscode='".$cuscode."' and flag='0' group by tcode";
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

	if($cuscode[0]=='C'&&$cuscode[1]=='U'&&$cuscode[2]=='S')
	{
		$result=$conn->query("select * from cusmaster where cuscode='".$cuscode."'");
		$row=$result->fetch_assoc();
		$result1=$conn->query("select gstno from cusmaster where cuscode='".$cuscode."'");
		$row1=$result1->fetch_assoc();
		//echo $conn->error;
		echo $row['paytype']."$".$row['baddress']."$".$row['daddress']."$".$row1['gstno'];
	}
	else
	{
		$result=$conn->query("select * from venmaster where vencode='".$cuscode."'");
		$row=$result->fetch_assoc();
		$result1=$conn->query("select gstno from venmaster where vencode='".$cuscode."'");
		$row1=$result1->fetch_assoc();
		//echo $conn->error;
		echo " $".$row['address1']."$".$row['address2']."$".$row1['gstno'];
	}

}
if($typ=="save")
{
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
			//echo "<br>".$code;

	$sql = "INSERT INTO trans (`dcno`,`cuscode`,`tcode`,`dcdate`,`intype`,`rang`,`dctype`,`orderby`,`orderno`,`daddress`,`effdate`) VALUES ('".$code."','".$cuscode."','".$tcode."','".$dcdate."','".$intype."','".$range."','".$dctype."','".$orderby."','".$orderno."','".$daddress."','".$effdate."')";

	//echo $sql."<br />";
  if ($conn->query($sql) === TRUE) {
    echo "1";
    }
	else
		echo "Error: " . $sql . "<br>" . $conn->error;

    $sql ="update enterorder set flag='1' where tcode='".$tcode."'";
    if ($conn->query($sql) === TRUE) {
      echo "1";
      }
    else
      echo "Error: " . $sql . "<br>" . $conn->error;

	$serial=$_POST['serial'];
	//echo $serial;
	$serial[0]=" ";
	$serial=trim($serial," ");
	//echo $serial;
	$serial=explode("$",$serial);
	//echo $serial;
	$status="";

  $costpm=$_POST['costpm'];
  $costpm[0]=" ";
  $costpm=trim($costpm," ");
  $costpm=explode("$",$costpm);
  //print_r($costpm);
	foreach(array_combine($serial,$costpm) as $ser => $cost)
	{
    //echo $ser." ".$cost;
		$ser=explode("-",$ser);
			$status="RENTAL";
		$sql="update promaster set status='".$status."' where serial='".$ser[0]."'";
    //echo $sql;
		$conn->query($sql);
    $sql = "update enterorder set costpm='".$cost."' where serial='".$ser[0]."'";
    //echo $sql;
    $conn->query($sql);
	}

  if($dctype=="rental"||$dctype=="sales"){
  //echo "invoice creating";
  $count=0;
	$year=date('Y').date('Y')+1;
	//echo $year."<br>";
	$month=date('m');
	//echo $month."<br>";
	if($month<4)
		{
			$year=(date('Y')-1).date('Y');
			//echo $year."<br>";
		}
	  $code1="IN".date('Y').$month;

		$sql ="select * from incount where year='".$year."'";
		$result = $conn->query($sql);

		if ($result->num_rows == 0){
			$sql = "INSERT INTO incount(`year`) values('".$year."')";
			$result=$conn->query($sql);
			//echo "new inserted <br>";

		}
			//echo $year."<br>";
			$sql ="select * from incount where year='".$year."'";
			$result = $conn->query($sql);
			//echo $conn->error;
			$row=$result->fetch_assoc();
			$count=$row['count'];
			//echo "<br>current count is ".$count."<br>";
			$count++;
			//echo "incremented count is ".$count."<br>";
			$conn->query("update incount set count=".$count." where year='".$year."'");
			//echo $conn->error;
			$code1.=$count;

			$sql = "INSERT INTO invoice (`dcno`,`iid`,`bdate`,`lbdate`) VALUES ('".$code."','".$code1."','".$effdate."','".$effdate."')";
      $result = $conn->query($sql);
			//echo $sql."<br />";
		if ($result === TRUE) {
		    echo "1";
		   }
			else
				echo "Error: " . $sql . "<br>" . $conn->error;
  }
 		b:;
}
if($typ == "update")
{
  $serial=$_POST['serial'];
	//echo $serial;
	$serial[0]=" ";
	$serial=trim($serial," ");
	//echo $serial;
	$serial=explode("$",$serial);
	//print_r($serial);
	$status="";

  $costpm=$_POST['costpm'];
  $costpm[0]=" ";
  $costpm=trim($costpm," ");
  $costpm=explode("$",$costpm);
  //print_r($costpm);
	foreach(array_combine($serial,$costpm) as $ser => $cost)
	{
    //echo $ser." ".$cost;
		$ser=explode("-",$ser);
			$status="RENTAL";
		$sql="update promaster set status='".$status."' where serial='".$ser[0]."'";
    //echo $sql;
		$conn->query($sql);
    $sql = "update enterorder set costpm='".$cost."' where serial='".$ser[0]."'";
    //echo $sql;
    $conn->query($sql);
	}

	$sql="update trans set  cuscode='".$_POST["cuscode"]."',tcode='".$_POST["tcode"]."',dcdate='".$_POST["dcdate"]."',intype='".$intype."',rang='".$range."',dctype='".$dctype."',orderby='".$orderby."',orderno='".$orderno."',daddress='".$daddress."',effdate='".$effdate."' where dcno='".$_POST["dcno"]."'";
	//echo $sql;
	if ($conn->query($sql) === TRUE) {
    echo "2";
	#echo $_POST["code"];
    }
	else{
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

  $sql = "select * from invoice where dcno='".$_POST["dcno"]."'";
  $result = $conn->query($sql);


if($result->num_rows==0){
  if($dctype=="rental"||$dctype=="sales"){
    
  $code = $_POST["dcno"];
  //echo "invoice creating";
  $count=0;
	$year=date('Y').date('Y')+1;
	//echo $year."<br>";
	$month=date('m');
	//echo $month."<br>";
	if($month<4)
		{
			$year=(date('Y')-1).date('Y');
			//echo $year."<br>";
		}
	  $code1="IN".date('Y').$month;

		$sql ="select * from incount where year='".$year."'";
		$result = $conn->query($sql);

		if ($result->num_rows == 0){
			$sql = "INSERT INTO incount(`year`) values('".$year."')";
			$result=$conn->query($sql);
			//echo "new inserted <br>";

		}
			//echo $year."<br>";
			$sql ="select * from incount where year='".$year."'";
			$result = $conn->query($sql);
			//echo $conn->error;
			$row=$result->fetch_assoc();
			$count=$row['count'];
			//echo "<br>current count is ".$count."<br>";
			$count++;
			//echo "incremented count is ".$count."<br>";
			$conn->query("update incount set count=".$count." where year='".$year."'");
			//echo $conn->error;
			$code1.=$count;

			$sql = "INSERT INTO invoice (`dcno`,`iid`,`bdate`,`lbdate`) VALUES ('".$_POST["dcno"]."','".$code1."','".$effdate."','".$effdate."')";
      $result = $conn->query($sql);
			//echo $sql."<br />";
    }
  }
}
if($typ==="set"){
		$sql = "select * from enterorder,promaster where enterorder.serial=promaster.serial and tcode='".$tcode."' and status!='returning'";
		//echo $sql;
		$result = $conn->query($sql);
		//$row = $result->fetch_assoc();
		//echo "count".$result->num_rows;
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
if($typ==="req"){
		//$cuscode=$_POST["cuscode"];
		$sql = "select * from trans where dcno='".$_POST['dcno']."'";
		//echo $sql;
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();
			if($result->num_rows>0){
				foreach($row as $data)
				{
						echo $data."$";
				}
			}
			else {
					echo "Error: ". $sql ."<br>". $conn->error;
			}
      $se='';
      if (isset($_POST['se'])){
        $se=$_POST['se'];
      }
      //echo "se".$se;
      if (isset($_POST['cuscode'])) {
        $sql = "select * from cusmaster where cuscode='".$_POST['cuscode']."'";
    		//echo $sql;
  			$result = $conn->query($sql);
  			$row = $result->fetch_assoc();
        echo $row['companyname'];
      }

      if (isset($_POST['vencode'])) {
        $sql = "select * from venmaster where vencode='".$_POST['vencode']."'";
    		//echo $sql;
  			$result = $conn->query($sql);
  			$row = $result->fetch_assoc();
        echo $row['vendorname'];
      }
      if ($se=='1') {
        $sql = "select * from cusmaster where cuscode='".$_POST['code']."'";
    		//echo $sql;
  			$result = $conn->query($sql);
  			$row = $result->fetch_assoc();
        echo $row['companyname'];
      }
      if ($se=='2') {
        $sql = "select * from venmaster where vencode='".$_POST['code']."'";
    		//echo $sql;
  			$result = $conn->query($sql);
  			$row = $result->fetch_assoc();
        echo $row['vendorname'];
      }
}
if($typ=="saves")
{
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
			//echo "<br>".$code;

	$sql = "INSERT INTO trans (`dcno`,`cuscode`,`tcode`,`dcdate`,`dctype`) VALUES ('".$code."','".$cuscode."','".$tcode."','".$dcdate."','".$dctype."')";

	//echo $sql."<br />";
  if ($conn->query($sql) === TRUE) {
    echo "1";
    }
	else
		echo "Error: " . $sql . "<br>" . $conn->error;

	$serial=$_POST['serial'];
	//echo $serial;
	$serial[0]=" ";
	$serial=trim($serial," ");
	//echo $serial;
	$serial=explode("$",$serial);
	//echo $serial;
	$status="";
	foreach($serial as $ser)
	{
		$ser=explode("-",$ser);
			$status="SERVICE";
		$sql="update promaster set status='".$status."' where serial='".$ser[0]."'";
		$conn->query($sql);
		//echo $sql;
	}
}
if($typ == "updates")
{
  $serial=$_POST['serial'];
	//echo $serial;
	$serial[0]=" ";
	$serial=trim($serial," ");
	//echo $serial;
	$serial=explode("$",$serial);
	//echo $serial;
	$status="";
	foreach($serial as $ser)
	{
		$ser=explode("-",$ser);
			$status="RENTAL";
		$sql="update promaster set status='".$status."' where serial='".$ser[0]."'";
		$conn->query($sql);
		//echo $sql;
	}

	$sql="update trans set  cuscode='".$_POST["cuscode"]."',tcode='".$_POST["tcode"]."',dcdate='".$_POST["dcdate"]."',dctype='".$dctype."' where dcno='".$_POST["dcno"]."'";
	//echo $sql;
	if ($conn->query($sql) === TRUE) {
    echo "2";
	#echo $_POST["code"];
    }
	else{
		echo $conn->error;
	}

}
if ($typ == 'dc') {

  $serial=$_POST['serial'];
  $serial[0]=" ";
  $serial=trim($serial," ");
  $serial=explode("$",$serial);

  foreach($serial as $seri)
  {
    $sql="update promaster set status='RETURNING' where serial='".$seri."'";
    if($conn->query($sql)){
      echo "1";
    }else{
      echo $conn->error;
    }

    //$sql="delete from enterorder where serial='".$seri."'";
    //$conn->query($sql);
  }


}
if($typ=='z')
{

?>

	<?php
	$l=$_POST['l'];
	$sql = "select * from trans as a,cusmaster as b where a.cuscode=b.cuscode and dcno like '%".$l."%' or a.cuscode=b.cuscode and companyname like '%".$l."%' or a.cuscode=b.cuscode and tcode like '%".$l."%' or a.cuscode=b.cuscode and dcdate like '%".$l."%' or a.cuscode=b.cuscode and intype like '%".$l."%' or a.cuscode=b.cuscode and rang like '%".$l."%' or a.cuscode=b.cuscode and dctype like '%".$l."%' or a.cuscode=b.cuscode and orderby like '%".$l."%' or a.cuscode=b.cuscode and orderno like '%".$l."%' or a.cuscode=b.cuscode and a.daddress like '%".$l."%'";

	$result = $conn->query($sql);
	$i=1;
	if ($result->num_rows > 0){ ?>
  <table class="table table-striped table-hover table-bordered ">
    <thead class="thead-dark">
      <th>DC no</th>
      <th>Customer code</th>
      <th>Transaction Code</th>
      <th>DC Entry Date</th>
      <th>Invoice Type</th>
      <th>Range</th>
      <th>DC type</th>
      <th>Order By</th>
      <th>Order No</th>
      <th>Delivery address</th>
    </thead>
    <tbody>
	<?php
	while($row = $result->fetch_assoc()){
	 echo "<tr onclick=\"req('".$row['dcno']."');to();\"><td>".$row["dcno"]."</td><td>".$row["companyname"]."</td><td>".$row["tcode"]."</td><td>".$row["dcdate"]."</td><td>".$row["intype"]."</td><td>".$row["rang"]."</td><td>".$row["dctype"]."</td><td>".$row["orderby"]."</td><td>".$row["orderno"]."</td><td>".$row["daddress"]."</td></tr>";
	}
    ?>
	</tbody>
  </table>
	<?php }
	else{
		echo "<h1> No Records Found</h1>";
	}
	//echo $sql;
	?>

<?php
}
if($typ=='z2')
{
	?>
	<?php
	$l=$_POST['l'];
$sql = "select * from trans,cusmaster where trans.cuscode=cusmaster.cuscode and companyname like '%".$l."%' or trans.cuscode=cusmaster.cuscode and dcno like '%".$l."%' or trans.cuscode=cusmaster.cuscode and tcode like '%".$l."%' or trans.cuscode=cusmaster.cuscode and dcdate like '%".$l."%' or trans.cuscode=cusmaster.cuscode and intype like '%".$l."%' or trans.cuscode=cusmaster.cuscode and rang like '%".$l."%' or trans.cuscode=cusmaster.cuscode and dctype like '%".$l."%' or trans.cuscode=cusmaster.cuscode and orderby like '%".$l."%' or trans.cuscode=cusmaster.cuscode and orderno like '%".$l."%' or trans.cuscode=cusmaster.cuscode and trans.daddress like '%".$l."%' ";
$result = $conn->query($sql);
$i = 1;

?>
  <table class="table table-striped table-hover table-bordered ">
    <thead class="thead-dark">
      <th>DC no</th>
      <th>Customer Name</th>
      <th>Transaction Code</th>
      <th>DC Entry Date</th>
      <th>Invoice Type</th>
      <th>Range</th>
      <th>DC type</th>
      <th>Order By</th>
      <th>Order No</th>
      <th>Delivery address</th>
    </thead>
    <tbody>
	<?php
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr onclick=\"req('" . $row['dcno'] . "','" . $row['cuscode'] . "','1');to();\"><td>" . $row["dcno"] . "</td><td>" . $row["companyname"] . "</td><td>" . $row["tcode"] . "</td><td>" . $row["dcdate"] . "</td><td>" . $row["intype"] . "</td><td>" . $row["rang"] . "</td><td>" . $row["dctype"] . "</td><td>" . $row["orderby"] . "</td><td>" . $row["orderno"] . "</td><td>" . $row["daddress"] . "</td></tr>";
    }
    }
    $sql = "select * from trans,venmaster where trans.cuscode=venmaster.vencode and vendorname like '%".$l."%' or trans.cuscode=venmaster.vencode and dcno like '%".$l."%' or trans.cuscode=venmaster.vencode and tcode like '%".$l."%' or trans.cuscode=venmaster.vencode and dcdate like '%".$l."%' or trans.cuscode=venmaster.vencode and intype like '%".$l."%' or trans.cuscode=venmaster.vencode and rang like '%".$l."%' or trans.cuscode=venmaster.vencode and dctype like '%".$l."%' or trans.cuscode=venmaster.vencode and orderby like '%".$l."%' or trans.cuscode=venmaster.vencode and orderno like '%".$l."%' or trans.cuscode=venmaster.vencode and trans.daddress like '%".$l."%'";
    //echo $sql;
	$result1 = $conn->query($sql);
    if ($result1->num_rows > 0) {
        while ($row = $result1->fetch_assoc()) {
            echo "<tr onclick=\"req('" . $row['dcno'] . "','" . $row['cuscode'] . "','2');to();\"><td>" . $row["dcno"] . "</td><td>" . $row["vendorname"] . "</td><td>" . $row["tcode"] . "</td><td>" . $row["dcdate"] . "</td><td>" . $row["intype"] . "</td><td>" . $row["rang"] . "</td><td>" . $row["dctype"] . "</td><td>" . $row["orderby"] . "</td><td>" . $row["orderno"] . "</td><td>" . $row["address1"] . "</td></tr>";
        }
      }
      if($result1->num_rows === 0 and $result->num_rows === 0){
        echo "<h2>No Record Found</h2>";
      }
    ?>

<?php
}

?>
