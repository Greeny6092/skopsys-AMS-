<?php include('../../database.php') ;


$t=$_POST['t'];
if ($t=='1') {

	$sql = "SELECT * from dc where slno='".$_POST['sno']."'";
	//echo $sql;
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	foreach ($row as $data) {
		echo str_replace("&","and",$data)."&";
	}
}
if($t=='2')
{ $l=$_POST['l'];
	?>
	<?php
	// $sql = "select * from dc where cuscode like '%".$l."%' or companyname like '%".$l."%' or dcno like '%".$l."%' or scount like '%".$l."%' or dctype like '%".$l."%' order by slno desc";
	$sql = "select * from dc where cuscode  like 'CUS%' and cuscode like '%".$l."%' and dctype!='return' or cuscode  like 'CUS%' and  companyname like '%".$l."%' and dctype!='return' or cuscode  like 'CUS%' and  dcno like '%".$l."%' and dctype!='return' or cuscode  like 'CUS%' and  scount like '%".$l."%' and dctype!='return' or cuscode  like 'CUS%' and  dctype like '%".$l."%' and dctype!='return' order by slno desc";
	//$sql="select distinct dcno from dc order by slno desc ";
	$result = $conn->query($sql);
	$i=1;
	if ($result->num_rows > 0){ ?>
  <table class="table table-striped table-hover table-bordered ">
    <thead class="thead-dark">

      <th>Customer Code</th>
      <th>Customer Name</th>
      <th>DCNO</th>
	  <th>DC Date</th>
      <th>Serial Count</th>
      <th>DC Type</th>
	  <th>View</th>
    </thead>
    <tbody>

<?php
	$dcnos=array();	
	while($row = $result->fetch_assoc()){
	 		$flag=0;
				 foreach($dcnos as $dcno)
		if($dcno==$row['dcno'])
		{
			$flag=1;
			break;
		}
		if($flag==0)
		{
			echo "<tr ><td>".$row["cuscode"]."</td><td>".$row["companyname"]."</td><td>".$row["dcno"]."</td><td>".$row['dcdate']."</td><td>".$row["scount"]."</td><td>".$row["dctype"]."</td><td><button type='button' class='btn btn-dark' data-toggle='modal' data-target='#exampleModal' onclick=\"fillpreview('".$row['slno']."')\">View</button></td></tr>";		
			array_push($dcnos,$row['dcno']);			
		}
	}
    ?>
    </tbody>
  </table>

  <?php }
	else{
		echo "<h1> No Records Found</h1>";
	}
	
}	
	?>
	
	
	

	<?php




if($t=="req")
{
//	echo "enterd req";
	$slno=$_POST['slno'];
	$sql="select * from dc where slno=".$slno;
//echo $sql;
	$result=$conn->query($sql);
	$row=$result->fetch_assoc();
	echo $row['dcno']."&".$row['cuscode']."&".$row['tcode']."&".$row['dcdate']."&".$row['intype']."&".$row['rang']."&".$row['dctype']."&".$row['orderby']."&".$row['orderno']."&".$row['baddress']."&".$row['daddress']."&".$row['serials']."&".$row['cdate']."&".$row['source']."&".$row['companyname']."&".$row['scount'];
}




?>







<?php

if($t=='21')
{ $l=$_POST['l'];
	?>
	<?php
	 $sql = "select * from dc where cuscode not like 'CUS%' and cuscode like '%".$l."%' and dctype!='return' or cuscode not like 'CUS%' and  companyname like '%".$l."%' and dctype!='return' or cuscode not like 'CUS%' and  dcno like '%".$l."%' and dctype!='return' or cuscode not like 'CUS%' and  scount like '%".$l."%' and dctype!='return' or cuscode not like 'CUS%' and  dctype like '%".$l."%' and dctype!='return' order by slno desc";
	$result = $conn->query($sql);
	$i=1;
	if ($result->num_rows > 0){ ?>
  <table class="table table-striped table-hover table-bordered ">
    <thead class="thead-dark">

      <th>Customer Code</th>
      <th>Customer Name</th>
      <th>DCNO</th>
	  <th>DC Date</th>
      <th>Serial Count</th>
      <th>DC Type</th>
	  <th>View</th>
    </thead>
    <tbody>

<?php
	$dcnos=array();	
	while($row = $result->fetch_assoc()){
	 		$flag=0;
				 foreach($dcnos as $dcno)
		if($dcno==$row['dcno'])
		{
			$flag=1;
			break;
		}
		if($flag==0)
		{
			echo "<tr ><td>".$row["cuscode"]."</td><td>".$row["companyname"]."</td><td>".$row["dcno"]."</td><td>".$row['dcdate']."</td><td>".$row["scount"]."</td><td>".$row["dctype"]."</td><td><button type='button' class='btn btn-dark' data-toggle='modal' data-target='#exampleModal' onclick=\"fillpreview('".$row['slno']."')\">View</button></td></tr>";		
			array_push($dcnos,$row['dcno']);			
		}
	}
    ?>
    </tbody>
  </table>

  <?php }
	else{
		echo "<h1> No Records Found</h1>";
	}
	
}	
	?>


