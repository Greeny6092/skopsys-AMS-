<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "skopsys";
$port = "3306";

$conn = new mysqli($servername, $username, $password, $dbname,$port);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function changedateformat($indate)
{
	$temp=explode("-",$indate);
	return  $temp[2]."-".$temp[1]."-".$temp[0];
}
//echo "hi";
?>
