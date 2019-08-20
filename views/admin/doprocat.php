<?php include('../../database.php');

$type= $_POST["type"];
$status = $_POST["status"];
$prodcatname = $_POST["prodcatname"];

if($type=="save")
{
	$nam = $_POST["prodcatname"];
	$nam = strtoupper($nam);
	$name = $nam[0];
	$l=strlen($nam);
	$nam = explode(" ",$nam);

	if(count($nam)!=1)
	{$nam=$nam[1];
		$name = $name.$nam[0];
	}
	else
	{
		$name = $name.$nam[0][$l-1];


	}

		a:
		$code=$name.date('Y').date('m').rand(1000,9999);

		$sql = "select * from venmaster where vencode='".$code."'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0)
			goto a;

	$sql = "INSERT INTO productcategory(prodcatcode,prodcatname,status) VALUES ('".$code."','".$prodcatname."','".$status."')";

	if ($conn->query($sql) === TRUE) {
    echo "1";
    }
	else{
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
 		b:;
}
else
{

	$sql="update productcategory set prodcatcode='".$_POST["prodcatcode"]."',prodcatname='".$_POST["prodcatname"]."',status='".$_POST["status"]."' where prodcatcode='".$_POST["prodcatcode"]."'";
	if ($conn->query($sql) === TRUE) {
    echo "2";
	#echo $_POST["code"];
    }
		else
			echo "Error: " . $sql . "<br>" . $conn->error;

}


?>
