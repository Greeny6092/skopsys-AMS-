<div id="up"></div>
<?php
include '../includes/head.php';
include '../../database.php';
?>
<form action="dc.php" method="post" target="_blank" id="dc">
<div class="container">
  <p style="color: royalblue;">Enter Supply DC Info</p><hr>

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
        <input class="form-control" name="companyname" oninput="pq();" list="cuscode">
          <datalist id="cuscode">
            <option></option>
            <?php
              $sql = "select * from cusmaster";
              $result = $conn->query($sql);
              while($row = $result->fetch_assoc()){
            ?>
              <option><?php echo $row["companyname"] ?>(<?php echo $row["cuscode"] ?>)</option>
            <?php } ?>
          </datalist>

          <input type="text" name="cuscode" hidden>
      </div>
    </div>

    <div class="col-lg-4 col-sm-12 col-md-12">
      <div class="form-group">
        <label>Transaction Code<sup>*</sup>:</label>
        <input type="text" name="tcode" class="form-control" list="tcode" oninput="serq();">
        <datalist id="tcode">

        </datalist>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-4 col-sm-12 col-md-12">
      <div class="form-group">
        <label for="vendortype">DC Entry Date<sup>*</sup>:</label>
        <input type="date" name="dcdate" value="<?php echo date('Y')."-".date('m')."-".date('d'); ?>" class="form-control">
      </div>
    </div>
    <div class="col-lg-4 col-sm-12 col-md-12">
      <div class="form-group">
        <label>Effective Date:</label>
        <input type="date" class="form-control" name="effdate" value="<?php echo date('Y')."-".date('m')."-".date('d'); ?>">
      </div>
    </div>
    <div class="col-lg-4 col-sm-12 col-md-12">
      <div class="form-group">
        <label>Delivery type</label>
        <select class="custom-select" name="dctype">
          <option value=""></option>
          <option value="rental">Rental</option>
          <option value="sales">Sales</option>
          <option value="testing">Testing</option>
        </select>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-4 col-sm-12 col-md-12">
      <div class="form-group">
        <label>Order by:</label>
        <input type="text" name="orderby" value="" class="form-control">
      </div>
    </div>
    <div class="col-lg-4 col-sm-12 col-md-12">
      <div class="form-group">
        <label>Order no:</label>
        <input type="text" name="orderno" value="" class="form-control">
      </div>
    </div>
    <div class="col-lg-4 col-sm-12 col-md-12">
      <div class="row">
          <div class="col-8">
            <div class="form-group">
              <label>Invoice type</label>
              <select class="custom-select" name="intype" onchange="">
                <option value="" selected></option>
                <option value="DAILY">DAILY</option>
                <option value="MONTHLY">MONTHLY</option>
              </select>
            </div>
          </div>
          <div class="col-4">
            <div class="form-group">
              <label>Range</label>
              <input type="text" name="range" value="1" class="form-control">
            </div>
          </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-4 col-sm-12 col-md-12">
      <div class="form-group">
        <label>Billing Address:</label>
        <textarea name="baddress" rows="2" class="form-control" readonly></textarea>
      </div>
    </div>
    <div class="col-lg-4 col-sm-12 col-md-12">
      <div class="form-group">
        <label>Delivery Address:</label>
        <textarea name="daddress" rows="2" class="form-control"></textarea>
      </div>
    </div>
    <div class="col-lg-4 col-sm-12 col-md-12">
      <div class="form-group">
        <label>Payment Type:</label>
        <input type="text" name="paytype" value="" class="form-control" readonly>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-4 col-sm-12 col-md-12">

    </div>
    <div class="col-lg-4 col-sm-12 col-md-12">

    </div>
    <div class="col-lg-4 col-sm-12 col-md-12">

    </div>
  </div>

  <input type="text" name="serial" class="form-control" hidden>
  <div name="box">

  </div>

  <hr>
  <div class="row">
    <div class="col-lg-8 col-sm-12 col-md-12"></div>
    <div class="col-lg-4 col-sm-12 col-md-12">
     <input type="button" name="button" value="save" class="btn btn-success" onclick="query();">
     <input type="button" class="btn btn-info" value="reset" onclick="location.reload();">
     <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal" onclick="fillpreview()" disabled name="previewbut">
       preview
     </button>

    </div>
  </div>
