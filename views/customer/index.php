<?php
include 'head.php';
include '../../database.php';
?>
<div class="container">
  <div class="row">
    <div class="col-lg-4 col-md-12 col-sm-12 mb-5">
      <div class="card" style="background-color:#667678 ;color:white;width:15rem;">
        <div class="card-body">
          <h5 class="card-title">STOCK</h5>
          <div class="row">
            <div class="col-7" style="font-size:2rem;color:white;">
                <?php $cuscode = $_SESSION['code'];
              //echo $cuscode;
            	$sql = "select * from enterorder,promaster where cuscode='".$cuscode."' and promaster.serial=enterorder.serial";
            	$result = $conn->query($sql);
              echo $result->num_rows; ?>
            </div>
            <div class="col-4 text-center" id="icon">
              <span class="fas fa-shopping-cart"></span>
            </div>
            <div class="col-1"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-12 col-sm-12 mb-5">
      <div class="card" style="background-color:#a3b47d ;color:white;width:15rem;">
        <div class="card-body">
          <h5 class="card-title">BILL GENERATED</h5>
          <div class="row">
            <div class="col-7" style="font-size:2rem;color:white;">
              <?php

              ?>
            </div>
            <div class="col-4 text-center" id="icon">
              <span class="fas fa-receipt"></span>
            </div>
            <div class="col-1"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-12 col-sm-12 mb-5">
      <?php  $sql="select * from cusmaster where cuscode='".$_SESSION['code']."'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $bal=$row["balance"];
        if($bal<=0){
      ?>
      <div class="card" style="background-color:green ;color:white;width:15rem;">
        <div class="card-body">
          <h5 class="card-title">BALANCE</h5>
          <div class="row">
            <div class="col-7" style="font-size:2rem;color:white;">
              <?php
                    echo $bal;
               ?>
            </div>
            <div class="col-4 text-center" id="icon">
              <span class="fas fa-dollar-sign"></span>
            </div>
            <div class="col-1"></div>
          </div>
        </div>
      </div>
    <?php }else{ ?>
      <div class="card" style="background-color:red ;color:white;width:15rem;cursor:pointer;">
        <div class="card-body">
            <h5 class="card-title">BALANCE</h5>
          <div class="row">
            <div class="col-7" style="font-size:2rem;color:white;">
              <?php
                    echo $bal;
               ?>
            </div>
            <div class="col-4 text-center" id="icon">
              <span class="fas fa-dollar-sign"></span>
            </div>
            <div class="col-1"></div>
          </div>
        </div>
      </div>
    <?php } ?>
    </div>
  </div>
  <hr>
  <p style="color: royalblue;">Customer Product</p><hr>
  <div class="contain">
    <?php
      $cuscode = $_SESSION['code'];
      //echo $cuscode;
    	$sql = "select * from enterorder,promaster,cusmaster where enterorder.cuscode='".$cuscode."' and promaster.serial=enterorder.serial and cusmaster.cuscode=enterorder.cuscode";
    	$result = $conn->query($sql);
    	$i=1;
    	if ($result->num_rows > 0){
    ?>
  <table class="table table-striped table-hover table-bordered ">
    <thead class="thead-dark">
      <th>Customer code</th>
      <th>Customer Name</th>
      <th>Serial</th>
      <th>Product Description</th>
      <th>Product Category</th>
      <th>Product Config</th>
    </thead>
    <tbody>
	<?php
	while($row = $result->fetch_assoc()){
	 echo "<tr><td>".$row["cuscode"]."</td><td>".$row["companyname"]."</td><td>".$row["serial"]."</td><td>".$row["prodesc"]."</td><td>".$row["prodcatname"]."</td><td>".$row["proconfig"]."</td></tr>";
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
<?php include 'foot.php'; ?>
