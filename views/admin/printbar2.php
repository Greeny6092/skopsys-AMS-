<?php
require '../../vendor/autoload.php';

$generator = new Picqer\Barcode\BarcodeGeneratorHTML();
$v = $_POST["serial0"];
//if(isset($_GET["ser"])){
//	$v = $_GET["ser"];
//}
//$v=CU002;
echo $generator->getBarcode($v, $generator::TYPE_CODE_128);
?>
