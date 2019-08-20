
<?php
include '../includes/head.php';
include '../../database.php';
?>
<style media="screen">
.contain{
    height: 30vh;
    width: inherit;
    max-width: 120vw;

    overflow-x: scroll !important;
    overflow-y: scroll !important;
}
</style>
<div class="container">
  <p style="color: royalblue;">DC Details</p>
  <hr>

  <div class="row">
    <div class="col-lg-9 col-sm-12 col-md-12"></div>
    <div class="col-lg-3 col-sm-12 col-md-12">
      <div class="form-group">
        <label>Search:</label>
        <input type="text" name="search" class="form-control"  oninput="update()">
      </div>
    </div>
  </div>
  <div class="contain" name="tbl">
<?php
$sql = "select * from trans,cusmaster where trans.cuscode=cusmaster.cuscode";
$result = $conn->query($sql);
$i = 1;
?>
  <table class="table table-striped table-hover table-bordered ">
    <thead class="thead-dark">
      <th>DC no</th>
      <th>Customer Name</th>
      <th>Transaction Code</th>
      <th>DC Entry Date</th>
      <th>Invoice Type</th>
      <th>Range</th>
      <th>DC type</th>
      <th>Order By</th>
      <th>Order No</th>
      <th>Delivery address</th>
    </thead>
    <tbody>
	<?php
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr onclick=\"req('" . $row['dcno'] . "','" . $row['cuscode'] . "','1');to();\"><td>" . $row["dcno"] . "</td><td>" . $row["companyname"] . "</td><td>" . $row["tcode"] . "</td><td>" . $row["dcdate"] . "</td><td>" . $row["intype"] . "</td><td>" . $row["rang"] . "</td><td>" . $row["dctype"] . "</td><td>" . $row["orderby"] . "</td><td>" . $row["orderno"] . "</td><td>" . $row["daddress"] . "</td></tr>";
    }
    }
    $sql = "select * from trans,venmaster where trans.cuscode=venmaster.vencode";
    $result1 = $conn->query($sql);
    if ($result1->num_rows > 0) {
        while ($row = $result1->fetch_assoc()) {
            echo "<tr onclick=\"req('" . $row['dcno'] . "','" . $row['cuscode'] . "','2');to();\"><td>" . $row["dcno"] . "</td><td>" . $row["vendorname"] . "</td><td>" . $row["tcode"] . "</td><td>" . $row["dcdate"] . "</td><td>" . $row["intype"] . "</td><td>" . $row["rang"] . "</td><td>" . $row["dctype"] . "</td><td>" . $row["orderby"] . "</td><td>" . $row["orderno"] . "</td><td>" . $row["address1"] . "</td></tr>";
        }
      }
      if($result1->num_rows === 0 and $result->num_rows === 0){
        echo "<h2>No Record Found</h2>";
      }
    ?>
	</tbody>
</table>
  </div>
<div id="up"></div>

<form action="retdc.php" method="post" target="_blank" id="dc">
<div class="mb-5">
  <p style="color: royalblue;">Enter Return DC Info</p><hr>

  <div class="row">
    <div class="col-lg-4 col-sm-12 col-md-12">
      <div class="form-group">
        <label>DC NO:</label>
        <input type="text" name="dcno" class="form-control" value="" readonly>
      </div>
    </div>

    <div class="col-lg-4 col-sm-12 col-md-12">
      <div class="form-group">
        <label for="customercode">Customer Name<sup>*</sup>:</label>
        <input type="text" name="companyname" class="form-control" oninput="pq();" >
        <datalist id="cuscode">
          <option></option>
           <option>CUSTOMER</option>
           <option></option>
           <?php
$sql = "select * from cusmaster";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    ?>
             <option><?php echo $row["companyname"] ?>(<?php echo $row["cuscode"] ?>)</option>
           <?php }?>
           <option>-----</option>
           <option>VENDOR</option>
           <option></option>
           <?php
