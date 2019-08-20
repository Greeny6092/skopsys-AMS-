<?php include('../../database.php');?>

<?php
$type=$_POST["type"];

if($type=="save")
{
	$nam = $_POST["vendorname"];
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

	#$sql = "select * from emp_master where username='".$_POST["username"]."'";
	#$result = $conn->query($sql);

	#if ($result->num_rows > 0)
	#{ echo "Username already exist!!";
	#	goto b;
	#}

	$sql = "INSERT INTO venmaster (vencode,vendorname,address1,address2,city,state,pincode,phone,mobile,gstno,email,status) VALUES ('".$code."','".$_POST["vendorname"]."','".$_POST["address1"]."','".$_POST["address2"]."','".$_POST["city"]."','".$_POST["state"]."','".$_POST["pincode"]."','".$_POST["phone"]."','".$_POST["mobile"]."','".$_POST["gstno"]."','".$_POST["email"]."','".$_POST["status"]."')";
	//echo $sql;
if ($conn->query($sql) === TRUE) {
    echo "1";
    }
	else
		echo "Error: " . $sql . "<br>" . $conn->error;

# b:


}
else
{

	$sql="update venmaster set vendorname='".$_POST["vendorname"]."',address1='".$_POST["address1"]."',address2='".$_POST["address2"]."',city='".$_POST["city"]."',state='".$_POST["state"]."',pincode='".$_POST["pincode"]."',phone='".$_POST["phone"]."',mobile='".$_POST["mobile"]."',gstno='".$_POST["gstno"]."',email='".$_POST["email"]."',status='".$_POST["status"]."' where vencode='".$_POST["vencode"]."'";
	if ($conn->query($sql) === TRUE) {
    echo "2";
    }
	else echo $conn->error;
}


?>
