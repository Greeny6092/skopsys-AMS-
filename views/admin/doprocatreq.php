<?php include('../../database.php');?>

<?php
$t=$_POST['t'];
if($t=='1')
{
$code=$_POST["code"];
$sql = "select * from productcategory where prodcatcode='".$code."'";
	//echo $sql;
	$result = $conn->query($sql);
	if($conn->query($sql)==false)
		echo $conn->error;
	else
	{
		//echo $result->fetch_assoc();
		$row = $result->fetch_assoc();
	foreach($row as $data)
	{
		echo $data."$";
	}
}

}

if($t=='2')
{
	$l=$_POST['l'];
	?>
	
	<?php
  	$sql = "select * from productcategory where prodcatcode like '%".$l."%' or prodcatname like '%".$l."%' or status like '%".$l."%' ";
  	$result = $conn->query($sql);
    echo $conn->error;
  	$i=1;
  	if ($result->num_rows > 0){
  ?>
  <table class="table table-striped table-hover table-bordered ">
    <thead class="thead-dark">
      <th>Product Category Code</th>
      <th>Product Category Name</th>
      <th>Status</th>
    </thead>
    <tbody>
      <?php while($row = $result->fetch_assoc()){ ?>
        <tr onclick="req('<?php echo $row['prodcatcode']?>');">
          <td><?php echo $row["prodcatcode"]?></td>
          <td><?php echo $row["prodcatname"]?></td>
          <td><?php echo $row["status"]?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
<?php
      }
      else{
        echo "<h1> No Records Found</h1>";
      }
?>
	
	<?php
	
}

?>
