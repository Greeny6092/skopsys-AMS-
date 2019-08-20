<?php include '../includes/head.php'; ?>
<?php include '../../database.php';?>
<?php
$p=$_SESSION['per'];

if($p[5]=='0')
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
    <p style="color: royalblue;">Enter Product Category Details</p>
    <hr>
    <div class="row">

        <div class="col-lg-4 col-sm-12 col-md-12">
          <div class="form-group">
            <label for="Vendor code">Product Category Code<sup>*</sup>:</label>
            <input type="text" name="prodcatcode" class="form-control" readonly>
          </div>
        </div>

        <div class="col-lg-4 col-sm-12 col-md-12">
          <div class="form-group">
            <label for="Vendor Name">Product Category Name<sup>*</sup>:</label>
            <input type="text" name="prodcatname" class="form-control">
          </div>
        </div>

        <div class="col-lg-4 col-sm-12 col-md-12">

          <div class="form-group">
            <div class="form-group">
              <label for="Status">Status:</label>
              <select class="custom-select" name="status">
                <option value="active">ACTIVE</option>
                <option value="inactive">INACTIVE</option>
              </select>
            </div>
          </div>
        </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-lg-8 col-sm-12 col-md-12"></div>
      <div class="col-lg-4 col-sm-12 col-md-12">
        <input type="button" value="save" class="btn btn-success" name="button" onclick="query()">
        <input type="button" value="reset" class="btn btn-info" onclick="location.reload();">
      </div>
    </div>
  </div>

<hr>

<div class="container" >
  <p style="color: royalblue;">Product Category Details</p>
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
  	$sql = "select * from productcategory";
  	$result = $conn->query($sql);
    echo $conn->error;
  	$i=1;
  	if ($result->num_rows > 0){
  ?>
  <table class="table table-striped table-hover table-bordered ">
    <thead class="thead-dark">
      <th>Product Category Code</th>
      <th>Product Category Name</th>
      <th>Status</th>
    </thead>
    <tbody>
      <?php while($row = $result->fetch_assoc()){ ?>
        <tr onclick="req('<?php echo $row['prodcatcode']?>');">
          <td><?php echo $row["prodcatcode"]?></td>
          <td><?php echo $row["prodcatname"]?></td>
          <td><?php echo $row["status"]?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
<?php
      }
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
  xhttp.open("POST", "doprocatreq.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("l="+v+"&t="+z);

}

function query()
{
//alert("check");
let v;
prodcatcode=document.getElementsByName("prodcatcode")[0].value;
prodcatname=document.getElementsByName("prodcatname")[0].value;
status=document.getElementsByName("status")[0].value;
typ=document.getElementsByName("button")[0].value;

//alert(prodcatcode+prodcatname+status);

var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      v = this.responseText;
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
  xhttp.open("POST", "doprocat.php", false);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("prodcatcode="+prodcatcode+"&prodcatname="+prodcatname+"&status="+status+"&type="+typ);
}

function req(n)
{ z='1';
  //alert("hi");
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      v=this.responseText;
  	  v=v.split("$");
      document.getElementsByName("prodcatcode")[0].value=v[0];
      document.getElementsByName("prodcatname")[0].value=v[1];
      document.getElementsByName("status")[0].value=v[2];
      document.getElementsByName("button")[0].value="update";

    }
  };
  xhttp.open("POST", "doprocatreq.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("code="+n+"&t="+z);

 //alert(v);

}
</script>
<?php } include '../includes/foot.php'; ?>
