<div id="up"></div>
<?php include '../includes/head.php'; ?>
<?php include('../../database.php');?>
<style media="screen">
  td:hover{
    cursor: pointer;
  }
</style>
<div>
  <div class="container" onload="getunupdated()">
    <p style="color: royalblue;">Enter Customer Details</p>
    <hr>
    <div class="row">
        <div class="col-lg-4 col-sm-12 col-md-12">
          <div class="form-group">
            <label for="Customer code">Customer Code:</label>
            <input type="text"  name="code" class="form-control" readonly>
          </div>
        </div>

        <div class="col-lg-4 col-sm-12 col-md-12">
          <div class="form-group">
            <label for="Customer Name">Customer/Company Name<sup>*</sup>:</label>
            <input type="text" name="companyname" class="form-control" >
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
          <label for="Delivery Address">Delivery Address<sup>*</sup>:</label>
          <textarea class="form-control" name="daddress" rows="2" ></textarea>
        </div>
      </div>
      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label for="Billing Address">Billing Address:</label>
          <textarea class="form-control" name="baddress" rows="2"></textarea>
        </div>
      </div>
      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label for="City">City<sup>*</sup>:</label>
          <input type="text" name="city" class="form-control" >
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label for="State">State<sup>*</sup>:</label>
          <input type="text" name="state" class="form-control" >
        </div>
      </div>
      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label for="Pincode">Pincode<sup>*</sup>:</label>
          <input type="number" name="pincode" class="form-control" >
        </div>
      </div>
      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label for="State Code">State Code<sup>*</sup>:</label>
          <input type="number" name="statecode" class="form-control" >
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label for="Mobile Number:">Mobile Number<sup>*</sup>:</label>
          <input type="text" name="mobile" class="form-control" >
        </div>
      </div>
      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label for="Telephone No">Telephone No:</label>
          <input type="text" name="phone" class="form-control">
        </div>
      </div>
      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label for="Email ID">Email ID<sup>*</sup>:</label>
          <input type="email" name="email" class="form-control" >
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label for="TDS">TDS(%)<sup>*</sup>:</label>
          <input type="number" name="tds" value="" class="form-control" >
        </div>
      </div>
      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label for="Payment Type">Payment Type<sup>*</sup>:</label>
          <select name="paytype" class="custom-select">
            <option value="PRE PAID">PRE PAID</option>
            <option  value="POST PAID">POST PAID</option>
          </select>
        </div>
      </div>
      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label for="Status">Invoice Date:</label>
          <select name="status" class="custom-select" onchange="domra();">
            <option value=""></option>
            <option value="som">Start of month</option>
            <option value="eom">End of month</option>
            <option value="dom">Day of month</option>
            <option value="nl">null</option>
          </select>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-4 col-sm-12 col-md-12"></div>
      <div class="col-lg-4 col-sm-12 col-md-12"></div>
      <div class="col-lg-4 col-sm-12 col-md-12" style="display:none" id="domran">
        <div class="form-group">
          <label>Date (1-31):</label>
          <input type="number" name="domran" class="form-control" min="1" max="31">
        </div>
      </div>
    </div>
    <hr>

    <div class="row">
      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label for="Username">Username<sup>*</sup>:</label>
          <input type="text" name="username" class="form-control" >
        </div>
      </div>
      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label for="Password">Password<sup>*</sup>:</label>
          <input type="password" name="password" class="form-control" >
        </div>
      </div>
      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label for="Confirm Password">Confirm Password<sup>*</sup>:</label>
          <input type="password" name="cpassword" class="form-control">
        </div>
      </div>
    </div>
    <hr>

    <div class="row">
      <div class="col-lg-8 col-sm-12 col-md-12"></div>
      <div class="col-lg-4 col-sm-12 col-md-12">
        <input type="button" name="button" value="save" class="btn btn-success" onclick="vali()">
        <input type="button" onclick="location.reload();" value="Reset" class="btn btn-info">
      </div>
    </div>

  </div>
