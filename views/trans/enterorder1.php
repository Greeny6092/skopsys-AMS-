<?php
include '../includes/head.php';
include '../../database.php';
?>


<div class="container" id="up">
  <p style="color: royalblue;">Enter Customer Order</p><hr>
  <div class="row">
    <div class="col-lg-4 col-sm-12 col-md-12">
      <div class="form-group">
        <label for="tcode">Transaction Code<sup>*</sup>:</label>
        <input type="text" name="tcode" class="form-control" value="" readonly>
      </div>
    </div>

    <div class="col-lg-4 col-sm-12 col-md-12">
      <div class="form-group">
        <label for="customercode">Customer Name<sup>*</sup>:</label>
        <select class="custom-select" name="cuscode" oninput="codeq();">
    			<option></option>
    			<?php
            $sql = "select * from cusmaster";
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()){
          ?>
            <option value='<?php echo $row["companyname"] ?>'><?php echo $row["companyname"] ?></option>
    			<?php  }	?>
        </select>
      </div>
    </div>

    <div class="col-lg-4 col-sm-12 col-md-12">
      <div class="form-group">
        <label for="customercode">Customer Code<sup>*</sup>:</label>
        <input type="text" name="cuscode" value="" class="form-control" readonly>
      </div>
    </div>

  </div>

  <div class="row">
    <div class="col-lg-4 col-sm-12 col-md-12">
      <div class="form-group">
        <label for="producttype">Product Category<sup>*</sup>:</label>
         <select class="custom-select" name="prodcatname"  onchange="typeq()">
			        <option></option>
              <?php
                $sql = "select * from productcategory";
                $result = $conn->query($sql);
                while($row = $result->fetch_assoc()){
              ?>
                <option value='<?php echo $row["prodcatname"] ?>'><?php echo $row["prodcatname"] ?></option>
        			<?php } ?>
			   </select>
      </div>
    </div>
    <div class="col-lg-4 col-sm-12 col-md-12">
      <div class="form-group">
        <label for="productcode">Product Code<sup>*</sup>:</label>
        <select class="custom-select" name="pcode"  onchange="codeq();"></select>
      </div>
    </div>
    <div class="col-lg-4 col-sm-12 col-md-12">
      <div class="row">
        <div class="col-6">
          <label>Quantity:</label>
          <input type="number" name="quantity" value="" class="form-control">
        </div>
        <div class="col-6">
          <label>Stock:</label>
          <input type="number" name="stock" value="" class="form-control" readonly>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-4 col-sm-12 col-md-12">
      <div class="form-group">
        <label for="costpermonth">Cost per Month<sup>*</sup>:</label>
        <input type="text" name="costpm" class="form-control" value="">
      </div>
    </div>
    <div class="col-lg-4 col-sm-12 col-md-12">
      <div class="form-group">
        <label for="odate">Order Date<sup>*</sup>:</label>
        <input type="text" name="odate" class="form-control" value="" id="datepicker">
      </div>
    </div>
    <div class="col-lg-4 col-sm-12 col-md-12">
      <label>Serial<sup>*</sup>:</label>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-4 col-sm-12 col-md-12">
      <div class="form-group">
        <label for="descr">Description:</label>
        <textarea name="descr" rows="4" class="form-control" readonly></textarea>
      </div>
    </div>
    <div class="col-lg-4 col-sm-12 col-md-12">
      <div class="form-group">
        <label for="remarks">Remarks:</label>
        <textarea name="remarks" rows="4" class="form-control"></textarea>
      </div>
    </div>
    <div class="col-lg-4 col-sm-12 col-md-12">

    </div>
  </div>

  <hr>
  <div class="row">
    <div class="col-lg-8 col-sm-12 col-md-12"></div>
    <div class="col-lg-4 col-sm-12 col-md-12">
     <input type="button" name="button" value="save" class="btn btn-success" onclick="query();">
     <input type="button" class="btn btn-info" value="reset" onclick="location.reload();">
    </div>
  </div>
</div>

