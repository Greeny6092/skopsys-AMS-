<?php
include '../../database.php';

if(isset($_POST['typ']))
{	
$typ=$_POST['typ'];

if ($typ=='1') {
  $sql="select * from invoices where billno='".$_POST['billno']."'";
  $result=$conn->query($sql);
  $row=$result->fetch_assoc();
  foreach($row as $data){
    echo $data."&";
  }
}
if ($typ=='2') {
  $sql="select * from cusmaster where cuscode='".$_POST['code']."'";
  $result=$conn->query($sql);
  $row=$result->fetch_assoc();
  echo $row['statecode'];
}
}
if(isset($_POST['t']))
{
	if($_POST['t']=='2'){
	$l=$_POST['l'];
	?>
	
	<?php
	 $sql = "select * from invoices where cuscode like '%".$l."%' or companyname like '%".$l."%' or dcno like '%".$l."%' or dcdate like '%".$l."%' or billno like '%".$l."%' or indate like '%".$l."%' or subtotal like '%".$l."%' or discount like '%".$l."%' order by slno desc";
	//echo $sql;
	$result = $conn->query($sql);
	//echo $sql;
	$i=1;
	if ($result->num_rows > 0){ ?>
                    <table class="table table-striped table-hover table-bordered ">
                        <thead class="thead-dark">
                            <th>Customer Code</th>
                            <th>Customer Name</th>
                            <th>Delvery Challan NO</th>
                            <th>Delvery Challan Date</th>
                            <th>CInvoice No</th>
                            <th>CInvoice Date</th>
                            <th>Invoice Amount</th>
                            <th>Discount</th>
                            <th>View</th>
                        </thead>
                        <tbody>
                            <?php
	while($row = $result->fetch_assoc()){
	 echo "<tr ><td>".$row["cuscode"]."</td><td>".$row["companyname"]."</td><td>".$row["dcno"]."</td><td>".$row["dcdate"]."</td><td>".$row["billno"]."</td><td>".$row["indate"]."</td><td>".$row["subtotal"]."</td><td>".$row["discount"]."</td><td><button type='button' class='btn btn-dark' data-toggle='modal' data-target='#exampleModal' onclick=\"fillpreview('".$row['slno']."')\">View</button></td></tr>";
	}
    ?>
                        </tbody>
                    </table>

                    <?php }
	else{
		echo "<h1> No Records Found</h1>";
	}
	?>
	
<?php	
	
	}
}
?>
