<div id="up"></div>
<?php
include '../includes/head.php';
include '../../database.php';
?>
<style media="screen">
  td:hover{
    cursor: pointer;
  }
</style>


<div class="container">
  <p style="color: royalblue;">Enter Order Items</p><hr>
  <div class="row">
    <div class="col-lg-4 col-sm-12 col-md-12">
      <div class="form-group">
        <label for="tcode">Transaction Code<sup>*</sup>:</label>
        <input type="text" name="tcode" class="form-control" value="" readonly>
      </div>
    </div>

    <div class="col-lg-4 col-sm-12 col-md-12">
      <div class="form-group">
        <label for="customercode">Customer Name<sup>*</sup>:</label>
		<div name="cmpyname">
			<input type="text" class="form-control" name="companyname" oninput="codeq();" list="code">
		</div>
          <datalist id="code" name="code">
            <option></option>
            <option>Customer</option>
            <?php
              $sql = "select * from cusmaster";
              $result = $conn->query($sql);
              while($row = $result->fetch_assoc()){
            ?>
              <option><?php echo $row["companyname"]; ?>(<?php echo $row["cuscode"]; ?>)</option>
            <?php } ?>
            <option>----</option>
            <option>Vendor</option>
            <?php
              $sql = "select * from venmaster";
             $result = $conn->query($sql);
              while($row = $result->fetch_assoc()){
            ?>
              <option><?php echo $row["vendorname"]; ?>(<?php echo $row["vencode"]; ?>)</option>
            <?php } ?><-->
          </datalist>
      </div>
    </div>

    <div class="col-lg-4 col-sm-12 col-md-12">
      <div class="form-group">
        <label for="customercode">Customer Code<sup>*</sup>:</label>
        <input type="text" name="cuscode" value="" class="form-control" readonly>
      </div>
    </div>

  </div>

  <div class="row">
    <div class="col-lg-4 col-sm-12 col-md-12">
      <div class="form-group">
        <label>No of Items:</label>
        <input type="number" name="noi" value="" class="form-control" oninput="createbox();serq();">
      </div>
    </div>
    <div class="col-lg-4 col-sm-12 col-md-12">
      <div class="form-group">
        <label for="odate">Order Date<sup>*</sup>:</label>
        <input type="date" name="odate" class="form-control" value="<?php echo date('Y')."-".date('m')."-".date('d'); ?>">
      </div>
    </div>
    <div class="col-lg-4 col-sm-12 col-md-12">
      <div class="form-group">
        <label for="remarks">Remarks:</label>
        <textarea name="remarks" rows="2" class="form-control"></textarea>
      </div>
    </div>
  </div>

  <div class="" name="box">

  </div>
  <hr>
  <div class="row">
    <div class="col-lg-8 col-sm-12 col-md-12"></div>
    <div class="col-lg-4 col-sm-12 col-md-12">
     <input type="button" name="button" value="save" class="btn btn-success" onclick="query();">
     <input type="button" class="btn btn-info" value="reset" onclick="location.reload();">
    </div>
  </div>
</div>
<div class="container">
  <p style="color: royalblue;">Customer Order Details</p>
  <hr>

  <!--div class="row">
    <div class="col-lg-2 col-sm-12 col-md-12">copy,csv,print</div>
    <div class="col-lg-10 col-sm-12 col-md-12"></div>
  </div-->

  <div class="row">
    <div class="col-lg-9 col-sm-12 col-md-12"></div>
    <div class="col-lg-3 col-sm-12 col-md-12">
      <div class="form-group">
        <label>Search:</label>
        <input type="text" name="search" oninput="update()"class="form-control">
      </div>
    </div>
  </div>
  <div class="contain" name="tbl" >


