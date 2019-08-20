	<?php include('../../database.php') ;
$instart=$_POST['instart'];
$inend=$_POST['inend'];
$dcno=$_POST['dcno'];
$orderno=$_POST['orderno'];
$orderby=$_POST['orderby'];
$source=$_POST['source'];
$billno=$_POST['billno'];
$baddress=$_POST['baddress'];
$tslno=$_POST['tslno'];
$tdesc=$_POST['tdesc'];
$thsnsac=$_POST['thsnsac'];
$tqty=$_POST['tqty'];
$trate=$_POST['trate'];
$tamount=$_POST['tamount'];
//echo "<script>alert('".$tdesc."');</script>" ;
$subtotal=$_POST['subtotal'];
$gst=$_POST['gst'];
$sgst="0";
$cgst="0";
$igst="0";
if($gst=="33")
{
	$sgst=$_POST['sgst'];
	$cgst=$_POST['cgst'];
}
else
{
	$igst=$_POST['igst'];
}
$tcharge=$_POST['tcharge'];
$discount=$_POST['discount'];
$scost=$_POST['scost'];
$total=$_POST['total'];
$summary=$_POST['tsummary'];
?>
<html>
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
			body
			{
				padding-left: 30px !important;
				padding-right: 100px !important;
				width: 100vw;
				height:100vh;
			}
		}
	</style>
		<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
	<link href="/skopsys/js/toastr.css" rel="stylesheet"/>
	<script type="text/javascript" src="/skopsys/js/toastr.min.js"></script>
