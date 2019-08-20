<?php include '../includes/head.php';
include '../../database.php';?>

<div class="container">
  <p style="color: royalblue;font-size:1.5rem">Return Product</p><hr>
  <div class="row">
    <div class="col-lg-4 col-md-12 col-sm-12">
      <div class="form-group">
        <label>Status:</label>
        <select class="custom-select" name="status">
          <option value=""></option>
          <option value="ACTIVE">ACTIVE</option>
          <option value="SCRAP">SCRAP</option>
          <option value="REPAIR">REPAIR</option>
        </select>
      </div>
    </div>
    <div class="col-lg-4 col-md-12 col-sm-12">
      <div class="form-group">
        <div class="form-group">
          <label>No of Items Returning:</label>
          <input type="text" name="noi" value="" class="form-control" oninput="createbox();">
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-12 col-sm-12">
      <div class="form-group">
        <div name="box"></div>
      </div>
    </div>
  </div>
  <hr>
  <div class="row">
    <div class="col-lg-8 col-md-12 col-sm-12"></div>
    <div class="col-lg-4 col-md-12 col-sm-12">
      <input type="button" name="button" value="update" class="btn btn-success" onclick="query();">
      <input type="button" name="" value="reset" onclick="location.reload();" class="btn btn-info">
    </div>
  </div>
</div>
<hr>
<script>
window.onload=function() {
  if((sessionStorage.getItem("success")!==null)){
    toastr.success(sessionStorage.getItem("success"));
    sessionStorage.removeItem("success");
  }
}
function createbox()
{
  i=0;
	v=document.getElementsByName("noi")[0].value;
	box=document.getElementsByName("box")[0];
	box.innerHTML="";
	for(i=0;i<v;i++)
		box.innerHTML+="<div class='col-10'><div class='form-group'><label>Serial "+(i+1)+"<sup>*</sup>:</label><input type='text' class='form-control' name='serial"+i+"'></div><br>";
	//box=document.getElementsByName("box")[0];
	//console.log(box.childElementCount);
}
function query() {
  noi=document.getElementsByName("noi")[0].value;
  status=document.getElementsByName("status")[0].value;
  var ser="";
  for(i=0;i<noi;i++)
  {
  	ser+="$"+document.getElementsByName('serial'+i)[0].value;
  }
  //alert(ser);
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      //alert(this.responseText);
      v = this.responseText;
	  
      if(v[v.length -1]==1)
        sessionStorage.setItem("success","Successfully Added item to Stock");
      else if(v[v.length -1]==2)
          sessionStorage.setItem("success","Successfully Scraped item and removed from Stock");
      else {
        alert("blank"+v);
      }
      location.reload();
    }
  };
  xhttp.open("POST", "doret.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("noi="+noi+"&serial="+ser+"&status="+status+"&typ="+"ret");
}
</script>
<?php include '../includes/foot.php'; ?>
