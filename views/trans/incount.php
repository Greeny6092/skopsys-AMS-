<?php include('../includes/head.php');
include('../../database.php') ;
 ?>

<div class="container">
  <p style="color: royalblue;" class="h4">Generate Invoice</p><hr>
  <div class="contain">
<?php
    $date = date('Y')."-".date('m')."-".date('d');
	 $sql = "select * from cusmaster where indate<='".$date."' and indate!='0000-00-00'";
   //echo $sql;
	 $result = $conn->query($sql);
	 if ($result->num_rows > 0){ ?>
   <table class="table table-striped table-hover table-bordered ">
    <thead class="thead-dark">
      <th>Customer Code</th>
	  <th>Customer Name</th>
	  <th>Mobile Number</th>
	  <th>View</th>
    </thead>
    <tbody>
	 <?php
	 $cuscode="";
	 while($row = $result->fetch_assoc()){
	 // echo "<tr><td>".$row['cuscode']."</td><td>".$row['companyname']."</td><td>".$row['mobile']."</td><td><button data-toggle='modal' data-target='#address' class='btn btn-info' onclick=\"pass('".$row['cuscode']."','".$row['indate']."')\">View</button></td></tr>";
	 $cuscode.="#".$row['cuscode'];
	}
	//echo $cuscode;
	$cuscode=explode('#',$cuscode);
	$cc='';
	for($i=1;$i<count($cuscode);$i++)
	{
		$sql1="select * from trans where cuscode='".$cuscode[$i]."' and intype!='DAILY' and dctype='rental'";
		$result1=$conn->query($sql1);
		if ($result1->num_rows > 0)
		{ //echo $cuscode[$i];
			//$cc.="#".$cuscode[$i]
			// echo "<tr><td>".$row['cuscode']."</td><td>".$row['companyname']."</td><td>".$row['mobile']."</td><td><button data-toggle='modal' data-target='#address' class='btn btn-info' onclick=\"pass('".$row['cuscode']."','".$row['indate']."')\">View</button></td></tr>";
			$sql2="select * from cusmaster where cuscode='".$cuscode[$i]."'";
			$result2=$conn->query($sql2);
			$row=$result2->fetch_assoc();
			if($row['paytype']=="PRE PAID")
				echo "<tr><td>".$row['cuscode']."</td><td>".$row['companyname']."</td><td>".$row['mobile']."</td><td><button data-toggle='modal' data-target='#address' class='btn btn-info' onclick=\"pass('".$row['cuscode']."','".$row['indate']."','1')\">View</button></td></tr>";
			else
				echo "<tr><td>".$row['cuscode']."</td><td>".$row['companyname']."</td><td>".$row['mobile']."</td><td><button data-toggle='modal' data-target='#address' class='btn btn-info' onclick=\"pass('".$row['cuscode']."','".$row['indate']."','2')\">View</button></td></tr>";
		}
	 }

	  $sql1="select * from trans where intype='DAILY' and dctype='rental' and dcdate<='".$date."' and effdate!='0000-00-00' ";
		$result1=$conn->query($sql1);
		while ($row1=$result1->fetch_assoc())
		{
			$sql2="select * from cusmaster where cuscode='".$row1['cuscode']."'";
			$result2=$conn->query($sql2);
			$row=$result2->fetch_assoc();
			echo "<tr><td>".$row['cuscode']."</td><td>".$row['companyname']."</td><td>".$row['mobile']."</td><td><button data-toggle='modal' data-target='#address' class='btn btn-info' onclick=\"pass('".$row['cuscode']."','".$row1['effdate']."','3','".$row1['rang']."','".$row1['dcno']."')\">View</button></td></tr>";
		}

    $sql1="select * from trans where intype='DAILY' and dctype='sales' and dcdate<='".$date."' and effdate!='0000-00-00' ";
		$result1=$conn->query($sql1);
		while ($row1=$result1->fetch_assoc())
		{
			$sql2="select * from cusmaster where cuscode='".$row1['cuscode']."'";
			$result2=$conn->query($sql2);
			$row=$result2->fetch_assoc();
			echo "<tr><td>".$row['cuscode']."</td><td>".$row['companyname']."</td><td>".$row['mobile']."</td><td><button data-toggle='modal' data-target='#address' class='btn btn-info' onclick=\"pass('".$row['cuscode']."','".$row1['effdate']."','4','1','".$row1['dcno']."')\">View</button></td></tr>";
		}

    ?>
	 </tbody>
  </table>

	<?php }
	else{
		echo "<h1>No Invoice to be Generated</h1>";
	}
	?>
  </div>
  <br>

