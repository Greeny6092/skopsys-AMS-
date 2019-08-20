<?php
include '../includes/head.php';
include '../../database.php';
?>
<div class="container">
<p style="color: royalblue;">Enter Replacement Details</p><hr>

  <div class="row">
    <div class="col-lg-4 col-sm-12 col-md-12">
      <div class="form-group">
        <label for="customercode">Customer Name<sup>*</sup>:</label>
        <input class="form-control" name="companyname" oninput="pq();" list="cuscode">
          <datalist id="cuscode">
            <option></option>
            <?php
              $sql = "select * from cusmaster";
              $result = $conn->query($sql);
              while($row = $result->fetch_assoc()){
            ?>
              <option><?php echo $row["companyname"] ?>(<?php echo $row["cuscode"] ?>)</option>
            <?php } ?>
          </datalist>
          <input type="text" name="cuscode" hidden>
      </div>
    </div>
    <div class="col-lg-4 col-sm-12 col-md-12">
      <div class="form-group" style="display:none">
        <label>Transaction Code<sup>*</sup>:</label>
        <input type="text" name="tcode" class="form-control" list="tcode" oninput="serq();">
        <datalist id="tcode">

        </datalist>
      </div>
      <div class="form-group">
        <label>Replacement In:<sup>*</sup>:</label>
        <input type="text" name="serialin" class="form-control" list="serin" onchange="seroq();">
        <datalist id="serin">

        </datalist>
      </div>
    </div>
    <div class="col-lg-4 col-sm-12 col-md-12">
      <div class="form-group">
        <label>Replacement Out:<sup>*</sup>:</label>
        <input type="text" name="serialout" class="form-control" list="serout" onchange="check(2)">
        <datalist id="serout">
          <?php  ?>
          <option value="<?php ?>"></option>
        </datalist>
      </div>
    </div>
  </div>

  <hr>
  <div class="row">
    <div class="col-lg-8 col-sm-12 col-md-12"></div>
    <div class="col-lg-4 col-sm-12 col-md-12">
      <input type="button" name="button" value="save" onclick="query();" class="btn btn-success" disabled style="cursor:not-allowed">
      <input type="reset" name="reset" value="reset" onclick="location.reload();" class="btn btn-info">
    </div>
  </div>

</div>
<hr>
<div class="container">
  <p style="color: royalblue;">Product Replacement Details</p>
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
        <input type="text" name="search" oninput="update()" class="form-control">
      </div>
    </div>
  </div>
  <div class="contain" name="tbl">
