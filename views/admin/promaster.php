<div id="up">

</div>
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
<style media="screen">
  td:hover{
    cursor: pointer;
  }
</style>

  <div class="container ">
    <p style="color: royalblue;">Enter Product Details</p>
    <hr>
    <div class="row">

        <div class="col-lg-4 col-sm-12 col-md-12">
          <div class="form-group">
            <label for="Product code">Product Code<sup>*</sup>:</label>
            <input type="text" name="procode" class="form-control" readonly>
          </div>
        </div>
        <div class="col-lg-4 col-sm-12 col-md-12">
          <div class="form-group">
            <label for="Product code">Product Category<sup>*</sup>:</label>
            <select class="custom-select" name="prodcatname">
              <option value=""></option>
              <?php
              $sql = "select prodcatname from productcategory";
              $result = $conn->query($sql);
              echo $conn->error;
              if ($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                ?>
              <option value="<?php echo $row["prodcatname"] ?>"><?php echo $row["prodcatname"] ?></option>
            <?php
                  }
                }
            ?>
            </select>
          </div>
        </div>
        <div class="col-lg-4 col-sm-12 col-md-12">
          <div class="form-group">
            <label for="Product Description">Product Description<sup>*</sup>:</label>
            <input type="text" name="prodesc" class="form-control">
          </div>
        </div>

    </div>

    <div class="row">
      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label for="Product Config">Product Config<sup>*</sup>:</label>
          <input type="text" name="proconfig" class="form-control input-element" data-toggle="tooltip" data-placement="top" title="processor-generation-motherboard-RAM-HDD-GC type">
        </div>
      </div>
      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label for="SGST">SGST(%)<sup>*</sup>:</label>
          <input type="number" name="sgst" class="form-control">
        </div>
      </div>
      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label for="CGST">CGST(%)<sup>*</sup>:</label>
          <input type="number" name="cgst" class="form-control">
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label for="IGST">IGST(%)<sup>*</sup>:</label>
          <input type="number" name="igst" class="form-control">
        </div>
      </div>
      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label for="HSN Code">HSN Code<sup>*</sup>:</label>
          <input type="text" name="hsncode" class="form-control">
        </div>
      </div>
      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label for="HSN Code">SAC Code<sup>*</sup>:</label>
          <input type="text" name="saccode" class="form-control">
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label for="stock">Stock<sup>*</sup>:</label>
          <input type="number" name="stock" class="form-control" oninput="createbox()">
        </div>
      </div>
      <div class="col-lg-4 col-sm-12 col-md-12">
		<label for="serial">Serial<sup>*</sup>:</label>
        <div name="box" class="form-group">

		</div>
      </div>
      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label>ACTIVE/INACTIVE<sup>*</sup>:</label>
          <select class="custom-select" name="status" disabled>
            <option value="ACTIVE">ACTIVE</option>
            <option value="RENTAL">RENTAL</option>
            <option value="SERVICE">SERVICE</option>
            <option value="SCRAP">SCRAP</option>
            <option value="RETURNING">RETURNING</option>
            <option value="REPAIR">REPAIR</option>
			<option value="REPIN">REPIN</option>
			<option value="REPOUT">REPOUT</option>
          </select>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label for="vendortype">Vendor Type<sup>*</sup>:</label>
          <select class="custom-select" name="vtype" oninput="vtype()">
            <option value="DIRECT">DIRECT</option>
            <option value="RENTAL">RENTAL</option>
          </select>
        </div>
      </div>
      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label>Warranty:</label>
          <textarea name="warranty" rows="1" class="form-control">N/A</textarea>
        </div>
      </div>
      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label>Purchase Date:</label>
          <div class="row">
            <div class="col-9">
              <input type="date" name="purrdate"  class="form-control">
            </div>
            <div class="col-3">
              <button type="button" name="" class="btn btn-dark" onclick="setdate();">Date</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label for="customercode">Vendor Name<sup>*</sup>:</label>
          <input type="text" name="venname" class="form-control" oninput="pq();" list="vencode" readonly>
          <datalist id="vencode">
            <option></option>

             <?php
               $sql = "select * from venmaster";
               $result = $conn->query($sql);
                while($row = $result->fetch_assoc()){
             ?>
               <option><?php echo $row["vendorname"] ?>(<?php echo $row["vencode"] ?>)</option>
             <?php } ?>
          </datalist>
          <input type="text" name="vencode" value="" hidden>
        </div>
      </div>

      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label for="receiptno">Receipt Number<sup>*</sup>:</label>
          <input type="number" name="recno" class="form-control" value="" readonly>
        </div>
      </div>

      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label for="receiptdate">Receipt Date<sup>*</sup>:</label>
          <input type="date" name="recdate" class="form-control" value="" readonly>
        </div>
      </div>

    </div>
    <hr>
    <form action="printbar.php" method="post" target="_blank">
      <div class="row" >

        <div class="col-lg-4 col-sm-12 col-md-12">
          <div class="form-group" id="bar" style="display:none;">
            <label>Serial:</label>
            <input type="text" name="serial0" value="" class="form-control">
          </div>
        </div>
        <div class="col-lg-6 col-sm-12 col-md-12">

          <div id="barcode" style="display:none;">
            <label>Bar Code:</label>
            <div id="barcode1" style="background-color:white;border-radius:5px;height:38px;padding-left:20px;padding-top:4px;">

            </div>
          </div>
        </div>
        <div class="col-lg-2 col-sm-12 col-md-12">
          <label>&nbsp; </label>
          <button type="submit" class="btn btn-dark" id="barprint" style="display:none;">Print</button>
        </div>
      </div>
    </form>
    <hr>
    <div class="row">
      <div class="col-lg-8 col-sm-12 col-md-12"></div>
      <div class="col-lg-4 col-sm-12 col-md-12">
        <input type="button" name="button" class="btn btn-success" onclick="query();" value="save">
        <input type="reset" value="reset" class="btn btn-info" onclick="location.reload();">

      </div>
    </div>
  </div>

