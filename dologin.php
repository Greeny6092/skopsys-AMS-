<?php
session_start(); ?>

<?php include('database.php');?>

<?php
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$n=$_POST['name'];
$p=$_POST['pass'];

$sql = "SELECT * FROM cusmaster where username='".$n."' AND password='".$p."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    //while($row = $result->fetch_assoc()) {
      //  echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";

	  $row = $result->fetch_assoc();
	  $_SESSION['dname']=$row["companyname"];
	  $_SESSION['per']=$row["permission"];
    $_SESSION['mobile']=$row["mobile"];
    $_SESSION['email']=$row["email"];
    $_SESSION['password']=$row["password"];
	  $_SESSION['code']=$row["cuscode"];
    $_SESSION['who']='cus';
	  echo '3';

} else {
    $sql = "SELECT * FROM emp_master where username='".$n."' AND password='".$p."'";
	$result = $conn->query($sql);
	if ($result->num_rows == 0)
	{
		echo '0';
	}
	else
	{
    $row = $result->fetch_assoc();
	  $_SESSION['dname']=$row["displayname"];
	  $_SESSION['per']=$row["permission"];
    $_SESSION['mobile']=$row["mobile"];
    $_SESSION['email']=$row["email"];
    $_SESSION['password']=$row["password"];
	  $_SESSION['code']=$row["empcode"];
    if($row['dept']==="service")
		  echo '2';
    else
      echo '1';
  $_SESSION['who']='emp';
	}
}
$conn->close();
?>
