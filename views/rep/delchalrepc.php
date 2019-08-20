<?php include '../includes/head.php'; include('../../database.php') ;?>



<div class="container">
  <p style="color: royalblue;">Supply DC Report</p>

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
	 $sql = "select * from dc where cuscode like 'CUS%' and dctype!='return' order by slno desc";
	$result = $conn->query($sql);
	$i=1;
	if ($result->num_rows > 0){ ?>
  <table class="table table-striped table-hover table-bordered ">
    <thead class="thead-dark">

      <th>Customer Code</th>
      <th>Customer Name</th>
      <th>DCNO</th>
	    <th>DC Date</th>
      <th>Serial Count</th>
      <th>DC Type</th>
	  <th>View</th>
    </thead>
    <tbody>

<?php
$dcnos=array();
	while($row = $result->fetch_assoc()){
	 		$flag=0;
				 foreach($dcnos as $dcno)
		if($dcno==$row['dcno'])
		{
			$flag=1;
			break;
		}
		if($flag==0)
		{
			echo "<tr ><td>".$row["cuscode"]."</td><td>".$row["companyname"]."</td><td>".$row["dcno"]."</td><td>".$row['dcdate']."</td><td>".$row["scount"]."</td><td>".$row["dctype"]."</td><td><button type='button' class='btn btn-dark' data-toggle='modal' data-target='#exampleModal' onclick=\"fillpreview('".$row['slno']."')\">View</button></td></tr>";
			array_push($dcnos,$row['dcno']);
		}
	}
    ?>
    </tbody>
  </table>

  <?php }
	else{
		echo "<h1> No Records Found</h1>";
	}
	?>

    </tbody>
  </table>
  </div>

</div>
<form name="dc" target="_blank" action="dc.php" method="post" onsubmit="combine_desc()">
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">DC View</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.reload()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container" style="border:1px solid;">
          <div class="row" style="border-bottom:1px solid;">
            <div class="col-6" style="border-right:1px solid;">
              <h1 style="color:red;margin-bottom:-19px;">SKOPSYS</h1>
              <br>
              No 8 Real Regency Ground Floor, Pycrofts Rd, Royapettah, Chennai, Tamil Nadu 600014
            </div>
            <div class="col-6">
              <div class="row" style="border-bottom:1px solid;">
                <div class="col-2"></div>
                <div class="col-8">
                  DC challan<input type="text" name="effdate" hidden>
                </div>
                <div class="col-2"></div>
              </div>
              <div class="row" style="border-bottom:1px solid;">
                <div class="col-6" style="border-right:1px solid;">
                  DC no:&nbsp &nbsp <input type="text" class="preview" name="dcno" style="width:8vw">
                </div>
                <div class="col-6">
                  Date:&nbsp &nbsp <input type="text" class="preview" name="dcdate" style="width:8vw">
                </div>
              </div>
              <div class="row" style="border-bottom:1px solid;">
                <div class="col-6" style="border-right:1px solid;">
                  P.order no:&nbsp &nbsp <input type="text" class="preview" name="orderno" style="width:8vw" >
                </div>
                <div class="col-6">
                  Source:&nbsp &nbsp <input type="text" class="preview" name="source" style="width:8vw">
                </div>
              </div>
              <div class="row">
                &nbsp; &nbsp; P.orderby:&nbsp &nbsp <input type="text" class="preview" name="orderby" style="width:12vw" >
              </div>
            </div>
          </div>
          <div class="row" style="border-bottom:1px solid;">
            <div class="col-6" style="border-right:1px solid;">
              Billing Address:<textarea class="preview form-control" name="baddress" ></textarea>
            </div>
            <div class="col-6">
              Delivery Address:<textarea class="preview form-control" name="daddress" ></textarea>
            </div>
          </div>
          <div class="row" style="border-bottom:1px solid;">
            <div class="col-2" style="border-right:1px solid;">
              sno
            </div>
            <div class="col-7" style="border-right:1px solid;">
              Description<textarea rows="100" cols="200" name="tdesc" hidden></textarea>
            </div>
            <div class="col-3" style="border-right:1px solid;">
              Quantity <input type="text" name="tqty" hidden>
            </div>
          </div>
		  <div name="descs">
          <div class="row" style="border-bottom:1px solid;" name="record">
            <div class="col-2" style="border-right:1px solid;">
			<input type="text" name="slnop" class="preview " style="width:2vw"><!--<br><br><br><br><br><br><br><br><br><br>-->
            </div>
            <div class="col-7" style="border-right:1px solid;">
			<textarea name="descp" class="preview form-control"></textarea>
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
		<input type="submit" class="btn btn-success"  value="print" />
		<button type="button" class="btn btn-dark" data-dismiss="modal" onclick="location.reload();">Close</button>
      </div>
    </div>
  </div>
