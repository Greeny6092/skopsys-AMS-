<div id="up"></div>
<?php include '../includes/head.php';
include '../../database.php';?>

<?php
$p=$_SESSION['per'];

if($p[20]=='0')
{
?>
<div class="alert alert-danger" role="alert">
  <h1 class="alert-heading text-center" style="font-size:3.5rem">Authorization Error</h1>
  <hr>
  <p class="mb-0 text-center" style="color:black;font-size:2.3rem">This page is not allowed for your permission level.</p>
</div>
<?php
}
else
{
?>
<div class="container">
  <p style="color: royalblue;">Payment Details</p>
  <hr>

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

        <div class="form-group">
          <label>Due Amount<sup>*</sup>:</label>
          <input type="text" name="cost" class="form-control" readonly>
        </div>
      </div>
      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label for="TDS Amount">TDS Amount:</label>
          <input type="text" name="tds" class="form-control" readonly>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label for="Billing No">Invoice No<sup>*</sup>:</label>
          <input type="text" name="iid" class="form-control" list="iid" onchange="inq();">
          <datalist id="iid">
          </datalist>
        </div>
      </div>
      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label for="To Date">Invoice Date<sup>*</sup>:</label>
          <input type="date" name="bdate" class="form-control" >
        </div>

      </div>
      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label for="Balance Amount">Invoice Amount<sup>*</sup>:</label>
          <input type="text" name="inamount" class="form-control" readonly>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label>Amount paying<sup>*</sup>:</label>
          <input type="text" name="pamount" class="form-control">
        </div>
      </div>
      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label for="Balance Amount">Balance Amount<sup>*</sup>:</label>
          <input type="text" name="balance" class="form-control" readonly>
        </div>
      </div>
      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label for="To Date">Payment Date<sup>*</sup>:</label>
          <input type="date" name="pdate" class="form-control" value="<?php echo date('Y')."-".date('m')."-".date('d')?>">
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label>Payment Type:</label>
          <select class="custom-select" name="ptype" onchange="pay();">
            <option value=""></option>
            <option value="neft">NEFT</option>
            <option value="cheque">Cheque</option>
          </select>
        </div>
      </div>
      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label id="number">Number:</label>
          <input type="text" name="num" class="form-control" value="">
        </div>
      </div>
      <div class="col-lg-4 col-sm-12 col-md-12">
        <div class="form-group">
          <label id="date">Date:</label>
          <input type="date" name="paydate" class="form-control" value="<?php echo date('Y')."-".date('m')."-".date('d')?>">
        </div>
      </div>
    </div>

    <hr>
    <div class="row">
      <div class="col-lg-8 col-sm-12 col-md-12"></div>
      <div class="col-lg-4 col-sm-12 col-md-12">
        <input type="button" name="button" value="save" class="btn btn-success" onclick="query();">
        <input type="button" value="reset" class="btn btn-info" onclick="location.reload();">
      </div>
    </div>
</div>

<hr>

<div class="container">
  <p style="color: royalblue;">Customer DC Details</p>
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
	 $sql = "select sno,companyname,iid,pamount,pay.balance,pdate,ptype,num from pay,cusmaster where pay.cuscode=cusmaster.cuscode";
	$result = $conn->query($sql);
	$i=1;
	if ($result->num_rows > 0){ ?>
  <table class="table table-striped table-hover table-bordered ">
    <thead class="thead-dark">
      <th>Customer Name</th>
      <th>Invoice No</th>
      <th>Paid amount</th>
      <th>Balance amt</th>
      <th>Paid Date</th>
      <th>Payment type</th>
      <th>Ref no</th>
    </thead>
    <tbody>
	<?php
	while($row = $result->fetch_assoc()){
	 echo "<tr onclick=\"req('".$row["sno"]."');to();\"><td>".$row["companyname"]."</td><td>".$row["iid"]."</td><td>".$row["pamount"]."</td><td>".$row["balance"]."</td><td>".$row["pdate"]."</td><td>".$row["ptype"]."</td><td>".$row["num"]."</td></tr>";
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
<!--tr onclick=\"req('".$row['dcno']."','".$row['cuscode']."');to();\"-->
<script>
  var i;
  window.onload=function(){
    if(sessionStorage.getItem('cn')!=null){
      document.getElementsByName('companyname')[0].value=sessionStorage.getItem('cn');
      document.getElementsByName('cuscode')[0].value=sessionStorage.getItem('cc');
      cusq();
      sessionStorage.removeItem("cc");
      sessionStorage.removeItem("cn");
    }
  }
  function to() {
    location.href="#up";
  }

  function pq()
  {
  	v=document.getElementsByName('companyname')[0].value;
    v=v.split("(");
    //alert(v);
    cusname = v[0];
    cuscode = v[1].split(")");
    document.getElementsByName('companyname')[0].value=cusname;
    document.getElementsByName('cuscode')[0].value=cuscode[0];
    cusq();
  }
  /*function cusq() {
    cuscode = document.getElementsByName('cuscode')[0].value;
    typ = '1';
    var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          //alert(this.responseText);
          v = this.responseText;
          v = v.split('$');
          document.getElementsByName('cost')[0].value = v[0];
          document.getElementsByName('tds')[0].value = v[1];
        }
      };
      xhttp.open("POST", "docuspay.php", false);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("cuscode="+cuscode+"&typ="+typ);
  }
  */
  function cusq() {
    cuscode = document.getElementsByName('cuscode')[0].value;
    typ = '1';
    document.getElementById('iid').innerHTML="<option value='none'></option>";
    var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          //alert(this.responseText);
          v = this.responseText;
          v = v.split('$');
          document.getElementsByName('cost')[0].value = v[0];
          document.getElementsByName('tds')[0].value = v[1];
          //document.getElementsByName('iid')[0].value ='';
          v1 = v[2].split('#');
          for(i=0;i<v1.length;i++){
            document.getElementById('iid').innerHTML += "<option value='"+v1[i]+"'>"+v1[i]+"</option>";
          }

        }
      };
      xhttp.open("POST", "docuspay.php", false);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("cuscode="+cuscode+"&typ="+typ);
  }

  function pay() {
    v = document.getElementsByName('ptype')[0].value;
    if(v=="neft"){
      document.getElementById('number').innerHTML="NEFT txn No:";
      document.getElementById('date').innerHTML="NEFT txn Date:";
    }
    else if(v=="cheque"){
      document.getElementById('number').innerHTML="Cheque No:";
      document.getElementById('date').innerHTML="Cheque Date:";
    }
  }

  function inq() {
    iid = document.getElementsByName('iid')[0].value;
    cuscode = document.getElementsByName('cuscode')[0].value;
    typ = '2';
    var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          //alert(this.responseText);
          v = this.responseText;
          v = v.split('$');
          //alert(moment(v[1],"DD-MM-YYYY"));
          document.getElementsByName('inamount')[0].value = v[0];
          document.getElementsByName('bdate')[0].value = moment(v[1],"DD-MM-YYYY").format("YYYY-MM-DD");
          document.getElementsByName('balance')[0].value = v[0];
        }
      };
      xhttp.open("POST", "docuspay.php", false);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("iid="+iid+"&typ="+typ);
  }
  function query() {
    cuscode = document.getElementsByName('cuscode')[0].value;
    iid = document.getElementsByName('iid')[0].value;
    pdate = document.getElementsByName('pdate')[0].value;
    pamount = parseInt(document.getElementsByName('pamount')[0].value);
    balance = parseInt(document.getElementsByName('balance')[0].value);
    ptype = document.getElementsByName('ptype')[0].value;
    num = document.getElementsByName('num')[0].value;
    paydate = document.getElementsByName('paydate')[0].value;
    typ = document.getElementsByName('button')[0].value;
    balance = balance-pamount;
    var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          v = this.responseText;
          if(v==11)
            sessionStorage.setItem("success","Successfully saved Data");
          else {
            alert(v);
          }
          location.reload();

        }
      };
      xhttp.open("POST", "docuspay.php", false);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      //alert("cuscode="+cuscode+"&iid="+iid+"&ptype="+ptype+"&pamount="+pamount+"&pdate="+pdate+"&balance="+balance+"&num="+num+"&paydate="+paydate+"&typ="+typ)
      xhttp.send("cuscode="+cuscode+"&iid="+iid+"&ptype="+ptype+"&pamount="+pamount+"&pdate="+pdate+"&balance="+balance+"&num="+num+"&paydate="+paydate+"&typ="+typ);
  }

  function req(sno) {
    typ = "req";
    var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          b = this.responseText;

          b=b.split("$");
          console.log(b);
          document.getElementsByName('cuscode')[0].value=b[1];
          //pq();
          cusq();
          //console.log(b);
          document.getElementsByName('iid')[0].value=b[2];
          inq();
          //document.getElementsByName('pamount')[0].value=b[3];
          document.getElementsByName('pdate')[0].value=b[4];
          document.getElementsByName('balance')[0].value=b[5];
          document.getElementsByName('ptype')[0].value=b[6];
          document.getElementsByName('num')[0].value=b[7];
          document.getElementsByName('paydate')[0].value=b[8];
          document.getElementsByName('companyname')[0].value=b[9];
        }
      };
      xhttp.open("POST", "docuspay.php", false);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("sno="+sno+"&typ="+typ);
  }
</script>
<?php } include '../includes/foot.php'; ?>
