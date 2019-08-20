<?php include('../../database.php');?>

<?php
$type=$_POST["typ"];

if($type=="save")
{
	a:
	$code='PER'.date('Y').date('m').rand(1000,9999);

	$sql = "select * from peripheral where code='".$code."'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0)
		goto a;

	$sql = "INSERT INTO peripheral (code,descr,sgst,type,spec,cgst,warranty,brand,stock,igst) VALUES ('".$code."','".$_POST["descr"]."','".$_POST["sgst"]."','".$_POST["type"]."','".$_POST["spec"]."','".$_POST["cgst"]."','".$_POST["warranty"]."','".$_POST["brand"]."','".$_POST["stock"]."','".$_POST["igst"]."')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    }
	else
		echo "Error: " . $sql . "<br>" . $conn->error;

 		b:;
}
else
{
      
	$sql="update promaster set code='".$_POST["code"]."',descr='".$_POST["descr"]."',sgst='".$_POST["sgst"]."',type='".$_POST["type"]."',spec='".$_POST["spec"]."',cgst='".$_POST["cgst"]."',warranty='".$_POST["warranty"]."',brand='".$_POST["brand"]."',stock='".$_POST["stock"]."',igst='".$_POST["igst"]."' where code='".$_POST["code"]."'";
	if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
	#echo $_POST["code"];
    }
	else{
		echo $conn->error;
	}
}


?>
