<?php
include '../includes/head.php';
include '../../database.php';
 ?>
<div class="container">
<p style="color: royalblue;">Enter Replacement DC Details</p><hr>
<div class="row">
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
      <label>Replacement:</label>
      <select class="custom-select" name="rep" onchange="serq();">
        <option></option>
        <option value="REPIN">IN</option>
        <option value="REPOUT">OUT</option>
      </select>
    </div>
  </div>
  <div class="col-lg-4 col-sm-12 col-md-12">
    <div class="form-group">
      <label for="vendortype">DC Entry Date<sup>*</sup>:</label>
      <input type="date" name="dcdate" value="<?php echo date('Y')."-".date('m')."-".date('d'); ?>" class="form-control">
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-4 col-sm-12 col-md-12">
    <div class="form-group">
      <label>Serial:</label>
      <input type="text" name="serial" class="form-control" hidden>
      <div name="box">

      </div>
    </div>
  </div>
  <div class="col-lg-4 col-sm-12 col-md-12">
    <div class="form-group">

    </div>
  </div>
  <div class="col-lg-4 col-sm-12 col-md-12">

  </div>
</div>

<hr>
<div class="row">
  <div class="col-lg-8 col-sm-12 col-md-12"></div>
  <div class="col-lg-4 col-sm-12 col-md-12">
    <input type="button" name="button" value="save" class="btn btn-success" disabled onclick="query();">
    <input type="button" class="btn btn-info" value="reset" onclick="location.reload();">
  </div>
</div>

</div>
<hr>
<form action="repldc.php" method="post" target="_blank" onsubmit="savechange()">
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Replacement DC preview</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.reload();">
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
			  <input type="text" name="tdesc" hidden>

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
        <input type="submit" class="btn btn-success"  value="print" onclick=""/>
		    <input type="button" class="btn btn-dark" onclick="location.reload()" value="close">
      </div>
    </div>
  </div>
</div>
</form>
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
	 $sql = "select * from repdc,cusmaster where repdc.cuscode=cusmaster.cuscode and flag='0'";
	$result = $conn->query($sql);
	$i=1;
	if ($result->num_rows > 0){ ?>
  <table class="table table-striped table-hover table-bordered ">
    <thead class="thead-dark">
      <th>DC no</th>
      <th>Customer code</th>
      <th>DC Entry Date</th>
      <th>DC Type</th>
      <th>preview</th>
    </thead>
    <tbody>
	<?php
	while($row = $result->fetch_assoc()){
	 echo "<tr><td>".$row["dcno"]."</td><td>".$row["companyname"]."</td><td>".$row["dcdate"]."</td><td>".$row["dctype"]."</td><td><button type=\"button\" class=\"btn btn-dark\" data-toggle=\"modal\" data-target=\"#exampleModal\" onclick='fillpreview(\"".$row["dcno"]."\")' name=\"previewbut\">preview</button></td></tr>";
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
function pq()
{
  v=document.getElementsByName('companyname')[0].value;
  v=v.split("(");
  //alert(v);
  cusname = v[0];
  cuscode = v[1].split(")");
  document.getElementsByName('companyname')[0].value=cusname;
  document.getElementsByName('cuscode')[0].value=cuscode[0];
  //transq();
}
function serq() {
  v = document.getElementsByName('cuscode')[0].value;
  rep = document.getElementsByName('rep')[0].value;
  typ='setting'
  var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        v=this.responseText;
		console.log("serq output :"+v);
        v=v.trim();
        //alert(v);
        //console.log(v);
        document.getElementsByName('serial')[0].value=v;
        v=v.split("$");
        //console.log(v);
        v = v.filter(function (el) {
    		  return el != "";
    		});
        console.log(v);
        box=document.getElementsByName("box")[0];
      	box.innerHTML="";
      	for(i=0;i<v.length;i++)
      		box.innerHTML+="<input type='text' class='form-control' name='serial"+i+"' value='"+v[i]+"' readonly><br>";
          document.getElementsByName("button")[0].disabled=false;
          //document.getElementsByName("previewbut")[0].disabled=false;
        }
    };
    xhttp.open("POST", "dorepdc.php", false);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    //alert("cuscode="+v+"&rep="+rep+"&typ="+typ);
    xhttp.send("cuscode="+v+"&rep="+rep+"&typ="+typ);
}
function query() {
  cuscode = document.getElementsByName("cuscode")[0].value;
  rep = document.getElementsByName("rep")[0].value;
  serial = document.getElementsByName("serial")[0].value;
  dcdate = document.getElementsByName("dcdate")[0].value;
  typ = document.getElementsByName("button")[0].value;

  var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        v=this.responseText;
        if(v==1)
          sessionStorage.setItem("success","Successfully saved Data");
        else {
          alert(v);
        }
        location.reload();
        }
    };
    xhttp.open("POST", "dorepdc.php", false);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    //alert("cuscode="+cuscode+"&dctype="+rep+"&serial="+serial+"&dcdate="+dcdate+"&typ="+typ);
    xhttp.send("cuscode="+cuscode+"&dctype="+rep+"&serial="+serial+"&dcdate="+dcdate+"&typ="+typ);
}

