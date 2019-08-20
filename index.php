<!--font-family: 'ZCOOL QingKe HuangYou', cursive;
font-family: 'Montserrat', sans-serif;
font-family: 'Roboto Mono', monospace;
font-family: 'Exo 2', sans-serif;
 -->
 <?php
session_start();
if(isset($_SESSION['who']))
	header('Location: /skopsys/views/');
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css">

    <title>Skopsys | Login</title>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <link rel="shortcut icon" href="static/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Exo+2:700|Montserrat|Roboto+Mono|ZCOOL+QingKe+HuangYou" rel="stylesheet">
<link href="js/toastr.css" rel="stylesheet"/>
<script type="text/javascript" src="js/toastr.min.js"></script>
<script type="text/javascript" src="js/toast.js"></script>
  </head>
  <body>
    <div class="d-none d-lg-block">


     <div style="position: absolute;right:1vw;">
       <p class="text-center h6" style="color:#9fa8a3;">Ams System</p>
     </div>

    <div class= "container" style="padding-top: 15vh;">   <p class="text-center h1" style="color:#E7475E; font-family: 'Exo 2', sans-serif;"> <img src = "static/favicon.png">Skopsys</p> </div>

      <div class="container" style="padding-top:5vh;padding-left:20vw;padding-right:20vw;">
      <div class="jumbotron"  style="background-color:#e6e6e8;border-radius:30px;">
          <p class="text-center h3" style="color:#E7475E; font-family: 'Montserrat', sans-serif;"> Welcome to Skopsys </p>
          <div class="form-group" >

            <input type="text" name="username" class="form-control" placeholder="Username" autocomplete="username"
                    style="background: url(static/User.png);
                    background-repeat: no-repeat;
                    background-size: 15px;
                    background-position: 99% 50% ;
                    padding-right:50px;">
          </div>
          <div class="form-group">

            <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="current-password"
            style="background: url(static/lock.png);
            background-repeat: no-repeat;
            background-size: 23px;
            background-position: right ;
            padding-right:30px;">
          </div>
          <br>
          <div class="form-group">
            <center>
              <button type="button" onclick="check()" class="btn btn-secondary" style="background-color:#E7475E;font-family: 'Montserrat', sans-serif;"> Login </button>
            </center>
          </div>

          <a onclick="admin();" href="views/">admin</a>
          <!--a onclick="emp();" href="views/employee/">emp</a-->
          <a onclick="cus();" href="views/customer/">cus</a>
		      <a href="views/index.php">check</a>

      </div>
    </div>
  </div>
  <div class="d-block d-md-block d-lg-none">
    <div style="position: absolute;right:1vw;">
      <p class="text-center h6" style="color:#9fa8a3;">Ams System</p>
    </div>
    <div class="container" style="padding-top: 13vh;">

      <p class="text-center h1" style="color:#E7475E; font-family: 'Exo 2', sans-serif;"> <img src = "static/favicon.png">Skopsys</p>

      <div style="padding-top: 7vh;"></div>


      <div class="jumbotron"  style="background-color:#e6e6e8;border-radius:30px;">

          <p class="text-center h3" style="color:#E7475E; font-family: 'Montserrat', sans-serif;"> Welcome to Skopsys </p>
          <br><br>
          <div class="form-group" >
            <input type="text" name="username" class="form-control" placeholder="Username" autocomplete="username"
                    style="background: url(static/User.png);
                    background-repeat: no-repeat;
                    background-size: 15px;
                    background-position: 99% 50% ;
                    padding-right:50px;">
          </div>
          <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="current-password"
            style="background: url(static/lock.png);
            background-repeat: no-repeat;
            background-size: 23px;
            background-position: right ;
            padding-right:30px;">
          </div>
          <br>
          <div class="form-group">
            <center>
              <button type="button" onclick="check()" class="btn btn-secondary" style="background-color:#E7475E;font-family: 'Montserrat', sans-serif;"> Login </button>
            </center>
          </div>

          <a onclick="admin();" href="views/">admin</a>
          <a onclick="emp();" href="views/employee/">emp</a>
          <a onclick="cus();" href="views/customer/">cus</a>
		      <a href="views/index.php">check</a>

      </div>
    </div>
  </div>
<script>

function admin()
{
  n='dany';
	p='12345';
  //alert("ad");
	var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      if(this.responseText==1)
	  {
		  window.location.replace("views/index.php");
	  }
        else
			{
        toastr.warning("Authentication Failed!!!");
        //alert("Authentication Failed!!!");
      }
    }
  };
  xhttp.open("POST", "dologin.php", false);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("name="+n+"&pass="+p);
}

function emp()
{
  n='ad';
	p='12345';
  //alert("EMP");
	var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      if(this.responseText==1)
	  {
		  location.href="views/employee/";
	  }
        else
			{
        toastr.warning("Authentication Failed!!!");
        //alert("Authentication Failed!!!");
      }
    }
  };
  xhttp.open("POST", "dologin.php", false);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("name="+n+"&pass="+p);
}

function cus()
{
  n='mapol';
	p='admin';
  //alert("cus");
	var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      if(this.responseText==1)
	  {
		  location.href="views/customer/";
	  }
        else
			{
        toastr.warning("Authentication Failed!!!");
        //alert("Authentication Failed!!!");
      }
    }
  };
  xhttp.open("POST", "dologin.php", false);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("name="+n+"&pass="+p);
}

function check()
{
toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": true,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "0",
  "hideDuration": "0",
  "timeOut": "3000",
  "preventDuplicates": true,
  "extendedTimeOut": "2000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}

  n=document.getElementsByName("username")[0].value;
	p=document.getElementsByName("password")[0].value;
	//var toast = new iqwerty.toast.Toast("Invalid!!");
  	if(p==""||n=="")
	{
	 	//alert("Invalid Username Or Password!!");
		//toastr.info("Invalid Username Or Password!!");
		//toast.show();
    toastr.error("Please Fill the Username and Password!!!");
		return false;
	}
	//alert(n+" check "+p);

	var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        if(this.responseText==1)
  	  {
  		  window.location.replace("views/index.php");
  	  }
      else if (this.responseText==2) {
        window.location.replace("views/employee/index.php");
      }
      else if (this.responseText==3) {
        window.location.replace("views/customer/index.php");
      }
        else
			{
        toastr.warning("Authentication Failed! Please verify your username and password");
        //alert("Authentication Failed!!!");
      }
    }
  };
  xhttp.open("POST", "dologin.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("name="+n+"&pass="+p);
}
</script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>