<div class="container">
  <p style="color: royalblue;">Employee Master Details</p>
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
	 $sql = "select * from porder,pclap,peripheral where porder.pcode=pclap.code or porder.pcode=peripheral.code";
	$result = $conn->query($sql);
	$i=1;
	if ($result->num_rows > 0){ ?>
  <table class="table table-striped table-hover table-bordered ">
    <thead class="thead-dark">
      <th>Transaction code</th>
      <th>Product Code</th>
      <th>Product Type</th>
      <th>Customer Code</th>
      <th>Vendor Type</th>
      <th>Description</th>
      <th>Order Date</th>
      <th>Quantity</th>
      <th>Stock</th>
      <th>Cost per month</th>
      <th>Remarks</th>
      <th>Vendor Code</th>
      <th>Receipt no</th>
      <th>Receipt Date</th>
    </thead>
    <tbody>
	<?php
	while($row = $result->fetch_assoc()){
	 echo "<tr onclick=\"req('".$row['tcode']."')\"><td>".$row["tcode"]."</td><td>".$row["pcode"]."</td><td>".$row["ptype"]."</td><td>".$row["cuscode"]."</td><td>".$row["vtype"]."</td><td>".$row["descr"]."</td><td>".$row["odate"]."</td><td>".$row["quantity"]."</td><td>".$row["stock"]."</td><td>".$row["costpm"]."</td><td>".$row["remarks"]."</td></tr>";
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
var pcode;
function typeq()
{
 v=document.getElementsByName('ptype')[0].value;
 var select = document.getElementsByName("pcode")[0];
 while(select.firstChild)
	 select.removeChild(select.firstChild);
 if(v=='')
 {return;}
 if(v=="PC")
 {s="select code from pclap where type='PC'"}
else
if(v=="LAPTOP")
{s="select code from pclap where type='Laptop'"}
else
{s="select code from peripheral"}
t='1';
var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
		let b = this.responseText,i;
		console.log("response text "+b);
		b=b.split("$");
		for(i=0;i<b.length;i++)
			console.log(i+" :"+b[i]);
		var option=document.createElement("OPTION");
		select.appendChild(option);

		b = b.filter(function (el) {
		  return el != "";
		});
		select = document.getElementsByName("pcode")[0];
		console.log("pcode is "+pcode);
		//console.log("In typeq is "+select);
		for(i=0;i<b.length;i++)
		{
			option=document.createElement("OPTION");
			option.innerHTML=b[i];
			option.setAttribute("value",b[i]);

			if(b[i].localeCompare(pcode)==0)
			{
				option.setAttribute("selected",true);
			}
			select.appendChild(option);
		}
		//console.log("In typeq childs "+select.childElementCount);
    }
  };
  xhttp.open("POST", "eotypeq.php", false);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("sql="+s+"&t="+t);

}

function codeq()
{
	v=document.getElementsByName('pcode')[0].value;
	console.log("v is "+v+"\nquery in code q is :");
if(v[1]=='C')
 {s="select descr,stock from pclap where code='"+v+"'";}
else
if(v[1]=='P')
{s="select descr,stock from pclap where code='"+v+"'";}
else
{s="select descr,stock from peripheral where code='"+v+"'";}
t='2';
console.log(s);
var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      let v=this.responseText;
	  console.log(v);
	  v=v.split('$');
	  document.getElementsByName('descr')[0].value=v[0];
	  document.getElementsByName('stock')[0].value=v[1];


    }
  };
  xhttp.open("POST", "eotypeq.php", false);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  console.log("sql="+s+"&t="+t);
  xhttp.send("sql="+s+"&t="+t);

}


function query()
{
alert("check");

tcode=document.getElementsByName("tcode")[0].value;
ptype=document.getElementsByName("ptype")[0].value;
vtype=document.getElementsByName("vtype")[0].value;
costpm=document.getElementsByName("costpm")[0].value;
cuscode=document.getElementsByName("cuscode")[0].value;
pcode=document.getElementsByName("pcode")[0].value;
odate=document.getElementsByName("odate")[0].value;
quantity=document.getElementsByName("quantity")[0].value;
remarks=document.getElementsByName("remarks")[0].value;
vencode=document.getElementsByName("vencode")[0].value;
recno=document.getElementsByName("recno")[0].value;
recdate=document.getElementsByName("recdate")[0].value;
typ=document.getElementsByName("button")[0].value;

alert(tcode+ptype+vtype+costpm+cuscode+pcode+odate+quantity+remarks+vencode+recno);

var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      alert(this.responseText);
	  location.reload();
    }
  };
  xhttp.open("POST", "doorder.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("tcode="+tcode+"&ptype="+ptype+"&vtype="+vtype+"&costpm="+costpm+"&cuscode="+cuscode+"&pcode="+pcode+"&odate="+odate+"&quantity="+quantity+"&remarks="+remarks+"&vencode="+vencode+"&recno="+recno+"&recdate="+recdate+"&typ="+typ);
}

function req(n)
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      let v=this.responseText;
      v=v.split("$");
	  let i=1;
      document.getElementsByName("tcode")[0].value=v[0];
	  document.getElementsByName("ptype")[0].value=v[1];
	  pcode=v[5];
	  typeq();
      document.getElementsByName("vtype")[0].value=v[2];
      document.getElementsByName("costpm")[0].value=v[3];
      document.getElementsByName("cuscode")[0].value=v[4];
	  var select = document.getElementsByName("pcode")[0];
	  //console.log("in req "+select);
	 // console.log("child in req "+select.childElementCount);
	  for(i=1;i<select.childNodes.length;i++)
	  {
		  console.log("hi "+i);
		  if(select.childNodes[i].value.localeCompare(v[5])==0)
			  select.childNodes[i].selected=true;
	  }
	  codeq();
      document.getElementsByName("odate")[0].value=v[6];
      document.getElementsByName("quantity")[0].value=v[7];
      document.getElementsByName("remarks")[0].value=v[8];
      document.getElementsByName("vencode")[0].value=v[9];
      document.getElementsByName("recno")[0].value=v[10];
      document.getElementsByName("recdate")[0].value=v[11];
      document.getElementsByName("button")[0].value="update";
    }
  };
  xhttp.open("POST", "doorderreq.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  console.log("par is "+"\ntcode="+n);
  xhttp.send("tcode="+n);
}

</script>

<?php
include '../includes/foot.php';
?>