<hr>

<div class="container mb-5">
  <p style="color: royalblue;">Product Details</p>
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
        <input type="text" name="search" oninput="update()"class="form-control">
      </div>
    </div>
  </div>
  <div class="contain" name="tbl">


<?php
    $sql = "select * from promaster";
    $result = $conn->query($sql);
    echo $conn->error;
    if ($result->num_rows > 0){
?>
<table class="table table-striped table-hover table-bordered ">
  <thead class="thead-dark">
      <th>Product Code</th>
      <th>Product Category</th>
      <th>Product Description</th>
      <th>Product Configuration</th>
	  <th>Serial No.</th>
      <th>SGST</th>
      <th>CGST</th>
      <th>IGST</th>
      <th>HSN Code</th>
      <th>SAC Code</th>
      <th>Vendor Type</th>
      <th>Status</th>
    </thead>
    <tbody>
      <?php while($row = $result->fetch_assoc()){ ?>
        <tr onclick="req('<?php echo $row["serial"]; ?>');to();">
          <td><?php echo $row["procode"]; ?></td>
          <td><?php echo $row["prodcatname"]; ?></td>
          <td><?php echo $row["prodesc"]; ?></td>
          <td><?php echo $row["proconfig"]; ?></td>
		      <td><?php echo $row["serial"]; ?></td>
          <td><?php echo $row["sgst"]; ?></td>
          <td><?php echo $row["cgst"]; ?></td>
          <td><?php echo $row["igst"]; ?></td>
          <td><?php echo $row["hsncode"]; ?></td>
          <td><?php echo $row["saccode"]; ?></td>
          <td><?php echo $row["vtype"]; ?></td>
          <td><?php echo $row["status"]; ?></td>
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
var val="",sc="";
var cleave = new Cleave('.input-element', {
    delimiter: '-',
    blocks: [3, 2, 3, 3, 3, 3],
    uppercase: true
});

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

function setdate() {
  date="<?php echo date('Y')."-".date('m')."-".date('d'); ?>";
  //alert(date);
  document.getElementsByName("purrdate")[0].value=date;
}

function to() {
  location.href="#up";
}

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
  xhttp.open("POST", "doproreq.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("l="+v+"&t="+z);

}

function pq()
{
	v=document.getElementsByName('venname')[0].value;
  v=v.split("(");
  //alert(v);
  cusname = v[0];
  cuscode = v[1].split(")");
  document.getElementsByName('venname')[0].value=cusname;
  document.getElementsByName('vencode')[0].value=cuscode[0];
}

function descq()
{
  var serials=document.getElementsByName('serials'),k=0,j=0;
  //alert("child count is "+serials[0].childElementCount+"\nserials.length is "+serials.length);
  console.log("serial length "+serials.length);
  for(k=0;k<serials.length;k++)
  {
	serials[k].childNodes[0].style.borderColor="transparent";
	serials[k].childNodes[0].style.backgroundColor="white";
  }
  for(k=0;k<serials.length-1;k++)
  {
	  if(serials[k].childNodes[0].value.length>0)
	  {
		  for(j=k+1;j<serials.length;j++)
		  {
			  //i!=j
				if(serials[j].childNodes[0].value==serials[k].childNodes[0].value)
				{
					console.log("matched "+j);
					console.log("already exist!!! j is "+j);
					//document.getElementsByName("mbutton")[0].dataShow=true;
					serials[k].childNodes[0].style.borderColor="tomato";
					serials[k].childNodes[0].style.backgroundColor="tomato";
					serials[j].childNodes[0].style.borderColor="tomato";
					serials[j].childNodes[0].style.backgroundColor="tomato";
				}
		  }
	  }
  }
}
function query()
{
//alert("check");
procode=document.getElementsByName("procode")[0].value;
prodcatname=document.getElementsByName("prodcatname")[0].value;
prodesc=document.getElementsByName("prodesc")[0].value;
proconfig=document.getElementsByName("proconfig")[0].value;
sgst=document.getElementsByName("sgst")[0].value;
cgst=document.getElementsByName("cgst")[0].value;
igst=document.getElementsByName("igst")[0].value;
hsncode=document.getElementsByName("hsncode")[0].value;
saccode=document.getElementsByName("saccode")[0].value;
status=document.getElementsByName("status")[0].value;
stock=document.getElementsByName("stock")[0].value;
vtype=document.getElementsByName("vtype")[0].value;
warranty=document.getElementsByName("warranty")[0].value;
purrdate=document.getElementsByName("purrdate")[0].value;
vencode=document.getElementsByName("vencode")[0].value;
if(vencode==""){
  vencode="SS";
}
recno=document.getElementsByName("recno")[0].value;
recdate=document.getElementsByName("recdate")[0].value;
typ=document.getElementsByName("button")[0].value;
val="";
n=document.getElementsByName("stock")[0].value;
for(i=0;i<n;i++)
{
	val+="$"+document.getElementsByName("box"+i)[0].value;
}
//alert(procode+prodcatname+prodesc+proconfig+sgst+cgst+igst+hsncode+saccode+status);
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
  xhttp.open("POST", "dopro.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  //alert("procode="+procode+"&prodcatname="+prodcatname+"&prodesc="+prodesc+"&proconfig="+proconfig+"&sgst="+sgst+"&cgst="+cgst+"&igst="+igst+"&hsncode="+hsncode+"&saccode="+saccode+"&status="+status+"&type="+typ+"&val="+val+"&vtype="+vtype+"&warranty="+warranty+"&purrdate="+purrdate+"&vencode="+vencode+"&recno="+recno+"&stock="+stock+"&recdate="+recdate);

  xhttp.send("procode="+procode+"&prodcatname="+prodcatname+"&prodesc="+prodesc+"&proconfig="+proconfig+"&sgst="+sgst+"&cgst="+cgst+"&igst="+igst+"&hsncode="+hsncode+"&saccode="+saccode+"&status="+status+"&type="+typ+"&val="+val+"&vtype="+vtype+"&warranty="+warranty+"&purrdate="+purrdate+"&vencode="+vencode+"&recno="+recno+"&stock="+stock+"&recdate="+recdate);
}

function req(n)
{ z='1';
  //alert("hi");
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      v=this.responseText;
      v=v.split("$");
	  console.log(v);
    document.getElementsByName("button")[0].value="update";
      document.getElementsByName("procode")[0].value=v[0];
      document.getElementsByName("prodcatname")[0].value=v[1];
      document.getElementsByName("prodesc")[0].value=v[2];
      document.getElementsByName("proconfig")[0].value=v[3];
	  document.getElementsByName("stock")[0].value=1;
	  document.getElementsByName("stock")[0].setAttribute("readonly","true");
	  //document.getElementsByName("serial")[0].value=v[4];
	  box=document.getElementsByName("box")[0];
	  box.innerHTML="";
	  box.innerHTML+="<input type='text' name='box0' class='form-control' value='"+v[4]+"'><br>";
      document.getElementsByName("sgst")[0].value=v[5];
      document.getElementsByName("cgst")[0].value=v[6];
      document.getElementsByName("igst")[0].value=v[7];
      document.getElementsByName("hsncode")[0].value=v[8];
      document.getElementsByName("saccode")[0].value=v[9];
      document.getElementsByName("status")[0].removeAttribute("disabled");

      document.getElementsByName("status")[0].value=v[10];
      document.getElementsByName("vtype")[0].value=v[11];
	  if(v[11]=="RENTAL"){
		  console.log("in");
        document.getElementsByName('venname')[0].readOnly = false;
    		document.getElementsByName('recno')[0].readOnly = false;
    		document.getElementsByName('recdate')[0].readOnly = false;
      }
      else {
        document.getElementsByName('venname')[0].readOnly = true;
    		document.getElementsByName('recno')[0].readOnly = true;
    		document.getElementsByName('recdate')[0].readOnly = true;
      }
      document.getElementsByName("warranty")[0].value=v[12];
      document.getElementsByName("purrdate")[0].value=v[13];
      document.getElementsByName("vencode")[0].value=v[14];
      namq(v[14]);
      document.getElementsByName("recno")[0].value=v[15];
      document.getElementsByName("recdate")[0].value=v[16];
      //console.log('set update');


      document.getElementById('bar').style.display="block";
      document.getElementById('barcode').style.display="block";
      document.getElementById('barprint').style.display="block";
      document.getElementsByName("serial0")[0].value=v[4];
      barcar();
	  //console.log("log");

    }
  };
  xhttp.open("POST", "doproreq.php", false);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("code="+n+"&t="+z);

//alert(v);


}
function namq(v) {
  var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        v=this.responseText;
  	    document.getElementsByName('venname')[0].value=v;
      }
    };
    xhttp.open("POST", "doproreq.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("code="+v+"&t="+"nam");
}
function barcar() {
  v=document.getElementsByName('serial0')[0].value;
  var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        //alert(this.responseText);
        b=this.responseText;
  	    document.getElementById('barcode1').innerHTML=b;
        //ocument.getElementsByName('barcode')[0].value+=v;
      }
    };
    xhttp.open("POST", "printbar2.php", false);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("serial0="+v);
}

