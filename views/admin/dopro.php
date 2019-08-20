<?php include('../../database.php');


$type=$_POST["type"];
if($type=="save")
{
	a:
	$code='PTC'.date('Y').date('m').rand(1000,9999);

	$sql = "select * from promaster where procode='".$code."'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0)
		goto a;
	$serial=$_POST['val'];
	$serial[0]=" ";
	//echo $serial;
	$serial = trim($serial," ");
	$serial=explode("$",$serial);
	foreach($serial as $ser){
	$sql = "INSERT INTO promaster (procode,prodcatname,prodesc,proconfig,sgst,cgst,igst,hsncode,saccode,status,`serial`,vtype,warranty,purrdate,vencode,recno,recdate) VALUES ('".$code."','".$_POST["prodcatname"]."','".$_POST["prodesc"]."','".$_POST["proconfig"]."','".$_POST["sgst"]."','".$_POST["cgst"]."','".$_POST["igst"]."','".$_POST["hsncode"]."','".$_POST["saccode"]."','ACTIVE','".$ser."','".$_POST["vtype"]."','".$_POST["warranty"]."','".$_POST["purrdate"]."','".$_POST['vencode']."','".$_POST["recno"]."','".$_POST["recdate"]."')";
	//echo $ser;
	//echo $sql;
	$result = $conn->query($sql);
	}

	if ($result === TRUE) {
    echo "1";
    }
	else
		echo "Error: " . $sql . "<br>" . $conn->error;

 		b:;

}

if($type=="update")
{
	$serial=$_POST['val'];
	$serial[0]=" ";
	$serial = trim($serial," ");
	//echo $serial;
	$sql="update promaster set procode='".$_POST["procode"]."', prodcatname='".$_POST["prodcatname"]."',prodesc='".$_POST["prodesc"]."',proconfig='".$_POST["proconfig"]."',sgst='".$_POST["sgst"]."',cgst='".$_POST["cgst"]."',igst='".$_POST["igst"]."',hsncode='".$_POST["hsncode"]."',saccode='".$_POST["saccode"]."',status='".$_POST["status"]."',vtype='".$_POST["vtype"]."',warranty='".$_POST["warranty"]."',purrdate='".$_POST["purrdate"]."',vencode='".$_POST['vencode']."',recno='".$_POST["recno"]."',recdate='".$_POST["recdate"]."' where serial='".$serial."'";
	//echo $sql;
	if ($conn->query($sql) === TRUE) {
    echo "2";
	#echo $_POST["code"];
    }
	else{
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}

if($type=="1"){
	$prodcat=$_POST['prodcat'];
	$sql="select * from promaster where prodcatname='".$prodcat."'";
	//echo $sql;
	$result=$conn->query($sql);
	echo $result->num_rows;
	echo $conn->error;
}

?>