<?php

if($t=='22')
{ $l=$_POST['l'];
	?>
	<?php
	// $sql = "select * from dc where cuscode like '%".$l."%' or companyname like '%".$l."%' or dcno like '%".$l."%' or scount like '%".$l."%' or dctype like '%".$l."%' order by slno desc";
	$sql = "select * from dc where cuscode  like 'CUS%' and cuscode like '%".$l."%' and dctype='return' or cuscode  like 'CUS%' and  companyname like '%".$l."%' and dctype='return' or cuscode  like 'CUS%' and  dcno like '%".$l."%' and dctype='return' or cuscode  like 'CUS%' and  scount like '%".$l."%' and dctype='return' or cuscode  like 'CUS%' and  dctype like '%".$l."%' and dctype='return' order by slno desc";
	$result = $conn->query($sql);
	$i=1;
	if ($result->num_rows > 0){ ?>
  <table class="table table-striped table-hover table-bordered ">
    <thead class="thead-dark">

      <th>Customer Code</th>
      <th>Customer Name</th>
      <th>DCNO</th>
	  <th>DC Date</th>
      <th>Serial Count</th>
      <th>DC Type</th>
	  <th>View</th>
    </thead>
    <tbody>

<?php
	$dcnos=array();	
	while($row = $result->fetch_assoc()){
	 		$flag=0;
				 foreach($dcnos as $dcno)
		if($dcno==$row['dcno'])
		{
			$flag=1;
			break;
		}
		if($flag==0)
		{
			echo "<tr ><td>".$row["cuscode"]."</td><td>".$row["companyname"]."</td><td>".$row["dcno"]."</td><td>".$row['dcdate']."</td><td>".$row["scount"]."</td><td>".$row["dctype"]."</td><td><button type='button' class='btn btn-dark' data-toggle='modal' data-target='#exampleModal' onclick=\"fillpreview('".$row['slno']."')\">View</button></td></tr>";		
			array_push($dcnos,$row['dcno']);			
		}
	}
    ?>
    </tbody>
  </table>

  <?php }
	else{
		echo "<h1> No Records Found</h1>";
	}
	
}	
	?>
	
	
<?php

if($t=='2121')
{ $l=$_POST['l'];
	?>
	<?php
	 $sql = "select * from dc where cuscode not like 'CUS%' and cuscode like '%".$l."%' and dctype='return' or cuscode not like 'CUS%' and  companyname like '%".$l."%' and dctype='return' or cuscode not like 'CUS%' and  dcno like '%".$l."%' and dctype='return' or cuscode not like 'CUS%' and  scount like '%".$l."%' and dctype='return' or cuscode not like 'CUS%' and  dctype like '%".$l."%' and dctype='return' order by slno desc";
	$result = $conn->query($sql);
	$i=1;
	if ($result->num_rows > 0){ ?>
  <table class="table table-striped table-hover table-bordered ">
    <thead class="thead-dark">

      <th>Customer Code</th>
      <th>Customer Name</th>
      <th>DCNO</th>
	  <th>DC Date</th>
      <th>Serial Count</th>
      <th>DC Type</th>
	  <th>View</th>
    </thead>
    <tbody>

<?php
	$dcnos=array();	
	while($row = $result->fetch_assoc()){
	 		$flag=0;
				 foreach($dcnos as $dcno)
		if($dcno==$row['dcno'])
		{
			$flag=1;
			break;
		}
		if($flag==0)
		{
			echo "<tr ><td>".$row["cuscode"]."</td><td>".$row["companyname"]."</td><td>".$row["dcno"]."</td><td>".$row['dcdate']."</td><td>".$row["scount"]."</td><td>".$row["dctype"]."</td><td><button type='button' class='btn btn-dark' data-toggle='modal' data-target='#exampleModal' onclick=\"fillpreview('".$row['slno']."')\">View</button></td></tr>";		
			array_push($dcnos,$row['dcno']);			
		}
	}
    ?>
    </tbody>
  </table>

  <?php }
	else{
		echo "<h1> No Records Found</h1>";
	}
	
}	
	?>
	
	