function fillpreview(dcno)
{
	var dcnof=document.getElementsByName("dcno")[0];
	document.getElementsByName("descs")[0].innerHTML='<div class="row" style="border-bottom:1px solid;" name="record"><div class="col-2" style="border-right:1px solid;"><input type="text" name="slnop" class="preview" style="width:2vw"></div><div class="col-7" style="border-right:1px solid;"><textarea name="descp" class="preview" cols="70" rows="1"></textarea></div><div class="col-3"><input type="text" name="qtyp" class="preview"></div></div>';
	dcnof.value=dcno;
	var date,baddress,daddress,source,descs,qtys;
	var req=new XMLHttpRequest();
	try
	{
		req.onreadystatechange=function()
								{
									if(this.readyState==4)
									{
										var v=this.responseText;
										console.log("fill preview "+v);
                    v = v.split("&")
                    document.getElementsByName('dcno')[0].value=dcno;
                    document.getElementsByName('dcdate')[1].value=changedateformat(v[0]);
                    document.getElementsByName('serial')[0].value=v[1];
                    send();
					document.getElementsByName('source')[0].value=v[6];
                    document.getElementsByName('baddress')[0].value=v[4]+'\n'+v[2]+'\nGSTNo:'+v[5];
                    document.getElementsByName('daddress')[0].value=v[4]+'\n'+v[3]+'\nGSTNo:'+v[5];
                    //document.getElementsByName('')[0].value=v[];
										//alert("success");
									}
								}
		req.open("POST","dorepdc.php",false);
		req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		//alert("typ=req&dcno="+dcno);
		req.send("typ=req&dcno="+dcno);
	}
	catch(e)
	{
		alert(e);
	}
}

function send() {
	var tdesc=document.getElementsByName("tdesc")[0];
  ser = document.getElementsByName('serial')[0].value;
  typ="send";
  var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        v=this.responseText;
		v=v.trim();
		console.log("response of send "+v);
        //console.log("res:"+v);
        v = v.split("$");
        console.log(v);
        v = v.filter(function (el) {
          return el != "";
        });
        console.log(v);
        newrecord=document.getElementsByName("record")[0];
        document.getElementsByName("descs")[0].appendChild(newrecord);
        for(i=0;i<v.length+2;i++)
        {
          record=newrecord.cloneNode(true);
          document.getElementsByName("descs")[0].appendChild(record);
        }
        slno=document.getElementsByName("slnop");
        desc=document.getElementsByName("descp");
        qty=document.getElementsByName("qtyp");
		tdesc.value=v[0];
        for(i=0;i<v.length;i++)
        {
          console.log(v[i]);
          slno[i].value=i+1;
          desc[i].innerHTML=v[i];
		  if(i>0)
			  tdesc.value+="$"+v[i];
          qty[i].value=1;
        }
		if(i>1)
			desc[i].value=i+" Unit(s) Only";
		else
			desc[i].value=i+" Unit Only";
        qty[i].value=i;
        scount=i;
        //document.getElementsByName('')[0].value=v[];
      }
    };
    xhttp.open("POST", "dorepdc.php", false);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    //alert("cuscode="+cuscode+"&dctype="+rep+"&serial="+serial+"&dcdate="+dcdate+"&typ="+typ);
    xhttp.send("serial="+ser+"&typ="+typ);
}

function savechange()
{
	let dcno,cuscode,tcodee,dcdate,intype,rang,dctype,orderby,orderno,baddress,daddress,seri,source;
	dcno=document.getElementsByName("dcno");
	cuscode="none";
	tcodee="none";
	dcdate=document.getElementsByName("dcdate");
	dctype="replacement";
	intype="none";
	rang="none";
	orderby=document.getElementsByName("orderby");
	orderno=document.getElementsByName("orderno");
	baddress=document.getElementsByName("baddress");
	daddress=document.getElementsByName("daddress");
	seri=document.getElementsByName("serial")[0].value;
	source=document.getElementsByName("source")[0];
	var par="dcno="+dcno[0].value+"&cuscode="+cuscode+"&tcode="+tcodee+"&dcdate="+dcdate[0].value+"&intype="+intype+"&rang="+rang+"&dctype="+dctype+"&orderby="+orderby[0].value+"&orderno="+orderno[0].value+"&daddress="+daddress[0].value+"&baddress="+baddress[0].value+"&serials="+seri+"&source="+source.value+"&t=1"+"&scount="+scount;
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
<?php include '../includes/foot.php'; ?>