</div>
</form>
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Customer DC Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                  DC no:&nbsp &nbsp<input type="text" class="preview" name="dcno" style="width:8vw">
                </div>
                <div class="col-6">
                  Date:&nbsp &nbsp<input type="text" class="preview" name="dcdate" style="width:8vw">
                </div>
              </div>
              <div class="row" style="border-bottom:1px solid;">
                <div class="col-6" style="border-right:1px solid;">
                  P.order no:&nbsp &nbsp<input type="text" class="preview" name="orderno" style="width:8vw">
                </div>
                <div class="col-6">
                  Source:&nbsp &nbsp <input type="text" class="preview" name="source" style="width:8vw">
                </div>
              </div>
              <div class="row">
                &nbsp; &nbsp; P.orderby:&nbsp &nbsp <input type="text" class="preview" name="orderby" style="width:18vw">
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
            <div class="col-3" style="border-right:1px solid;">
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
        <input type="button"  value="close" onclick="location.reload();" class="btn btn-danger" data-dismiss="modal">
      </div>
    </div>
  </div>
</div>
<div class="container">
  <p style="color: royalblue;">Customer DC Details</p>
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
	 $sql = "select * from trans,cusmaster where trans.cuscode=cusmaster.cuscode";
	$result = $conn->query($sql);
	$i=1;
	if ($result->num_rows > 0){ ?>
  <table class="table table-striped table-hover table-bordered ">
    <thead class="thead-dark">
      <th>DC no</th>
      <th>Customer code</th>
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
	while($row = $result->fetch_assoc()){
	 echo "<tr onclick=\"req('".$row['dcno']."','".$row['cuscode']."');to();\"><td>".$row["dcno"]."</td><td>".$row["companyname"]."</td><td>".$row["tcode"]."</td><td>".$row["dcdate"]."</td><td>".$row["intype"]."</td><td>".$row["rang"]."</td><td>".$row["dctype"]."</td><td>".$row["orderby"]."</td><td>".$row["orderno"]."</td><td>".$row["daddress"]."</td></tr>";
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
var effdate;
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

$('#exampleModal').on('hidden.bs.modal',function (){
  window.alert('hidden event fired!');
});

var dcno,dcdate,baddress,daddress,orderby,orderno,source,serial,slno,desc,qty,seri,cuscode,tcodee,intype,rang,dctype,source,cuscode,scount;
function update()
{  z='z';
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
function fillpreview()
{
	//var dcno,dcdate,baddress,daddress,orderby,orderno,source,serial,slno,desc,qty,seri;
	cuscode=document.getElementsByName("cuscode");
	rang=document.getElementsByName("range");
	source=document.getElementsByName("source");
	tcodee=document.getElementsByName("tcode");
	intype=document.getElementsByName("intype");
	dctype=document.getElementsByName("dctype");
	dcno=document.getElementsByName("dcno");
	dcdate=document.getElementsByName("dcdate");
	baddress=document.getElementsByName("baddress");
	daddress=document.getElementsByName("daddress");
	orderby=document.getElementsByName("orderby");
	orderno=document.getElementsByName("orderno");
	source=document.getElementsByName("source")[0];
	dcno[1].value=dcno[0].value;
	dcdate[1].value=changedateformat(dcdate[0].value);
	orderby[1].value=orderby[0].value;
	orderno[1].value=orderno[0].value;
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
									//alert("res is "+res)
									console.log(res);
									res=res.split("&");
                  //console.log(res);
									prodesc=res[2];
									prodesc=prodesc.split("$");

									source.value = res[3];

									procat=res[0];
									procat=procat.split("$");
									//alert(procat);
									newrecord=document.getElementsByName("record")[0];
									for(i=0;i<prodesc.length;i++)
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
									desc[i].value="Rental starts from "+res[6];
									effdate=res[6];
									if(i>1)
										desc[i+1].value=i+" Unit(s) Only";
									else
										desc[i+1].value=i+" Unit Only";
									qty[i+1].value=i;
									scount=i;
									baddress[1].value=res[4]+"\n"+baddress[0].value+"\nGSTIN :"+res[5];
									daddress[1].value=res[4]+"\n"+daddress[0].value+"\nGSTIN :"+res[5];
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


function to() {
  location.href="#up";
}

var tcode;
function transq()
{
 cuscode=document.getElementsByName('cuscode')[0].value;
 let typ = "1";

 var dl = document.getElementById("tcode");
 while(dl.firstChild)
	 dl.removeChild(dl.firstChild);

  var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
      		let b = this.responseText,i;
      		console.log("response text " + b);
      		b=b.split("$");
      		for(i=0;i<b.length;i++)
      			//console.log(i+" :"+b[i]);
      		var option=document.createElement("OPTION");
      		dl.appendChild(option);

      		b = b.filter(function (el) {
      		  return el != "";
      		});
      		dl = document.getElementById("tcode");
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
      			dl.appendChild(option);
  		}
		document.getElementsByName("paytype")[0].value=b[i];
		document.getElementsByName("baddress")[0].value=b[i+1];
		document.getElementsByName("daddress")[0].value=b[i+2];
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
        console.log(v);
		//v=v.trim();
		document.getElementsByName('serial')[0].value=v;
        v=v.split("$");
        v = v.filter(function (el) {
    		  return el != "";
    		});
     console.log(v);
        box=document.getElementsByName("box")[0];
      	box.innerHTML="";
		for(i=0;i<v.length;i++)
			box.innerHTML+="<div class='row'><div class='col-lg-4 col-sm-12 col-md-12'><div class='form-group'><label>Serial:</label><input type='text' class='form-control' name='serial"+i+"' value='"+v[i]+"' readonly></div></div><div class='col-lg-4 col-sm-12 col-md-12'><div class='form-group'><label>Description "+(i+1)+":</label><textarea name='descr"+i+"' rows='2' class='form-control' readonly></textarea></div></div><div class='col-lg-4 col-sm-12 col-md-12'><div class='form-group'><label>Cost<sup>*</sup>:</label><input type='text' name='costpm"+i+"' class='form-control'></div></div></div>";
      	for(i=0;i<v.length;i++){
			//box.innerHTML+="<div class='row'><div class='col-lg-4 col-sm-12 col-md-12'><div class='form-group'><label>Serial:</label><input type='text' class='form-control' name='serial"+i+"' value='"+v[i]+"' readonly></div></div><div class='col-lg-4 col-sm-12 col-md-12'><div class='form-group'><label>Description "+(i+1)+":</label><textarea name='descr"+i+"' rows='2' class='form-control' readonly></textarea></div></div><div class='col-lg-4 col-sm-12 col-md-12'><div class='form-group'><label>Cost<sup>*</sup>:</label><input type='number' name='costpm"+i+"' class='form-control'  onchange=\"tod('"+i+"');\"></div></div></div>";
          //alert(document.getElementsByName('serial'+i)[0].value+" "+i);
          descq(document.getElementsByName('serial'+i)[0].value,i);
          cosq(document.getElementsByName('serial'+i)[0].value,i);
		  //box=document.getElementsByName("box")[0];
	if(i==1)
	console.log("value before of "+i+"th value is "+document.getElementsByName("costpm"+(i-1))[0].value);
        }
      }
    };
    xhttp.open("POST", "dotrans.php", false);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	console.log("tcode="+v+"&typ="+typ);
    xhttp.send("tcode="+v+"&typ="+typ);
}
function cosq(v,i)
{
console.log(i);
  t='5';
  s=v;
  //v=document.getElementsByName('serial'+i)[0].value;
  //console.log(v);
var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      let v=this.responseText;
      console.log("\nCostq response:"+v+"\n");
      val = v;
      rang = parseInt(document.getElementsByName("range")[0].value);
      intype = document.getElementsByName('intype')[0].value;
      if(intype=="DAILY"){
        val=val*rang;
      }
      else{
        val=val*(rang*30);
		
        val = val.toFixed(2);
		//console.log(val);
      }
	  //for(i=0;i<document.getElementsByName("box")[0].childElementCount;i++)
		document.getElementsByName('costpm'+i)[0].value=val;

		//console.log(document.getElementsByName('costpm'+i)[0].value);
		//console.log(parseFloat(parseInt(val*100)/100));
      //alert(document.getElementsByName('costpm'+i)[0].value+" "+i);
    }
  };
  xhttp.open("POST", "eotypeq.php", false);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  //console.log("v="+v+"&t="+t);
  xhttp.send("v="+s+"&t="+t);

}
function tod(i) {
	console.log("called tod");
  val = document.getElementsByName('costpm'+i)[0].value;
  rang = parseInt(document.getElementsByName("range")[0].value);
  intype = document.getElementsByName('intype')[0].value;
  if(intype=="DAILY"){
    val=val/rang;
  }
  else{
    val=val/(rang*30);
  }
  //val = Math.seil(val);
  document.getElementsByName('costpm'+i)[0].value = val;
}
function descq(v,i)
{
  t='9';
  //v=document.getElementsByName('serial'+i)[0].value;
  //console.log(v);
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      let v1=this.responseText;
	     //console.log(v1);
       //v=v.split('$');
  	  document.getElementsByName('descr'+i)[0].value=v1;
    }
  };
  xhttp.open("POST", "eotypeq.php", false);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  //console.log("v="+v+"&t="+t);
  xhttp.send("v="+v+"&t="+t);

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
effdate=document.getElementsByName("effdate")[0].value;
var ser="";
costpm="";
//alert(serial.childElementCount);
rang = parseInt(document.getElementsByName("range")[0].value);
for(i=0;i<serial.childNodes.length;i++)
{
	//alert(serial.childNodes[i].tagName);
	if(serial.childNodes[i].tagName!="BR")
	ser+="$"+document.getElementsByName("serial"+i)[0].value;
  val=document.getElementsByName("costpm"+i)[0].value;
  //alert("val is "+val+"\nrang is"+rang);
  if(intype=="DAILY"){
    val=val/rang;
  }
  else{
    val=val/(rang*30);
  }
  costpm+="$"+val;
}
//alert("value is "+costpm);
var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      v = this.responseText;
      if(v==111)
        sessionStorage.setItem("success","Successfully saved Data");
      else if(v==11)
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
  //alert("dcno="+dcno+"&tcode="+tcode+"&cuscode="+cuscode+"&dcdate="+dcdate+"&intype="+intype+"&dctype="+dctype+"&orderby="+orderby+"&orderno="+orderno+"&daddress="+daddress+"&typ="+typ+"&range="+range+"&serial="+ser+"&effdate="+effdate+"&costpm="+costpm);
  xhttp.send("dcno="+dcno+"&tcode="+tcode+"&cuscode="+cuscode+"&dcdate="+dcdate+"&intype="+intype+"&dctype="+dctype+"&orderby="+orderby+"&orderno="+orderno+"&daddress="+daddress+"&typ="+typ+"&range="+range+"&serial="+ser+"&effdate="+effdate+"&costpm="+costpm);
}