</div>

<hr>

<div class="container">
  <p style="color: royalblue;">Customer Details</p>
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
	 $sql = "select * from cusmaster";
	$result = $conn->query($sql);
	$i=1;
	if ($result->num_rows > 0){ ?>
  <table class="table table-striped table-hover table-bordered ">
    <thead class="thead-dark">
      <th>Customer Code</th>
      <th>Customer Name</th>
      <th>TDS</th>
      <th>GST No</th>
      <th style="text-overflow: ellipsis;">Delivery Address</th>
      <th>City</th>
      <th>Pincode</th>
      <th>Mobile No</th>
      <th>Email</th>
      <th>Payment Type</th>
      <th>Status</th>
    </thead>
    <tbody>
<?php
	while($row = $result->fetch_assoc()){
	 echo "<tr onclick=\"req('".$row['cuscode']."');to();\"><td>".$row["cuscode"]."</td><td>".$row["companyname"]."</td><td>".$row["tds"]."</td><td>".$row["gstno"]."</td><td>".$row["daddress"]."</td><td>".$row["city"]."</td><td>".$row["pincode"]."</td><td>".$row["mobile"]."</td><td>".$row["email"]."</td><td>".$row["paytype"]."</td><td>".$row["status"]."</td></tr>";
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
<script>
var unupdatedbaddress;
function update()
{  z='2';
	v=document.getElementsByName("search")[0].value;
	//alert(v);
    console.log(v);
	var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementsByName("tbl")[0].innerHTML = this.responseText;
    }
  };
  xhttp.open("POST", "docusreq.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("l="+v+"&t="+z);

}

function to() {
  location.href="#up";
}

  var cuscode,companyname,gstno,baddress,daddress,city,state,pincode,phone,email,statecode,tds,paytype,status,username,password,typ;
  function vali()
  {
    cuscode=document.getElementsByName("code")[0].value;
    companyname=document.getElementsByName("companyname")[0].value;
    gstno=document.getElementsByName("gstno")[0].value;
    daddress=document.getElementsByName("daddress")[0].value;
    baddress=document.getElementsByName("baddress")[0].value;
	//alert("before "+baddress+"\ninclude is "+baddress.includes(unupdatedbaddress));
	//companyname=companyname.bold();
	/*if(baddress.includes(unupdatedbaddress)==false||unupdatedbaddress==null)
		baddress=companyname+","+document.getElementsByName("baddress")[0].value+"\n";
	else
		baddress=baddress.replace(unupdatedbaddress,companyname)+"\n";*/
	//alert("after "+baddress);
    city=document.getElementsByName("city")[0].value;
    statecode=document.getElementsByName("statecode")[0].value;
    pincode=document.getElementsByName("pincode")[0].value;
    mobile=document.getElementsByName("mobile")[0].value;
    phone=document.getElementsByName("phone")[0].value;
    email=document.getElementsByName("email")[0].value;
    state=document.getElementsByName("state")[0].value;
    tds=document.getElementsByName("tds")[0].value;
    paytype=document.getElementsByName("paytype")[0].value;
    status=document.getElementsByName("status")[0].value;
    if(status=="dom"){
      if(document.getElementsByName("domran")[0].value=="")
      {
      toastr.info("Please enter date");
      return false;
      }
      status=document.getElementsByName("domran")[0].value;
    }
    username=document.getElementsByName("username")[0].value;
    password=document.getElementsByName("password")[0].value;
    cpassword=document.getElementsByName("cpassword")[0].value;
    typ=document.getElementsByName("button")[0].value;

    //var companyname_re=/^[a-zA-Z0-9 ]*$/;
    var gstno_re=/^[0-9]{2}[A-Z0-9]{10}[0-9]{1}[A-Z]{1}[0-9A-Za-za]{1}$/;
    var city_re=/^[A-Za-z]{3,30}$/;
    //var email_re=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    var pincode_re=/^[0-9]{6}$/;
    var mobile_re=/^[0-9]{10}$/;
    var username_re=/^[a-zA-Z0-9]*$/;
    //alert(empcode+firstname+lastname+dept+email+mobile+username+password+status+displayname+ip);
    if(companyname=="")
       {
      toastr.info("Invalid company name");
      return false;
       }

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

    if(city==""||!(city_re.test(city)))
       {
      toastr.info("Invalid city");
      return false;
       }
    if(pincode==""||!(pincode_re.test(pincode)))
       {
      toastr.info("Invalid pincode");
      return false;
       }
       if(password.localeCompare(cpassword)!=0)
       {
      toastr.info("Re-Enter Password Correctly!!!");
      return false;
       }
      if(password==""||password.length<5)
      {
      toastr.info("Password is too small");
      return false;
      }
      if(document.getElementsByName("status")[0].value=="")
      {
      toastr.info("Please enter date");
      return false;
      }

    //alert(empcode+firstname+lastname+dept+email+mobile+username+password+status+displayname+ip);

    query();
  }

function query()
{
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
		console.log(v);
      }
  location.reload();
  console.log("reloaded!!!");
	  //location.reload();
    }
  };
  xhttp.open("POST", "docus.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("cuscode="+cuscode+"&companyname="+companyname+"&gstno="+gstno+"&daddress="+daddress+"&baddress="+baddress+"&city="+city+"&state="+state+"&pincode="+pincode+"&mobile="+mobile+"&phone="+phone+"&email="+email+"&statecode="+statecode+"&tds="+tds+"&paytype="+paytype+"&status="+status+"&username="+username+"&password="+password+"&type="+typ);
}

