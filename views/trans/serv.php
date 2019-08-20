<div id="up"></div>
<?php
include '../includes/head.php';
include '../../database.php';
?>

<form action="dc.php" method="post" target="_blank" id="dc" >
<input type="text" name="orderby" hidden>
<input type="text" name="orderno" hidden>
<input type="text" value="service" name="typ" hidden>
<div class="container">
  <p style="color: royalblue;">Enter Service DC Info</p><hr>

  <div class="row">
    <div class="col-lg-4 col-sm-12 col-md-12">
      <div class="form-group">
        <label>DC NO:</label>
        <input type="text" name="dcno" class="form-control" value="" readonly>
      </div>
    </div>

    <div class="col-lg-4 col-sm-12 col-md-12">
      <div class="form-group">
        <label for="customercode">Vendor Name<sup>*</sup>:</label>
        <input type="text" name="companyname" class="form-control" oninput="pq();" list="cuscode">
        <datalist id="cuscode">
          <option></option>

           <?php
             $sql = "select * from venmaster";
             $result = $conn->query($sql);
              while($row = $result->fetch_assoc()){
           ?>
             <option><?php echo $row["vendorname"] ?>(<?php echo $row["vencode"] ?>)</option>
           <?php } ?>
        </datalist>
        <input type="text" name="cuscode" value="" hidden>
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
        <input type="date" name="dcdate" value="<?php echo date('Y')."-".date('m')."-".date('d'); ?>" class="form-control">
      </div>
    </div>
    <div class="col-lg-4 col-sm-12 col-md-12">
      <div class="form-group">
        <label>Delivery type</label>
        <select class="custom-select" name="dctype" disabled>
          <option value="service">SERVICE</option>
        </select>
      </div>
    </div>
    <div class="col-lg-4 col-sm-12 col-md-12">
      <div class="form-group">
        <label>Serial:</label>
        <input type="text" name="serial" class="form-control" hidden>
		            <div class="col-6" style="border-right:1px solid;">
             <textarea  name="baddress" rows="4" cols="50" hidden></textarea>
            </div>
            <div class="col-6">
             <textarea  name="daddress" rows="4" cols="50" hidden></textarea>
            </div>
        <div name="box"></div>
      </div>
    </div>
  </div>
  <hr>
  <div class="row">
    <div class="col-lg-8 col-sm-12 col-md-12"></div>
    <div class="col-lg-4 col-sm-12 col-md-12">
     <input type="button" name="button" value="save" class="btn btn-success" onclick="query();">
     <input type="button" name="button1" value="saves" class="btn btn-success" hidden>
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
        <h5 class="modal-title" id="exampleModalLabel">Service DC Preview</h5>
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
                  DC no: &nbsp &nbsp <input type="text" name="dcno" class="preview" style="width:8vw">
                </div>
                <div class="col-6">
                  Date: &nbsp &nbsp <input type="text" name="dcdate" class="preview" style="width:8vw">
                </div>
              </div>
              <div class="row" style="border-bottom:1px solid;">
                <div class="col-6" style="border-right:1px solid;">
                  P.order no: &nbsp &nbsp <input type="text" name="orderno" placeholder="Enter Order no here" style="width:10vw">
                </div>
                <div class="col-6">
                  Source: &nbsp &nbsp <input type="text" name="source" class="preview" style="width:8vw">
                </div>
              </div>
              <div class="row">
                &nbsp; &nbsp; P.orderby: &nbsp &nbsp <input type="text" name="orderby" placeholder="Enter Order by here">
              </div>
            </div>
          </div>
          <div class="row" style="border-bottom:1px solid;">
            <div class="col-6" style="border-right:1px solid;">
              Address 1: &nbsp &nbsp <textarea name="baddress" rows="4" cols="60" class="preview" ></textarea>
            </div>
            <div class="col-6">
			  Address 2: &nbsp &nbsp <textarea name="daddress" rows="4" cols="60" class="preview" ></textarea>
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
<div class="container">
  <p style="color: royalblue;">Service DC Details</p>
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
        <input type="text" name="search" class="form-control">
      </div>
    </div>
  </div>
  <div class="contain">
