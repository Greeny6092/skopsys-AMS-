<?php include('../../database.php');?>

<?php
$type=$_POST["type"];

if($type=="save")
{ $date='0000-00-00';
	a:
	$code='CUS'.date('Y').date('m').rand(1000,9999);
	
	$sql = "select * from cusmaster where cuscode='".$code."'";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0)
		goto a;
	$sql = "select * from cusmaster where username='".$_POST["username"]."'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0)
	{
		echo "Username already exist!!";
		goto b;
	}
	if($_POST['status']=="som")
	{
		if(date('d')==1)
			$date=date('Y')."/".date('m')."/"."1";	
		else
			$date=date('Y')."/".((date('m')+1)%12)."/"."1";	
	}
	else
	if($_POST['status']=="eom")
	{
		if(date('t')==date('d'))
		{
			$temp=date(date('Y').'/'.((date('m')+1)%12).'/'.date('2'));
			$date = date('Y-m-t',strtotime($temp));
		}		
		else
		{
			$date=date('Y')."/".((date('m')+1)%12)."/".date('t');	
		}
	}	
	else
	if($_POST['status']!=""&&$_POST['status']!="nl")
	{
		$date=date('Y')."/".date('m')."/".$_POST['status'];
	}	
	$sql = "INSERT INTO cusmaster (cuscode,companyname,gstno,daddress,baddress,city,state,pincode,mobile,phone,email,statecode,tds,paytype,status,username,password,permission,indate) VALUES ('".$code."','".$_POST["companyname"]."','".$_POST["gstno"]."','".$_POST["daddress"]."','".$_POST["baddress"]."','".$_POST["city"]."','".$_POST["state"]."','".$_POST["pincode"]."','".$_POST["mobile"]."','".$_POST["phone"]."','".$_POST["email"]."','".$_POST["statecode"]."','".$_POST["tds"]."','".$_POST["paytype"]."','".$_POST["status"]."','".$_POST["username"]."','".$_POST["password"]."','00000000000000000000000000000000','".$date."')";

if ($conn->query($sql) === TRUE) {
    echo "1";
    }
	else
		echo "Error: " . $sql . "<br>" . $conn->error;

 b:;


}
else
{

if($_POST['status']=="som")
	{
		if(date('d')==1)
			$date=date('Y')."/".date('m')."/"."1";	
		else
			$date=date('Y')."/".((date('m')+1)%12)."/"."1";	
	}
	else
	if($_POST['status']=="eom")
	{
	//	if(date('t')==date('d'))
		{
			$temp=date('Y').'/'.((date('m')+1)%12).'/'.date('2');
			$date = date('Y-m-t',strtotime($temp));
		}		
	//	else
		{
		//	$date=date('Y')."/".date('m')."/".date('t');	
		}
	}	
	else
	if($_POST['status']!=""&&$_POST['status']!="nl")
	{
		$date=date('Y')."/".date('m')."/".$_POST['status'];
	}	
	$sql="update cusmaster set companyname='".$_POST["companyname"]."',gstno='".$_POST["gstno"]."',daddress='".$_POST["daddress"]."',baddress='".$_POST["baddress"]."',city='".$_POST["city"]."',state='".$_POST["state"]."',pincode='".$_POST["pincode"]."',mobile='".$_POST["mobile"]."',phone='".$_POST["phone"]."',email='".$_POST["email"]."',statecode='".$_POST["statecode"]."',tds='".$_POST["tds"]."',paytype='".$_POST["paytype"]."',status='".$_POST["status"]."',username='".$_POST["username"]."',password='".$_POST["password"]."',indate='".$date."' where cuscode='".$_POST["cuscode"]."'";
	if ($conn->query($sql) === TRUE) {
    echo "2";
    }
}

		
?>