</head>
	<body onload="getidetails()" style= "top:4vh;padding-rigth:50vw;">
	<input type="text" name="subtotal" value="<?php echo $subtotal?>" hidden>
	<input type="text" name="tcharge" value="<?php echo $tcharge?>" hidden>
	<input type="text" name="discount" value="<?php echo $discount?>" hidden>
	<input type="text" name="scost" value="<?php echo $scost?>" hidden>
	<input type="text" name="sgst" value="<?php echo $sgst?>" hidden>
	<input type="text" name="cgst" value="<?php echo $cgst?>" hidden>
	<input type="text" name="igst" value="<?php echo $igst?>" hidden>
	<input type="text" name="sumqty" value="<?php echo $total?>" hidden>
	<input type="text" name="gst" value="<?php echo $gst?>" hidden>
	<input type="text" name="companyname" value="<?php echo $cn?>" hidden>
		<span id="mtable" >
			<table border="2" width="100%"  >
				<tr>
					<td rowspan="5" width="35%" name="unwanted">SKOPSYS</td>
					<td colspan="4" name="mostunwanted" style="color:tomato;font-size:15pt;text-align:center;height:2vh;">TAX INVOICE</td>
				</tr>
				<tr >
					<td style="padding:2vh 0vw;" name="mostunwanted">Bill no. :</td>
					<td style="padding:2vh 0vw;"><input type="text" name="billno" value='<?php echo $billno?>'></td>
					<td style="padding:2vh 0vw;" name="mostunwanted">Date :</td>
					<td style="padding:2vh 0vw;"><input type="text" value="<?php echo $instart; ?>" name="instart"></td>
				</tr>
				<tr>
					<td style="padding:2vh 0vw;" name="mostunwanted">D.C No.:</td>
					<td style="padding:2vh 0vw;"><input type="text" value="<?php echo $dcno; ?>" name="dcno"></td>
					<td style="padding:2vh 0vw;" name="mostunwanted">Date :</td>
					<td style="padding:2vh 0vw;">
					<input type="text" value="<?php echo $inend; ?>" name="inend"></td>
					<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
				</tr>
				<tr>
					<td style="padding:2vh 0vw;" name="mostunwanted">P.Order No. :</td>
					<td style="padding:2vh 0vw;"><input type="text" name="orderno" value="<?php echo $orderno;?>"></td>
					<td style="padding:2vh 0vw;" name="mostunwanted">Source :</td>
					<td style="padding:2vh 0vw;"><input type="text"  name="source" value="<?php echo $source;?>"></td>
				</tr>
				<tr>
					<td name="mostunwanted">P.order By</td>
					<td colspan="3"><input type="text" name="orderby" style="text-align:center;width:25vw;" value="<?php echo $orderby; ?>"></td>
				</tr>
				<tr>
				<td width="35%"><textarea cols="60" rows="8" name="baddress"><?php echo $baddress?></textarea></td>
				<td colspan="4" name="mostunwanted"><u name="unwanted">BANK DETAILS</u><br><table><tr><td name="unwanted">NAME   :</td><td name="unwanted">SKOPSYS</td></tr><tr><td name="unwanted">ACCOUNT NO :</td><td name="unwanted">307107951000001</td></tr><tr><td name="unwanted">BANK NAME  :</td><td name="unwanted">VIJAYA BANK,ADAMBAKKAM BRANCH</td></tr><tr><td name="unwanted">IFSC CODE  :</td><td name="unwanted">VIJB0003071  SWIFT CODE : VIJBINBBEGM</td></tr></table></td>
				</tr>
			</table>
			<table width="100%" border="2"  style="top:7vh;" cellpadding="1">
			<tr name="mostunwanted">
				<td width="3%" height="13%" name="unwanted">S.No<input type="text" name="tslno" value="<?php echo $tslno?>" hidden></td>
				<td width="27%" height="13%" name="unwanted">Description of Goods <textarea name="tdesc" hidden><?php echo $tdesc?></textarea> </td>
				<td width="5.75%" height="13%" name="unwanted">HSN/SAC<input type="text" name="thsnsac" value="<?php echo $thsnsac?>" hidden></td>
				<td width="5.75%" height="13%" name="unwanted">Qty.No<input type="text" name="tqty" value="<?php echo $tqty?>" hidden></td>
				<td width="13.75%" height="13%" name="unwanted">Rate<input type="text" name="trate" value="<?php echo $trate?>" hidden></td>
				<td width="16.75%" height="13%" name="unwanted">Amount<input type="text" name="tamount" value="<?php echo $tamount?>" hidden><textarea name="tsummary" cols="100" rows="2" hidden><?php echo $summary?></textarea></td>
			</tr>
			<!--<tr>
				<td><textarea rows="40" cols="3"></textarea></td>
				<td style="padding-left:2vw;"><textarea rows="40" cols="80"></textarea></td>
				<td><textarea rows="40" cols="8"></textarea></td>
			</tr>-->
			<tr>
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="1" cols="50" name="desc" ></textarea></td>
				<td><input type="text" style="width:11vw;text-align:left;" name="hsn/sac"></td>
				<td><input type="text" style="width:6vw;text-align:center;" name="qty"></td>
				<td><input type="text" style="width:17vw;text-align:center;" name="rate"></td>
				<td><input type="text" style="width:14vw;text-align:left;" name="amount"></td>
			</tr>
			<tr>
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="1" cols="50" name="desc"></textarea></td>
				<td><input type="text" style="width:11vw;text-align:left;" name="hsn/sac"></td>
				<td><input type="text" style="width:6vw;text-align:center;" name="qty"></td>
				<td><input type="text" style="width:17vw;text-align:center;" name="rate"></td>
				<td><input type="text" style="width:14vw;text-align:left;" name="amount"></td>
			</tr>
			<tr>
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="1" cols="50" name="desc"></textarea></td>
				<td><input type="text" style="width:11vw;text-align:left;" name="hsn/sac"></td>
				<td><input type="text" style="width:6vw;text-align:center;" name="qty"></td>
				<td><input type="text" style="width:17vw;text-align:center;" name="rate"></td>
				<td><input type="text" style="width:14vw;text-align:left;" name="amount"></td>
			</tr>
		<tr>
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="1" cols="50" name="desc"></textarea></td>
				<td><input type="text" style="width:11vw;text-align:left;" name="hsn/sac"></td>
				<td><input type="text" style="width:6vw;text-align:center;" name="qty"></td>
				<td><input type="text" style="width:17vw;text-align:center;" name="rate"></td>
				<td><input type="text" style="width:14vw;text-align:left;" name="amount"></td>
			</tr>
			<tr>
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="1" cols="50" name="desc"></textarea></td>
				<td><input type="text" style="width:11vw;text-align:left;" name="hsn/sac"></td>
				<td><input type="text" style="width:6vw;text-align:center;" name="qty"></td>
				<td><input type="text" style="width:17vw;text-align:center;" name="rate"></td>
				<td><input type="text" style="width:14vw;text-align:left;" name="amount"></td>
			</tr>
			<tr>
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="1" cols="50" name="desc"></textarea></td>
				<td><input type="text" style="width:11vw;text-align:left;" name="hsn/sac"></td>
				<td><input type="text" style="width:6vw;text-align:center;" name="qty"></td>
				<td><input type="text" style="width:17vw;text-align:center;" name="rate"></td>
				<td><input type="text" style="width:14vw;text-align:left;" name="amount"></td>
			</tr>
			<tr>
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="1" cols="50" name="desc"></textarea></td>
				<td><input type="text" style="width:11vw;text-align:left;" name="hsn/sac"></td>
				<td><input type="text" style="width:6vw;text-align:center;" name="qty"></td>
				<td><input type="text" style="width:17vw;text-align:center;" name="rate"></td>
				<td><input type="text" style="width:14vw;text-align:left;" name="amount"></td>
			</tr>
			<tr>
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="1" cols="50" name="desc"></textarea></td>
				<td><input type="text" style="width:11vw;text-align:left;" name="hsn/sac"></td>
				<td><input type="text" style="width:6vw;text-align:center;" name="qty"></td>
				<td><input type="text" style="width:17vw;text-align:center;" name="rate"></td>
				<td><input type="text" style="width:14vw;text-align:left;" name="amount"></td>
			</tr>
			<tr>
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="1" cols="50" name="desc"></textarea></td>
				<td><input type="text" style="width:11vw;text-align:left;" name="hsn/sac"></td>
				<td><input type="text" style="width:6vw;text-align:center;" name="qty"></td>
				<td><input type="text" style="width:17vw;text-align:center;" name="rate"></td>
				<td><input type="text" style="width:14vw;text-align:left;" name="amount"></td>
			</tr>
			<tr>
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="1" cols="50" name="desc"></textarea></td>
				<td><input type="text" style="width:11vw;text-align:left;" name="hsn/sac"></td>
				<td><input type="text" style="width:6vw;text-align:center;" name="qty"></td>
				<td><input type="text" style="width:17vw;text-align:center;" name="rate"></td>
				<td><input type="text" style="width:14vw;text-align:left;" name="amount"></td>
			</tr>
			<tr>
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="1" cols="50" name="desc"></textarea></td>
				<td><input type="text" style="width:11vw;text-align:left;" name="hsn/sac"></td>
				<td><input type="text" style="width:6vw;text-align:center;" name="qty"></td>
				<td><input type="text" style="width:17vw;text-align:center;" name="rate"></td>
				<td><input type="text" style="width:14vw;text-align:left;" name="amount"></td>
			</tr>
			<tr>
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="1" cols="50" name="desc"></textarea></td>
				<td><input type="text" style="width:11vw;text-align:left;" name="hsn/sac"></td>
				<td><input type="text" style="width:6vw;text-align:center;" name="qty"></td>
				<td><input type="text" style="width:17vw;text-align:center;" name="rate"></td>
				<td><input type="text" style="width:14vw;text-align:left;" name="amount"></td>
			</tr>
			<tr>
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="1" cols="50" name="desc"></textarea></td>
				<td><input type="text" style="width:11vw;text-align:left;" name="hsn/sac"></td>
				<td><input type="text" style="width:6vw;text-align:center;" name="qty"></td>
				<td><input type="text" style="width:17vw;text-align:center;" name="rate"></td>
				<td><input type="text" style="width:14vw;text-align:left;" name="amount"></td>
			</tr>
			<tr>
				<td><input type="text" style="width:3vw;text-align:left;" name="slno"></td>
				<td><textarea rows="1" cols="50" name="desc"></textarea></td>
				<td><input type="text" style="width:11vw;text-align:left;" name="hsn/sac"></td>
				<td><input type="text" style="width:6vw;text-align:center;" name="qty"></td>
				<td><input type="text" style="width:17vw;text-align:center;" name="rate"></td>
				<td><input type="text" style="width:14vw;text-align:left;" name="amount"></td>
			</tr>
			<tr>
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="1" cols="50" name="desc"></textarea></td>
				<td><input type="text" style="width:11vw;text-align:left;" name="hsn/sac"></td>
				<td><input type="text" style="width:6vw;text-align:center;" name="qty"></td>
				<td><input type="text" style="width:17vw;text-align:center;" name="rate"></td>
				<td><input type="text" style="width:14vw;text-align:left;" name="amount"></td>
			</tr>
			<tr>
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="1" cols="50" name="desc"></textarea></td>
				<td><input type="text" style="width:11vw;text-align:left;" name="hsn/sac"></td>
				<td><input type="text" style="width:6vw;text-align:center;" name="qty"></td>
				<td><input type="text" style="width:17vw;text-align:center;" name="rate"></td>
				<td><input type="text" style="width:14vw;text-align:left;" name="amount"></td>
			</tr>
			<tr>
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="1" cols="50" name="desc"></textarea></td>
				<td><input type="text" style="width:11vw;text-align:left;" name="hsn/sac"></td>
				<td><input type="text" style="width:6vw;text-align:center;" name="qty"></td>
				<td><input type="text" style="width:17vw;text-align:center;" name="rate"></td>
				<td><input type="text" style="width:14vw;text-align:left;" name="amount"></td>
			</tr>
			<tr>
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="1" cols="50" name="desc"></textarea></td>
				<td><input type="text" style="width:11vw;text-align:left;" name="hsn/sac"></td>
				<td><input type="text" style="width:6vw;text-align:center;" name="qty"></td>
				<td><input type="text" style="width:17vw;text-align:center;" name="rate"></td>
				<td><input type="text" style="width:14vw;text-align:left;" name="amount"></td>
			</tr>
			<tr>
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="1" cols="50" name="desc"></textarea></td>
				<td><input type="text" style="width:11vw;text-align:left;" name="hsn/sac"></td>
				<td><input type="text" style="width:6vw;text-align:center;" name="qty"></td>
				<td><input type="text" style="width:17vw;text-align:center;" name="rate"></td>
				<td><input type="text" style="width:14vw;text-align:left;" name="amount"></td>
			</tr>
			<tr>
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="1" cols="50" name="desc"></textarea></td>
				<td><input type="text" style="width:11vw;text-align:left;" name="hsn/sac"></td>
				<td><input type="text" style="width:6vw;text-align:center;" name="qty"></td>
				<td><input type="text" style="width:17vw;text-align:center;" name="rate"></td>
				<td><input type="text" style="width:14vw;text-align:left;" name="amount"></td>
			</tr>
			<tr>
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="1" cols="50" name="desc"></textarea></td>
				<td><input type="text" style="width:11vw;text-align:left;" name="hsn/sac"></td>
				<td><input type="text" style="width:6vw;text-align:center;" name="qty"></td>
				<td><input type="text" style="width:17vw;text-align:center;" name="rate"></td>
				<td><input type="text" style="width:14vw;text-align:left;" name="amount"></td>
			</tr>
			<div name="lpart">
			<tr id="rsubtotal">
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="1" cols="50" name="desc"></textarea></td>
				<td><input type="text" style="width:11vw;text-align:left;" name="hsn/sac"></td>
				<td><input type="text" style="width:6vw;text-align:center;" name="qty"></td>
				<td><input type="text" style="width:17vw;text-align:center;" name="rate" value="SUB TOTAL"></td>
				<td><input type="text" style="width:14vw;text-align:left;" name="subtotal"></td>
			</tr>
			<tr id="rtcharge">
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="1" cols="50" name="desc"></textarea></td>
				<td><input type="text" style="width:11vw;text-align:left;" name="hsn/sac"></td>
				<td><input type="text" style="width:6vw;text-align:center;" name="qty"></td>
				<td><input type="text" style="width:17vw;text-align:center;" name="rate" value="TRANSPORT CHARGE"></td>
				<td><input type="text" style="width:14vw;text-align:left;" name="tcharge"></td>
			</tr>
			<tr id="rdiscount">
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="1" cols="50" name="desc"></textarea></td>
				<td><input type="text" style="width:11vw;text-align:left;" name="hsn/sac"></td>
				<td><input type="text" style="width:6vw;text-align:center;" name="qty"></td>
				<td><input type="text" style="width:17vw;text-align:center;" name="rate" value="DISCOUNT"></td>
				<td><input type="text" style="width:14vw;text-align:left;" name="discount"></td>
			</tr>
			<tr id="rscost">
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="1" cols="50" name="desc"></textarea></td>
				<td><input type="text" style="width:11vw;text-align:left;" name="hsn/sac"></td>
				<td><input type="text" style="width:6vw;text-align:center;" name="qty"></td>
				<td><input type="text" style="width:17vw;text-align:center;" name="rate" value="SERVICE COST"></td>
				<td><input type="text" style="width:14vw;text-align:left;" name="scost"></td>
			</tr>
			<tr id="rsgst">
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="1" cols="50" name="desc"></textarea></td>
				<td><input type="text" style="width:11vw;text-align:left;" name="hsn/sac"></td>
				<td><input type="text" style="width:6vw;text-align:center;" name="qty"></td>
				<td><input type="text" style="width:17vw;text-align:center;" name="rate" value="SGST"></td>
				<td><input type="text" style="width:14vw;text-align:left;" name="sgst"></td>
			</tr>
			<tr id="rcgst">
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="1" cols="50" name="desc"></textarea></td>
				<td><input type="text" style="width:11vw;text-align:left;" name="hsn/sac"></td>
				<td><input type="text" style="width:6vw;text-align:center;" name="qty"></td>
				<td><input type="text" style="width:17vw;text-align:center;" name="rate" value="CGST"></td>
				<td><input type="text" style="width:14vw;text-align:left;" name="cgst"></td>
			</tr>
			<tr id="rigst">
				<td><input type="text" style="width:3vw;text-align:left;"  name="slno"></td>
				<td><textarea rows="1" cols="50" name="desc"></textarea></td>
				<td><input type="text" style="width:11vw;text-align:left;" name="hsn/sac"></td>
				<td><input type="text" style="width:6vw;text-align:center;" name="qty"></td>
				<td><input type="text" style="width:17vw;text-align:center;" name="rate" value="IGST"></td>
				<td><input type="text" style="width:14vw;text-align:left;" name="igst"></td>
			</tr>

					<!--	<tr>
				<td><textarea rows="14" cols="3"></textarea></td>
				<td style="padding-left:2vw;Int:right;"><textarea rows="14" cols="12"></textarea></td>
				<td><textarea rows="14" cols="8"></textarea></td>
			</tr>-->
			<tr>
				<td><center><input type="text" style="width:4vw;text-align:left;"></center></td>
				<td colspan="4"><textarea rows="2" cols="100" name="summary">

				</textarea></td>
				<td><input type="text" style="width:14vw;text-align:center;" name="sumqty"></td>
			</tr></div>
			<tr><td colspan="6" name="unwanted"><div style="font-size:18pt;color:tomato;">Terms and Conditions</div></td></tr>
			<tr>
				<td colspan="6" name="unwanted">
					<ol style="font-size:15pt">
						<li> The above Systems/equipements are supplied only on rental basis ,and are to be returned at the expiry of rental period.</li>
						<li> The above systems/equipments should not be shifted / relocated to any other location without our consent in writing.</li>
						<li> payment against this invoice should be made only by account payee cheque/bank draft in the name of SKOPSYS.</li>
						<li> If the payment is not made by the customer with in the stipulated time we will take back our system/equipment without prior notice.</li>
						<li> All claims and disputes are subject to chennai jurisdiction only</li>
					</ol>
				</td>
			</tr>
			<tr>
				<td colspan="6" name="unwanted">
					<span name="mostunwanted" style="Int:left"><p style="color:tomato">&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Customer's Signature</p>Goods Recieved in Good Condition</span>
					<span name="mostunwanted" style="Int:right">For &nbsp <span style="color:tomato">SKOPSYS</span><br><br>Proprietor</span>
				</td>
			</tr>
		</table>
	</table>
	<center><input type="button" onclick="h1(this)" value="Print" style="position:absolute;top:208vh;" name="unwanted" id="print"></center>
		</span>
		<script>
		var e=0;
		function extension()
		{
			var mtable=document.getElementById("mtable");
			var neww=mtable.clone(true);
			document.getElementsByTagName("body")[0].appendChild(neww);
			e++;
		}
	function getidetails()
	{
	//alert("gst "+document.getElementsByName('gst')[0].value);
		var tslno,tdesc,thsnsac,tqty,trate,tamount,i;
		var subtotal,tcharge,discount,scost,sgst,cgst,igst,total,summary;
		tslno=document.getElementsByName("tslno")[0].value;
		tdesc=document.getElementsByName("tdesc")[0].value;
		thsnsac=document.getElementsByName("thsnsac")[0].value;
		tqty=document.getElementsByName("tqty")[0].value;
		trate=document.getElementsByName("trate")[0].value;
		tamount=document.getElementsByName("tamount")[0].value;
		tslno=tslno.split("$");
		tdesc=tdesc.split("$");
		thsnsac=thsnsac.split("$");
		tqty=tqty.split("$");
		trate=trate.split("$");
		tamount=tamount.split("$");
		subtotal=document.getElementsByName("subtotal");
		tcharge=document.getElementsByName("tcharge");
		scost=document.getElementsByName("scost");
		discount=document.getElementsByName("discount");
		sgst=document.getElementsByName("sgst");
		cgst=document.getElementsByName("cgst");
		igst=document.getElementsByName("igst");
		total=document.getElementsByName("sumqty");
		summary=document.getElementsByName("summary");

		if(parseInt(tdesc.length/21)>0)
		{
			//alert("extension");
			for(i=0;i<(serials.length)/21;i++)
			{
				extension();
				e++;
			}
		}
		for(i=1;i<tdesc.length;i++)
		{
			document.getElementsByName("slno")[i-1].value=tslno[i];
			document.getElementsByName("desc")[i-1].innerHTML=tdesc[i]
			document.getElementsByName("hsn/sac")[i-1].value=thsnsac[i]
			if(tqty[i]=="-1")
				document.getElementsByName("qty")[i-1].value="";
			else
				document.getElementsByName("qty")[i-1].value=tqty[i];
			document.getElementsByName("rate")[i-1].value=trate[i];
			document.getElementsByName("amount")[i-1].value=tamount[i];
		}
		subtotal[subtotal.length-1].value=subtotal[0].value;
		tcharge[tcharge.length-1].value=tcharge[0].value;
		if(tcharge[tcharge.length-1].value=="0")
			tcharge[tcharge.length-1].parentNode.parentNode.style.display="none";
		discount[discount.length-1].value=discount[0].value;
		if(discount[discount.length-1].value=="0")
			discount[discount.length-1].parentNode.parentNode.style.display="none";
		scost[scost.length-1].value=scost[0].value;
		if(scost[scost.length-1].value=="0")
			scost[scost.length-1].parentNode.parentNode.style.display="none";
		sgst[sgst.length-1].value=sgst[0].value;
		if(sgst[sgst.length-1].value=="0")
			sgst[sgst.length-1].parentNode.parentNode.style.display="none";
		cgst[cgst.length-1].value=cgst[0].value;
		if(cgst[cgst.length-1].value=="0")
			cgst[cgst.length-1].parentNode.parentNode.style.display="none";
		igst[igst.length-1].value=igst[0].value;
		if(igst[igst.length-1].value=="0")
			igst[igst.length-1].parentNode.parentNode.style.display="none";
		total[total.length-1].value=total[0].value;
		//document.getElementsByName("summary")[0].innerHTML=numtoword(total[0].value);
		summary[summary.length-1].value=numtoword(total[total.length-1].value);
		var lpart=document.getElementsByName("lpart");
		for(i=0;i<e;i++)
		{
			lpart[i].style.visibility="hidden";
		}
		document.getElementById("print").onclick();
	}

	function numtoword(amount) {
    var words = new Array();
    words[0] = '';
    words[1] = 'One';
    words[2] = 'Two';
    words[3] = 'Three';
    words[4] = 'Four';
    words[5] = 'Five';
    words[6] = 'Six';
    words[7] = 'Seven';
    words[8] = 'Eight';
    words[9] = 'Nine';
    words[10] = 'Ten';
    words[11] = 'Eleven';
    words[12] = 'Twelve';
    words[13] = 'Thirteen';
    words[14] = 'Fourteen';
    words[15] = 'Fifteen';
    words[16] = 'Sixteen';
    words[17] = 'Seventeen';
    words[18] = 'Eighteen';
    words[19] = 'Nineteen';
    words[20] = 'Twenty';
    words[30] = 'Thirty';
    words[40] = 'Forty';
    words[50] = 'Fifty';
    words[60] = 'Sixty';
    words[70] = 'Seventy';
    words[80] = 'Eighty';
    words[90] = 'Ninety';
    amount = amount.toString();
    var atemp = amount.split(".");
    var number = atemp[0].split(",").join("");
    var n_length = number.length;
    var words_string = "";
    if (n_length <= 9) {
        var n_array = new Array(0, 0, 0, 0, 0, 0, 0, 0, 0);
        var received_n_array = new Array();
        for (var i = 0; i < n_length; i++) {
            received_n_array[i] = number.substr(i, 1);
        }
        for (var i = 9 - n_length, j = 0; i < 9; i++, j++) {
            n_array[i] = received_n_array[j];
        }
        for (var i = 0, j = 1; i < 9; i++, j++) {
            if (i == 0 || i == 2 || i == 4 || i == 7) {
                if (n_array[i] == 1) {
                    n_array[j] = 10 + parseInt(n_array[j]);
                    n_array[i] = 0;
                }
            }
        }
        value = "";
        for (var i = 0; i < 9; i++) {
            if (i == 0 || i == 2 || i == 4 || i == 7) {
                value = n_array[i] * 10;
            } else {
                value = n_array[i];
            }
            if (value != 0) {
                words_string += words[value] + " ";
            }
            if ((i == 1 && value != 0) || (i == 0 && value != 0 && n_array[i + 1] == 0)) {
                words_string += "Crores ";
            }
            if ((i == 3 && value != 0) || (i == 2 && value != 0 && n_array[i + 1] == 0)) {
                words_string += "Lakhs ";
            }
            if ((i == 5 && value != 0) || (i == 4 && value != 0 && n_array[i + 1] == 0)) {
                words_string += "Thousand ";
            }
            if (i == 6 && value != 0 && (n_array[i + 1] != 0 && n_array[i + 2] != 0)) {
                words_string += "Hundred and ";
            } else if (i == 6 && value != 0) {
                words_string += "Hundred ";
            }
        }
        words_string = words_string.split("  ").join(" ");
    }
    return words_string;
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
		//window.print();

}
		</script>
	</body>
</html>