</div>
<form action="invoice.php" method="post" target="_blank">
<div class="modal fade" id="address" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">User Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.reload();">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-4">
              <div class="form-group">
                <label>Invoice Starts From</label>
                <input type="date" name="instart" value="" class="form-control" onchange="getpdetails()" >
              </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-4">
              <div class="form-group">
                <label>Invoice End Date:</label>
                <input type="date" name="inend" value="" class="form-control" onchange="getpdetails()" required>
              </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-4">
              <div class="form-group">
                <label>Transport Charges:</label>
                <input type="number" name="tcharge" class="form-control" onchange="tcq();" value=0>
              </div>

            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-4">
              <div class="form-group">
                <label>Discount:</label>
                <input type="number" name="discount" class="form-control" onchange="disq();" value=0>
              </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-4">
              <div class="form-group" style="display:none">
                <label>Cost:</label>
                <input type="number" name="cost1" class="form-control" value=0>
              </div>
              <div class="form-group" id="rang">
                <label>Service Cost:</label>
                <input type="number" name="scost" class="form-control" onchange="tcq();" value=0>
              </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-4">
              <!--div class="form-group">
                <label>Description:</label>
                <textarea name="descrip" class="form-control"></textarea>
              </div-->
            </div>

            <input type="text" name="dcno" class="form-control" hidden>
            <input type="text" name="iid" class="form-control" hidden>
            <input type="number" name="cost" class="form-control" hidden>

          </div>
        </div>
	<form id="invoice" action="invoice.php" method="post">
        <div class="collapse" id="collapseExample">
          <hr>
          <div class="container" style="border:1px solid;">
              <div class="row" style="border-bottom:1px solid;">
                  <div class="col-6" style="border-right:1px solid;">
                      <h1 style="color:red;margin-bottom:-19px;">SKOPSYS</h1>
                      <br> No 8 Real Regency Ground Floor, Pycrofts Rd, Royapettah, Chennai, Tamil Nadu 600014
                  </div>
                  <div class="col-6">
                      <div class="row" style="border-bottom:1px solid;">
                          <div class="col-2"></div>
                          <div class="col-8">
                              Invoice challan
                          </div>
                          <div class="col-2"></div>
                      </div>
                      <div class="row" style="border-bottom:1px solid;">
                          <div class="col-6" style="border-right:1px solid;">
                              Bill no:&nbsp &nbsp
							  <input type="text" class="preview" name="billno" style="width:8vw">
                          </div>
                          <div class="col-6">
                              Date:&nbsp &nbsp
							  <input type="text" class="preview" name="instart" style="width:8vw">
                          </div>
                      </div>
                      <div class="row" style="border-bottom:1px solid;">
                          <div class="col-6" style="border-right:1px solid;">
                              DC no:&nbsp &nbsp <input type="text" class="preview" name="dcno" style="width:12vw">
                          </div>
                          <div class="col-6">
                              Date:&nbsp &nbsp <input type="text" class="preview" name="inend" style="width:12vw">
                          </div>

                      </div>
                      <div class="row">
                          <div class="col-6" style="border-right:1px solid;">
                              P.order no:&nbsp &nbsp <input type="text" class="preview" name="orderno" style="width:8vw">
                          </div>
                          <div class="col-6">
                              Source:&nbsp &nbsp <input type="text" class="preview" name="source" style="width:8vw">
                          </div>
                      </div>

                  </div>
              </div>
              <div class="row" style="border-bottom:1px solid;">
                  <div class="col-6" style="border-right:1px solid;">
                      Billing Address:<textarea class="preview form-control" name="baddress" rows="6"></textarea>
                  </div>
                  <div class="col-6">
                    <div class="row" style="border-bottom:1px solid;">
                        &nbsp &nbsp P.order by:&nbsp &nbsp <input type="text" name="orderby" class="preview" style="width:18vw">
                    </div>
                    <div class="row">
                      <u>BANK DETAILS</u><br>
                      <table>
                          <tr>
                              <td>NAME :</td>
                              <td>SKOPSYS</td>
                          </tr>
                          <tr>
                              <td>ACCOUNT NO :</td>
                              <td>307107951000001</td>
                          </tr>
                          <tr>
                              <td>BANK NAME :</td>
                              <td>VIJAYA BANK,ADAMBAKKAM BRANCH</td>
                          </tr>
                          <tr>
                              <td>IFSC CODE :</td>
                              <td>VIJB0003071 SWIFT CODE : VIJBINBBEGM</td>
                          </tr>
                      </table>
                    </div>
                  </div>
              </div>
              <div class="row" style="border-bottom:1px solid;">
                  <div class="col-1" style="border-right:1px solid;">
                      sno
					  <input type="text" name="tslno" hidden>
                  </div>
                  <div class="col-4" style="border-right:1px solid;">
                      Description<textarea rows="100" cols="200" name="tdesc" hidden></textarea>
                  </div>
                  <div class="col-2" style="border-right:1px solid;">
                      HSN/SAC code<input type="text" name="thsnsac" hidden>
                  </div>
                  <div class="col-1" style="border-right:1px solid;">
                      Quantity<input type="text" name="tqty" hidden><input type="text" name="tsummary" hidden>
                  </div>
                  <div class="col-2" style="border-right:1px solid;">
                      Rate<input type="text" name="trate" hidden><input type="text" name="hrate" hidden>
                  </div>
                  <div class="col-2" style="border-right:1px solid;">
                      Amount<input type="text" name="tamount" hidden><input type="text" name="vamount" hidden><input type="text" name="gst" hidden>
                  </div>
              </div>
              <div name="descs">
                  <div class="row" style="border-bottom:1px solid;" name="record">
                      <div class="col-1" style="border-right:1px solid;">
                          <input type="text" name="slnop" class="preview form-control" style="width:3vw">
                          <!--<br><br><br><br><br><br><br><br><br><br>-->
                      </div>
                      <div class="col-4" style="border-right:1px solid;">
                          <textarea name="descp" class="preview form-control"></textarea>
                          <!--<br>-->
                      </div>
                      <div class="col-2" style="border-right:1px solid;">
                          <input type="text" name="hsn/sac" class="preview form-control">
                          <!--<br>-->
                      </div>
                      <div class="col-1" style="border-right:1px solid;">
                          <input type="text" name="qty" class="preview form-control" >
                          <!--<br>-->
                      </div>
                      <div class="col-2" style="border-right:1px solid;">
                          <input type="text" name="rate" class="preview form-control" >
                          <!--<br>-->
                      </div>
                      <div class="col-2" >
                          <input type="text" name="amount" class="preview form-control">
                          <!--<br>-->
                      </div>
                  </div>
              </div>
              <div >
                <div class='row' style='border-bottom:1px solid;'>
                  <div class='col-8' style='border-right:1px solid'></div>
                  <div class='col-2' style='border-right:1px solid'>
                    Sub Total:
                  </div>
                  <div class='col-2'>
                    <input type='text' class='form-control' name='subtotal' >
                  </div>
                </div>
                <div class='row' style='border-bottom:1px solid;' id="discount">
                  <div class='col-8' style='border-right:1px solid'></div>
                  <div class='col-2' style='border-right:1px solid'>Discount:</div>
                  <div class='col-2'>
                    <input type='text' class='form-control' name='discount' value=0>
                  </div>
                </div>
                <div class='row' style='border-bottom:1px solid;' id="tcharge">
                  <div class='col-8'style='border-right:1px solid'></div>
                  <div class='col-2' style='border-right:1px solid'>Transport charges:</div>
                  <div class='col-2'>
                    <input type='text' class='form-control' name='tcharge' value=0>
                  </div>
                </div>
				<div class='row' style='border-bottom:1px solid;' id="scost">
                  <div class='col-8'style='border-right:1px solid'>
                    <textarea name="descp" class="form-control" name="descp"></textarea>
                  </div>
                  <div class='col-2' style='border-right:1px solid'>Service Cost:</div>
                  <div class='col-2'>
                    <input type='text' class='form-control' name='scost' value=0>
                  </div>
                </div>
              <div id="sub">

              </div>
              <div class="row" style="border-bottom:1px solid;">
                  <div class="col-8" style="border-right:1px solid;" id="num">

                  </div>
                  <div class="col-2" style="border-right:1px solid;">
                      Total:
                  </div>
                  <div class="col-2">
                      <input type="text" name="total" class="form-control">
                  </div>
              </div>
              <div class="row" style="border-bottom:1px solid;">
                  <br><br><br>
              </div>
          </div>
        </div>

      </div>

      <div class="modal-footer">
        <button type="button" onclick="getidetails();" class="btn btn-success" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" name="submitbutton">
            Submit
        </button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="location.reload();">Cancel</button>
        <input type="submit" name="pbutton"  class="btn btn-dark" onclick="query();" value="print" disabled>
      </div>
	  </form>
    </div>
  </div>
