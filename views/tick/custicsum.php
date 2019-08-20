<?php include '../includes/head.php';
include '../../database.php';
?>

<div class="container">
  <p style="color: royalblue;">Customer Ticketing Summary</p>

  <hr>
  <div class="contain">
  <?php
	    $sql = "select * from ticket,cusmaster where ticket.cuscode=cusmaster.cuscode and flag='0' order by slno desc";
	    $result = $conn->query($sql);
	    $i=1;
	    if ($result->num_rows > 0){ ?>
  <table class="table table-striped table-hover table-bordered ">
    <thead class="thead-dark">
      <th>Date</th>
      <th>Customer Name</th>
      <th>Mobile No</th>
      <th>Serial</th>
      <th>Product Description</th>
      <th>Type</th>
      <th>Comment</th>
     
    </thead>
    <tbody>
	<?php
	while($row = $result->fetch_assoc()){
	 echo "<tr><td>".$row["date"]."</td><td>".$row["cusname"]."</td><td>".$row["mobile"]."</td><td>".$row["serial"]."</td><td>".$row["desc"]."</td><td>".$row["type"]."</td><td>".$row["msg"]."</td></tr>";
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

<?php include '../includes/foot.php'; ?>