$sql = "select * from venmaster";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    ?>
             <option><?php echo $row["vendorname"] ?>(<?php echo $row["vencode"] ?>)</option>
           <?php }?>
        </datalist>
        <input type="text" name="cuscode" hidden>
      </div>
    </div>

    <div class="col-lg-4 col-sm-12 col-md-12">
      <div class="form-group">
        <label>Transaction Code<sup>*</sup>:</label>
        <input type="text" name="tcode" class="form-control" oninput="serq();" list="tcode">
        <datalist id="tcode">

        </datalist>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-4 col-sm-12 col-md-12">
      <div class="form-group">
        <label for="vendortype">DC Entry Date<sup>*</sup>:</label>
        <input type="date" name="dcdate" value="<?php echo date('Y') . "-" . date('m') . "-" . date('d'); ?>" class="form-control">
      </div>
    </div>
    <div class="col-lg-4 col-sm-12 col-md-12">
      <div class="form-group">
        <label>Delivery Address:</label>
        <textarea name="daddress" rows="2" class="form-control"></textarea>
		<textarea name="baddress" rows="2" class="form-control" hidden></textarea>
		<input type="text" name="orderno" hidden>
		<input type="text" name="orderby" hidden>
		<input type="text" name="source" hidden>
      </div>
    </div>
    <div class="col-lg-4 col-sm-12 col-md-12">
      <div class="form-group">
        <label>Serial:</label>
        <input type="text" name="serial" class="form-control" hidden>
        <div name="box">

        </div>
      </div>
    </div>
  </div>
  <hr>
  <div class="row">
    <div class="col-lg-8 col-sm-12 col-md-12"></div>
    <div class="col-lg-4 col-sm-12 col-md-12">
     <input type="button" class="btn btn-info" value="reset" onclick="location.reload();">
     <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal" onclick="fillpreview()" disabled name="previewbut">
       preview
     </button>

    </div>
  </div>
</div>
</form>
</div>

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Return DC Preview</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.reload()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container" style="border:1px solid;">
          <div class="row" style="border-bottom:1px solid;">
            <div class="col-6" style="border-right:1px solid;">
              <h1 style="color:red">SKOPSYS</h1>
              <br>
              #8,"Real Agency",#102
            </div>
            <div class="col-6">
              <div class="row" style="border-bottom:1px solid;">
                <div class="col-2"></div>
                <div class="col-8">
                  DC challan
                </div>
                <div class="col-2"></div>
              </div>
              <div class="row" style="border-bottom:1px solid;">
                <div class="col-6" style="border-right:1px solid;">
                  RDC no:&nbsp &nbsp<input type="text" class="preview" name="dcno" style="width:8vw">
                </div>
                <div class="col-6">
                  Date:&nbsp &nbsp<input type="text" class="preview" name="dcdate" style="width:8vw">
                </div>
              </div>
              <div class="row" style="border-bottom:1px solid;">
                <div class="col-6" style="border-right:1px solid;">
                  P.order no:&nbsp &nbsp <input type="text" class="preview" name="orderno" style="width:8vw" placeholder="Enter OrderNo">
                </div>
                <div class="col-6">
                  Source:&nbsp &nbsp <input type="text" class="preview" name="source" style="width:8vw">
                </div>
              </div>
              <div class="row">
                &nbsp; &nbsp; P.orderby:&nbsp &nbsp <input type="text" class="preview" name="orderby" style="width:18vw" placeholder="Enter OrderBy">
              </div>
            </div>
          </div>
          <div class="row" style="border-bottom:1px solid;">
            <div class="col-6" style="border-right:1px solid;">
              Billing Address:<textarea class="preview" name="baddress" rows="4" cols="50" ></textarea>
            </div>
            <div class="col-6">
              Delivery Address:<textarea class="preview" name="daddress" rows="4" cols="50" ></textarea>
            </div>
          </div>
          <div class="row" style="border-bottom:1px solid;">
            <div class="col-2" style="border-right:1px solid;">
              sno
            </div>
            <div class="col-7" style="border-right:1px solid;">
              Description
            </div>
            <div class="col-3">
              Quantity
            </div>
          </div>
		  <div name="descs">
          <div class="row" style="border-bottom:1px solid;" name="record">
            <div class="col-2" style="border-right:1px solid;">
			<input type="text" name="slnop" class="preview" style="width:2vw"><!--<br><br><br><br><br><br><br><br><br><br>-->
            </div>
            <div class="col-7" style="border-right:1px solid;">
			<textarea name="descp" class="preview" cols="70" rows="1"></textarea>
              <!--<br>-->
            </div>
            <div class="col-3">
			<input type="text" name="qtyp" class="preview"><!--<br>-->
            </div>
		  </div>
		  </div>
          <div class="row" style="border-bottom:1px solid;">
            <div class="col-2" style="border-right:1px solid;">
              <br>
            </div>
            <div class="col-7" style="border-right:1px solid;">
              <br>
            </div>
            <div class="col-3">
              <br>
            </div>
          </div>
          <div class="row" style="border-bottom:1px solid;">
            <br><br><br>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <input type="button" class="btn btn-dark" onclick="savechange()" value="print" />
      </div>
    </div>
  </div>