</div>
</form>

<script>
var res,gstno,discount,tcharge,cuscode,subtotal=0,dcnos="",cn="",paytype,rng="",dcnoo;
function pass(c,indate,p,r="0",dcno="") {
	paytype=p;
	dcnoo=dcno;
	rng=r;
	//alert(" r "+r);
	if(p=="1")
	{
	document.getElementsByName("instart")[0].value=indate;
	now = moment(indate).format('YYYY-MM-DD');
  nw = moment(now).add(1,'months').format('YYYY-MM-DD');
	nw = moment(nw).subtract(1,'days').format('YYYY-MM-DD');
	document.getElementsByName("inend")[0].value=nw;
	}
	else if(p=="2")
	{
		document.getElementsByName("inend")[0].value=indate;
		//document.getElementsByName("instart")[0].disabled=true;
	}
	else if(p=='3')
	{
		document.getElementsByName("instart")[0].value=indate;
		nw = moment(indate).format('YYYY-MM-DD');
		nw = moment(nw).add(r-1,'days').format('YYYY-MM-DD');
		document.getElementsByName("inend")[0].value=nw;
	}else if (p=="4") {
    document.getElementsByName("instart")[0].value=indate;
    document.getElementsByName("inend")[0].value=indate;
  }
	cuscode=c;
	//alert(document.getElementsByName("instart")[0].value);
	/*let req;
	req=new XMLHttpRequest;
	var par="";
	try
	{
		req.onreadystatechange=function()
								{
									if(req.readyState==4)
									{
										var res=req.responseText;
										alert("response pass "+res);
									}
								}
		req.open("POST","doincount.php",false);
		req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		req.send(par);
	}
	catch(e)
	{alert(e);}*/
}