<?php
	 $sql = "select * from trans,venmaster where trans.cuscode=venmaster.vencode and dctype='service'";
	$result = $conn->query($sql);
	$i=1;
	if ($result->num_rows > 0){ ?>
  <table class="table table-striped table-hover table-bordered ">
    <thead class="thead-dark">
      <th>DC no</th>
      <th>Vendor name</th>
      <th>Transaction Code</th>
      <th>DC Entry Date</th>
      <th>DC type</th>
    </thead>
    <tbody>
	<?php
	while($row = $result->fetch_assoc()){
	 echo "<tr onclick=\"req('".$row['dcno']."','".$row['cuscode']."');to();\"><td>".$row["dcno"]."</td><td>".$row["vendorname"]."</td><td>".$row["tcode"]."</td><td>".$row["dcdate"]."</td><td>".$row["dctype"]."</td></tr>";
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
var dcno,dcdate,baddress,daddress,orderby,orderno,source,serial,slno,desc,qty,seri,cuscode,tcodee,intype,rang,dctype,source,cuscode,scount;
function fillpreview()
{
	var dcnop=document.getElementsByName("dcno")[1];
	var dcdatep=document.getElementsByName("dcdate")[1];
	var baddressp=document.getElementsByName("baddress")[1];
	var daddressp=document.getElementsByName("daddress")[1];
	dcnop.value=document.getElementsByName("dcno")[0].value;
	dcdatep.value=changedateformat(document.getElementsByName("dcdate")[0].value);
	console.log(document.getElementsByName("baddress")[0].innerHTML);
	baddressp.innerHTML=document.getElementsByName("companyname")[0].value+"\n"+document.getElementsByName("baddress")[0].innerHTML+"\nGSTIN :"+gst;
	daddressp.innerHTML=document.getElementsByName("companyname")[0].value+"\n"+document.getElementsByName("daddress")[0].innerHTML+"\nGSTIN :"+gst;

	sourcep=document.getElementsByName("source")[0];
	cuscode=document.getElementsByName("cuscode");
	rang="0";
	tcodee=document.getElementsByName("tcode");
	intype="Day";
	dctype="Service";
	dcno=document.getElementsByName("dcno");
	dcdate=document.getElementsByName("dcdate");
	baddress=document.getElementsByName("baddress");
	daddress=document.getElementsByName("daddress");
	orderby=document.getElementsByName("orderby");
	orderno=document.getElementsByName("orderno");
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
									res=res.split("&");
									prodesc=res[2];
									prodesc=prodesc.split("$");
									sourcep.value = res[3];
									source= res[3];
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
window.onload=function() {
  if((sessionStorage.getItem("success")!==null)){
    toastr.success(sessionStorage.getItem("success"));
    sessionStorage.removeItem("success");
  }
}
var tcode,gst;
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
      		console.log("response text " + b);
			    b=b.split("$");
      		//b[0]=b[0].split("$");
      		for(i=0;i<b.length;i++)
      			//console.log(i+" :"+b[i]);
      		var option=document.createElement("OPTION");
      		select.appendChild(option);

      		b = b.filter(function (el) {
      		  return el != "";
      		});
		      gst=b[b.length-1];
          //console.log(b);
      		select = document.getElementById("tcode");
      		//console.log("tcode is "+b);
      		//console.log("In cuscode is "+select);
      		for(i=0;i<b.length-3;i++)
      		{
            //console.log(i+" :"+b[i]);
      			option=document.createElement("OPTION");
      			option.innerHTML=b[i];
      			option.setAttribute("value",b[i]);

      			if(b[i].localeCompare(tcode)==0)
      			{
      				option.setAttribute("selected",true);
      			}
      			select.appendChild(option);
			}
			//document.getElementsByName("paytype")[0].value=b[i];
			document.getElementsByName("baddress")[0].innerHTML=b[i];
			document.getElementsByName("daddress")[0].innerHTML=b[i+1];
  		//console.log("In tcode childs "+select.childElementCount);
      }
  };
  xhttp.open("POST", "dotrans.php", false);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  //alert("typ="+typ+"&cuscode="+cuscode);
  xhttp.send("typ="+typ+"&cuscode="+cuscode);

}

