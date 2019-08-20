<?php include '../includes/head.php';
include '../../database.php';?>
<style media="screen">
.contain{
    height: auto;
    width: inherit;
    max-width: 120vw;

    overflow-x: scroll !important;
    overflow-y: scroll !important;
}
</style>
<div>
  <div class="container">
    <p style="color: royalblue;">Enter Employee Rights</p>
    <hr>
    <div class="row">

        <div class="col-lg-4 col-sm-12 col-md-12">

          <div class="form-group">
            <label for="Employee code">Employee/User Code:</label>
            <select class="custom-select" name="code" onchange="query()">
			<option></option>
              <?php
              $sql = "select * from emp_master";
              $result = $conn->query($sql);


                while($row = $result->fetch_assoc()){
                ?>
              <option><?php echo $row["empcode"] ?></option>
            <?php
                  }

            ?>
			<?php
              $sql = "select * from cusmaster";
              $result = $conn->query($sql);


                while($row = $result->fetch_assoc()){
                ?>
              <option><?php echo $row["cuscode"] ?></option>
            <?php
                  }

            ?>

            </select>
          </div>
        </div>

        <div class="col-lg-4 col-sm-12 col-md-12">
          <div class="form-group">
            <label for="Employee Name">Employee Name:</label>
            <input type="text" name="name" class="form-control" readonly>
          </div>
        </div>

        <div class="col-lg-4 col-sm-12 col-md-12 pt-2">
          <br>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="dc" onchange="check()">
            <label class="form-check-label" for="defaultCheck1">
              Select all Screens
            </label>
          </div>

        </div>

    </div>
    <hr>
    <div class="row">
      <div class="col-lg-8 col-sm-12 col-md-12"></div>
      <div class="col-lg-4 col-sm-12 col-md-12">
        <input type="button" value="save" onclick="save()" class="btn btn-success">
        <input type="reset" value="Reset" class="btn btn-info" onclick="location.reload();">
      </div>
    </div>
  </div>
</div>

<hr>

