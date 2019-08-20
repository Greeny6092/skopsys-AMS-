<?php
include '../includes/head.php';
include '../../database.php';
?>
<style>
th,tr,td
{
		text-align:center;
}
</style>
<div class="container" id="up">
  <p style="color: royalblue;">Filter Options</p><hr>
  <div class="row">
      <div class="col-lg-4 col-sm-12 col-md-12">
      <div class="form-group">
        <label for="cuscode">Customer Code:</label>
        <input type="text"  name="cuscode" class="form-control" onchange="getcusname(this.value)" placeholder="Select Any" list="cuscode">
      </div>
    </div>

    <div class="col-lg-4 col-sm-12 col-md-12">
      <div class="form-group">
        <label for="cusname">Customer Name:</label>
        <input type="text"   name="cusname" class="form-control" onchange="getcuscode(this.value)" placeholder="Select Any" list="cusname">
      </div>
    </div>

    <div class="col-lg-4 col-sm-12 col-md-12">
      <div class="form-group">
        <label for="prodcatname">Product Category<sup>*</sup>:</label>
        <input type="text"  class="form-control" name="prodcatname"  onchange="filter()" placeholder="Select Any" list="prodcatname">
      </div>
    </div>

    <div class="col-lg-4 col-sm-12 col-md-12">
      <div class="form-group">
        <label for="status">Status<sup>*</sup>:</label>
        <input type="text"  value="" name="status"  class="form-control" onchange="checkforactive(this.value)" placeholder="Select Any" list="status">
      </div>
    </div>
</div>
<datalist id="cuscode">
<option  value="none"></option>
<?php
$result=$conn->query("select cuscode from cusmaster");
while($row=$result->fetch_assoc())
	echo "<option value='".$row['cuscode']."'>".$row['cuscode']."</option>";
?>
</datalist>
<datalist id="cusname">
<option  value="none"></option>
<?php
$result=$conn->query("select companyname from cusmaster");
while($row=$result->fetch_assoc())
	echo "<option value='".$row['companyname']."'>".$row['companyname']."</option>";
?>
</datalist>
<datalist id="prodcatname">
<option  value="none"></option>
<?php
$result=$conn->query("select DISTINCT prodcatname from promaster");
while($row=$result->fetch_assoc())
	echo "<option value='".$row['prodcatname']."'>".$row['prodcatname']."</option>";
?>
</datalist>
<datalist id="status">
<option  value="none"></option>
<option value="ACTIVE">ACTIVE</option>
<option value="SCRAP">SCRAP</option>
<option value="SERVICE">SERVICE</option>
<option value="RENTAL">RENTAL</option>
</datalist>
<br>
  <hr>
 <br><br>
 <div class="contain" style="height:auto;">


  <table class="table table-striped table-hover table-bordered ">
  <thead class="thead-dark">
  <th>Product Category Name</th>
  <th>Serials</th>
  <th>Product Code</th>
  <th>Status</th>
  <th>View</th>
  </thead>
  <tbody>
	<?php
	$result=$conn->query("select * from promaster order by prodcatname asc");
	while($row=$result->fetch_assoc())
		echo "<tr><td>".$row['prodcatname']."</td><td>".$row['serial']."</td><td>".$row['procode']."</td><td>".$row['status']."</td><td><button data-toggle='modal' data-target='#address' class='btn btn-success' onclick=\"pass('".$row['serial']."')\">view</td></tr>";
	?>
  </tbody>
  </table>
	</div>
</div>
<div class="modal fade" id="address" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">User Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
				 <div class="container">
					 <div class="row">
						 <div class="col-lg-4 col-sm-12 col-md-12">
							 <div class="form-group">
							 	<label>Serial:</label>
								<input type="text" name="serial" value="" class="form-control" readonly>
							 </div>
						 </div>
						 <div class="col-lg-4 col-sm-12 col-md-12">
							 <div class="form-group">
								 <label>Description:</label>
								 <textarea name="desc" rows="3" class="form-control" readonly></textarea>
							 </div>
						 </div>
						 <div class="col-lg-4 col-sm-12 col-md-12">
							 <div class="form-group">
							 	<label>Availability:</label>
								<input type="text" name="ava" value="" class="form-control" readonly>
							 </div>
						 </div>
					 </div>
					 <div class="row">
						 <div class="col-lg-4 col-sm-12 col-md-12">
							 <div class="form-group">
							 	<label>With:</label>
								<input type="text" name="cname" value="" class="form-control" readonly>
							 </div>
						 </div>
						 <div class="col-lg-4 col-sm-12 col-md-12">
							 <div class="form-group">
								 <label>Address:</label>
								 <textarea name="address" rows="3" class="form-control" readonly></textarea>
							 </div>
						 </div>
						 <div class="col-lg-4 col-sm-12 col-md-12">
							 <div class="form-group">
								 <label>Contact:</label>
								 <textarea name="ph" rows="3" class="form-control" readonly></textarea>
							 </div>
						 </div>
					 </div>
				 </div>
      </div>
			<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
