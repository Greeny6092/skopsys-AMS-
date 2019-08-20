<?php
include '../../database.php';

if(isset($_POST['typ']))
  $typ = $_POST['typ'];
if(isset($_POST['iid']))
  $iid = $_POST['iid'];
if(isset($_POST['cost']))
  $cost = $_POST['cost'];
if(isset($_POST['date1']))
  $date1 = $_POST['date1'];
if(isset($_POST['date2']))
  $date2 = $_POST['date2'];
if(isset($_POST['dcno']))
  $dcno = $_POST['dcno'];

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

  $sql = "SELECT * FROM trans WHERE cuscode='".$cuscode."'";
  $result = $conn->query($sql);
  $i=0;
  $dcno =array();
  if ($result->num_rows>0) {
    while ($row = $result->fetch_assoc()) {
      array_push($dcno,$row['dcno']);
      //echo $dcno[i]."$";
      $i++;
    }
  }
  else {
    echo $conn->error;
  }
  //print_r($dcno);

  foreach($dcno as $dc) {
    //echo $dc;
    $sql = "SELECT * FROM invoice where dcno='".$dc."'";
    $result = $conn->query($sql);
    if ($result->num_rows>0) {
      while ($row = $result->fetch_assoc()) {
        echo "#".$row['iid'];
      }
    }
    else {
      echo $conn->error;
    }
  }
}
if ($typ==="2") {
  $sql = "SELECT * FROM invoice WHERE iid='".$iid."'";
  $result = $conn->query($sql);
  if ($result->num_rows>0) {
    while ($row = $result->fetch_assoc()) {
      echo $row['cost']."$".$row['bdate'];
    }
  }
  else {
    echo $conn->error;
  }
}

if ($typ=="print") {
  $sql = "UPDATE invoice SET cost='".$cost."',lbdate='".$date1."',bdate='".$date2."' ,flag='1' where iid='".$iid."'";
  if($conn->query($sql)===true){
    echo "1";
  }
  else {
    echo "error: ".$conn->error;
  }
}

if ($typ=="prints") {
  $sql = "UPDATE invoice SET cost='".$cost."',lbdate='".$date1."',bdate='".$date2."' ,flag2='1' where iid='".$iid."'";
  if($conn->query($sql)===true){
    echo "1";
  }
  else {
    echo "error: ".$conn->error;
  }
}

if ($typ==="pa") {
  $sql="select * trans where cuscode='".$."'";
}
?>
