<?php include 'head.php';
include '../../database.php'; ?>

<div class="container">
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
	  <th>Ticketing</th>
    </thead>
    <tbody>
  <?php
  while($row = $result->fetch_assoc()){
   echo "<tr><td>".$row["cuscode"]."</td><td>".$row["companyname"]."</td><td>".$row["serial"]."</td><td>".$row["prodesc"]."</td><td>".$row["prodcatname"]."</td><td>".$row["proconfig"]."</td><td><button type=\"button\" class=\"btn btn-success\" data-toggle=\"modal\" data-target='#exampleModal' onclick=\"pass('".$row['serial']."','".$row['prodesc']."','".$row["cuscode"]."','".$row["companyname"]."')\">Ticketing</td></tr>";
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
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ticketing</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Serial:</label>
          <input type="text" name="serial" class="form-control" readonly >
        </div>
        <div class="form-group">
          <label>Description:</label>
          <textarea name="desc" rows="2" class="form-control" readonly></textarea>
        </div>
				<div class="form-group">
					<label>Type:</label>
					<select name="typ" class="custom-select">
					  <option></option>
					  <option>Repair</option>
					  <option>Replace</option>
					  <option>Return</option>
					  <option>Upgradation</option>
					</select>
				</div>
          <div class="form-group">
            <label>Message:</label>
            <textarea name='msg' class="form-control" id="message-text"></textarea>
          </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="dosubmit()">Submit</button>
      </div>
    </div>
  </div>
</div>
<script>
var sql="";
function dosubmit()
{
	dat="<?php echo date('Y')."-".date('m')."-".date('d')?>";
	msg=document.getElementsByName("msg")[0].value;
	typ=document.getElementsByName("typ")[0].value;
	s=document.getElementsByName("serial")[0].value;
	d=document.getElementsByName("desc")[0].value;
	c ='<?php echo $_SESSION["code"]?>';
	cn ='<?php echo $_SESSION["dname"]?>';

	sql="insert into ticket (serial,cusname,cuscode,`desc`,msg,type,date) values ('"+s+"','"+cn+"','"+c+"','"+d+"','"+msg+"','"+typ+"','"+dat+"' )";
	//alert(sql);
	z="1";
	var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      v = this.responseText;
      if(v==1)
        sessionStorage.setItem("success","Reported Admin Successfully");
      else {
        alert(v);
      }

	  location.reload();
    }
  };
  xhttp.open("POST", "doticketing.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("sql="+sql+"&t="+z);


}

function pass(s,d,c,cn)
{   //alert(s+d);
	document.getElementsByName("serial")[0].value=s;
	document.getElementsByName("desc")[0].value=d;

}
</script>
<?php include 'foot.php'; ?>