</div>


<script>
function update()
{  z='z2';
	v=document.getElementsByName("search")[0].value;
	//alert(v);

	var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementsByName("tbl")[0].innerHTML = this.responseText;
    }
  };
  xhttp.open("POST", "dotrans.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("l="+v+"&typ="+z);

}

function pq()
{
	v=document.getElementsByName('companyname')[0].value;
  v=v.split("(");
  //alert(v);
  cusname = v[0];
  cuscode = v[1].split(")");
  document.getElementsByName('companyname')[0].value=cusname;
  document.getElementsByName('cuscode')[0].value=cuscode[0];
  transq();
}
function to() {
  location.href="#up";
}

var tcode;
function transq()
{
 cuscode=document.getElementsByName('cuscode')[0].value;
 let typ = "1";

 var select = document.getElementById("tcode");
 while(select.firstChild)
	 select.removeChild(select.firstChild);

  var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
      		let b = this.responseText,i;
			console.log("transq ->"+b);
      		b=b.split("$");

      		for(i=0;i<b.length;i++)
      			//console.log(i+" :"+b[i]);
      		var option=document.createElement("OPTION");
      		select.appendChild(option);

      		b = b.filter(function (el) {
      		  return el != "";
      		});

      		select = document.getElementById("tcode");
      		//console.log("tcode is "+b);
      		//console.log("In cuscode is "+select);
      		for(i=0;i<b.length-4;i++)
      		{
      			option=document.createElement("OPTION");
      			option.innerHTML=b[i];
      			option.setAttribute("value",b[i]);

      			if(b[i].localeCompare(tcode)==0)
      			{
      				option.setAttribute("selected",true);
      			}
      			select.appendChild(option);
  		}
      //console.log(b[b.length-1]);
		    document.getElementsByName("daddress")[0].innerHTML=b[b.length-2];

  		//console.log("In tcode childs "+select.childElementCount);
      }
  };
  xhttp.open("POST", "dotrans.php", false);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("typ="+typ+"&cuscode="+cuscode);

}

function serq() {
  v=document.getElementsByName('tcode')[0].value;
  typ='set'
  var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        v=this.responseText;
		console.log("serq ->"+v);
        //alert(v);
        document.getElementsByName('serial')[0].value=v;
        v=v.split("$");
        v = v.filter(function (el) {
    		  return el != "";
    		});
        //console.log(v.length);
        box=document.getElementsByName("box")[0];
      	box.innerHTML="";
      	for(i=0;i<v.length;i++){
      		box.innerHTML+="<div class='row' id='row"+i+"'><div class='col-10'><input type='text' class='form-control' name='serial"+i+"' value='"+v[i]+"' readonly></div><div class='col-2'><button type='button' class='btn btn-danger' onclick=\"dele('"+i+"','"+v.length+"')\"><span class='fas fa-minus'></span></button></div></div><br>";
          document.getElementsByName("previewbut")[0].disabled=false;
        }
      }

    };
    xhttp.open("POST", "dotrans.php", false);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("tcode="+v+"&typ="+typ);
}

