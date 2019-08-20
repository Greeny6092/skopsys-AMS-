<?php include 'head.php';
include '../../database.php'; ?>

<div class="container">
            <p style="color: royalblue;">Customer Invoice Report</p>

            <hr>

            <!--div class="row">
    <div class="col-lg-2 col-sm-12 col-md-12">copy,csv,print</div>
    <div class="col-lg-10 col-sm-12 col-md-12"></div>
  </div-->

            <div class="row">
                <div class="col-lg-9 col-sm-12 col-md-12"></div>
                <div class="col-lg-3 col-sm-12 col-md-12">
                    <div class="form-group">
                        <!--label>Search:</label>
                        <input type="text" name="search" class="form-control" oninput="update()"-->
                    </div>
                </div>
            </div>
            <div class="contain" name="tbl">
                <?php
	 $sql = "select *  from invoices where cuscode='".$_SESSION['code']."' order by indx desc";
	$result = $conn->query($sql);
	$i=1;
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

	while($row = $result->fetch_assoc())
	{
		$sql1="select * from cusmaster where cuscode='".$row['cuscode']."' ";
		$result1=$conn->query($sql1);
		$row1=$result1->fetch_assoc();
		echo "<tr ><td>".$row["cuscode"]."</td><td>".$row["companyname"]."</td><td>".$row1['mobile']."</td><td><button type='button' class='btn btn-dark' data-toggle='modal' data-target='#address' onclick=\"fillpreview('".$row['billno']."')\">View</button></td></tr>";
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
		<form name="in" action="invoice.php" method="post" target="_blank" onsubmit="combine_desc()">
		<div class="modal fade" id="address" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <!--<div class="collapse" id="collapseExample">
          <hr>-->
		  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">User Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.reload();">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
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
                        &nbsp &nbsp P.order by:&nbsp &nbsp <input type="text" name="orderby" class="preview" style="width:8vw">
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
                          <input type="text" name="qty" class="preview form-control">
                          <!--<br>-->
                      </div>
                      <div class="col-2" style="border-right:1px solid;">
                          <input type="text" name="rate" class="preview form-control">
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
                    <input type='number' class='form-control' name='discount' value=0>
                  </div>
                </div>
                <div class='row' style='border-bottom:1px solid;' id="tcharge">
                  <div class='col-8'style='border-right:1px solid'></div>
                  <div class='col-2' style='border-right:1px solid'>Transport charges:</div>
                  <div class='col-2'>
                    <input type='number' class='form-control' name='tcharge' value=0>
                  </div>
                </div>
				<div class='row' style='border-bottom:1px solid;' id="scost">
                  <div class='col-8'style='border-right:1px solid'></div>
                  <div class='col-2' style='border-right:1px solid'>Service Cost:</div>
                  <div class='col-2'>
                    <input type='number' class='form-control' name='scost' value=0>
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
      <!--</div>-->

      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="location.reload();">Cancel</button>
        <input type="submit" name="pbutton"  class="btn btn-dark"  value="print" >
      </div>
	  </form>
    </div>
  </div>
</div>
</div>
	</form>
        <script>

            function fillpreview(billno) {

              var xhttp = new XMLHttpRequest();
            	xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  let v=this.responseText;
				  var i;
                  v=v.split("&");
                  console.log(v);
                  document.getElementsByName('billno')[0].value = v[0];
                  document.getElementsByName('instart')[0].value = v[1];
                  document.getElementsByName('inend')[0].value = v[2];
                  document.getElementsByName('dcno')[0].value = v[3];
                  document.getElementsByName('orderno')[0].value = v[4];
                  document.getElementsByName('source')[0].value = v[5];
                  document.getElementsByName('baddress')[0].value = v[6];
				  document.getElementsByName("tslno")[0].value=v[18];
				  document.getElementsByName("tdesc")[0].value=v[7];
				  document.getElementsByName("thsnsac")[0].value=v[8];
				  document.getElementsByName("tqty")[0].value=v[9];
				  document.getElementsByName("trate")[0].value=v[10];
				  document.getElementsByName("tamount")[0].value=v[11];
				  //alert("tamount "+v[11]);
				  var sl=v[18].split("$");
				  var prodesc=v[7].split("$");
				  var hsnsac=v[8].split("$");
				  var qty=v[9].split("$");
				  var rate=v[10].split("$");
				  var amount=v[11].split("$");
                  newrecord=document.getElementsByName("record")[0];
				  document.getElementsByName("descs")[0].innerHTML="<div class='row' style='border-bottom:1px solid;' name='record'><div class='col-1' style='border-right:1px solid;'><input type='text' name='slnop' class='preview form-control' style='width:3vw'></div><div class='col-4' style='border-right:1px solid;'><textarea name='descp' class='preview form-control'></textarea></div><div class='col-2' style='border-right:1px solid;'><input type='text' name='hsn/sac' class='preview form-control'></div><div class='col-1' style='border-right:1px solid;'><input type='text' name='qty' class='preview form-control'></div><div class='col-2' style='border-right:1px solid;'><input type='text' name='rate' class='preview form-control'></div><div class='col-2' ><input type='text' name='amount' class='preview form-control'></div></div>";
				  //alert("len v of 7 "+((prodesc.length)-1)+"v of 7 is "+prodesc);
				  for(i=0;i<prodesc.length-1;i++)
					{
						record=newrecord.cloneNode(true);
						document.getElementsByName("descs")[0].appendChild(record);
					}
                  slno=document.getElementsByName("slnop");
				  desc=document.getElementsByName("descp");
				  qtyp=document.getElementsByName("qty");
                  hsn=document.getElementsByName("hsn/sac");
                  ratep=document.getElementsByName("rate");
                  amountp=document.getElementsByName("amount");
				  //alert("len v of 7 "+((sl.length)-1)+"v of 7 is "+sl);
				  for(i=1;i<prodesc.length-2;i++)
			 		{
						console.log("slno entered!!");
						if(sl[i].value!="undefined")
							slno[i].value=sl[i];
						//console.log("slno :"+i+" :"+slno[i].value);
						desc[i].innerHTML=prodesc[i];
						if(qty[i]!="-1")
							qtyp[i].value=qty[i];
						hsn[i].value=hsnsac[i];
						ratep[i].value=rate[i];
						amountp[i].value=amount[i];
					}
									scount=i;
                  document.getElementsByName('subtotal')[0].value = v[12];


				  document.getElementById('sub').innerHTML="";

			if(v[15]=="33"){
				document.getElementById('sub').innerHTML+="<div class='row' style='border-bottom:1px solid;'><div class='col-8' style='border-right:1px solid'></div><div class='col-2' style='border-right:1px solid'>SGST:</div><div class='col-2'><input type='text' class='form-control' name='sgst' value="+v[20]+"></div></div>";
				document.getElementById('sub').innerHTML+="<div class='row' style='border-bottom:1px solid;'><div class='col-8' style='border-right:1px solid'></div><div class='col-2' style='border-right:1px solid'>CGST:</div><div class='col-2'><input type='text' class='form-control' name='cgst' value="+v[21]+"></div></div>";
				document.getElementsByName("total")[0].value=v[23];
				document.getElementById('num').innerHTML=v[16];

		   }else{
			   document.getElementById('sub').innerHTML+="<div class='row' style='border-bottom:1px solid;'><div class='col-8' style='border-right:1px solid'></div><div class='col-2' style='border-right:1px solid'>IGST:</div><div class='col-2'><input type='number' class='form-control' name='igst' value="+v[22]+"></div></div>";
				document.getElementsByName("total")[0].value=v[23];
				document.getElementById('num').innerHTML=v[16];
		   }
		   if(document.getElementsByName("tcharge")[0].value=="0")
			   document.getElementById("tcharge").style.display="none";
		   if(document.getElementsByName("discount")[0].value=="0")
			   document.getElementById("discount").style.display="none";
		   if(document.getElementsByName("scost")[0].value=="0")
			   document.getElementById("scost").style.display="none";
			document.getElementsByName("gst")[0].value=v[15];
                }
              };
              xhttp.open("POST", "docusinrep.php",false);
              xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
              //console.log("cuscode="+n);
			  //alert("billno="+billno+"&typ="+"1");
              xhttp.send("billno="+billno+"&typ="+"1");
            }
            function fin(code,sub) {

              cgst = (sub*9)/100;
              sgst = (sub*9)/100;
              igst = (sub*18)/100;
              //alert(cgst+" "+sgst+" "+igst+" "+sub);
              var xhttp = new XMLHttpRequest();
            	xhttp.onreadystatechange = function() {

                if (this.readyState == 4 && this.status == 200) {
                  let v=this.responseText;
                  //console.log(v);
                  subi = document.getElementById('sub');
				  subi.innerHTML="";
                  if (v=='33') {
                    subi.innerHTML+="<div class='row' style='border-bottom:1px solid;'><div class='col-8' style='border-right:1px solid'></div><div class='col-2' style='border-right:1px solid'>SGST:</div><div class='col-2'><input type='text' class='form-control' name='sgst'></div></div><div class='row' style='border-bottom:1px solid;'><div class='col-8' style='border-right:1px solid'></div><div class='col-2' style='border-right:1px solid'>CGST:</div><div class='col-2'><input type='text' class='form-control' name='cgst'></div></div>";
                    document.getElementsByName('sgst')[0].value = sgst;
					hrate+="$sgst";
					vamount+="$"+sgst;
                    document.getElementsByName('cgst')[0].value = cgst;
					hrate+="$cgst";
					vamount+="$"+cgst;
                    dis = parseInt(document.getElementsByName('discount')[0].value);
                    tc = parseInt(document.getElementsByName('tcharge')[0].value);
                    total = (sub-dis)+tc+cgst+sgst;
                      //alert(total);
                    document.getElementsByName('total')[0].value=total;
					hrate+="$total";
					vamount+="$"+total;
                  }
                  else{
                    subi.innerHTML+="<div class='row' style='border-bottom:1px solid;'><div class='col-8' style='border-right:1px solid'></div><div class='col-2' style='border-right:1px solid'>IGST:</div><div class='col-2'><input type='text' class='form-control' name='igst'></div></div>";
                    document.getElementsByName('igst')[0].value = igst;
					hrate+="$igst";
					vamount+="$"+igst;
                    dis = parseInt(document.getElementsByName('discount')[0].value);
                    tc = parseInt(document.getElementsByName('tcharge')[0].value);
                    total = (sub-dis)-dis+tc-igst;
                    //alert(total);
                    document.getElementsByName('total')[0].value=total;
					hrate+="$total";
					vamount+="$"+total;
                  }



                }
              };
              xhttp.open("POST", "docusinrep.php",false);
              xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
              //console.log("cuscode="+n);
              xhttp.send("code="+code+"&typ="+"2");
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
  xhttp.open("POST", "docusinrep.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("l="+v+"&t="+z);

}

function combine_desc()
{
	var desc,hsnsac,quantity,rate,amount,i;
	var d=document.getElementsByName("descp");
	var h=document.getElementsByName("hsn/sac");
	var q=document.getElementsByName("qty");
	var r=document.getElementsByName("rate");
	var a=document.getElementsByName("amount");
	desc=d[0].innerHTML;
	hsnsac=h[0].value;
	quantity=q[0].value;
	rate=r[0].value;
	amount=a[0].value;
	for(i=1;i<d.length;i++)
	{
		desc+="$"+d[i].value;
		hsnsac+="$"+h[i].value;
		quantity+="$"+q[i].value;
		rate+="$"+r[i].value;
		amount+="$"+a[i].value;
	}
	document.getElementsByName("tdesc")[0].innerHTML=desc;
	document.getElementsByName("thsnsac")[0].value=hsnsac;
	document.getElementsByName("tqty")[0].value=quantity;
	document.getElementsByName("trate")[0].value=rate;
	document.getElementsByName("tamount")[0].value=amount;
	/*hrate=r[i].value;
	vamount=a[i].value
	for(i=i+1;i<r.length;i++)
	{
		hrate+="$".r[i].innerHTML;
		vamount+="$".a[i].value;
	}*/
	document.getElementsByName("hrate")[0].value=hrate;
	document.getElementsByName("vamount")[0].value=vamount;
}
</script>
<?php include 'foot.php'; ?>
