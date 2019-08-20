<div id="up"></div>
<?php include '../includes/head.php';
 include('../../database.php');?>
 <?php
$p=$_SESSION['per'];

if($p[4]=='0')
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
<style media="screen">
  td:hover{
    cursor: pointer;
  }
</style>
  <div class="container">
    <p style="color: royalblue;">Enter Vendor Details</p>
    <hr>
    <div class="row">

        <div class="col-lg-4 col-sm-12 col-md-12">
          <div class="form-group">
            <label for="Vendor code">Vendor Code<sup>*</sup>:</label>
            <input type="text" name="code" class="form-control" readonly>
          </div>
        </div>
        <div class="col-lg-4 col-sm-12 col-md-12">
          <div class="form-group">
            <label for="Vendor Name">Vendor Name<sup>*</sup>:</label>
            <input type="text" name="vendorname" class="form-control" required>
          </div>
        </div>
        <div class="col-lg-4 col-sm-12 col-md-12">
          <div class="form-group">
            <label for="GST No">GST No:</label>
            <input type="text" name="gstno" class="form-control" >
          </div>
        </div>

    </div>

    <div class="row">
      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label for="Address1">Address1<sup>*</sup>:</label>
          <textarea name="address1"class="form-control" rows="2"></textarea>
        </div>
      </div>
      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label for="Address2">Address2<sup>*</sup>:</label>
          <textarea name="address2"class="form-control" rows="2" required></textarea>
        </div>
      </div>
      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label for="City">City<sup>*</sup>:</label>
          <input type="text" name="city" class="form-control" required >
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label for="State">State<sup>*</sup>:</label>
          <input type="text" name="state" class="form-control" required>
        </div>
      </div>
      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label for="Pincode">Pincode<sup>*</sup>:</label>
          <input type="number" name="pincode" class="form-control" required>
        </div>
      </div>
      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label for="Mobile Number:">Mobile Number<sup>*</sup>:</label>
          <input type="text" name="mobile" class="form-control" required pattern="[5-9][0-9]{9}">
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label for="Telephone No">Telephone No:</label>
          <input type="text" name="phone" class="form-control">
        </div>
      </div>
      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label for="Email ID">Email ID<sup>*</sup>:</label>
          <input type="email" name="email" class="form-control" required>
        </div>
      </div>
      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label for="Status">Status:</label>
          <select name="status" class="custom-select">
            <option value="ACTIVE">ACTIVE</option>
            <option value="INACTIVE">INACTIVE</option>
          </select>
        </div>
      </div>
    </div>

    <hr>
    <div class="row">
      <div class="col-lg-8 col-sm-12 col-md-12"></div>
      <div class="col-lg-4 col-sm-12 col-md-12">
        <input type="button" name="button" value="save" onclick="query()" class="btn btn-success">
        <input type="reset" value="Reset" class="btn btn-info" onclick="location.reload();">
      </div>
    </div>
  </div>
<hr>

<div class="container">
  <p style="color: royalblue;">Vendor Details</p>
  <hr>

  <!--div class="row">
    <div class="col-lg-2 col-sm-12 col-md-12">copy,csv,print</div>
    <div class="col-lg-10 col-sm-12 col-md-12"></div>
  </div-->

  <div class="row">
    <div class="col-lg-9 col-sm-12 col-md-12"></div>
    <div class="col-lg-3 col-sm-12 col-md-12">
      <div class="form-group">
        <label>Search:</label>
        <input type="text" name="search" oninput="update()" class="form-control">
      </div>
    </div>
  </div>
  <div class="contain" name="tbl">