function req(n,cuscode)
{
	document.getElementsByName("previewbut")[0].disabled=false;
	z=1;
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      let v=this.responseText;
      v=v.split("$");
      //console.log(v);
      document.getElementsByName("dcno")[0].value=v[0];
      //document.getElementsByName("companyname")[0].value=v[1];
      document.getElementsByName("cuscode")[0].value=v[1];
      transq();
      document.getElementsByName("tcode")[0].value=v[2];
      document.getElementsByName("dcdate")[0].value=v[3];
      document.getElementsByName("intype")[0].value=v[4];
      document.getElementsByName("range")[0].value=v[5];
      document.getElementsByName("dctype")[0].value=v[6];
      document.getElementsByName("orderby")[0].value=v[7];
      document.getElementsByName("orderno")[0].value=v[8];
      document.getElementsByName("daddress")[0].value=v[9];
      document.getElementsByName("effdate")[0].value=v[10];
      document.getElementsByName("companyname")[0].value=v[11];
      serq();
      //cosq();
      document.getElementsByName("button")[0].value="update";
    }
  };
  xhttp.open("POST", "dotrans.php",false);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  //console.log("cuscode="+n);
  xhttp.send("dcno="+n+"&typ="+"req"+"&cuscode="+cuscode);
}
function savechange()
{
	var par="dcno="+dcno[0].value+"&cuscode="+cuscode[0].value+"&tcode="+tcodee[0].value+"&dcdate="+dcdate[0].value+"&intype="+intype[0].value+"&rang="+rang[0].value+"&dctype="+dctype[0].value+"&orderby="+orderby[0].value+"&orderno="+orderno[0].value+"&daddress="+daddress[1].value+"&baddress="+baddress[1].value.replace(/&/g,"%26")+"&serials="+seri+"&source="+source.value+"&t=1"+"&scount="+scount+"&effdate="+effdate;
	//alert(par);
	console.log(par);
	var req=new XMLHttpRequest();
	try
	{
		req.onreadystatechange=function()
								{
									if(req.readyState==4)
									{
										let res=req.responseText;
										//alert(res);
										console.log(res);
										if(res==0)
										{
											toastr.success("Successfully saved changes!!!");
											document.getElementById('dc').submit();
										}
										else
										if(res.includes("No changes detected with previous DC"))
										{
											toastr.success(res);
											document.getElementById('dc').submit();
										}
										else
										{
											console.log("\n"+res);
										return toastr.info("Error ocurred while saving changes to DC!!!");
										}
									}
								}
		req.open("POST","savedc.php",false);
		req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		//alert(par);
		req.send(par);
	}
	catch(e)
	{

	}
}

function changedateformat(ind)
{
	var temp=ind.split("-");
	return temp[2]+"-"+temp[1]+"-"+temp[0];
}
</script>

<?php
include '../includes/foot.php';
?>