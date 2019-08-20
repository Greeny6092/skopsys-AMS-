<!DOCTYPE html>
<html>
<?php
session_start(); ?>
<script>
<?php if(!isset($_SESSION['dname']))
	header('Location: /skopsys/');
       if($_SESSION['who']!='cus')
header('Location: /skopsys/views/');

?>
</script>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Skopsys | Home</title>

    <link rel="shortcut icon" href="/skopsys/static/favicon.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="/skopsys/css/style.css">
		<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>


	<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
	<link href="/skopsys/js/toastr.css" rel="stylesheet"/>
	<script type="text/javascript" src="/skopsys/js/toastr.min.js"></script>
</head>
<body>

				<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">

				  <a class="navbar-brand" href="/skopsys/views/customer/">
				    <img src="/skopsys/static/favicon.png" width="30" height="30" alt="">
				  </a>

					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler1" aria-controls="navbarToggler1" aria-expanded="false" aria-label="Toggle navigation">
				    <span class="navbar-toggler-icon"></span>
				  </button>

					<div class="collapse navbar-collapse" id="navbarToggler1">
    				<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
  						<li class="nav-item">
  			        <a class="nav-link" href="/skopsys/views/customer/index.php">Dashboard</a>
  			      </li>
							<li class="nav-item">
  			        <a class="nav-link" href="/skopsys/views/customer/bills.php">Bills</a>
  			      </li>
							<li class="nav-item">
  			        <a class="nav-link" href="/skopsys/views/customer/ticketing.php">Ticketing</a>
  			      </li>
            </ul>
  					<div class="my-auto" style="color:white;">
  						<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
  							<li class="nav-item dropdown">
  	 						 <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  	 							 Welcome <?php echo $_SESSION["dname"]; ?>
  	 						 </a>
  	 						 <div class="dropdown-menu" aria-labelledby="navbarDropdown">
  								 <a class="dropdown-item" href="/skopsys/views/profile.php">Profile</a>
  								 <a class="dropdown-item" href="/skopsys/out.php">Logout</a>
  	 						 </div>
  	 					 </li>
  						</ul>
  					</div>
		  	</div>
			</nav>
			<div style="padding-top:15vh;">

			</div>
			<script>
			toastr.options = {
				"closeButton": true,
				"debug": false,
				"newestOnTop": true,
				"progressBar": false,
				"positionClass": "toast-top-right",
				"preventDuplicates": true,
				"onclick": null,
				"showDuration": "300",
				"hideDuration": "1000",
				"timeOut": "3000",
				"extendedTimeOut": "2000",
				"showEasing": "swing",
				"hideEasing": "linear",
				"showMethod": "fadeIn",
				"hideMethod": "fadeOut"
			}
			window.onload=function() {
				if((sessionStorage.getItem("success")!==null)){
					toastr.success(sessionStorage.getItem("success"));
					sessionStorage.removeItem("success");
				}
			}
			</script>
