<?php include('../../database.php');
$dccode=$_POST['dcno'];
$cuscode=$_POST['cuscode'];
$date=$_POST['dcdate'];
$baddress=$_POST['baddress'];
$daddress=$_POST['daddress'];
if(isset($_POST['orderno']))
	$orderno=$_POST['orderno'];
else
	$orderno="";
if(isset($_POST['orderby']))
	$orderby=$_POST['orderby'];
else
	$orderby="";
$tcode=$_POST['tcode'];
$serial1=$_POST['serial'];
$serial=$serial1;
$serial[0]=" ";
$serial=trim($serial," ");
$serial=explode("$",$serial);

/*foreach($serial as $seri)
{
	$sql="update promaster set status='RETURNING' where serial='".$seri."'";
	$conn->query($sql);
}
*/
//echo $serial;
$sql="select distinct a.vencode from promaster as a,enterorder as b where b.tcode='".$tcode."' and a.serial=b.serial";
//echo $sql;
$result=$conn->query($sql);
$res="";
echo $conn->error;
while($row=$result->fetch_assoc())
{
	$res.=$row['vencode'][0].$row['vencode'][0]." ";
}
$source=$_POST['source'];
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
<input type="text"  hidden value="<?php echo $serial1?>" name="mostunwanted" id="serial">
<span id="mtable" >
	<table border="2" width="100%" style= "top:4vh;" >
		<tr>
			<td width="30%" rowspan="4" colspan="2" name="unwanted">SKOPSYS</td>
			<td colspan="4" name="mostunwanted"><textarea name="unwanted" rows="6" cols="15" style="text-align:right;">DELIVERY CHALLAN</textarea></td>
		</tr>
		<tr>
			<td name="unwanted">D.C no</td>
			<td> &nbsp;  &nbsp; <input type="text" value="<?php echo $dccode ?>"><br><br> </td>
			<td name="unwanted">Date</td>
			<td> <input type="text" value="<?php echo $date?>" maxlength="10"><br><br></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
		</tr>
		<tr>
			<td name="unwanted">P.Order no</td>
			<td>&nbsp;  &nbsp;  &nbsp; <input type="text" value="<?php echo $orderno?>"><br><br></td>
			<td name="unwanted">Source</td>
			<td><input type="text" value="<?php echo $source; ?>"><br><br></td>
		</tr>
		<tr>
			<td name="unwanted">P.Order By</td>
			<td colspan="3"> &nbsp;  &nbsp;  &nbsp; <input type="text" value="<?php echo $orderby?>" style="width:18vw;"><br><br><br></td>
		</tr>
		<tr>
			<td name="unwanted">Billing Address:</td>
			<td><textarea rows="8" cols="38">


