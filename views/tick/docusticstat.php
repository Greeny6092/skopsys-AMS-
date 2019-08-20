<?php

include '../../database.php';


$sql = "UPDATE ticket SET flag='0' WHERE slno=".$_POST['slno'];

if ($conn->query($sql) === TRUE) {
    echo "1";
} else {
    echo "0";
}




?>