function pass(ser) {
	document.getElementsByName('serial')[0].value=ser;

	var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      v = this.responseText;
	  v=v.split("&");
	  document.getElementsByName('desc')[0].value=v[0];
	  document.getElementsByName('ava')[0].value=v[1];
	  document.getElementsByName('cname')[0].value=v[2];
	  document.getElementsByName('address')[0].value=v[3];
	  document.getElementsByName('ph')[0].value=v[4];
    }
  };
  xhttp.open("POST", "dofilter.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("s="+ser+"&o=3");

}
var o;
function filter()
{
	var filoption="";
	o="2";
	var tbody=document.getElementsByTagName("tbody")[0],i;
	tbody.innerHTML="";
	cuscode=document.getElementsByName("cuscode")[0].value;
	prodcatname=document.getElementsByName("prodcatname")[0].value;
	status=document.getElementsByName("status")[0].value;
	//alert("cuscode "+cuscode);
	//alert("prodcatname "+prodcatname);
	//alert("status "+status);
	var req=new XMLHttpRequest();
	if(cuscode.length==0||cuscode=="none")
		filoption+="0"
	else
		filoption+="1"
	if(prodcatname.length==0||prodcatname=="none")
		filoption+="0"
	else
		filoption+="1"

	if(status.length==0||status=="none")
		filoption+="0"
	else
		filoption+="1"
	//alert("filoption is "+filoption);
	try
	{
		req.onreadystatechange=function()
										{
											if(req.readyState==4)
											{
												var res=req.responseText;
												var tbody=document.getElementsByTagName("tbody")[0];
												tbody.innerHTML=res;
												//alert(res);
											}
										}
		req.open("POST","dofilter.php",false);
		req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		//alert("o="+o+"&filoption="+filoption+"&cuscode="+cuscode+"&prodcatname="+prodcatname+"&status="+status);
		req.send("o="+o+"&filoption="+filoption+"&cuscode="+cuscode+"&prodcatname="+prodcatname+"&status="+status);
	}
	catch(e)
	{
		alert(e);
	}
}
function getcusname(cuscode)
{	o="1";
	document.getElementsByName("status")[0].value="";
	document.getElementsByName("prodcatname")[0].value="";
	var req=new XMLHttpRequest();
	if(cuscode!="none"){try
	{
		req.onreadystatechange=function()
										{
											if(req.readyState==4)
											{
												var res=req.responseText;
												var res=res.split("$");
												document.getElementsByName("cusname")[0].value=res[0];
												document.getElementsByName("cuscode")[0].value=res[1];
											}
										}
		req.open("POST","dofilter.php",false);
		req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		//alert("o="+o+"&cuscode="+document.getElementsByName("cuscode")[0].value);
		req.send("o="+o+"&cuscode="+document.getElementsByName("cuscode")[0].value);
	}
	catch(e)
	{
		alert(e);
	}
	filter();}
	else
		document.getElementsByName("cusname")[0].value="none";
}
function getcuscode(cusname)
{
	o="1";
	document.getElementsByName("status")[0].value="";
	document.getElementsByName("prodcatname")[0].value="";
	var req=new XMLHttpRequest();
	if(cusname!="none"){
	try
	{
		req.onreadystatechange=function()
										{
											if(req.readyState==4)
											{
												var res=req.responseText;
												var res=res.split("$");
												document.getElementsByName("cusname")[0].value=res[0];
												document.getElementsByName("cuscode")[0].value=res[1];
											}
										}
		req.open("POST","dofilter.php",false);
		req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		req.send("o="+o+"&cusname="+document.getElementsByName("cusname")[0].value);
	}
	catch(e)
	{
		alert(e);
	}
	filter();}
	else
		document.getElementsByName("cuscode")[0].value="none";
}
function checkforactive(val)
{
		document.getElementsByName("cuscode")[0].value="";
		document.getElementsByName("cusname")[0].value="";
		document.getElementsByName("prodcatname")[0].value="";
	filter();
}
</script>
<?php include '../includes/foot.php'?>
