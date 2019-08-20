<?php include('includes/head.php');
include('../database.php');
?>

<?php
$month=date('m');

if($month>=4)
{
	$sql="select * from incount";
	$result=$conn->query($sql);
	$row=$result->fetch_assoc();
	if((date('Y')!=$row['year']))
	{
		$sql="update incount set count='0',year='".date('Y')."'";
		$conn->query($sql);
	}
}
?>
<?php
$p=$_SESSION['per'];

if($p[0]=='0')
{
?>
<div class="alert alert-danger" role="alert">
  <h1 class="alert-heading text-center" style="font-size:3.5rem">Authorization Error</h1>
  <hr>
  <p class="mb-0 text-center" style="color:black;font-size:2.3rem">This page is not allowed for your permission level.</p>
</div>
<?php
}
else
{
?>

<div class="container" >

  <div class="row">
    <div class="col-lg-4 col-sm-12 col-md-12 mt-3">
      <a href="trans/incount.php">
        <div class="card" style="background-color:#c43235 ;color: white;width:15rem;">
          <div class="card-body">
            <h5>INVOICE COUNT</h5>

            <div class="row">
              <div class="col-7" style="font-size:2rem;color:white;">
                <?php
				$sum=0;
    $date = date('Y')."-".date('m')."-".date('d');
	 $sql = "select * from cusmaster where indate<='".$date."' and indate!='0000-00-00'";
   //echo $sql;
	 $result = $conn->query($sql);
	 if ($result->num_rows > 0){ ?>
	 <?php
	 $cuscode="";
	 while($row = $result->fetch_assoc()){
	 // echo "<tr><td>".$row['cuscode']."</td><td>".$row['companyname']."</td><td>".$row['mobile']."</td><td><button data-toggle='modal' data-target='#address' class='btn btn-info' onclick=\"pass('".$row['cuscode']."','".$row['indate']."')\">View</button></td></tr>";
	 $cuscode.="#".$row['cuscode'];
	}
	//echo $cuscode;
	$cuscode=explode('#',$cuscode);
	$cc='';
	for($i=1;$i<count($cuscode);$i++)
	{
		$sql1="select * from trans where cuscode='".$cuscode[$i]."' and intype!='DAILY' and dctype!='testing'";
		$result1=$conn->query($sql1);
		if ($result1->num_rows > 0)
		{ //echo $cuscode[$i];
			//$cc.="#".$cuscode[$i]
			// echo "<tr><td>".$row['cuscode']."</td><td>".$row['companyname']."</td><td>".$row['mobile']."</td><td><button data-toggle='modal' data-target='#address' class='btn btn-info' onclick=\"pass('".$row['cuscode']."','".$row['indate']."')\">View</button></td></tr>";
			$sql2="select * from cusmaster where cuscode='".$cuscode[$i]."'";
			$result2=$conn->query($sql2);
			$row=$result2->fetch_assoc();
			//if($row['paytype']=="PRE PAID")
				//echo "<tr><td>".$row['cuscode']."</td><td>".$row['companyname']."</td><td>".$row['mobile']."</td><td><button data-toggle='modal' data-target='#address' class='btn btn-info' onclick=\"pass('".$row['cuscode']."','".$row['indate']."','1')\">View</button></td></tr>";
			//else
				//echo "<tr><td>".$row['cuscode']."</td><td>".$row['companyname']."</td><td>".$row['mobile']."</td><td><button data-toggle='modal' data-target='#address' class='btn btn-info' onclick=\"pass('".$row['cuscode']."','".$row['indate']."','2')\">View</button></td></tr>";
		$sum+=1;
		}


	}
	$sql1="select * from trans where intype='DAILY' and dcdate<='".$date."' and effdate!='0000-00-00' ";
		$result1=$conn->query($sql1);
		while ($row1=$result1->fetch_assoc())
		{
			$sql2="select * from cusmaster where cuscode='".$row1['cuscode']."'";
			$result2=$conn->query($sql2);
			$row=$result2->fetch_assoc();
			//echo "<tr><td>".$row['cuscode']."</td><td>".$row['companyname']."</td><td>".$row['mobile']."</td><td><button data-toggle='modal' data-target='#address' class='btn btn-info' onclick=\"pass('".$row['cuscode']."','".$row1['effdate']."','3','".$row1['rang']."','".$row1['dcno']."')\">View</button></td></tr>";
		$sum+=1;
		}
		echo $sum;
    ?>
		<?php }
	else{
		//echo "<h1>No Invoice to be Generated</h1>";
		echo $sum;
	}
	?>		
				
              </div>
              <div class="col-4 text-center" id="icon">
                <span class="fas fa-receipt"></span>
              </div>
              <div class="col-1"></div>
            </div>
          </div>
        </div>
      </a>
    </div>
    <div class="col-lg-4 col-sm-12 col-md-12 mt-3">
      <a href="admin/checkavail.php">
        <div class="card" style="background-color: royalblue;color: white;width:15rem;">
          <div class="card-body">
            <h5>TOTAL STOCK</h5>
            <div class="row">
              <div class="col-7" style="font-size:2rem; color:white;">
                <?php
                  $sql = "SELECT * FROM promaster";
                  $result = $conn->query($sql);
                  echo $result->num_rows;
                ?>
              </div>
              <div class="col-4 text-center" id="icon">
                <span class="fas fa-cubes"></span>
              </div>
              <div class="col-1"></div>
            </div>
          </div>
        </div>
      </a>
    </div>
    <div class="col-lg-4 col-sm-12 col-md-12 mt-3">
      <a href="tick/custicstat.php">
        <div class="card" style="background-color: #300032;color: white;width:15rem;">
          <div class="card-body">
            <h5>CUSTOMER QUERY</h5>
            <div class="row">
              <div class="col-7" style="font-size:2rem;color:white;">
                <?php $sql="select * from ticket where flag='1' ";
					   $result = $conn->query($sql);
					   echo $result->num_rows;
				?>
              </div>
              <div class="col-4 text-center" id="icon">
                <span class="fas fa-question"></span>
              </div>
              <div class="col-1"></div>
            </div>
          </div>
        </div>
      </a>
    </div>
  </div>
  <div class="row mt-5">
  <div class="col-lg-4 col-sm-12 col-md-12 mt-3">
      <a onclick="goto('REPAIR');">
        <div class="card glow" style="color: black;width:15rem;cursor:pointer;" name="glowcard">
          <div class="card-body">
            <h5 name="alerthead">REPAIR</h5>
            <div class="row">
              <div class="col-7" style="font-size:2rem;" name="nor">
                <?php $sql="select * from promaster where status='REPAIR' ";
					   $result = $conn->query($sql);
					   echo $result->num_rows." <span style='font-size:1rem;'></span>";
				?>
              </div>
              <div class="col-4 text-center" id="icon">
                <span class="fas fa-screwdriver"></span>
              </div>
              <div class="col-1"></div>
            </div>
          </div>
        </div>
      </a>
    </div>
    <div class="col-lg-4 col-sm-12 col-md-12 mt-3">
        <a onclick="goto('REPIN');">
          <div class="card" style="background-color:#BDB76B ;color:white;width:15rem;cursor:pointer;">
            <div class="card-body">
              <h5>REPLACEMENT IN</h5>
              <div class="row">
                <div class="col-7" style="font-size:2rem;color:white;">
                  <?php $sql="select * from promaster where status='REPIN' ";
  					            $result = $conn->query($sql);
  					            echo $result->num_rows." <span style='font-size:1rem;'></span>";
  				         ?>
                </div>
                <div class="col-4 text-center" id="icon">
                  <span class="fas fa-arrow-down"></span>
                </div>
                <div class="col-1"></div>
              </div>
            </div>
          </div>
        </a>
      </div>
      <div class="col-lg-4 col-sm-12 col-md-12 mt-3">
          <a href="trans/rep.php">
            <div class="card" style="background-color:#A9A9A9 ;color:white;width:15rem;cursor:pointer;">
              <div class="card-body">
                <h5>REPLACEMENT OUT</h5>
                <div class="row">
                  <div class="col-7" style="font-size:2rem;color:white;">
                    <?php $sql="select * from promaster where status='REPOUT' ";
    					            $result = $conn->query($sql);
    					            echo $result->num_rows." <span style='font-size:1rem;'></span>";
    				         ?>
                  </div>
                  <div class="col-4 text-center" id="icon">
                    <span class="fas fa-arrow-up"></span>
                  </div>
                  <div class="col-1"></div>
                </div>
              </div>
            </div>
          </a>
        </div>
  </div>

  <div class="row mt-5">
    <div class="col-lg-4 col-sm-12 col-md-12 mt-3">
        <a onclick="goto('RETURNING');">
          <div class="card" style="background-color:#498 ;color:white;width:15rem;cursor:pointer;">
            <div class="card-body">
              <h5>RETURNING</h5>
              <div class="row">
                <div class="col-7" style="font-size:2rem;color:white;">
                  <?php $sql="select * from promaster where status='RETURNING' ";
                        $result = $conn->query($sql);
                        echo $result->num_rows." <span style='font-size:1rem;'></span>";
                   ?>
                </div>
                <div class="col-4 text-center" id="icon">
                  <span class="fas fa-undo-alt"></span>
                </div>
                <div class="col-1"></div>
              </div>
            </div>
          </div>
        </a>
      </div>
			<div class="col-lg-4 col-sm-12 col-md-12 mt-3">
	        <a href="/skopsys/views/admin/payment.php">
	          <div class="card" style="background-color:#978 ;color:white;width:15rem;cursor:pointer;">
	            <div class="card-body">
	              <h5>CUSTOMER DUE</h5>
	              <div class="row">
	                <div class="col-7" style="font-size:2rem;color:white;">
	                  <?php $sql="select * from cusmaster where balance>0";
	                        $result = $conn->query($sql);
	                        echo $result->num_rows." <span style='font-size:1rem;'></span>";
	                   ?>
	                </div>
	                <div class="col-4 text-center" id="icon">
	                  <span class="fas fa-money-check"></span>
	                </div>
	                <div class="col-1"></div>
	              </div>
	            </div>
	          </div>
	        </a>
	      </div>
  </div>

</div>
<script>
  function goto(val) {
    sessionStorage.setItem("value",val);
    location.href = "admin/checkavail.php";
  }
	//alert("Enterd");
	var nor=document.getElementsByName("nor")[0].innerHTML;
	nor=nor.split(" ");
	nor = nor.filter(function (el) {
      		  return el != "";
      		});
	var card=document.getElementsByName("glowcard")[0];
	var alerthead=document.getElementsByName("alerthead")[0];
	if(parseInt(nor[1])>0)
	{

			//alert("nor greater");
			card.setAttribute("class","card glow");
	}
	else
	{
		card.setAttribute("class","card");
		card.style.backgroundColor="green";
		card.style.color="white";
	}

</script>
<?php }

include('includes/foot.php'); ?>
