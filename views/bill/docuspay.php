<?php
include '../../database.php';

if(isset($_POST['typ']))
  $typ = $_POST['typ'];
if(isset($_POST['cuscode']))
  $cuscode = $_POST['cuscode'];
if(isset($_POST['balance']))
  $balance = $_POST['balance'];
if(isset($_POST['pamount']))
  $pamount = $_POST['pamount'];
if(isset($_POST['pdate']))
  $pdate = $_POST['pdate'];

if ($typ==="1") {
  $sql ="SELECT * FROM cusmaster WHERE cuscode='".$cuscode."'";
  //echo $sql;
  $result = $conn->query($sql);
  if ($result->num_rows>0) {
    while ($row = $result->fetch_assoc()) {
      echo $row['balance']."$".$row['tds']."$";
    }
  }
  else {
    echo $conn->error;
  }
  $sql="select * from invoices where cuscode='".$cuscode."' group by billno";
  $result = $conn->query($sql);
  if ($result->num_rows>0) {
    while ($row = $result->fetch_assoc()) {
      echo "#".$row['billno'];
    }
  }
}

if ($typ==="2") {

  $sql = "SELECT * FROM invoices WHERE billno='".$_POST['iid']."' group by billno";
  $result = $conn->query($sql);
  if ($result->num_rows>0) {
    while ($row = $result->fetch_assoc()) {
      echo $row['total']."$";
      echo $row['instart'];
    }
  }
  else {
    echo $conn->error;
  }
}
if ($typ==="save") {

  $sql = "INSERT INTO pay (cuscode,iid,pamount,pdate,balance,ptype,num,paydate) VALUES ('".$cuscode."','".$_POST['iid']."','".$pamount."','".$pdate."','$balance','".$_POST['ptype']."','".$_POST['num']."','".$_POST['paydate']."')";

  if($conn->query($sql)===true){
    echo "1";
  }
  else {
    echo "error: ".$conn->error;
  }

  $sql = "select balance from cusmaster where cuscode='".$cuscode."'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();

  $bal = $row['balance']-$pamount;

  $sql = "UPDATE cusmaster SET balance='".$bal."' where cuscode='".$cuscode."'";
  if($conn->query($sql)===true){
    echo "1";
  }
  else {
    echo "error: ".$conn->error;
  }
}
if ($typ === "req") {
  $sql = "select * from pay where sno='".$_POST['sno']."'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $cuscode = $row['cuscode'];
	foreach($row as $data)
	{
	   echo $data."$";
	}

  $sql="select * from cusmaster where cuscode='".$cuscode."'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  echo $row['companyname'];
}
?>
