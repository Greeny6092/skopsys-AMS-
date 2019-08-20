<div id="up"></div>
<?php include '../includes/head.php'; ?>
<?php include('../../database.php');?>
<?php
$p=$_SESSION['per'];

if($p[2]=='0')
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
<div>
  <div class="container">
    <p style="color: royalblue;">Enter Employee Details</p>
    <hr>
    <div class="row">

      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label for="Employee code">Employee Code:</label>
          <input type="text" value="" name="empcode" class="form-control" readonly>
        </div>
      </div>
      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label for="First name">First Name<sup>*</sup>:</label>
          <input type="text" name="firstname" class="form-control" required>
        </div>
      </div>
      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label for="Last name">Last Name<sup>*</sup>:</label>
          <input type="text" name="lastname" class="form-control" required>
        </div>
      </div>

    </div>

    <div class="row">

      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label for="Department">Department<sup>*</sup>:</label>
          <input type="text" name="dept" class="form-control" required>
        </div>
      </div>
      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label for="Email">Email<sup>*</sup>:</label>
          <input type="email" name="email" class="form-control" required>
        </div>
      </div>
      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label for="Mobile Number:">Mobile Number<sup>*</sup>:</label>
          <input type="text" name="mobile" class="form-control" required >
        </div>
      </div>

    </div>

    <div class="row">

        <div class="col-lg-4 col-sm-12 col-md-12">
          <div class="form-group">
            <label for="Status">Status:</label>
            <select class="custom-select" name="status">
              <option value="ACTIVE">ACTIVE</option>
              <option value="INACTIVE">INACTIVE</option>
            </select>
          </div>
        </div>
        <div class="col-lg-4 col-sm-12 col-md-12"></div>
        <div class="col-lg-4 col-sm-12 col-md-12"></div>

    </div>

    <hr>

    <div class="row">

      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label for="Username">Username<sup>*</sup>:</label>
          <input type="text" name="username" class="form-control" required>
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
          <input type="password" name="cpassword" class="form-control" onchange="check_p()">
        </div>
      </div>

    </div>

    <div class="row">

      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label for="Display name">Display Name:</label>
          <input type="text" name="displayname" class="form-control" >
        </div>
      </div>
      <div class="col-lg-4 col-sm-12 col-md-12">
      </div>
      <div class="col-lg-4 col-sm-12 col-md-12"></div>

    </div>

    <hr>

    <div class="row">
      <div class="col-lg-8 col-sm-12 col-md-12"></div>
      <div class="col-lg-4 col-sm-12 col-md-12">
        <input type="button" name="button" value="save" class="btn btn-success" onclick="vali()">
        <input type="button" value="Reset" onclick="location.reload();" class="btn btn-info">
      </div>
    </div>
  </div>
</div>

<hr>

<div class="container">
  <p style="color: royalblue;">Employee Details</p>
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
        <input type="text" name="search" class="form-control" oninput="update()">
      </div>
    </div>
  </div>
  <div class="contain" name="tbl">
<?php
	 $sql = "select empcode,firstname,lastname,dept,email,mobile,status from emp_master";
	$result = $conn->query($sql);
	$i=1;
	if ($result->num_rows > 0){ ?>
  <table class="table table-striped table-hover table-bordered ">
    <thead class="thead-dark">
      <th>Employee Code</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Departments</th>
      <th>Email</th>
      <th>Mobile No</th>
      <th>Status</th>
    </thead>
    <tbody>
	<?php
	while($row = $result->fetch_assoc()){
	 echo "<tr onclick=\"req('".$row['empcode']."');to();\"><td>".$row["empcode"]."</td><td>".$row["firstname"]."</td><td>".$row["lastname"]."</td><td>".$row["dept"]."</td><td>".$row["email"]."</td><td>".$row["mobile"]."</td><td>".$row["status"]."</td></tr>";
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
  xhttp.open("POST", "doempreq.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("l="+v+"&t="+z);

}
function to() {
  location.href="#up";
}
window.onload=function() {
  if((sessionStorage.getItem("success")!==null)){
    toastr.success(sessionStorage.getItem("success"));
    sessionStorage.removeItem("success");
  }
}
var dept,empcode,firstname,lastname,email,mobile,username,password,status,displayname,typ,cpassword;
function check_p()
{
	var pwd=document.getElementsByName("password")[0].value;
	var rpwd=document.getElementsByName("cpassword")[0].value;
	if(pwd.localeCompare(rpwd)!=0)
	{
		console.log("password Mismatch");
		toastr.error("password Mismatch");
	}
}
function query()
{
console.log("check");
var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      //console.log(this.responseText+" "+document.getElementsByName("button")[0].value);
	  //location.reload();
	  let v=this.responseText;
	  //console.log("compare "+v.localeCompare("save"));
	if(v==1)
		sessionStorage.setItem("success","Successfully saved Data");
	else if (v==2) {
    sessionStorage.setItem("success","Successfully updated Data");
  }
	else {
    alert(v);
  }

	location.reload();
	//console.log("reloaded!!!");
    }
  };
  xhttp.open("POST", "doemp.php", false);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("empcode="+empcode+"&firstname="+firstname+"&lastname="+lastname+"&dept="+dept+"&email="+email+"&mobile="+
  mobile+"&username="+username+"&password="+password+"&status="+status+"&displayname="+displayname+"&type="+typ);

}