function serq() {
  v=document.getElementsByName('tcode')[0].value;
  typ='set'
  var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        v=this.responseText;
        //alert(v);
        document.getElementsByName('serial')[0].value=v;
        v=v.split("$");
        v = v.filter(function (el) {
    		  return el != "";
    		});
        //console.log(v.length);
        box=document.getElementsByName("box")[0];
      	box.innerHTML="";
      	for(i=0;i<v.length;i++)
      		box.innerHTML+="<input type='text' class='form-control' name='serial"+i+"' value='"+v[i]+"' readonly><br>";
        }
    };
    xhttp.open("POST", "dotrans.php", false);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("tcode="+v+"&typ="+typ);
}

function dele(n) {
  //alert(n);
}
function query()
{
//alert("check");

tcode=document.getElementsByName("tcode")[0].value;
cuscode=document.getElementsByName("cuscode")[0].value;
dcdate=document.getElementsByName("dcdate")[0].value;
dctype="service";
dcno=document.getElementsByName("dcno")[0].value;
typ=document.getElementsByName("button1")[0].value;
serial=document.getElementsByName("box")[0];
status=document.getElementsByName("status")[0];
var ser="";
//alert(typ);
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
      v = this.responseText;
      if(v==1)
        sessionStorage.setItem("success","Successfully Added");
      else if(v==2)
        sessionStorage.setItem("success","Successfully updated");
      else {
        alert(v);
      }
      location.reload();
    }
  };
  xhttp.open("POST", "dotrans.php", false);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  //alert("dcno="+dcno+"&tcode="+tcode+"&cuscode="+cuscode+"&dcdate="+dcdate+"&dctype="+dctype+"&typ="+typ+"&serial="+ser);
  xhttp.send("dcno="+dcno+"&tcode="+tcode+"&cuscode="+cuscode+"&dcdate="+dcdate+"&dctype="+dctype+"&typ="+typ+"&serial="+ser);
}

function req(n,vencode)
{
	document.getElementsByName("previewbut")[0].disabled=false;
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      let v=this.responseText;
      v=v.split("$");
      console.log(v);
      document.getElementsByName("dcno")[0].value=v[0];
      document.getElementsByName("cuscode")[0].value=v[1];
      transq();
      document.getElementsByName("tcode")[0].value=v[2];
      serq();
      document.getElementsByName("dcdate")[0].value=v[3];
      document.getElementsByName("dctype")[0].value=v[6];
      document.getElementsByName("companyname")[0].value=v[11];
      document.getElementsByName("button")[0].value="update";
      document.getElementsByName("button1")[0].value="updates";
    }
  };
  xhttp.open("POST", "dotrans.php",false);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  //console.log("cuscode="+n);
  xhttp.send("dcno="+n+"&typ="+"req"+"&vencode="+vencode);
}

function savechange()
{
	var par="dcno="+dcno[0].value+"&cuscode="+cuscode[0].value+"&tcode="+tcodee[0].value+"&dcdate="+dcdate[0].value+"&intype="+intype+"&rang="+rang+"&dctype="+dctype+"&orderby="+orderby[1].value+"&orderno="+orderno[1].value+"&daddress="+daddress[0].innerHTML+"&baddress="+baddress[0].innerHTML+"&serials="+seri+"&source="+source+"&t=1"+"&scount="+scount;
	//alert(par);
	var orderbyy,ordernoo;
	orderbyy=document.getElementsByName("orderby");
	ordernoo=document.getElementsByName("orderno");
	orderbyy[0].value=orderbyy[1].value;
	ordernoo[0].value=ordernoo[1].value;
	var req=new XMLHttpRequest();
	try
	{
		req.onreadystatechange=function()
								{
									if(req.readyState==4)
									{
										var res=req.responseText;
										//alert(res);
										console.log(res);
										if(res==0)
										{
											toastr.success("Successfully saved changes!!!");
											document.getElementById('dc').submit();
											//return true;
										}
										else
											if(res=="No changes detected with previous DC")
												{
											toastr.success(res);
											document.getElementById('dc').submit();
											//return true;
										}
										else
											return toastr.info("Error ocurred while saving changes to DC!!!");
									}
								}
		req.open("POST","savedc.php",true);
		req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		//alert("par :"+par);
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