function createbox()
{ 	i=0;
	v=document.getElementsByName("stock")[0].value;
	box=document.getElementsByName("box")[0];
	box.innerHTML="";
	for(i=0;i<v;i++)
		box.innerHTML+="<div name='serials'><input type='text' name='box"+i+"' class='form-control' placeholder='serial "+(i+1)+"' onchange=\"descq();\"></div><br>";
  box.innerHTML+="<center><button class='btn btn-warning' onclick='generator()'>Generate All</button></center>"
	box=document.getElementsByName("box")[0];
	//console.log(box.childElementCount);
}
function generate(i) {

  cat=document.getElementsByName("prodcatname")[0].value;
  config=document.getElementsByName("proconfig")[0].value;
  config=config.replace(/-/g,"");
  //alert(config);
  if(document.getElementsByName("vtype")[0].value=="DIRECT"){
    source="SS";
  }else{
    source=document.getElementsByName("vencode")[0].value;
    source=source[0]+source[1];
  }

  var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        //alert(this.responseText);
        b=this.responseText;
        b=parseInt(b)+1;
        sc=source+config;
        val=formatted_string('0000',b,'l');
        document.getElementsByName("box"+i)[0].value=sc+val;
      }
    };
    xhttp.open("POST", "dopro.php", false);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("prodcat="+cat+"&type="+"1");

}
function generator() {
  n=document.getElementsByName("stock")[0].value;

  for(i=0;i<n;i++){
    if(document.getElementsByName("box"+i)[0].value==""){
      if(val==""){
        generate(i);
      }
      else{
        v=parseInt(val);
        v++;
        val=formatted_string('0000',v.toString(),'l');
        document.getElementsByName("box"+i)[0].value=sc+val;
      }
    }
  }
}
function formatted_string(pad, user_str, pad_pos)
{
  if (typeof user_str === 'undefined')
    return pad;
  if (pad_pos == 'l')
     {
     return (pad + user_str).slice(-pad.length);
     }
  else
    {
    return (user_str + pad).substring(0, pad.length);
    }
}
function check()
{
	v="";
	n=document.getElementsByName("stock")[0].value;
	for(i=0;i<n;i++)
	{
		v+=document.getElementsByName("box"+i)[0].value+"$";
	}
	console.log("v :"+v);
}
function vtype()
{
	if(document.getElementsByName('vtype')[0].value=="DIRECT")
	{
		document.getElementsByName('venname')[0].readOnly = true;
		document.getElementsByName('recno')[0].readOnly = true;
		document.getElementsByName('recdate')[0].readOnly = true;

	}
  else
  {
    document.getElementsByName('venname')[0].readOnly = false;
    document.getElementsByName('recno')[0].readOnly = false;
    document.getElementsByName('recdate')[0].readOnly = false;
  }
}
</script>

<?php } include '../includes/foot.php'; ?>