</div>
</form>
<input type="text" name="serial" hidden>

<br><br><br><br><br>

<div class="container">
  <p style="color: royalblue;">Return DC Report</p>

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
        <input type="text" name="search2" oninput="update2()" class="form-control">
      </div>
    </div>
  </div>

  <div class="contain" name="tb2">
  <?php
	  $sql = "select * from dc where cuscode like 'CUS%' and dctype='return' order by slno desc";
	$result = $conn->query($sql);
	$i=1;
	if ($result->num_rows > 0){ ?>
  <table class="table table-striped table-hover table-bordered ">
    <thead class="thead-dark">

      <th>Customer Code</th>
      <th>Customer Name</th>
      <th>DCNO</th>
	  <th>DC Date</th>
      <th>Serial Count</th>
      <th>DC Type</th>
	  <th>View</th>
    </thead>
    <tbody>

<?php

	$dcnos=array();
	while($row = $result->fetch_assoc()){
	 		$flag=0;
				 foreach($dcnos as $dcno)
		if($dcno==$row['dcno'])
		{
			$flag=1;
			break;
		}
		if($flag==0)
		{
			echo "<tr ><td>".$row["cuscode"]."</td><td>".$row["companyname"]."</td><td>".$row["dcno"]."</td><td>".$row['dcdate']."</td><td>".$row["scount"]."</td><td>".$row["dctype"]."</td><td><button type='button' class='btn btn-dark' data-toggle='modal' data-target='#exampleModal' onclick=\"fillpreview('".$row['slno']."')\">View</button></td></tr>";
			array_push($dcnos,$row['dcno']);
		}
	}
    ?>
    </tbody>
  </table>

  <?php }
	else{
		echo "<h1> No Records Found</h1>";
	}
	?>

    </tbody>
  </table>
  </div>

</div>
<form name="dc" target="_blank" action="dc.php" method="post" onsubmit="combine_desc()">

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">DC View</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.reload()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container" style="border:1px solid;">
          <div class="row" style="border-bottom:1px solid;">
            <div class="col-6" style="border-right:1px solid;">
              <h1 style="color:red;margin-bottom:-19px;">SKOPSYS</h1>
              <br>
              No 8 Real Regency Ground Floor, Pycrofts Rd, Royapettah, Chennai, Tamil Nadu 600014
            </div>
            <div class="col-6">
              <div class="row" style="border-bottom:1px solid;">
                <div class="col-2"></div>
                <div class="col-8">
                  DC challan<input type="text" name="effdate" placeholder="hello there"/>
                </div>
                <div class="col-2"></div>
              </div>
              <div class="row" style="border-bottom:1px solid;">
                <div class="col-6" style="border-right:1px solid;">
                  DC no:&nbsp &nbsp <input type="text" class="preview" name="dcno" style="width:8vw">
                </div>
                <div class="col-6">
                  Date:&nbsp &nbsp <input type="text" class="preview" name="dcdate" style="width:8vw">
                </div>
              </div>
              <div class="row" style="border-bottom:1px solid;">
                <div class="col-6" style="border-right:1px solid;">
                  P.order no:&nbsp &nbsp <input type="text" class="preview" name="orderno" style="width:8vw" >
                </div>
                <div class="col-6">
                  Source:&nbsp &nbsp <input type="text" class="preview" name="source" style="width:8vw">
                </div>
              </div>
              <div class="row">
                &nbsp; &nbsp; P.orderby:&nbsp &nbsp <input type="text" class="preview" name="orderby" style="width:12vw" >
              </div>
            </div>
          </div>
          <div class="row" style="border-bottom:1px solid;">
            <div class="col-6" style="border-right:1px solid;">
              Billing Address:<textarea class="preview form-control" name="baddress" ></textarea>
            </div>
            <div class="col-6">
              Delivery Address:<textarea class="preview form-control" name="daddress" ></textarea>
            </div>
          </div>
          <div class="row" style="border-bottom:1px solid;">
            <div class="col-2" style="border-right:1px solid;">
              sno
            </div>
            <div class="col-7" style="border-right:1px solid;">
              Description<textarea rows="100" cols="200" name="tdesc" hidden></textarea>
            </div>
            <div class="col-3" style="border-right:1px solid;">
              Quantity <input type="text" name="tqty" hidden>
            </div>
          </div>
		  <div name="descs">
          <div class="row" style="border-bottom:1px solid;" name="record">
            <div class="col-2" style="border-right:1px solid;">
			<input type="text" name="slnop" class="preview " style="width:2vw"><!--<br><br><br><br><br><br><br><br><br><br>-->
            </div>
            <div class="col-7" style="border-right:1px solid;">
			<textarea name="descp" class="preview form-control"></textarea>
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
		<input type="submit" class="btn btn-success"  value="print" />
		<button type="button" class="btn btn-dark" data-dismiss="modal" onclick="location.reload();">Close</button>
      </div>
    </div>
  </div>