<?php
	$sql = "select * from venmaster";
	$result = $conn->query($sql);
	//$i=1;
	if ($result->num_rows > 0){
?>
<table class="table table-striped table-hover table-bordered ">
  <thead class="thead-dark">
      <th>Vendor Id</th>
      <th>Vendor Name</th>
      <th>Address</th>
      <th>City</th>
      <th>Pincode</th>
      <th>Mobile No</th>
      <th>Status</th>
    </thead>
    <tbody>
<?php
	while($row = $result->fetch_assoc()){
	 echo "<tr onclick=\"req('".$row['vencode']."');to();\"><td>".$row["vencode"]."</td><td>".$row["vendorname"]."</td><td>".$row["address1"]."</td><td>".$row["city"]."</td><td>".$row["pincode"]."</td><td>".$row["mobile"]."</td><td>".$row["status"]."</td></tr>";
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
function update()
{  z='2';
	v=document.getElementsByName("search")[0].value;
	//alert(v);

	var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementsByName("tbl")[0].innerHTML = this.responseText;
    }
  };
  xhttp.open("POST", "dovenreq.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("l="+v+"&t="+z);

}
function to() {
  location.href="#up";
}
function query()
{
//alert("check");

vencode=document.getElementsByName("code")[0].value;
vendorname=document.getElementsByName("vendorname")[0].value;
address1=document.getElementsByName("address1")[0].value;
address2=document.getElementsByName("address2")[0].value;
city=document.getElementsByName("city")[0].value;
state=document.getElementsByName("state")[0].value;
pincode=document.getElementsByName("pincode")[0].value;
phone=document.getElementsByName("phone")[0].value;
mobile=document.getElementsByName("mobile")[0].value;
gstno=document.getElementsByName("gstno")[0].value;
email=document.getElementsByName("email")[0].value;
status=document.getElementsByName("status")[0].value;
typ=document.getElementsByName("button")[0].value;
var gstno_re=/^[0-9]{2}[A-Z0-9]{10}[0-9]{1}[A-Z]{1}[0-9A-Za-za]{1}$/;

if(!(gstno_re.test(gstno)))
       {
		    if(gstno=="")
			   {
				  //toastr.info("No GST value inserted :Inserting default value\(000000000000000\)!!");
				  var v=confirm("No GST value inserted :Inserting default value\(000000000000000\)!!\nDo you agree?");
				  gstno="000000000000000";
				  console.log("your decision "+v);
				  if(v==false)
					return v;
			   }
			   else
			if(gstno.localeCompare("000000000000000")!=0)
			   {
				  toastr.info("Invalid GST NO format");
				  return false;
			   }
       }
//alert(empcode+firstname+lastname+dept+email+mobile+username+password+status+displayname+ip);

var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      let v=this.responseText;
        if(v==1)
          sessionStorage.setItem("success","Successfully saved Data");
        else if(v==2)
          sessionStorage.setItem("success","Successfully updated Data");
        else {
          alert(v);
        }
		location.reload();
    }
  };
  xhttp.open("POST", "doven.php", false);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("vencode="+vencode+"&vendorname="+vendorname+"&address1="+address1+"&address2="+address2+"&city="+city+"&state="+state+"&pincode="+pincode+"&phone="+phone+"&mobile="+mobile+"&gstno="+gstno+"&email="+email+"&status="+status+"&type="+typ);
}
toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": true,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": true,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "3000",
  "extendedTimeOut": "2000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
window.onload=function() {
  if((sessionStorage.getItem("success")!==null)){
    toastr.success(sessionStorage.getItem("success"));
    sessionStorage.removeItem("success");
  }
}
function req(n)
{ z='1';
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      v=this.responseText;
      v=v.split("$");
      document.getElementsByName("code")[0].value=v[0];
      document.getElementsByName("vendorname")[0].value=v[1];
      document.getElementsByName("address1")[0].value=v[2];
      document.getElementsByName("address2")[0].value=v[3];
      document.getElementsByName("city")[0].value=v[4];
      document.getElementsByName("state")[0].value=v[5];
      document.getElementsByName("pincode")[0].value=v[6];
      document.getElementsByName("phone")[0].value=v[7];
      document.getElementsByName("mobile")[0].value=v[8];
      document.getElementsByName("gstno")[0].value=v[9];
      document.getElementsByName("email")[0].value=v[10];
      document.getElementsByName("status")[0].value=v[11];
      document.getElementsByName("button")[0].value="update";
    }
  };
  xhttp.open("POST", "dovenreq.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("code="+n+"&t="+z);

 //alert(v);



}

</script>
<?php } include '../includes/foot.php'; ?>