<?php
  $sql = "select distinct tcode,a.cuscode,b.companyname,odate,remarks from enterorder as a,cusmaster as b where a.cuscode=b.cuscode";
	$result = $conn->query($sql);
	$i=1;
	if ($result->num_rows > 0){ ?>
  <table class="table table-striped table-hover table-bordered ">
    <thead class="thead-dark">
      <th>Transaction code</th>
      <th>Name</th>
      <th>Code</th>
      <th>Order Date</th>
      <th>Remarks</th>
    </thead>
    <tbody>
	<?php
	while($row = $result->fetch_assoc()){
	 echo "<tr onclick=\"req('".$row['tcode']."','".$row['cuscode']."','1');to();\"><td>".$row["tcode"]."</td><td>".$row["companyname"]."</td><td>".$row["cuscode"]."</td><td>".$row["odate"]."</td><td>".$row["remarks"]."</td></tr>";
	}
  $sql = "select distinct tcode,a.cuscode,b.vendorname,odate,remarks from enterorder as a,venmaster as b where a.cuscode=b.vencode";
  $result = $conn->query($sql);
  $i=1;
  if ($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
  	 echo "<tr onclick=\"req('".$row['tcode']."','".$row['cuscode']."','2');to();\"><td>".$row["tcode"]."</td><td>".$row["vendorname"]."</td><td>".$row["cuscode"]."</td><td>".$row["odate"]."</td><td>".$row["remarks"]."</td></tr>";
  	}
  }
    ?>
	</tbody>
  </table>
	<?php }
	else{
		echo "<h1> No Records Found</h1>";
	}
	?>
  </div>
</div>

<script>

function to() {
  location.href="#up";
}

function update()
{  z='2';
	v=document.getElementsByName("search")[0].value;
	//alert(v);

	var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementsByName("tbl")[0].innerHTML = this.responseText;
    }
  };
  xhttp.open("POST", "doorderreq.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("l="+v+"&t="+z);

}

function codeq()
{
	v=document.getElementsByName('companyname')[0].value;
  v=v.split("(");
  //alert(v);
  cusname = v[0];
  cuscode = v[1].split(")");
  document.getElementsByName('companyname')[0].value=cusname;
  document.getElementsByName('cuscode')[0].value=cuscode[0];
  /*t='1';
var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      let v=this.responseText;
	  console.log(v);
	  v=v.split('$');
	  document.getElementsByName('cuscode')[0].value=v[0];
    }
  };
  xhttp.open("POST", "eotypeq.php", false);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  console.log("v="+v+"&t="+t);
  xhttp.send("v="+v+"&t="+t);*/

}
function createbox()
{
  i=0;
	v=document.getElementsByName("noi")[0].value;
	box=document.getElementsByName("box")[0];
	box.innerHTML="";
	for(i=0;i<v;i++)
		box.innerHTML+="<div class='row' id='row"+i+"'><div class='col-lg-4 col-sm-12 col-md-12'><div name='serials' class='form-group'><label>Serial "+(i+1)+"<sup>*</sup>:</label><input type='text' class='form-control' name='serial"+i+"' onchange=\"descq('"+i+"');\"></div></div><div class='col-lg-4 col-sm-12 col-md-12'><div class='form-group'><label>Description "+(i+1)+":</label><textarea name='descr"+i+"' rows='2' class='form-control' readonly></textarea></div></div><div class='col-lg-4 col-sm-12 col-md-12'><br><center><button class='btn btn-danger' onclick=\"del('"+i+"')\"><span class='fas fa-trash'></span></button></center></div></div><br>";
	//box=document.getElementsByName("box")[0];
	//console.log(box.childElementCount);
}

