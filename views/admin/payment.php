<div id="up"></div>
<?php
include '../includes/head.php';
include '../../database.php';
?>

<div class="container">
  <p style="color: royalblue;">Customer Payment Details</p>
  <hr>

  <!--div class="row">
    <div class="col-lg-2 col-sm-12 col-md-12">copy,csv,print</div>
    <div class="col-lg-10 col-sm-12 col-md-12"></div>
  </div-->


  <div class="contain" name="tbl">
<?php
	 $sql = "select * from cusmaster where balance>0";
	$result = $conn->query($sql);
	$i=1;
	if ($result->num_rows > 0){ ?>
  <table class="table table-striped table-hover table-bordered ">
    <thead class="thead-dark">
      <th>Customer code</th>
      <th>Customer code</th>
      <th>Phone no</th>
      <th>Due amount</th>
    </thead>
    <tbody>
	<?php
	while($row = $result->fetch_assoc()){
	 echo "<tr onclick=\"goto('".$row["cuscode"]."','".$row["companyname"]."');\"> <td>".$row["cuscode"]."</td><td>".$row["companyname"]."</td><td>".$row["mobile"]."</td><td>".$row["balance"]."</td></tr>";
	}
    ?>
	</tbody>
  </table>
	<?php }
	else{
		echo "<h1> No Records Found</h1>";
	}
	?>
  </div>
</div>

<script>
function goto(val1,val2) {
  sessionStorage.setItem("cc",val1);
  sessionStorage.setItem("cn",val2);
  location.href = "../bill/cuspaydel.php";
}
</script>

<?php
include '../includes/foot.php';
?>
