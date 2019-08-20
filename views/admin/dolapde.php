<?php include('../../database.php');

$typ= $_POST["typ"];
$code = $_POST["code"];
$type = $_POST["type"];
$processor = $_POST["processor"];
$ram = $_POST["ram"];
$gcard = $_POST["gcard"];
$mobo = $_POST["mobo"];
$monitor = $_POST["monitor"];
$stock = $_POST["stock"];
$sgst = $_POST["sgst"];
$cgst = $_POST["cgst"];
$igst = $_POST["igst"];
$warranty = $_POST["warranty"];
$descr = $_POST["descr"];
$brand = $_POST["brand"];

if($typ=="save")
{ 
    if($type!='PC')
	{$t='LP';}
 else
	 $t='PC';
	a:
	$code=$t.date('Y').date('m').rand(1000,9999);

	$sql = "select * from pclap where code='".$code."'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0)
		goto a;
	
	$sql = "select * from pclap where code='".$code."'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0)
	{ echo "Username already exist!!";
		goto b;
	}

	$sql = "INSERT INTO pclap(code,type,processor,ram,gcard,mobo,monitor,stock,sgst,cgst,igst,warranty,descr,brand) VALUES ('".$code."','".$type."','".$processor."','".$ram."','".$gcard."','".$mobo."','".$monitor."','".$stock."','".$sgst."','".$cgst."','".$igst."','".$warranty."','".$descr."','".$brand."')";

	if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    }
	else{
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
 		b:;
}
else
{	
	if($type=='PC')
		$code = str_replace("LP","PC",$code);
	if($type=='Laptop')
		$code = str_replace("PC","LP",$code);
	$sql="update pclap set code='".$code."',type='".$type."',processor='".$processor."',ram='".$ram."',gcard='".$gcard."',mobo='".$mobo."',monitor='".$monitor."',stock='".$stock."',sgst='".$sgst."',cgst='".$cgst."',igst='".$igst."',warranty='".$warranty."',descr='".$descr."',brand='".$brand."'  where code='".$_POST["code"]."'";
	if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
	#echo $_POST["code"];
    }
		else
			echo "Error: " . $sql . "<br>" . $conn->error;

}


?>