function del(i) {
  //confirm("Do you want to delete this entry");
  //console.log('check'+i);
  v = document.getElementsByName('serial'+i)[0].value;
  confirm("Do you want to delete entry "+v);
  s = document.getElementsByName('noi')[0].value;
  t='6';
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      let v=this.responseText;
  	  //lert(v);
  	  if(v==1){
        document.getElementById('row'+i).style.display = 'none';
        document.getElementsByName('noi')[0].value = s-1;
        createbox();
        serq();
      }
    }
  };
  xhttp.open("POST", "eotypeq.php", false);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  //console.log("v="+v+"&t="+t);
  xhttp.send("v="+v+"&t="+t);

}
function descq(i)
{	
	//alert(i);
  var ranflag=0,sindex=i;
  var serials=document.getElementsByName('serials'),k=0,j=0;
  //alert("child count is "+serials[0].childElementCount+"\nserials.length is "+serials.length);
  for(k=0;k<serials.length;k++)
  {
	  if(serials[k].childNodes[1].style.backgroundColor=="tomato")
	  {
		  serials[k].childNodes[1].style.borderColor="transparent";
		  serials[k].childNodes[1].style.backgroundColor="white";
		  descq(k);
	  }
  }
  for(k=0;k<serials.length-1;k++)
  {
	  if(serials[k].childNodes[1].value.length>0)
	  {
		  for(j=k+1;j<serials.length;j++)
		  {
			  //i!=j
				if(serials[j].childNodes[1].value==serials[k].childNodes[1].value)
				{
					console.log("already exist!!! j is "+j);
					//document.getElementsByName("mbutton")[0].dataShow=true;
					serials[k].childNodes[1].style.borderColor="tomato";
					serials[k].childNodes[1].style.backgroundColor="tomato";
					serials[j].childNodes[1].style.borderColor="tomato";
					serials[j].childNodes[1].style.backgroundColor="tomato";
				}
		  }
	  }
  }
  //alert(document.getElementsByName("serials")[i].childNodes[1].value);
  var splitval=document.getElementsByName("serials")[i].childNodes[1].value.split("-");
  var val=document.getElementsByName("serials")[i].childNodes[1].value;
  document.getElementsByName("serials")[i].childNodes[1].value=splitval[0];
  var prefix="";
  if(splitval!=val)
  {
	  let start="",end,i;
	  end=splitval[1];
	  /*for(i=0;i<splitval[0].length;i++)
	  {	let temp=parseInt(splitval[0][i]);
		//alert("temp "+temp);
		  if(temp>=0&&temp<=9&&temp!=NaN)
		  {
			  //alert("Entered");
			  start+=splitval[0][i];
		  }
		  else
		  {
			  prefix+=splitval[0][i];
		  }
	  }*/
	  prefix=splitval[0].substring(0,splitval[0].length-splitval[1].length);
	  start=parseInt(splitval[0].substring(splitval[0].length-splitval[1].length,splitval[0].length));
	  console.log("start "+start+"\n end "+end+"\n prefix "+prefix);	  
	  console.log("start "+parseInt(start)+"\n end "+parseInt(end)+"\n prefix "+prefix+"\nsindex "+sindex+"\n end index "+(parseInt(sindex)+parseInt(end)));
	  start=parseInt(start);
	  let s=start;
	  var x="";
	  start+=1;
	  descq(parseInt(sindex));
	  for(i=parseInt(sindex)+1;i<=(parseInt(sindex)+parseInt(end)-s);i++)
		{
			//alert("i"+i);
			//if(start>99)
				x="0000000000"+start++;
				x=x.substr(x.length-splitval[1].length);
				document.getElementsByName('serials')[i].childNodes[1].value=prefix+x;
			/*else if(start>9)
				document.getElementsByName('serials')[i].childNodes[1].value=prefix+"0"+start++;
			else
				document.getElementsByName('serials')[i].childNodes[1].value=prefix+"00"+start++;*/
			descq(i);
		}
  }
  else
  {
  t='2';
  v=document.getElementsByName('serial'+i)[0].value;
  //console.log(v);
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      let v1=this.responseText;
	  if(v1=="RENTAL")
	  {
		  serials[i].childNodes[1].style.borderColor="#0eb9f7";
		  serials[i].childNodes[1].style.backgroundColor="#0eb9f7";  
		  toastr.info(v+" is under "+v1);
		  document.getElementsByName('descr'+i)[0].value="";
	  }
	  else if(v1=="SERVICE")
	  {
		  serials[i].childNodes[1].style.borderColor="#f9dc00";
		  serials[i].childNodes[1].style.backgroundColor="#f9dc00";  			 
		  toastr.warning(v+" is under "+v1);
		  document.getElementsByName('descr'+i)[0].value="";
	  }
	  else if(v1=="SCRAP")
	  {
		  serials[i].childNodes[1].style.borderColor="#f9dc00";
		  serials[i].childNodes[1].style.backgroundColor="#f9dc00";  		  
		  toastr.warning(v+" is under "+v1);
		  document.getElementsByName('descr'+i)[0].value="";
	  }
	  else if(v1=="-1")
	  {
		  serials[i].childNodes[1].style.borderColor="#e81212";
		  serials[i].childNodes[1].style.backgroundColor="#e81212";  		 
		  toastr.error(v+" does not exist");
		  document.getElementsByName('descr'+i)[0].value="";
	  }
	  else if(v1=="RETURNING")
	  {
		  serials[i].childNodes[1].style.borderColor="#40ce14";
		  serials[i].childNodes[1].style.backgroundColor="#40ce14";  		  
		  toastr.success(v+" is under "+v1);
		  document.getElementsByName('descr'+i)[0].value="";
	  }
	  else
	  {		  console.log(v);
  	  v1=v1.split('$');
  	  document.getElementsByName('descr'+i)[0].value=v1[0];
	  serials[i].childNodes[1].style.borderColor="transparent";
	  serials[i].childNodes[1].style.backgroundColor="white";
	  }
    }
  };
  xhttp.open("POST", "eotypeq.php", false);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  //console.log("v="+v+"&t="+t);
  xhttp.send("v="+v+"&t="+t);
  }
}