function req(n){
	z='1';
var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      v=this.responseText;
      console.log(v);
      v=v.split("$");
      document.getElementsByName("code")[0].value=v[0];
      document.getElementsByName("companyname")[0].value=v[1];
      document.getElementsByName("gstno")[0].value=v[2];
      document.getElementsByName("daddress")[0].value=v[3];
      document.getElementsByName("baddress")[0].value=v[4];
	  unupdatedbaddress=document.getElementsByName("baddress")[0].value;
	  unupdatedbaddress=unupdatedbaddress.split(",")[0];
	  /*if(unupdatedbaddress!=v[1])
		unupdatedbaddress=null;*/
	  //alert("unupdated is"+unupdatedbaddress);
      document.getElementsByName("city")[0].value=v[5];
      document.getElementsByName("state")[0].value=v[6];
      document.getElementsByName("pincode")[0].value=v[7];
      document.getElementsByName("mobile")[0].value=v[8];
      document.getElementsByName("phone")[0].value=v[9];
      document.getElementsByName("email")[0].value=v[10];
      document.getElementsByName("statecode")[0].value=v[11];
      document.getElementsByName("tds")[0].value=v[12];
      document.getElementsByName("paytype")[0].value=v[13];
      if(!isNaN(v[14])){
          document.getElementsByName("status")[0].value="dom";
          document.getElementById("domran").style.display="block";
          document.getElementsByName("domran")[0].value=v[14];
      }
      else{
        document.getElementsByName("status")[0].value=v[14];
        document.getElementById("domran").style.display="none";
        document.getElementsByName("domran")[0].value="";
      }
      document.getElementsByName("username")[0].value=v[15];
      document.getElementsByName("password")[0].value=v[16];
      document.getElementsByName("cpassword")[0].value=v[16];
      document.getElementsByName("button")[0].value="update";
    }
  };
  xhttp.open("POST", "docusreq.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("code="+n+"&t="+z);

 //alert(v);


}

function domra() {
  //alert("hi");
  v=document.getElementsByName("status")[0].value;
  if (v=="dom") {
    document.getElementById("domran").style.display="block";
  }
  else{
    document.getElementById("domran").style.display="none";
  }
}
</script>
<?php  include '../includes/foot.php'; ?>