<?php echo $baddress?>
			</textarea></td>
			<td name="unwanted">Delivery Address:</td>
			<td colspan="3"><textarea rows="8" cols="38">


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
				<td><input type="text" style="width:14vw;text-align:left;" name="qty"></td>
			</tr>
			<tr>
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="2" cols="90" name="desc"></textarea></td>
				<td><input type="text" style="width:14vw;text-align:left;" name="qty"></td>
			</tr>
			<tr>
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="2" cols="90" name="desc"></textarea></td>
				<td><input type="text" style="width:14vw;text-align:left;" name="qty"></td>
			</tr>
			<tr>
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="2" cols="90" name="desc"></textarea></td>
				<td><input type="text" style="width:14vw;text-align:left;" name="qty"></td>
			</tr>
			<tr>
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="2" cols="90" name="desc"></textarea></td>
				<td><input type="text" style="width:14vw;text-align:left;" name="qty"></td>
			</tr>
			<tr>
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="2" cols="90" name="desc"></textarea></td>
				<td><input type="text" style="width:14vw;text-align:left;" name="qty"></td>
			</tr>
			<tr>
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="2" cols="90" name="desc"></textarea></td>
				<td><input type="text" style="width:14vw;text-align:left;" name="qty"></td>
			</tr>
			<tr>
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="2" cols="90" name="desc"></textarea></td>
				<td><input type="text" style="width:14vw;text-align:left;" name="qty"></td>
			</tr>
			<tr>
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="2" cols="90" name="desc"></textarea></td>
				<td><input type="text" style="width:14vw;text-align:left;" name="qty"></td>
			</tr>
			<tr>
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="2" cols="90" name="desc"></textarea></td>
				<td><input type="text" style="width:14vw;text-align:left;" name="qty"></td>
			</tr>
			<tr>
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="2" cols="90" name="desc"></textarea></td>
				<td><input type="text" style="width:14vw;text-align:left;" name="qty"></td>
			</tr>
			<tr>
				<td><input type="text" style="width:3vw;text-align:left;" name="slno"></td>
				<td><textarea rows="2" cols="90" name="desc"></textarea></td>
				<td><input type="text" style="width:14vw;text-align:left;" name="qty"></td>
			</tr>
			<tr>
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="2" cols="90" name="desc"></textarea></td>
				<td><input type="text" style="width:14vw;text-align:left;" name="qty"></td>
			</tr>
			<tr>
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="2" cols="90" name="desc"></textarea></td>
				<td><input type="text" style="width:14vw;text-align:left;" name="qty"></td>
			</tr>

			<tr>
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="2" cols="90" name="desc"></textarea></td>
				<td><input type="text" style="width:14vw;text-align:left;" name="qty"></td>
			</tr>
			<tr>
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="2" cols="90" name="desc"></textarea></td>
				<td><input type="text" style="width:14vw;text-align:left;" name="qty"></td>
			</tr>
			<tr>
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="2" cols="90" name="desc"></textarea></td>
				<td><input type="text" style="width:14vw;text-align:left;" name="qty"></td>
			</tr>
			<tr>
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="2" cols="90" name="desc"></textarea></td>
				<td><input type="text" style="width:14vw;text-align:left;" name="qty"></td>
			</tr>
					<!--	<tr>
				<td><textarea rows="14" cols="3"></textarea></td>
				<td style="padding-left:2vw;float:right;"><textarea rows="14" cols="12"></textarea></td>
				<td><textarea rows="14" cols="8"></textarea></td>
			</tr>-->
			<tr>
				<td><center><input type="text" style="width:3vw;text-align:left;"></center></td>
				<td><textarea rows="2" cols="90" name="summary">

				</textarea></td>
				<td><input type="text" style="width:14vw;text-align:left;" name="sumqty"></td>
			</tr>
			<tr>
				<td colspan="5">
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

     window.print();

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
	var serial=document.getElementById("serial").value;
	var res;
	var e=0;
	seri = serial;
	//alert(seri);
	serials=serial.split("$");
	serials = serials.filter(function (el) {
      		  return el != "";
      		});
	//alert(serials);
	//alert(parseInt(serials.length/20));
	if(parseInt(serials.length/20)>0)
	{
		//alert("extension");
		for(i=1;i<(serials.length)/20;i++)
		{
		extension();
		e++;
		}
	}
			//extension();

	var req=new XMLHttpRequest();
	var desc,prodesc="",slno,qty,procat="";
	try
	{
		req.onreadystatechange=function()
							{
									if(req.readyState==4)
									{	//alert("response recieved");
										res=req.responseText;
										//alert("res is "+res);
										res=res.split("&");
										prodesc=res[2];
										prodesc=prodesc.split("$");
										procat=res[0];
										procat=procat.split("$");
										ser=res[1];
										ser=ser.split("$");
										desc=document.getElementsByName("desc");
										slno=document.getElementsByName("slno");
										qty=document.getElementsByName("qty");
										for(i=1;i<prodesc.length;i++)
										{
											slno[i-1].value=i;
											desc[i-1].innerHTML=procat[i]+" "+ser[i]+" "+prodesc[i];
											qty[i-1].value="1";
										}
										document.getElementsByName('sumqty')[e].value=i-1;
										if((i-1)>1)
											document.getElementsByName('summary')[e].innerHTML="                                                                                                                                                                                                                                                                                                                                                                                              "+(i-1)+" Unit(s) Only";
										else
											document.getElementsByName('summary')[e].innerHTML="                                                                                                                                                                                                                                                                                                                                                                                              "+(i-1)+" Unit Only";
										document.getElementsByName("printbutton")[0].onclick();
									}
							}
		req.open("POST","dodc.php",false);
		req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		req.send("serial="+seri);

	}
	catch(e)
	{
		alert("unable to connect to server!!!");
	}
}
</script>
<br><br><br><br>

</body>