</div>
</form>
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
  xhttp.open("POST", "dodelchalrep.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("l="+v+"&t="+z);

}


function update2()
{  z='22';
	v=document.getElementsByName("search2")[0].value;
	//alert(v);

	var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementsByName("tb2")[0].innerHTML = this.responseText;
    }
  };
  xhttp.open("POST", "dodelchalrep.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("l="+v+"&t="+z);

}

function fill(seri,tcode) {

  //while(descs.firstChild)
   //descs.removeChild(descs.firstChild);
  descs = document.getElementsByName("descs")[0];
  descs.innerHTML="<div class=\"row\" style=\"border-bottom:1px solid;\" name=\"record\"><div class=\"col-2\" style=\"border-right:1px solid;\"><input type=\"text\" name=\"slnop\" class=\"preview \" style=\"width:2vw\"></div><div class=\"col-7\" style=\"border-right:1px solid;\"><textarea name=\"descp\" class=\"preview form-control\"></textarea></div><div class=\"col-3\"><input type=\"text\" name=\"qtyp\" class=\"preview\"></div></div>";
  serial=document.getElementsByName("serial")[0].value;
	seri=serial;
	serial=serial.split("$");
  //alert(serial);
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      /*v = this.responseText;
      console.log(v);
      v = v.split("$");
      console.log(v);*/
      var prodesc,procat,res,record;
      res=this.responseText;
      //alert("res is "+res)
	  console.log("fillpreview "+res);
      res=res.split("&");
      
      prodesc=res[2];
      prodesc=prodesc.split("$");
      //source = document.getElementsByName("source")[0];
      //source.value = res[3];
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
	  desc[i].value="Rental starts from "+effdate;
      desc[i+1].value=i+" Unit(s) Only";
      qty[i+1].value=i;
      scount=i;
    }
  };
  xhttp.open("POST", "dodc.php", false);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("serial="+seri+"&tcode="+tcode);
}

function fillpreview(sno) {
  z='1';
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      v = this.responseText;
      console.log("fillsno "+v);
      v = v.split("&");
      console.log(v);
      document.getElementsByName('dcno')[0].value=v[1];
      document.getElementsByName('dcdate')[0].value=v[4];
      document.getElementsByName('orderby')[0].value=v[8];
      document.getElementsByName('orderno')[0].value=v[9];
      document.getElementsByName('daddress')[0].value=v[10];
      document.getElementsByName('baddress')[0].value=v[11];
      document.getElementsByName('serial')[0].value=v[12];
      document.getElementsByName('source')[0].value=v[14];
	  effdate=v[17];
	  document.getElementsByName("effdate")[0].value=v[17];
      fill(v[12],v[3]);
    }
  };
  xhttp.open("POST", "dodelchalrep.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("sno="+sno+"&t="+z);
}

function combine_desc()
{
	var desc,qty,i;
	var d=document.getElementsByName("descp");
	desc=d[0].innerHTML;
	//alert(d.length);
	for(i=1;i<d.length-1;i++)
		desc+="$"+d[i].innerHTML;
	document.getElementsByName("tdesc")[0].innerHTML=desc;
}
</script>
<?php include '../includes/foot.php'; ?>