<div class="container">
  <p style="color: royalblue;">User Authentication Details</p>
  <hr>

  <div class="contain">
  <table class="table table-striped table-hover table-bordered">
    <thead class="thead-dark">
      <th>ISSelect</th>
      <th>ScreenName</th>
        <th>DashBoard</th>
    </thead>
    <tbody>


      <tr>
        <td>
          <div class="form-group">
            <input type="checkbox" name="cc" value="" class="custom-checkbox">
          </div>
        </td>
        <td>DashBoard</td>
        <td>DashBoard</td>
      </tr>
       <tr>
        <td>
          <div class="form-group">
            <input type="checkbox" name="cc" value="" class="custom-checkbox">
          </div>
        </td>
        <td>Admin</td>
        <td>Admin</td>
      </tr>
       <tr>
        <td>
          <div class="form-group">
            <input type="checkbox" name="cc" value="" class="custom-checkbox">
          </div>
        </td>
        <td>Employee Master</td>
         <td>Master</td>
      </tr>
       <tr>
        <td>
          <div class="form-group">
            <input type="checkbox" name="cc" value="" class="custom-checkbox">
          </div>
        </td>
        <td>Customer Master</td>
        <td>Master</td>
      </tr>
       <tr>
        <td>
          <div class="form-group">
            <input type="checkbox" name="cc" value="" class="custom-checkbox">
          </div>
        </td>
        <td>Vendor Master</td>
        <td>Master</td>
      </tr>
       <tr>
        <td>
          <div class="form-group">
            <input type="checkbox" name="cc" value="" class="custom-checkbox">
          </div>
        </td>
        <td>Product Category Master</td>
        <td>Master</td>
      </tr>
       <tr>
        <td>
          <div class="form-group">
            <input type="checkbox" name="cc" value="" class="custom-checkbox">
          </div>
        </td>
        <td>Product Master</td>
        <td>Master</td>
      </tr>
       <tr>
        <td>
          <div class="form-group">
            <input type="checkbox" name="cc" value="" class="custom-checkbox">
          </div>
        </td>
        <td>User Screen Config</td>
        <td>Master</td>
      </tr>
       <tr>
        <td>
          <div class="form-group">
            <input type="checkbox" name="cc" value="" class="custom-checkbox">
          </div>
        </td>
        <td>Transaction Details</td>
        <td>Transaction</td>
      </tr>
       <tr>
        <td>
          <div class="form-group">
            <input type="checkbox" name="cc" value="" class="custom-checkbox">
          </div>
        </td>
        <td>Product Stock</td>
        <td>Transaction</td>
      </tr>
      <tr>
        <td>
          <div class="form-group">
            <input type="checkbox" name="cc" value="" class="custom-checkbox">
          </div>
        </td>

        <td>Serial No.Reprint</td>
        <td>Transaction</td>
      </tr>
       <tr>
        <td>
          <div class="form-group">
            <input type="checkbox" name="cc" value="" class="custom-checkbox">
          </div>
        </td>
        <td>Delivery Challan</td>
        <td>Transaction</td>
      </tr>
       <tr>
        <td>
          <div class="form-group">
            <input type="checkbox" name="cc" value="" class="custom-checkbox">
          </div>
        </td>
        <td>Customer Invoice</td>
        <td>Transaction</td>
      </tr>
       <tr>
        <td>
          <div class="form-group">
            <input type="checkbox" name="cc" value="" class="custom-checkbox">
          </div>
        </td>
        <td>Customer Return</td>
        <td>Transaction</td>
      </tr>
       <tr>
        <td>
          <div class="form-group">
            <input type="checkbox" name="cc" value="" class="custom-checkbox">
          </div>
        </td>
        <td>Vendor Invoice</td>
        <td>Transaction</td>
      </tr>
       <tr>
        <td>
          <div class="form-group">
            <input type="checkbox" name="cc" value="" class="custom-checkbox">
          </div>
        </td>
        <td>Vendor Return</td>
        <td>Transaction</td>
      </tr>
       <tr>
        <td>
          <div class="form-group">
            <input type="checkbox" name="cc" value="" class="custom-checkbox">
          </div>
        </td>
        <td>Upgradation</td>
        <td>Transaction</td>
      </tr>
       <tr>
        <td>
          <div class="form-group">
            <input type="checkbox" name="cc" value="" class="custom-checkbox">
          </div>
        </td>
        <td>Replacement Out</td>
        <td>Transaction</td>
      </tr>
       <tr>
        <td>
          <div class="form-group">
            <input type="checkbox" name="cc" value="" class="custom-checkbox">
          </div>
        </td>
        <td>Replacement In</td>
        <td>Transaction</td>
      </tr>
       <tr>
        <td>
          <div class="form-group">
            <input type="checkbox" name="cc" value="" class="custom-checkbox">
          </div>
        </td>
        <td>Billing Details</td>
        <td>Billing</td>
      </tr>
       <tr>
        <td>
          <div class="form-group">
            <input type="checkbox" name="cc" value="" class="custom-checkbox">
          </div>
        </td>
        <td>Customer Payment Details</td>
        <td>Billing</td>
      </tr>
       <tr>
        <td>
          <div class="form-group">
            <input type="checkbox" name="cc" value="" class="custom-checkbox">
          </div>
        </td>
        <td>Vendor Payment Details</td>
        <td>Billing</td>
      </tr>
       <tr>
        <td>
          <div class="form-group">
            <input type="checkbox" name="cc" value="" class="custom-checkbox">
          </div>
        </td>
        <td>Report</td>
        <td>Report</td>
      </tr>
       <tr>
        <td>
          <div class="form-group">
            <input type="checkbox" name="cc" value="" class="custom-checkbox">
          </div>
        </td>
        <td>Stock Count Report</td>
        <td>Report</td>
      </tr>
	  <tr>
        <td>
          <div class="form-group">
            <input type="checkbox" name="cc" value="" class="custom-checkbox">
          </div>
        </td>
        <td>Customer Stock Report</td>
        <td>Report</td>
      </tr>
       <tr>
        <td>
          <div class="form-group">
            <input type="checkbox" name="cc" value="" class="custom-checkbox">
          </div>
        </td>
        <td>Delivery Challan Report</td>
        <td>Report</td>
      </tr>
       <tr>
        <td>
          <div class="form-group">
            <input type="checkbox" name="cc" value="" class="custom-checkbox">
          </div>
        </td>
        <td>Customer Invoice Report</td>
        <td>Report</td>
      </tr>
       <tr>
        <td>
          <div class="form-group">
            <input type="checkbox" name="cc" value="" class="custom-checkbox">
          </div>
        </td>
        <td>Ticket</td>
        <td>Ticket</td>
      </tr>
       <tr>
        <td>
          <div class="form-group">
            <input type="checkbox" name="cc" value="" class="custom-checkbox">
          </div>
        </td>
        <td>Ticketing</td>
        <td>CustomerTicket</td>
      </tr>
       <tr>
        <td>
          <div class="form-group">
            <input type="checkbox" name="cc" value="" class="custom-checkbox">
          </div>
        </td>
        <td>Ticketing</td>
         <td>AdminTicket</td>
      </tr>
       <tr>
        <td>
          <div class="form-group">
            <input type="checkbox" name="cc" value="" class="custom-checkbox">
          </div>
        </td>
        <td>Ticket summary</td>
         <td>AdminTicket</td>
      </tr>
       <tr>
        <td>
          <div class="form-group">
            <input type="checkbox" name="cc" value="" class="custom-checkbox">
          </div>
        </td>
        <td>Invoice Cancel</td>
         <td>Transaction</td>
      </tr>




    </tbody>
  </table>
  </div>
</div>
<script>
function query()
{
	code=document.getElementsByName("code")[0].value;
	//alert(code);
	var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
	  v=this.responseText;
	  v=v.split("&");
      document.getElementsByName("name")[0].value=v[0];
	  a=v[1];
	  for(i=0;i<32;i++)
	  { if(a[i]==1)
		  document.getElementsByName("cc")[i].checked=true;
		  else
			  document.getElementsByName("cc")[i].checked = false;
	  }
    }
  };
  xhttp.open("POST", "douserreq.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("code="+code);

}


function save()
{
	code=document.getElementsByName("code")[0].value;
	s='';
	//alert("he");
	var checkBox=document.getElementsByName("cc");
	for(i=0;i<32;i++)
		if(checkBox[i].checked==true)
			s=s+'1';
		else
			s=s+'0';

	//alert(s);
			var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
	  v=this.responseText;
	  alert(v);
    location.reload();
    }
  };
  xhttp.open("POST", "douser.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("code="+code+"&s="+s);




}
function check()
{   var checkBox=document.getElementsByName("cc");
	if(document.getElementById("dc").checked==true)
	{
		for(i=0;i<32;i++)
			checkBox[i].checked=true;
	}
else
	{
		for(i=0;i<32;i++)
			checkBox[i].checked=false;
	}
}
</script>

<?php include '../includes/foot.php'; ?>