function dele(i,n) {
  /*/alert(document.getElementsByName('serial')[0].value);
    v = document.getElementsByName('serial'+i)[0].value;
  //confirm("Do you want to delete entry "+v);
  //s = document.getElementsByName('noi')[0].value;
  t='6';
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      let v=this.responseText;
  	  //lert(v);
  	  if(v==1){
        document.getElementById('row'+i).style.display = 'none';
        document.getElementsByName('noi')[0].value = s-1;
        createbox();
        serq();
		    //toastr.info("deleted successfully");
      }
    }
  };
  xhttp.open("POST", "eotypeq.php", false);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  //console.log("v="+v+"&t="+t);
  xhttp.send("v="+v+"&t="+t);*/

  document.getElementsByName('serial'+i)[0].value="";
  //alert(n);
  document.getElementById('row'+i).style.display="none";
  ser="";
  for(j=0;j<n;j++){
    if(document.getElementsByName('serial'+j)[0].value=="")
      continue;
    ser += "$"+document.getElementsByName('serial'+j)[0].value;
  }
  document.getElementsByName('serial')[0].value=ser;
  //alert(ser);
}
function query()
{
//alert("check");

tcode=document.getElementsByName("tcode")[0].value;
cuscode=document.getElementsByName("cuscode")[0].value;
dcdate=document.getElementsByName("dcdate")[0].value;
intype=document.getElementsByName("intype")[0].value;
range=document.getElementsByName("range")[0].value;
dctype=document.getElementsByName("dctype")[0].value;
orderby=document.getElementsByName("orderby")[0].value;
orderno=document.getElementsByName("orderno")[0].value;
daddress=document.getElementsByName("daddress")[0].value;
dcno=document.getElementsByName("dcno")[0].value;
typ=document.getElementsByName("button")[0].value;
serial=document.getElementsByName("box")[0];
status=document.getElementsByName("status")[0];
var ser="";
//alert(serial.childElementCount);
for(i=0;i<serial.childNodes.length;i++)
{
	//alert(serial.childNodes[i].tagName);
	if(serial.childNodes[i].tagName!="BR")
	ser+="$"+serial.childNodes[i].value;
}
//alert("value is "+ser);
var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      //alert(this.responseText);
      v = this.responseText;
      if(v==111)
        sessionStorage.setItem("success","Successfully saved Data");
      else if(v==2)
        sessionStorage.setItem("success","Successfully updated Data");
      else {
        alert(v);
      }
	    location.reload();
    }
  };
  xhttp.open("POST", "dotrans.php", false);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("dcno="+dcno+"&tcode="+tcode+"&cuscode="+cuscode+"&dcdate="+dcdate+"&intype="+intype+"&dctype="+dctype+"&orderby="+orderby+"&orderno="+orderno+"&daddress="+daddress+"&typ="+typ+"&range="+range+"&serial="+ser);
}

