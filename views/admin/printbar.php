<?php
require '../../vendor/autoload.php';

$generator = new Picqer\Barcode\BarcodeGeneratorHTML();
$v = $_POST["serial0"];
//if(isset($_GET["ser"])){
//	$v = $_GET["ser"];
//}
//$v=CU002;
echo "<div name='code'>".$generator->getBarcode($v, $generator::TYPE_CODE_128)."<input type='text' value='".$v."' style='text-align:center'></div>";
?>
<body>
<style>
@media print
{
	
	   @page
   {
    size: 2.5cm 0.5cm;
    
  }
	div
	{
	-webkit-print-color-adjust: exact !important;
	}
	input[type="text"]
	{
		border:transparent !important;
	}
}

</style>
<script>
var tag=document.getElementsByName("code")[0];
var newwin=window.open('','','width=30,height=2');
newwin.document.open();
newwin.document.write("<html><body onclick='window.print()'>"+tag.innerHTML+"</body></html>");
newwin.document.close();
</script>
</body>