function pass1(dcno,iid,lbdate) {
  document.getElementById('rang').style.display="none";
	//document.getElementsByName('inend')[1].value=document.getElementsByName('inend')[0].value;;
  typ="pa";
  var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        //alert(this.responseText);
        v = this.responseText;
        document.getElementsByName('rang')[0].value = v;
        //moment(lbdate, "YYYY-MM-DD");
        //now = moment().format('YYYY-MM-DD');
        //nw = moment(now).add(v-1,'days').format('YYYY-MM-DD');
        //alert(now+" "+nw);
        //document.getElementsByName('inend')[0].value = now;
        document.getElementsByName('pbutton')[0].value = "prints";
        getpdetails();
      }
    };
    xhttp.open("POST", "doincount.php", false);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("dcno="+dcno+"&typ="+typ);
}

function dele(dcno,iid) {
  //alert(dcno+" "+iid);
}

function disq() {
  cost = parseInt(document.getElementsByName('cost1')[0].value);
  dis = parseInt(document.getElementsByName('discount')[0].value);
    cost -=dis;
    document.getElementsByName('cost1')[0].value=cost;
    document.getElementsByName('discount')[1].value = '-'+document.getElementsByName('discount')[0].value;
}

function tcq(){
  //cost = parseInt(document.getElementsByName('cost1')[0].value);
  //tc = parseInt(document.getElementsByName('tcharge')[0].value);
    //cost=cost+tc;
    //document.getElementsByName('cost1')[0].value = cost;
    document.getElementsByName('tcharge')[1].value = document.getElementsByName('tcharge')[0].value;
	document.getElementsByName('scost')[1].value = document.getElementsByName('scost')[0].value;
}