function req(n,code,se)
{

	z="req";
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      let v=this.responseText;
      v=v.split("$");
      console.log("req ->"+v);
      document.getElementsByName("dcno")[0].value=v[0];
      document.getElementsByName("cuscode")[0].value=v[1];
      transq();
      document.getElementsByName("tcode")[0].value=v[2];
      serq();
      //document.getElementsByName("daddress")[0].value=v[9];
      document.getElementsByName("companyname")[0].value=v[11];
	     //alert(v[11]);
      //document.getElementsByName("button")[0].value="update";
    }
  };
  xhttp.open("POST", "dotrans.php",false);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  //console.log("cuscode="+n);
  xhttp.send("dcno="+n+"&typ="+z+"&code="+code+"&se="+se);
}
function fillpreview()
{
	//var dcno,dcdate,baddress,daddress,orderby,orderno,source,serial,slno,desc,qty,seri;
	cuscode=document.getElementsByName("cuscode");
	rang="0";
	source=document.getElementsByName("source");
	tcodee=document.getElementsByName("tcode");
	intype="Day";
	dctype="return";
	dcno=document.getElementsByName("dcno");
	dcdate=document.getElementsByName("dcdate");
	baddress=document.getElementsByName("baddress");
	daddress=document.getElementsByName("daddress");
	orderby=document.getElementsByName("orderby");
	orderno=document.getElementsByName("orderno");
	//source=document.getElementsByName("source")[0];
	dcno[1].value=dcno[0].value;
	dcdate[1].value=dcdate[0].value;
	baddress[0].innerHTML=daddress[0].innerHTML;
	baddress[1].innerHTML=baddress[0].innerHTML;
	console.log("daddress "+daddress[0].innerHTML);
	daddress[1].innerHTML='SKOPSYS #8, GROUND FLOOR, "REAL REGENCY" #233/102. PYCROFTS ROAD, ROYAPETTAH, CHENNAI - 600014';
	orderby[0].value='';
	orderno[0].value='';
	serial=document.getElementsByName("serial")[0].value;
	seri=serial;
	serial=serial.split("$");
	tcode = document.getElementsByName("tcode")[0].value;
	document.getElementsByName("descs")[0].innerHTML='<div class="row" style="border-bottom:1px solid;" name="record"><div class="col-2" style="border-right:1px solid;"><input type="text" name="slnop" class="preview" style="width:2vw"></div><div class="col-7" style="border-right:1px solid;"><textarea name="descp" class="preview" cols="70" rows="1"></textarea></div><div class="col-3"><input type="text" name="qtyp" class="preview"></div></div>';

	var req=new XMLHttpRequest();
	try
	{
		req.onreadystatechange=function()
							{
								if(req.readyState==4)
								{
									var prodesc,procat,res,record,newrecord;
									res=req.responseText;
									console.log("fill preview ->"+res);
									//alert("res is "+res)
									res=res.split("&");
									baddress[1].innerHTML=res[res.length-3]+"\n"+baddress[1].innerHTML+"\nGSTIN :"+res[res.length-2];
									prodesc=res[2];
									prodesc=prodesc.split("$");
									source[0].value = res[3];
									source[1].value = res[3];
									procat=res[0];
									procat=procat.split("$");
									//alert(procat);
									newrecord=document.getElementsByName("record")[0];
									for(i=0;i<prodesc.length-1;i++)
									{
										record=newrecord.cloneNode(true);
										document.getElementsByName("descs")[0].appendChild(record);
									}
									slno=document.getElementsByName("slnop");
									desc=document.getElementsByName("descp");
									qty=document.getElementsByName("qtyp");
									for(i=0;i<prodesc.length-1;i++)
			 						{
											slno[i].value=i+1;
											desc[i].innerHTML=procat[i+1]+" "+serial[i+1]+" "+prodesc[i+1];;
											qty[i].value=1;
									}
									if(i>1)
										desc[i].value=i+" Unit(s) Only";
									else
										desc[i].value=i+" Unit Only";
									qty[i].value=i;
									scount=i;
								}
							}
		req.open("POST","dodc.php",false);
		req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		req.send("serial="+seri+"&tcode="+tcode);
	}
	catch(e)
	{

	}
}
function dc(n) {
  //alert("enter change");
  var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      v = this.responseText;
      if(v=='1')
        toastr.info("dc update");
      else
        alert(v);
    }
  };
  xhttp.open("POST", "dotrans.php",false);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  console.log("dcno="+n);
  xhttp.send("serial="+n+"&typ="+"dc");
}
function savechange()
{
	var baddress=document.getElementsByName("baddress");
	var daddress=document.getElementsByName("daddress");
	orderno[0].value=orderno[1].value;
	orderby[0].value=orderby[1].value;
	baddress[0].value=baddress[1].value;
	daddress[0].value=daddress[1].value;
  dc(seri);
	var par="dcno="+dcno[0].value+"&cuscode="+cuscode[0].value+"&tcode="+tcodee[0].value+"&dcdate="+dcdate[0].value+"&intype="+intype+"&rang="+rang+"&dctype="+dctype+"&orderby="+orderby[1].value+"&orderno="+orderno[1].value+"&daddress="+daddress[1].innerHTML+"&baddress="+baddress[0].innerHTML+"&serials="+seri+"&source="+source.value+"&t=1"+"&scount="+scount;
	//alert(par);
	var req=new XMLHttpRequest();
	try
	{
		req.onreadystatechange=function()
								{
									if(req.readyState==4)
									{
										var res=req.responseText;
										//alert(res);
										if(res==0)
										{
											toastr.success("Successfully saved changes!!!");
											document.getElementById('dc').submit();
										}
										else
											if(res=="No changes detected with previous DC")
												{
											toastr.success(res);
											document.getElementById('dc').submit();
										}
										else
											return toastr.info("Error ocurred while saving changes to DC!!!");
									}
								}
		req.open("POST","savedc.php",false);
		req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		req.send(par);
	}
	catch(e)
	{

	}
}

</script>

<?php
include '../includes/foot.php';
?>
