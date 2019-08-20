<?php include('../../database.php');?>

<?php
$type=$_POST["type"];

if($type=="save")
{
	a:
	$code='EMP'.date('Y').date('m').rand(1000,9999);

	$sql = "select * from emp_master where empcode='".$code."'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0)
		goto a;
	
	//$sql = "select * from emp_master where username='".$_POST["username"]."'";
	//$result = $conn->query($sql);
	/*
	$year=date('Y').date('Y')+1;
	$month=date('m');
	if($month<4)
		{
			$year=(date('Y')-1).date('Y');
		}
	$code="EMP".date('Y').$month;
    
		$sql ="select * from dccount where year='".$year."'";
		$result = $conn->query($sql);

		if ($result->num_rows == 0){
			$sql = "INSERT INTO dccount(`year`) values('".$year."')";
			$result=$conn->query($sql);
		}
			$sql ="select * from dccount where year='".$year."'";
			$result = $conn->query($sql);
			$row=$result->fetch_assoc();
			$count=$row['empcount'];
			$count++;
			$conn->query("update dccount set empcount=".$count." where year='".$year."'");
			$code.=$count;
			//echo $code;

*/
	$sql = "INSERT INTO emp_master (empcode,firstname,lastname,dept,email,mobile,username,password,status,displayname,permission) VALUES ('".$code."','".$_POST["firstname"]."','".$_POST["lastname"]."','".$_POST["dept"]."','".$_POST["email"]."','".$_POST["mobile"]."','".$_POST["username"]."','".$_POST["password"]."','".$_POST["status"]."','".$_POST["displayname"]."','11111111111111111111111111111111')";

if ($conn->query($sql) === TRUE) {
    echo "1";
    }
	else
		echo "Error: " . $sql . "<br>" . $conn->error;

 b:;


}
else
{

	$sql="update emp_master set firstname='".$_POST["firstname"]."',lastname='".$_POST["lastname"]."',dept='".$_POST["dept"]."',email='".$_POST["email"]."',mobile='".$_POST["mobile"]."',username='".$_POST["username"]."',password='".$_POST["password"]."',status='".$_POST["status"]."',displayname='".$_POST["displayname"]."' where empcode='".$_POST["empcode"]."'";
	if ($conn->query($sql) === TRUE) {
    echo "2";
	#echo $_POST["code"];
    }
}


?>
