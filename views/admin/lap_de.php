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

  <div class="container">
    <div class="row">

        <div class="col-lg-4 col-sm-12 col-md-12">
          <div class="form-group">
            <label for="code">Code<sup>*</sup>:</label>
            <input type="text" name="code" class="form-control" readonly>
          </div>
          <div class="form-group">
            <label for="processor">Processor<sup>*</sup>:</label>
            <input type="text" name="processor" class="form-control">
          </div>
          <div class="form-group">
            <label for="motherboard">Mother Board<sup>*</sup>:</label>
            <input type="text" name="mobo" class="form-control">
          </div>
          <div class="form-group">
            <label for="sgst">SGST(%)<sup>*</sup>:</label>
            <input type="number" name="sgst" class="form-control">
          </div>
          <div class="form-group">
            <label for="descr">Description:</label>
            <textarea name="descr" rows="3" class="form-control"></textarea>
          </div>
        </div>

        <div class="col-lg-4 col-sm-12 col-md-12">
          <div class="form-group">
            <label for="code">PC/Laptop<sup>*</sup>:</label>
            <select class="custom-select" name="type">
              <option value="PC">PC</option>
              <option value="Laptop">Laptop</option>
            </select>
          </div>
          <div class="form-group">
            <label for="ram">Ram<sup>*</sup>:</label>
            <input type="text" name="ram" class="form-control">
          </div>
          <div class="form-group">
            <label for="screen">Monitor<sup>*</sup>:</label>
            <input type="text" name="monitor" class="form-control">
          </div>
          <div class="form-group">
            <label for="cgst">CGST(%)<sup>*</sup>:</label>
            <input type="number" name="cgst" class="form-control">
          </div>
          <div class="form-group">
            <label for="warranty">Warranty<sup>*</sup>:</label>
            <input type="text" name="warranty" class="form-control">
          </div>

        </div>

        <div class="col-lg-4 col-sm-12 col-md-12">

          <div class="form-group">
            <label for="brand">Brand<sup>*</sup>:</label>
            <input type="text" name="brand" class="form-control">
          </div>
          <div class="form-group">
            <label for="graphicscard">Graphics Card:</label>
            <input type="text" name="gcard" class="form-control">
          </div>
          <div class="form-group">
            <label for="stock">Stock<sup>*</sup>:</label>
            <input type="text" name="stock" class="form-control">
          </div>
          <div class="form-group">
            <label for="IGST">IGST(%)<sup>*</sup>:</label>
            <input type="number" name="igst" class="form-control">
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

<div class="container">
  <p style="color: royalblue;">Product Details</p>
  <hr>

  <div class="row">
    <div class="col-lg-2 col-sm-12 col-md-12">copy,csv,print</div>
    <div class="col-lg-10 col-sm-12 col-md-12"></div>
  </div>

  <div class="row">
    <div class="col-lg-10 col-sm-12 col-md-12"></div>
    <div class="col-lg-2 col-sm-12 col-md-12">search</div>
  </div>
<div class="contain">


  <?php
  	$sql = "select * from pclap";
  	$result = $conn->query($sql);
    echo $conn->error;
  	$i=1;
  	if ($result->num_rows > 0){
  ?>
  <table class="table table-striped table-hover table-bordered ">
    <thead class="thead-dark">
      <th>Code</th>
      <th>PC/Laptop</th>
      <th>Brand</th>
      <th>Processor</th>
      <th>RAM</th>
      <th>G-Card</th>
      <th>Mother Board</th>
      <th>Monitor</th>
      <th>Stock</th>
      <th>SGST</th>
      <th>CGST</th>
      <th>IGST</th>
      <th>Warranty</th>
    </thead>
    <tbody>
      <?php while($row = $result->fetch_assoc()){ ?>
        <tr onclick="req('<?php echo $row['code']?>');">
          <td><?php echo $row["code"]?></td>
          <td><?php echo $row["type"]?></td>
          <td><?php echo $row["brand"]?></td>
          <td><?php echo $row["processor"]?></td>
          <td><?php echo $row["ram"]?></td>
          <td><?php echo $row["gcard"]?></td>
          <td><?php echo $row["mobo"]?></td>
          <td><?php echo $row["monitor"]?></td>
          <td><?php echo $row["stock"]?></td>
          <td><?php echo $row["sgst"]?></td>
          <td><?php echo $row["cgst"]?></td>
          <td><?php echo $row["igst"]?></td>
          <td><?php echo $row["descr"]?></td>
          <td><?php echo $row["warranty"]?></td>
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
let v;
code=document.getElementsByName("code")[0].value;
type=document.getElementsByName("type")[0].value;
brand=document.getElementsByName("brand")[0].value;
processor=document.getElementsByName("processor")[0].value;
ram=document.getElementsByName("ram")[0].value;
gcard=document.getElementsByName("gcard")[0].value;
mobo=document.getElementsByName("mobo")[0].value;
monitor=document.getElementsByName("monitor")[0].value;
stock=document.getElementsByName("stock")[0].value;
sgst=document.getElementsByName("sgst")[0].value;
cgst=document.getElementsByName("cgst")[0].value;
igst=document.getElementsByName("igst")[0].value;
warranty=document.getElementsByName("warranty")[0].value;
descr=document.getElementsByName("descr")[0].value;
typ=document.getElementsByName("button")[0].value;

//alert(prodcatcode+prodcatname+status);

var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      alert(this.responseText);
	  setTimeout(function()
	  {location.reload();},3000);
	    
    }
  };
  xhttp.open("POST", "dolapde.php", false);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("code="+code+"&type="+type+"&brand="+brand+"&processor="+processor+"&ram="+ram+"&gcard="+gcard+"&mobo="+mobo+"&monitor="+monitor+"&stock="+stock+"&sgst="+sgst+"&cgst="+cgst+"&igst="+igst+"&warranty="+warranty+"&typ="+typ+"&descr="+descr);
  console.log("code="+code+"&type="+type+"&brand="+brand+"&processor="+processor+"&ram="+ram+"&gcard="+gcard+"&mobo="+mobo+"&monitor="+monitor+"&stock="+stock+"&sgst="+sgst+"&cgst="+cgst+"&igst="+igst+"&warranty="+warranty+"&typ="+typ+"&descr="+descr);
}

function req(n)
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      v=this.responseText;
  	  v=v.split("$");
      document.getElementsByName("code")[0].value=v[0];
      document.getElementsByName("type")[0].value=v[5];
      document.getElementsByName("brand")[0].value=v[10];
      document.getElementsByName("processor")[0].value=v[1];
      document.getElementsByName("ram")[0].value=v[6];
      document.getElementsByName("gcard")[0].value=v[11];
      document.getElementsByName("mobo")[0].value=v[2];
      document.getElementsByName("monitor")[0].value=v[8];
      document.getElementsByName("stock")[0].value=v[12];
      document.getElementsByName("sgst")[0].value=v[3];
      document.getElementsByName("cgst")[0].value=v[8];
      document.getElementsByName("igst")[0].value=v[13];
      document.getElementsByName("warranty")[0].value=v[9];
      document.getElementsByName("descr")[0].value=v[4];
      document.getElementsByName("button")[0].value="update";

    }
  };
  xhttp.open("POST", "dolapdereq.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("code="+n);
}
</script>
<?php } include '../includes/foot.php'; ?>