<?php
	 $sql = "select * from rep,cusmaster where flag='0' and rep.cuscode=cusmaster.cuscode";
	$result = $conn->query($sql);
	$i=1;
	if ($result->num_rows > 0){ ?>
  <table class="table table-striped table-hover table-bordered ">
    <thead class="thead-dark">
      <th>Customer</th>
      <th>Replacement In</th>
      <th>Replacement Out</th>
      <th>Delivery</th>
    </thead>
    <tbody>
	<?php
	while($row = $result->fetch_assoc()){
	 echo "<tr onclick=\"to();\"><td>".$row["companyname"]."</td><td>".$row["serialin"]."</td><td>".$row["serialout"]."</td><td><button class='btn btn-success' onclick=\"pass('".$row['serialout']."','".$row['slno']."','".$row['cuscode']."')\">Delivered</button></td></tr>";
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
function pq()
{
  v=document.getElementsByName('companyname')[0].value;
  v=v.split("(");
  //alert(v);
  cusname = v[0];
  cuscode = v[1].split(")");
  document.getElementsByName('companyname')[0].value=cusname;
  document.getElementsByName('cuscode')[0].value=cuscode[0];
  //transq();
  serq();
}
function pass(ser,slno,cuscode) {
  t = "pass";
  var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
      		v = this.responseText;
          if(v[v.length -1]=="1"){
            sessionStorage.setItem("success","Product added to customer sucessfully");
            location.reload();
          }
          else{
            alert(v);
          }
      }
  };
  xhttp.open("POST", "dorep.php", false);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  //alert("typ="+t+"&serialout="+ser+"&slno="+slno+"&cuscode="+cuscode);
  xhttp.send("typ="+t+"&serialout="+ser+"&slno="+slno+"&cuscode="+cuscode+"&avoiderror='1'");
}
function transq()
{
 cuscode=document.getElementsByName('cuscode')[0].value;
 let t = "1";

 var dl = document.getElementById("tcode");
 while(dl.firstChild)
	 dl.removeChild(dl.firstChild);

  var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
      		let b = this.responseText,i;
      		console.log("response text " + b);
      		b=b.split("$");
      		for(i=0;i<b.length;i++)
      			//console.log(i+" :"+b[i]);
      		var option=document.createElement("OPTION");
      		dl.appendChild(option);

      		b = b.filter(function (el) {
      		  return el != "";
      		});

      		dl = document.getElementById("tcode");
      		console.log("tcode is "+b);
      		//console.log("In cuscode is "+select);
      		for(i=0;i<b.length;i++)
      		{
      			option=document.createElement("OPTION");
      			option.innerHTML=b[i];
      			option.setAttribute("value",b[i]);

      			if(b[i].localeCompare(tcode)==0)
      			{
      				option.setAttribute("selected",true);
      			}
      			dl.appendChild(option);
  		    }
  		//console.log("In tcode childs "+select.childElementCount);
      }
  };
  xhttp.open("POST", "dorep.php", false);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("typ="+t+"&cuscode="+cuscode);

}
function serq() {
  v=document.getElementsByName('cuscode')[0].value;
  typ='set'
  var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        v=this.responseText;
        //alert(v);
        //document.getElementsByName('serial')[0].value=v;
        v=v.split("$");
        v = v.filter(function (el) {
    		  return el != "";
    		});
        //console.log(v.length);
        dl = document.getElementById("serin");
        console.log("serial is "+v);
        //console.log("In cuscode is "+select);
        for(i=0;i<v.length;i++)
        {
          option=document.createElement("OPTION");
          option.innerHTML=v[i];
          option.setAttribute("value",v[i]);

          if(v[i].localeCompare(tcode)==0)
          {
            option.setAttribute("selected",true);
          }
          dl.appendChild(option);
        }
      }
    };
    xhttp.open("POST", "dorep.php", false);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("cuscode="+v+"&typ="+typ);
}
function seroq() {
  v=document.getElementsByName('serialin')[0].value;
  typ='setout'
  var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        v=this.responseText;
        //alert(v);
        //document.getElementsByName('serial')[0].value=v;
        v=v.split("$");
        v = v.filter(function (el) {
    		  return el != "";
    		});
        //console.log(v.length);
        dl = document.getElementById("serout");
        console.log("serial is "+v);
        //console.log("In cuscode is "+select);
        for(i=0;i<v.length;i++)
        {
          option=document.createElement("OPTION");
          option.innerHTML=v[i];
          option.setAttribute("value",v[i]);

          if(v[i].localeCompare(tcode)==0)
          {
            option.setAttribute("selected",true);
          }
          dl.appendChild(option);
        }
      }
    };
    xhttp.open("POST", "dorep.php", false);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("serial="+v+"&typ="+typ);
	check(1);
}
function query() {
  cuscode = document.getElementsByName('cuscode')[0].value;
  tcode = document.getElementsByName('tcode')[0].value;
  serialin = document.getElementsByName('serialin')[0].value;
  serialout = document.getElementsByName('serialout')[0].value;
  typ = document.getElementsByName('button')[0].value;
  var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        v=this.responseText;
        if(v=="1"){
          sessionStorage.setItem("success","Successfully saved Data");
          location.reload();
        }
        else{
          alert(v);
        }
      }
    };
    xhttp.open("POST", "dorep.php", false);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("cuscode="+cuscode+"&tcode="+tcode+"&serialin="+serialin+"&serialout="+serialout+"&typ="+typ);
}
var v1='',v2='';
function check(i)
{typ='check';
	if(i==1)
		a=document.getElementsByName('serialin')[0].value;
	else a=document.getElementsByName('serialout')[0].value;

	var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      v= this.responseText;
	  if(v=='')
		  toastr.error("Product doesn\'t Exist");
	  if(i==1)
	  { v1=v;

			 document.getElementsByName('button')[0].disabled=true;
	  }
	  else
	  {
		  v2=v;

			 document.getElementsByName('button')[0].disabled=true;
	  }
	  if(v1===v2 && v1!='' && v2!=''){
		  document.getElementsByName('button')[0].disabled=false;
      document.getElementsByName('button')[0].style.cursor="auto";
    }
	  else
		 if(v1!='' && v2!='')
		 {
			 toastr.error('Product doesn\'t match');
			 document.getElementsByName('button')[0].disabled=true;
		 }
    }
  };
  xhttp.open("POST", "dorep.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send('a='+a+"&typ="+typ);


}
</script>
<?php include '../includes/foot.php'; ?>
