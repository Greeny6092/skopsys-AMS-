<?php include('../../database.php');
$dccode=$_POST['dcno'];
$tdesc=$_POST['tdesc'];
$date=$_POST['dcdate'];
$baddress=$_POST['baddress'];
$daddress=$_POST['daddress'];
$source=$_POST['source'];
if(isset($_POST['orderno']))
	$orderno=$_POST['orderno'];
else
	$orderno="";
if(isset($_POST['orderby']))
	$orderby=$_POST['orderby'];
else
	$orderby="";
$effdate=$_POST['effdate'];
//echo "effdate".$effdate;
?>
<head>
	<style>
	@media print
	{
		::-webkit-scrollbar
		{
			display:none !important;
		}
		
		input[type="text"],textarea
		{
					border: transparent !important;
					background-color:transparent !important;
						position:relative !important;
						left:0vw !important;
						font-size:14pt !important;
						font-weight:bold !important;
		}
		table
		{
			border: transparent !important;
			display:inline-table;
			padding-right:100px !important;
		}
		input[type="button"]
		{
			display:none !important;
		}
		body{
			padding-left: 30px !important;
			padding-right: 100px !important;
			width: 100vw;
			height:100vh;
		}
	}

	input[type="text"]
	{
		height:3vh;
		color: black;
		font-size:11pt;
	}
	table
	{
		border:2px dotted tomato;
		border-radius:5px;

	}
	textarea
	{
		font-size:11pt;
		color: black;
	}
	</style>
</head>
<body onload="getpdetails()" style="padding-left: 30px;padding-right: 100px;">
<input type="text" name="effdate" value="<?php echo $effdate?>" hidden>
<input type="text"  hidden value="<?php echo $serial1?>" name="mostunwanted" id="serial">
<span id="mtable" >
	<table border="2" width="100%" style= "top:4vh;" >
		<tr>
			<textarea rows="100" cols="200" name="tdesc" hidden><?php echo $tdesc ?></textarea><td width="30%" rowspan="4" colspan="2" name="unwanted">SKOPSYS</td>
			<td colspan="4" name="mostunwanted"><textarea name="unwanted" rows="3" cols="15" style="text-align:right;">DELIVERY CHALLAN</textarea></td>
		</tr>
		<tr>
			<td name="unwanted">D.C no</td>
			<td> &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;
			<input type="text" value="<?php echo $dccode ?>" style="text-align:right"><br><br> </td>
			<td name="unwanted">Date</td>
			<td> &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;
			<input type="text" value="<?php echo changedateformat($date)?>" maxlength="10" style="text-align:right"><br><br></td>
			<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
		</tr>
		<tr>
			<td name="unwanted">P.Order no</td>
			<td> &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;
			<input type="text" value="<?php echo $orderno ?>" style="text-align:right"><br><br></td>
			<td name="unwanted">Source</td>
			<td> &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;
			<input type="text" value="<?php echo $source; ?>" style="text-align:right"><br><br></td>
		</tr>
		<tr>
			<td name="unwanted">P.Order By</td>
			<td colspan="3"> &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;
			<input type="text" value="<?php echo $orderby?>" style="text-align:right"><br><br></td>
		</tr>
		<tr>
			<td name="unwanted">Billing Address:</td>
			<td><textarea rows="8" cols="40">

<?php echo $baddress?>
			</textarea></td>
			<td name="unwanted">Delivery Address:</td>
			<td colspan="3"> &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;
			<textarea rows="8" cols="40">