function vali()
{
	console.log("valstart");
empcode=document.getElementsByName("empcode")[0].value;
firstname=document.getElementsByName("firstname")[0].value;
lastname=document.getElementsByName("lastname")[0].value;
dept=document.getElementsByName("dept")[0].value;
email=document.getElementsByName("email")[0].value;
mobile=document.getElementsByName("mobile")[0].value;
username=document.getElementsByName("username")[0].value;
password=document.getElementsByName("password")[0].value;
cpassword=document.getElementsByName("cpassword")[0].value;
status=document.getElementsByName("status")[0].value;
displayname=document.getElementsByName("displayname")[0].value;
typ=document.getElementsByName("button")[0].value;
var dept_re=/^[a-zA-Z]+$/;
var fname_re=/^[A-Za-z]{2,20}$/;
var lname_re=/^[A-Za-z]*$/;
var email_re=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
var mobile_re=/^[0-9]{10}$/;
var username_re=/^[a-zA-Z0-9]*$/;
//var password_re=/^$/;
//var status_re=/^$/;
var displayname_re=/^[a-zA-Z0-9]*$/;
//var typ_re=/^$/;
//alert("valend");

console.log("going to check dept "+dept);
if(dept==""||!(dept_re.test(dept)))
{
	console.log("invalid");
	toastr.warning("Invalid Department");
	return false;
}
if(firstname==""||!(fname_re.test(firstname)))
{
	toastr.warning("Invalid Firstname");
	return false;
}
if(lastname==""||!(lname_re.test(lastname)))
{
	toastr.warning("Invalid lastname");
	return false;
}
if(email==""||!(email_re.test(email)))
{
	toastr.warning("Invalid Email ID");
	return false;
}
if(mobile==""||!(mobile_re.test(mobile)))
{
	toastr.warning("Invalid Mobile Number");
	return false;
}
if(username==""||!(username_re.test(username)))
{
	toastr.warning("Invalid UserName");
	return false;
}
if(displayname==""||!(displayname_re.test(displayname)))
{
	toastr.warning("Invalid DisplayName");
	return false;
}
if(password.length<5)
{
  toastr.error("password too small");
  return false;
}
if(password.localeCompare(cpassword)!=0)
{
	console.log("password Mismatch");
	toastr.error("password Mismatch");
	return false;
}
//alert(empcode+firstname+lastname+dept+email+mobile+username+password+status+displayname+ip);
//alert("pas");
query();
}


function req(n)
{z='1';
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      v=this.responseText;
      v=v.split("$");
      document.getElementsByName("empcode")[0].value=v[0];
      document.getElementsByName("firstname")[0].value=v[1];
      document.getElementsByName("lastname")[0].value=v[2];
      document.getElementsByName("dept")[0].value=v[3];
      document.getElementsByName("email")[0].value=v[4];
      document.getElementsByName("mobile")[0].value=v[5];
      document.getElementsByName("username")[0].value=v[6];
      document.getElementsByName("password")[0].value=v[7];
      document.getElementsByName("cpassword")[0].value=v[7];
      document.getElementsByName("status")[0].value=v[8];
      document.getElementsByName("displayname")[0].value=v[9];
      document.getElementsByName("button")[0].value="update";
    }
  };
  xhttp.open("POST", "doempreq.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("code="+n+"&t="+z);

 //alert(v);


}
</script>

<?php } include '../includes/foot.php'; ?>
