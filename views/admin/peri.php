<?php include '../includes/head.php';
include '../../database.php';?>
<?php
$p=$_SESSION['per'];

if($p[6]=='0')
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

  <div class="container">
    <div class="row">

        <div class="col-lg-4 col-sm-12 col-md-12">
          <div class="form-group">
            <label for="code">Code<sup>*</sup>:</label>
            <input type="text" name="code" class="form-control" readonly>
          </div>
          <div class="form-group">
            <label for="desc">Description:</label>
            <textarea name="desc" rows="2" class="form-control"></textarea>
          </div>
          <div class="form-group">
            <label for="sgst">SGST(%)<sup>*</sup>:</label>
            <input type="number" name="sgst" class="form-control">
          </div>
        </div>

        <div class="col-lg-4 col-sm-12 col-md-12">
          <div class="form-group">
            <label for="peri">Peripheral Select<sup>*</sup>:</label>
            <select class="custom-select" name="peritype">
              <?php ?>
                <option value="">Select a Option</option>
				<option value="RAM">RAM</option>
				<option value="MONITOR">MONITOR</option>
				<option value="PROCESSOR">PROCESSOR</option>
				<option value="GCARD">GCARD</option>
				<option value="HDD">HDD</option>
				<option value="SDD">SDD</option>
				<option value="KEYBOARD">KEYBOARD</option>
				<option value="MOUSE">MOUSE</option>
              <?php ?>
            </select>
          </div>
          <div class="form-group">
            <label for="spec">Specifications<sup>*</sup>:</label>
            <input type="text" name="spec" class="form-control">
          </div>
          <div class="form-group">
            <label for="cgst">CGST(%)<sup>*</sup>:</label>
            <input type="number" name="cgst" class="form-control">
          </div>
          <div class="form-group">
            <label for="warranty">Warranty</label>
            <input type="text" name="warranty" class="form-control">
          </div>
        </div>

        <div class="col-lg-4 col-sm-12 col-md-12">
          <div class="form-group">
            <label for="brand">Brand<sup>*</sup>:</label>
            <input type="text" name="brand" class="form-control">
          </div>
          <div class="form-group">
            <label for="stock">Stock<sup>*</sup>:</label>
            <input type="text" name="stock" class="form-control">
          </div>
          <div class="form-group">
            <label for="igst">IGST(%)<sup>*</sup>:</label>
            <input type="number" name="igst" class="form-control">
          </div>
        </div>

    </div>
    <hr>
    <div class="row">
      <div class="col-lg-8 col-sm-12 col-md-12"></div>
      <div class="col-lg-4 col-sm-12 col-md-12">
        <input type="button" name="button" value="save" class="btn btn-success" onclick="query();">
        <input type="reset" value="reset" class="btn btn-info" onclick="location.reload();">
      </div>
    </div>
  </div>

<hr>

<div class="container">
  <p style="color: royalblue;">Product Master Details</p>
  <hr>

  <div class="row">
    <div class="col-lg-2">copy,csv,print</div>
    <div class="col-lg-10"></div>
  </div>

  <div class="row">
    <div class="col-lg-10"></div>
    <div class="col-lg-2">search</div>
  </div>
  <div class="contain">


<?php
    $sql = "select * from peripheral";
    $result = $conn->query($sql);
    echo $conn->error;
    if ($result->num_rows > 0){
?>
<table class="table table-striped table-hover table-bordered ">
  <thead class="thead-dark">
      <th>Code</th>
      <th>Description</th>
      <th>Brand</th>
      
      <th>Specifications</th>
	  <th>Type</th>
	  <th>Stock</th>
      
    </thead>
    <tbody>
      <?php while($row = $result->fetch_assoc()){ ?>
        <tr onclick="req('<?php echo $row["code"]; ?>')">
			<td><?php echo $row["code"]; ?></td>
          <td><?php echo $row["descr"]; ?></td>
          <td><?php echo $row["brand"]; ?></td>
          <td><?php echo $row["spec"]; ?></td>
          <td><?php echo $row["type"]; ?></td>
          <td><?php echo $row["stock"]; ?></td>
          
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
function query()
{
//alert("check");
code=document.getElementsByName("code")[0].value;
peritype=document.getElementsByName("peritype")[0].value;
brand=document.getElementsByName("brand")[0].value;
desc=document.getElementsByName("desc")[0].value;
spec=document.getElementsByName("spec")[0].value;
stock=document.getElementsByName("stock")[0].value;
sgst=document.getElementsByName("sgst")[0].value;
cgst=document.getElementsByName("cgst")[0].value;
igst=document.getElementsByName("igst")[0].value;
warranty=document.getElementsByName("warranty")[0].value;
typ=document.getElementsByName("button")[0].value;

//alert(procode+prodcatname+prodesc+proconfig+sgst+cgst+igst+hsncode+saccode+status);

var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      alert(this.responseText);
	    location.reload();
    }
  };
  xhttp.open("POST", "doperi.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("code="+code+"&type="+peritype+"&brand="+brand+"&descr="+desc+"&spec="+spec+"&stock="+stock+"&sgst="+sgst+"&cgst="+cgst+"&igst="+igst+"&warranty="+warranty+"&typ="+typ);
}

function req(n)
{
  //alert("hi");
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      v=this.responseText;
      v=v.split("$");
      document.getElementsByName("code")[0].value=v[0];
document.getElementsByName("desc")[0].value=v[1];
document.getElementsByName("sgst")[0].value=v[2];

document.getElementsByName("peritype")[0].value=v[3];
document.getElementsByName("spec")[0].value=v[4];
document.getElementsByName("cgst")[0].value=v[5];
document.getElementsByName("warranty")[0].value=v[6];
document.getElementsByName("brand")[0].value=v[7];


document.getElementsByName("stock")[0].value=v[8];


document.getElementsByName("igst")[0].value=v[9];

      document.getElementsByName("button")[0].value="update";
    }
  };
  xhttp.open("POST", "doperireq.php", false);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("code="+n);

//alert(v);


}
</script>
<?php } include '../includes/foot.php'; ?>