<?php echo $daddress ?>
			</textarea></td>
		</tr>
	</table>
		<table width="100%" border="2"  style="top:8vh;" cellpadding="1">
			<tr name="mostunwanted">
				<td width="3%" height="13%" name="unwanted"><center>S.No</center></td>
				<td width="77%" height="13%" name="unwanted"><center>Description of Goods</center></td>
				<td width="20%" height="13%" name="unwanted"><center>Qty.No</center></td>
			</tr>
			<!--<tr>
				<td><textarea rows="40" cols="3"></textarea></td>
				<td style="padding-left:2vw;"><textarea rows="40" cols="80"></textarea></td>
				<td><textarea rows="40" cols="8"></textarea></td>
			</tr>-->
			<tr>
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="2" cols="90" name="desc" ></textarea></td>
				<td><input type="text" style="width:14vw;text-align:right;" name="qty"></td>
			</tr>
			<tr>
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="2" cols="90" name="desc"></textarea></td>
				<td><input type="text" style="width:14vw;text-align:right;" name="qty"></td>
			</tr>
			<tr>
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="2" cols="90" name="desc"></textarea></td>
				<td><input type="text" style="width:14vw;text-align:right;" name="qty"></td>
			</tr>
			<tr>
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="2" cols="90" name="desc"></textarea></td>
				<td><input type="text" style="width:14vw;text-align:right;" name="qty"></td>
			</tr>
			<tr>
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="2" cols="90" name="desc"></textarea></td>
				<td><input type="text" style="width:14vw;text-align:right;" name="qty"></td>
			</tr>
			<tr>
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="2" cols="90" name="desc"></textarea></td>
				<td><input type="text" style="width:14vw;text-align:right;" name="qty"></td>
			</tr>
			<tr>
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="2" cols="90" name="desc"></textarea></td>
				<td><input type="text" style="width:14vw;text-align:right;" name="qty"></td>
			</tr>
			<tr>
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="2" cols="90" name="desc"></textarea></td>
				<td><input type="text" style="width:14vw;text-align:right;" name="qty"></td>
			</tr>
			<tr>
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="2" cols="90" name="desc"></textarea></td>
				<td><input type="text" style="width:14vw;text-align:right;" name="qty"></td>
			</tr>
			<tr>
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="2" cols="90" name="desc"></textarea></td>
				<td><input type="text" style="width:14vw;text-align:right;" name="qty"></td>
			</tr>
			<tr>
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="2" cols="90" name="desc"></textarea></td>
				<td><input type="text" style="width:14vw;text-align:right;" name="qty"></td>
			</tr>
			<tr>
				<td><input type="text" style="width:3vw;text-align:left;" name="slno"></td>
				<td><textarea rows="2" cols="90" name="desc"></textarea></td>
				<td><input type="text" style="width:14vw;text-align:right;" name="qty"></td>
			</tr>
			<tr>
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="2" cols="90" name="desc"></textarea></td>
				<td><input type="text" style="width:14vw;text-align:right;" name="qty"></td>
			</tr>
			<tr>
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="2" cols="90" name="desc"></textarea></td>
				<td><input type="text" style="width:14vw;text-align:right;" name="qty"></td>
			</tr>

			<tr>
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="2" cols="90" name="desc"></textarea></td>
				<td><input type="text" style="width:14vw;text-align:right;" name="qty"></td>
			</tr>
			<tr>
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="2" cols="90" name="desc"></textarea></td>
				<td><input type="text" style="width:14vw;text-align:right;" name="qty"></td>
			</tr>
			<tr>
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="2" cols="90" name="desc"></textarea></td>
				<td><input type="text" style="width:14vw;text-align:right;" name="qty"></td>
			</tr>
			<tr>
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="2" cols="90" name="desc"></textarea></td>
				<td><input type="text" style="width:14vw;text-align:right;" name="qty"></td>
			</tr>
			<tr>
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="2" cols="90" name="desc"></textarea></td>
				<td><input type="text" style="width:14vw;text-align:right;" name="qty"></td>
			</tr>
					<!--	<tr>
				<td><textarea rows="14" cols="3"></textarea></td>
				<td style="padding-left:2vw;float:right;"><textarea rows="14" cols="12"></textarea></td>
				<td><textarea rows="14" cols="8"></textarea></td>
			</tr>-->
			<tr>
				<td><center><input type="text" style="width:3vw;text-align:left;"></center></td>
				<td><br><br><textarea rows="2" cols="90" name="summary">

				</textarea></td>
				<td><br><br><br><input type="text" style="width:14vw;text-align:right;padding-top:2px;" name="sumqty"></td>
			</tr>
			<tr>
				<td colspan="5" name="mostunwanted">
					<span name="mostunwanted" style="float:left"><p style="color:tomato">&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Customer's Signature</p>Goods Recieved in Good Condition</span>
					<span name="mostunwanted" style="float:right">For &nbsp <span style="color:tomato">SKOPSYS</span><br><br>Proprietor</span>
				</td>

			</tr>
		</table>
	</table>
	<center><input type="button" name="printbutton" onclick="h1(this)" value="Print" style="position:absolute;top:208vh;"></center>
</span>

<script>
function h(butto) {
	butto.style="display:none";
     var printContents = document.getElementById("print").innerHTML;
     var originalContents = document.body.innerHTML;
     document.body.innerHTML = printContents;

     //window.print();

     document.body.innerHTML = originalContents;
}
function h1(butto)
{
	  var unwanted=document.getElementsByName("unwanted");
	  //var styles=document.all.toString();//.replace("solid","transparent");
	  //document.all=styles;
	  var i;
	  //console.log(styles);
	  for(i=0;i<unwanted.length;i++)
	  {
		  console.log("loop");
		  unwanted[i].style.visibility="hidden";
	  }
	  unwanted=document.getElementsByName("mostunwanted");
	  for(i=0;i<unwanted.length;i++)
	  {
		  console.log("loop");
		  unwanted[i].style.display="none";
	  }
		//butto.style.display="none";
		window.print();

}
function extension()
{
	var master_table=document.getElementById("mtable");
	var new_table=master_table.cloneNode(true);
	document.getElementsByTagName("body")[0].appendChild(new_table);
}
function getpdetails()
{	var i;
	var res;
	var e=0;
	var prodesc=document.getElementsByName("tdesc")[0].innerHTML;
	console.log("got details "+prodesc);
	prodesc=prodesc.split("$");
	console.log("got details[0] "+prodesc[0]);
	//alert(seri);	
	//alert(serials);
	//alert(parseInt(serials.length/20));
	if(parseInt(prodesc.length/19)>0)
	{
		//alert("extension");
		for(i=1;i<(prodesc.length)/19;i++)
		{
		extension();
		e++;
		}
	}
	console.log("after extension");
			//extension();
		desc=document.getElementsByName("desc");
		slno=document.getElementsByName("slno");
		qty=document.getElementsByName("qty");
		for(i=0;i<prodesc.length-2;i++)
		{
			slno[i].value=i+1;
			desc[i].innerHTML=prodesc[i];
			qty[i].value="1";
			console.log("fixxing details");
		}
		//alert("effdate "+document.getElementsByName("effdate")[0].value);
		desc[i].innerHTML="Rental starts from "+document.getElementsByName("effdate")[0].value;
		console.log("done !!");
		document.getElementsByName('sumqty')[e].value=i;
		document.getElementsByName('summary')[e].innerHTML="                                                                                                                                                                                                                                                                                                                                                                                              "+(i)+" Unit(s) Only";
		document.getElementsByName("printbutton")[0].onclick();	
		console.log("completed");
}

function changedateformat(ind)
{
	var temp=ind.split("-");
	return temp[2]+"-"+temp[1]+"-"+temp[0];
}

</script>
<br><br><br><br>

</body>