function getpdetails()
			{
			  var t=1;
				var date1 = new Date(document.getElementsByName('instart')[0].value);
				var date2 = new Date(document.getElementsByName('inend')[0].value);
				if(date1=="Invalid Date"||date2=="Invalid Date")
					return false;
				var timeDiff = Math.abs(date2.getTime() - date1.getTime());
				var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
				diffDays+=1;
				dcno=document.getElementsByName("dcno")[0].value;
				var req=new XMLHttpRequest();
				var desc=document.getElementsByName("cost")[0],i,cost=0;

				try
				{	//alert("trying");
					req.onreadystatechange=function()
										{
											if(req.readyState==4&&req.status==200)
											{	//alert("result came");
													var res=req.responseText;
													//alert(res);
													res=res.split("&");
													//document.getElementsByName("baddress")[0].innerHTML=res[0];
													var descs=res[1].split("#");
													var qtys=res[2].split("$");
													var costpms=res[3].split("$");
													for(i=0;i<descs.length;i++)
													{
														//slno[i].value=i+1;
														//desc[i].innerHTML=descs[i];
														//qty[i].value=qtys[i];
														//costpm[i].value=costpms[i];

														cost+=parseFloat(costpms[i]*diffDays*parseInt(qtys[i]));
														cost= Math.ceil(cost);
														//alert("amount[i] "+amount[i].value+"\ncostpm[i] "+costpm[i].value+"\ndiff days"+diffDays)
													}
													//alert("completed!!!");
													document.getElementsByName("cost1")[0].value=cost;
													desc.value=cost;
													document.getElementsByName("subtotal")[0].value=cost;

											}
										}
					req.open("POST","doinvoice.php",false);
					req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					req.send("dcno="+dcno+"&t="+t);
				}
				catch(e)
				{

				}
			}
function query() {
  /*date1 = document.getElementsByName('instart')[0].value;
  date2 = document.getElementsByName('inend')[0].value;
  cost=document.getElementsByName("cost")[0].value;
  iid=document.getElementsByName("iid")[0].value;
  typ=document.getElementsByName("button")[0].value;
  var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        v = this.responseText;
        if(v==1)
          sessionStorage.setItem("success","Successfully saved Data");
        else {
          alert(v);
        }
  	    location.reload();
      }
    };
    xhttp.open("POST", "doincount.php", false);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("iid="+iid+"&date1="+date1+"&date2="+date2+"&cost="+cost+"&typ="+typ);*/
	savechange();
}
function del(dcno,iid) {

}