function cosq(i)
{

  t='5';
  v=document.getElementsByName('serial'+i)[0].value;
  //console.log(v);
var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      let v=this.responseText;
  	  //console.log(v);
  	  v=v.split('$');
  	  document.getElementsByName('costpm'+i)[0].value=v[0];
    }
  };
  xhttp.open("POST", "eotypeq.php", false);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  //console.log("v="+v+"&t="+t);
  xhttp.send("v="+v+"&t="+t);

}

function serq(i)
{

  t='4';
  v=document.getElementsByName('tcode')[0].value;
  if(v!='')
    {
  //console.log(v);
var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      let v=this.responseText;
  	  //console.log(v);
  	  v=v.split('$');
      v = v.filter(function (el) {
        return el != "";
      });
      //console.log(v);
      for (i = 0; i < v.length; i++) {
        document.getElementsByName('serial'+i)[0].value=v[i];
        descq(i);
        //cosq(i);
      }

    }
  };
  xhttp.open("POST", "eotypeq.php", false);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  //console.log("v="+v+"&t="+t);
  xhttp.send("v="+v+"&t="+t);
 }
}

function noiq()
{

  t='3';
  v=document.getElementsByName('tcode')[0].value;
  //console.log(v);
var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      let v=this.responseText;
  	  //console.log(v);
  	  //v=v.split('$');
  	  document.getElementsByName('noi')[0].value=v;
    }
  };
  xhttp.open("POST", "eotypeq.php", false);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  //console.log("v="+v+"&t="+t);
  xhttp.send("v="+v+"&t="+t);

}


function query()
{
//alert("check");

tcode=document.getElementsByName("tcode")[0].value;
cuscode=document.getElementsByName("cuscode")[0].value;
odate=document.getElementsByName("odate")[0].value;
remarks=document.getElementsByName("remarks")[0].value;
noi=document.getElementsByName("noi")[0].value;
serial="";
descr="";
//costpm="";
n=document.getElementsByName("noi")[0].value;
for(i=0;i<n;i++)
{
  serial+="$"+document.getElementsByName("serial"+i)[0].value;
  descr+="$"+document.getElementsByName("descr"+i)[0].value;
  //costpm+="$"+document.getElementsByName("costpm"+i)[0].value;
}
typ=document.getElementsByName("button")[0].value;

//alert(tcode+ptype+vtype+costpm+cuscode+pcode+odate+noi+remarks+vencode+recno);

var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      v = this.responseText;
      if(v==1)
        sessionStorage.setItem("success","Successfully saved Data");
      else if(v==2)
        sessionStorage.setItem("success","Successfully updated Data");
      else {
        alert(v);
      }
	    location.reload();
    }
  };
  xhttp.open("POST", "doorder.php", false);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  //alert("tcode="+tcode+"&cuscode="+cuscode+"&odate="+odate+"&remarks="+remarks+"&serial="+serial+"&descr="+descr+"&costpm="+costpm+"&typ="+typ+"&noi="+noi);
  xhttp.send("tcode="+tcode+"&cuscode="+cuscode+"&odate="+odate+"&remarks="+remarks+"&serial="+serial+"&descr="+descr+"&typ="+typ+"&noi="+noi);

}

function req(n,code,se)
{ z='1';
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      let v=this.responseText;
	 // alert(v);
    console.log(v);
      v=v.split("$");
      //alert(v);
      let i=1;
      document.getElementsByName("tcode")[0].value=v[0];
      document.getElementsByName("cuscode")[0].value=v[1];
	  document.getElementsByName("companyname")[0].removeAttribute('list');
	    document.getElementsByName("companyname")[0].value=v[4];

      document.getElementsByName("companyname")[0].setAttribute("readonly","true");
      //codeq();
      document.getElementsByName("odate")[0].value=v[2];
      document.getElementsByName("remarks")[0].value=v[3];

      //console.log("done");
      noiq();
      createbox();
      serq();
      document.getElementsByName("button")[0].value="update";
    }
  };
  xhttp.open("POST", "doorderreq.php", false);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  //console.log("\ntcode="+n);
  xhttp.send("v="+n+"&t="+z+"&code="+code+"&se="+se);
}

</script>

<?php
include '../includes/foot.php';
?>
