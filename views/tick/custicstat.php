<?php include '../includes/head.php';
include '../../database.php';
?>

<div class="container">
  <p style="color: royalblue;">Customer Ticketing Status</p>

  <hr>
  <div class="contain">
  <?php
	    $sql = "select * from ticket,cusmaster where ticket.cuscode=cusmaster.cuscode and flag='1'";
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
      <th>Status</th>
    </thead>
    <tbody>
	<?php
	while($row = $result->fetch_assoc()){
	 echo "<tr><td>".$row["date"]."</td><td>".$row["cusname"]."</td><td>".$row["mobile"]."</td><td>".$row["serial"]."</td><td>".$row["desc"]."</td><td>".$row["type"]."</td><td>".$row["msg"]."</td><td><button class='btn btn-success' onclick=\"update('".$row['slno']."')\">Complete</button></td></tr>";
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
function update(i)
{
	var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      let v=this.responseText;
        if(v==1)
          sessionStorage.setItem("success","Job marked as Complete");
        else {
          alert(v);
        }

	  location.reload();
    }
  };
  xhttp.open("POST", "docusticstat.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("slno="+i);
}
</script>

<?php include '../includes/foot.php'; ?>