function getidetails()
			{
				document.getElementsByName("pbutton")[0].disabled=false;


				var hsnsac=document.getElementsByName("hsn/sac");
				console.log("called");
				dcno=document.getElementsByName("dcno")[0].value;
				var req=new XMLHttpRequest();
				var desc=document.getElementsByName("descp"),i;
				var qty=document.getElementsByName("qty");
				costpm=document.getElementsByName("rate");
				amount=document.getElementsByName("amount");
				var slno=document.getElementsByName("slnop");
				console.log(amount.length+" "+(amount.length-4));
				document.getElementsByName('total')[0].value = document.getElementsByName('cost1')[0].value
				//document.getElementsByName('inend')[1].value = changedateformat(document.getElementsByName('inend')[0].value);
				var cur_date=new Date();
				var today=cur_date.getDate()+"-"+cur_date.getMonth()+"-"+cur_date.getFullYear();
				document.getElementsByName('instart')[1].value =changedateformat(document.getElementsByName('instart')[0].value);
				if(document.getElementsByName('instart')[1].value[0]=="u")
				{
					document.getElementsByName('instart')[1].value=changedateformat(document.getElementsByName("inend")[0].value);
				}
        if(document.getElementsByName('tcharge')[0].value=="0"){
          //alert("hi");
          document.getElementById('tcharge').style.display='none';
        }
        if(document.getElementsByName('discount')[0].value=="0"){
          //alert("hi");
          document.getElementById('discount').style.display='none';
        }
		if(document.getElementsByName('scost')[0].value=="0"){
          //alert("hi");
          document.getElementById('scost').style.display='none';
        }

				try
				{	//alert("trying");
					req.onreadystatechange=function()
										{
											if(req.readyState==4&&req.status==200)
											{	//alert("result came");
													res=req.responseText;
													//console.log(temp);
													console.log("res is "+res);
													var temp=res.split("~");
													//alert("length"+(temp.length-1));
													var i,j,recpointer=0,k,serialno=1;
													//alert(res);
													for(j=0;j<temp.length-1;j++)
													{

													//alert("dcno "+i);
													res=temp[j];
													console.log("getidetails "+res);
													res=res.split("&");
													dcnos+="$"+res[8];
													var date1 = new Date(res[9]);
													//alert("date1 :"+date1);
													var date2 = new Date(document.getElementsByName('inend')[0].value);
													//alert("date2 :"+date2);

                          /*
													var timeDiff = Math.abs(date2.getTime() - date1.getTime());
													var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
													diffDays+=1;
													if(diffDays%28<=3)
														diffDays=parseInt(diffDays/28)*30;

                          */
							var a = moment(date2);
							var b = moment(date1);
							diffDays = a.diff(b, 'days');

							if(paytype==3){
								//alert("paytype 3");
								diffDays=parseInt(rng);
							}
							else if(diffDays == 28 || diffDays == 29 || diffDays == 30 || diffDays == 31){
								diffDays = 30;
							}
							else if(diffDays%30 == 0 ||  diffDays%30 == 1 ||  diffDays%30 == 2){
								diffDays = 30*(diffDays/30);
							}
							else{
								diffDays;
							}

                          //alert("diffDays ="+diffDays);

													document.getElementsByName("baddress")[0].innerHTML=res[7]+"\n"+res[0]+"\nGSTIN :"+res[6];
													cn=res[7];
													descs=res[1].split("#");
													qtys=res[2].split("$");
													costpms=res[3].split("$");
													hsnsacs=res[5].split("#");
													gstno=res[4];
													newrecord=document.getElementsByName("record")[recpointer];
													for(i=recpointer,k=0;i<(descs.length)+recpointer+2;i++,k++)
													{

														record=newrecord.cloneNode(true);
														document.getElementsByName("descs")[0].appendChild(record);
													}

													for(i=recpointer,k=-1;i<(descs.length)+recpointer+2;i++,k++)
													{

														if(k!=-1&&i!=(descs.length)+recpointer+1)
														{
															slno[i].value=serialno++;
															hsnsac[i].value=hsnsacs[k];
															qty[i].value=qtys[k];
															if(qty.value=="NaN")
															{
																qty[i].value=0;
															}
															  desc[i].innerHTML=descs[k];
															  if(paytype==1 || paytype==2){
																costpm[i].value=(parseFloat(costpms[k])*diffDays).toFixed(2);
															  }
															else if(paytype==3 || paytype==4)
																costpm[i].value=(parseFloat(costpms[k])*parseInt(rng)).toFixed(2);
															
															if(costpm[i].value=="NaN")
															{
																costpm[i].value=0;
															}
															  if (paytype==4) {
																amount[i].value=(parseFloat(costpms[k])*parseInt(qtys[k])).toFixed(2);
															  }
															  else{
																amount[i].value=(parseFloat(costpms[k])*diffDays*parseInt(qtys[k])).toFixed(2);
															  }
															  
															  if(amount[i].value=="NaN")
															  {
																  amount[i].value=0;
															  }
															amount[i].value=parseFloat(amount[i].value).toFixed(2);
															subtotal+=parseFloat(amount[i].value);
														}
														else if(k==-1){
                              //alert(k);
                              desc[i].innerHTML="Dc NO: "+res[8];
                            }
														else if(i==(descs.length)+recpointer+1){
                              if (paytype!="4") {
                                desc[i].innerHTML="Rental period : "+changedateformat(res[9])+" to "+changedateformat(document.getElementsByName("inend")[0].value)+" ("+diffDays+" Days)";
                              }
                            }
														//else


														if(i==0)
															amounts=amount[i].value;
														else
															amounts+="$"+amount[i].value;
														//alert("amount[i] "+amount[i].value+"\ncostpm[i] "+costpm[i].value+"\ndiff days"+diffDays)
													}
													recpointer=i;
													//alert("j="+j+"\nrecpointer "+recpointer);
													//alert("completed!!!");
													dcno=document.getElementsByName("dcno")[0].value;
													instart=document.getElementsByName("instart")[0].value;
													inend=document.getElementsByName("inend")[0].value;
													source=document.getElementsByName("source")[0].value;
													orderno=document.getElementsByName("orderno")[0].value;
													orderby=document.getElementsByName('orderby')[0].value;
													baddress=document.getElementsByName("baddress")[0].value;
													billno=document.getElementsByName("billno")[0].value;
													//fillsrc();

													}

													fillsrc();
													//savechange();
											}
										}
					req.open("POST","doinvoice.php",false);
					req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					//alert("cuscode="+cuscode+"&paytype="+paytype+"&dcno="+dcnoo);
					req.send("cuscode="+cuscode+"&paytype="+paytype+"&dcno="+dcnoo);

				}
				catch(e)
				{

				}
			}
	function fillsrc()
	{	//alert("Entered fillsrc");

	//alert("cost "+subtotal+"\ntcharge "+thcarge+"\nscost"+scost+"\ndiscount "+discount);
	let tcharge=parseFloat(document.getElementsByName("tcharge")[0].value);
	//alert("tcharge "+tcharge);
	let scost=parseFloat(document.getElementsByName("scost")[0].value);
	//alert("scost "+scost);
	let discount=parseFloat(document.getElementsByName("discount")[0].value);
	//alert("discount "+discount);
	//alert("cost "+subtotal+"\ntcharge "+thcarge+"\nscost"+scost+"\ndiscount "+discount);
	let cost=subtotal+tcharge+scost-discount;

	document.getElementsByName("subtotal")[0].value=parseFloat(subtotal).toFixed(2);
	//alert("cost s "+cost);
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			//alert("enter");
      if (this.readyState == 4 && this.status == 200) {
        //alert(this.responseText);
			v = this.responseText;
			//alert(v);
			console.log("fillsrc "+v);
			v = v.split("$");
			//->>>get the source here 
			document.getElementsByName('source')[0].value = v[0];
			document.getElementsByName('billno')[0].value=v[1];
			//document.getElementsByName('orderno')[0].value = v[1];
      //document.getElementsByName('orderby')[0].value = v[2];
			document.getElementById('sub').innerHTML="";

			if(gstno=="33"){
				document.getElementById('sub').innerHTML+="<div class='row' style='border-bottom:1px solid;'><div class='col-8' style='border-right:1px solid'></div><div class='col-2' style='border-right:1px solid'>SGST:</div><div class='col-2'><input type='text' class='form-control' name='sgst'></div></div>";

				document.getElementById('sub').innerHTML+="<div class='row' style='border-bottom:1px solid;'><div class='col-8' style='border-right:1px solid'></div><div class='col-2' style='border-right:1px solid'>CGST:</div><div class='col-2'><input type='text' class='form-control' name='cgst'></div></div>";

				//cost = parseInt(document.getElementsByName('cost1')[0].value);
				sgst = parseFloat(cost*0.09);
				cgst = parseFloat(cost*0.09);
				cost += sgst + cgst;
				document.getElementsByName('sgst')[0].value= sgst.toFixed(2);
				document.getElementsByName('cgst')[0].value= cgst.toFixed(2);
				document.getElementsByName('total')[0].value= parseFloat(cost).toFixed(2);
				document.getElementById('num').innerHTML="Rupees : "+numtoword(parseInt(document.getElementsByName('total')[0].value))+" only";

		   }else{
			   document.getElementById('sub').innerHTML+="<div class='row' style='border-bottom:1px solid;'><div class='col-8' style='border-right:1px solid'></div><div class='col-2' style='border-right:1px solid'>IGST:</div><div class='col-2'><input type='number' class='form-control' name='igst'></div></div>";

				//cost = parseInt(document.getElementsByName('cost1')[0].value);
				alert("cost ="+cost);
				igst = parseFloat(cost*0.18).toFixed(2);
				cost += parseFloat(igst);
				alert("igst ="+igst+"\ncost ="+cost);
				document.getElementsByName('igst')[0].value= igst;
				document.getElementsByName('total')[0].value= parseFloat(cost).toFixed(2);
				document.getElementById('num').innerHTML="Rupees : "+numtoword(parseInt(document.getElementsByName('total')[0].value))+" only";
				//document.getElementById('num').innerHTML+=" only";

		   }
          //alert(document.getElementsByName('descrip')[0].value);
       //document.getElementsByName('descp')[1].value = document.getElementsByName('descp')[0].value;
       document.getElementsByName("submitbutton")[0].disabled=true;
       $('.collapse').collapse();
		}
		};
		xhttp.open("POST", "doret.php", false);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		//alert("fillsrc :"+"cuscode="+cuscode+"&typ="+"inc");
		xhttp.send("cuscode="+cuscode+"&typ="+"inc"+"&paytype="+paytype+"&dcno="+dcnoo);

	}

	function savechange()
	{
		var billno,indate,inend,source,baddress,slno,desc,hsnsac,qty,costpm,amount,summary,scost;
		var slnos="",descs="",hsnsacs="",qtys="",costpms="",amounts="",gst=gstno,sgsts=0,cgsts=0,igsts=0,total,subtotal,orderby,orderno,dcno,tcharge,discount,total;
		billno=document.getElementsByName("billno")[0];
		indate=document.getElementsByName("instart")[1];
		inend=document.getElementsByName("inend")[1];
		source=document.getElementsByName("source")[0];
		baddress=document.getElementsByName("baddress")[0];
		slno=document.getElementsByName("slnop");
		desc=document.getElementsByName("descp");
		hsnsac=document.getElementsByName("hsn/sac");
		qty=document.getElementsByName("qty");
		costpm=document.getElementsByName("rate");
		amount=document.getElementsByName("amount");
		summary=document.getElementById("num");
		scost=document.getElementsByName("scost")[1];
		subtotal=document.getElementsByName("subtotal")[0];
		dcno=document.getElementsByName("dcno")[0];
		tcharge=document.getElementsByName("tcharge")[1];
		discount=document.getElementsByName("discount")[1];
		total=document.getElementsByName("total")[0];
		if(gst=="33")
		{
			sgsts=document.getElementsByName("sgst")[0].value;
			cgsts=document.getElementsByName("cgst")[0].value;
		}
		else
			igsts=document.getElementsByName("igst")[0].value;
		orderby=document.getElementsByName("orderby")[0];
		orderno=document.getElementsByName("orderno")[0];
		var i=0;
		var len=document.getElementsByName("record");
		//alert("len "+len.length);
		for(i=0;i<len.length;i++)
		{
			console.log("i is "+i+"\tqty :"+qty[i].value);
			slnos+="$"+slno[i].value;
			descs+="$"+desc[i].value;
			hsnsacs+="$"+hsnsac[i].value;
			costpms+="$"+costpm[i].value;
			amounts+="$"+amount[i].value;
			if(qty[i].value.length==0)
				qtys+="$-1";
			else
				qtys+="$"+qty[i].value;
		}
		if(scost!=0||scost!="")
		{
			//alert("count"+desc.length+"\nreason: "+desc[desc.length-1].value);
			descs+=desc[desc.length-1].value;
		}

		var par="billno="+billno.value+"&indate="+indate.value+"&inend="+inend.value+"&source="+source.value+"&baddress="+baddress.value+"&slno="+slnos+"&desc="+descs+"&hsnsac="+hsnsacs+"&qty="+qtys+"&rate="+costpms+"&amount="+amounts+"&gst="+gst+"&dcno="+dcno.value+"&orderno="+orderno.value+"&orderby="+orderby.value+"&subtotal="+subtotal.value+"&tcharge="+tcharge.value+"&discount="+discount.value+"&scost="+scost.value+"&sgst="+sgsts+"&cgst="+cgsts+"&igst="+igsts+"&summary="+summary.innerHTML+"&total="+total.value+"&cuscode="+cuscode+"&dcnos="+dcnos+"&companyname="+cn+"&paytype="+paytype+"&t=2";
		console.log("par are "+par);
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
											console.log(res);
											if(res==0)
											{
												toastr.success("Successfully saved changes!!!");
												//window.print()
											}
											else
											if(res.includes("No changes detected with previous Invoice"))
											{
												toastr.success(res);
												//window.print()
											}
											else
												return toastr.info("Error ocurred while saving changes to DC!!!");
										}
									}
			req.open("POST","savedc.php",false);
			req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			//alert(par);
			req.send(par);
			document.getElementsByName("tslno")[0].value=slnos;
			document.getElementsByName("tdesc")[0].value=descs;
			document.getElementsByName("thsnsac")[0].value=hsnsacs;
			document.getElementsByName("tqty")[0].value=qtys;
			document.getElementsByName("trate")[0].value=costpms;
			document.getElementsByName("tamount")[0].value=amounts;
			document.getElementsByName("gst")[0].value=gstno;
			document.getElementsByName("tsummary")[0].value=document.getElementById('summary').innerHTML;
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
