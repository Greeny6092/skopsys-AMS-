<?php
//echo date(date('Y').'/'.date('2').'/'.date('t'));
//$dateToTest = "2019/06/15";
//$lastday = date('t-m-Y',strtotime($dateToTest));
//echo $lastday;
//$s= (date('12')+1)%12;
//$date=date('Y')."/".$s."/".date('d');
$temp=date('Y').'/'.((date('m')+1)%12).'/'.date('t');
			$date = date('Y-m-t',strtotime($temp));


echo $temp.'<br>';
echo $date;
?>