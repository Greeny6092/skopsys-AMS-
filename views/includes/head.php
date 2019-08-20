<!DOCTYPE html>
<html>
<?php
session_start(); ?>
<script>
<?php if(!isset($_SESSION['dname']))
	header('Location: /skopsys/');
      if($_SESSION['who']=='cus')
		  header('Location: /skopsys/views/customer/');


?>
</script>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
<style>
@-webkit-keyframes greenPulse {
  from { background-color: #000000; -webkit-box-shadow: 0 0 9px #000000; color:white;}
  30% {background-color: #ff0300; -webkit-box-shadow: 0 0 42px #ff0300;color:black; }
  35% {background-color: #ff0300; -webkit-box-shadow: 0 0 62px #ff0300;color:black; }
  to {background-color: #000000; -webkit-box-shadow: 0 0 9px #000000; color:white;   }

}

div.card.glow {
  -webkit-animation-name: greenPulse;
  -webkit-animation-duration: 1s;
  -webkit-animation-iteration-count: infinite;
}

textarea.preview
{
	border:1px transparent;
}
input[type="text"].preview
{
	border:1px transparent;
}
</style>
    <title>Skopsys | Home</title>

    <link rel="shortcut icon" href="/skopsys/static/favicon.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="/skopsys/css/style.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>

		<link href="/skopsys/js/toastr.css" rel="stylesheet"/>
		<script type="text/javascript" src="/skopsys/js/toastr.min.js"></script>
		<script type="text/javascript" src="/skopsys/js/cleave.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/moment@2.24.0/moment.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment-range/4.0.2/moment-range.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment-range/4.0.2/moment-range.js.map"></script>
</head>
<body>

				<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">

				  <a class="navbar-brand" href="/skopsys/views/">
				    <img src="/skopsys/static/favicon.png" width="30" height="30" alt="">
				  </a>

					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler1" aria-controls="navbarToggler1" aria-expanded="false" aria-label="Toggle navigation">
				    <span class="navbar-toggler-icon"></span>
				  </button>

					<div class="collapse navbar-collapse" id="navbarToggler1">
    				<ul class="navbar-nav mr-auto mt-2 mt-lg-0">

							<li class="nav-item dropdown">
				        <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
				          Admin
				        </a>
				        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
				          <a class="dropdown-item" href="/skopsys/views/admin/empmaster.php">Employee Master</a>
				          <a class="dropdown-item" href="/skopsys/views/admin/custmaster.php">Customer Master</a>
				          <a class="dropdown-item" href="/skopsys/views/admin/venmaster.php">Vendor Master</a>
				          <a class="dropdown-item" href="/skopsys/views/admin/procastmaster.php">Product Category Master</a>
									<a class="dropdown-item" href="/skopsys/views/admin/promaster.php">Product Master</a>
									<a class="dropdown-item" href="/skopsys/views/admin/checkavail.php">Check Product Availability</a>
									<a class="dropdown-item" href="/skopsys/views/admin/payment.php">Customer Due</a>
				        </div>
				     </li>

						 <li class="nav-item dropdown">
							 <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
								 Transaction
							 </a>
							 <div class="dropdown-menu" aria-labelledby="navbarDropdown">
								 <a class="dropdown-item" href="/skopsys/views/trans/enterorder.php">Enter DC Items</a>
								 <a class="dropdown-item" href="/skopsys/views/trans/custrn.php">Enter DC info</a>
								 <a class="dropdown-item" href="/skopsys/views/trans/incount.php">Invoice Generation</a>

								 <a class="dropdown-item" href="/skopsys/views/trans/serv.php">Service DC</a>

								 <a class="dropdown-item" href="/skopsys/views/trans/rep.php">Replacement</a>
								 <a class="dropdown-item" href="/skopsys/views/trans/repdc.php">Replacement DC</a>

								 <a class="dropdown-item" href="/skopsys/views/trans/returndc.php">Return dc</a>
								 <a class="dropdown-item" href="/skopsys/views/trans/return.php">Return product</a>
							 </div>
						</li>

						<li class="nav-item">
			        <a class="nav-link" href="/skopsys/views/bill/cuspaydel.php">Customer Payment</a>
			      </li>

						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
								Report
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
										<a class="dropdown-item" href="/skopsys/views/rep/delchalrepc.php">Customer DC Report</a>
										<a class="dropdown-item" href="/skopsys/views/rep/delchalrepv.php">Vendor DC Report</a>
										<a class="dropdown-item" href="/skopsys/views/rep/repdcrep.php">Replacement DC Report</a>
										<a class="dropdown-item" href=/skopsys/views/rep/cusinrep.php>Customer Invoice Report</a>
							</div>
					 	</li>

					 <li class="nav-item dropdown">
						 <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
							 Ticketing
						 </a>
						 <div class="dropdown-menu" aria-labelledby="navbarDropdown">
									 <a class="dropdown-item" href="/skopsys/views/tick/custicstat.php">Customer Ticketing Status</a>
									 <a class="dropdown-item" href="/skopsys/views/tick/custicsum.php">Customer Ticketing Summary</a>
						 </div>
					 </li>

					 <li class="nav-item">
						 <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#datemodal">
	 					  Date calculator
	 					</button>
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

			<div class="modal fade" id="datemodal" tabindex="-1" role="dialog" aria-labelledby="datemodalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Date calculator</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">

							<div class="row">
								<div class="col-lg-4 col-md-12 col-sm-12">
									<div class="form-group">
										<label>Start Date:</label>
										<input type="date" name="sdate" class="form-control" value="">
									</div>
								</div>
								<div class="col-lg-4 col-md-12 col-sm-12">
									<div class="form-group">
										<label>End Date:</label>
										<input type="date" name="edate" class="form-control" value="">
									</div>
								</div>
								<div class="col-lg-4 col-md-12 col-sm-12">
									<div class="form-group">
										<label>No of Days:</label>
										<input type="text" name="nd" class="form-control" value="">
									</div>
								</div>
							</div>

							<center>
								<button type="button" class="btn btn-outline-primary" onclick="compute();">Compute</button>
							</center>

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>


          <script type="text/javascript">

					function compute() {
						window['moment-range'].extendMoment(moment);
						sdate = document.getElementsByName('sdate')[0].value;
						edate = document.getElementsByName('edate')[0].value;

						var a = moment(edate);
						var b = moment(sdate);
						days = a.diff(b, 'days')

						document.getElementsByName('nd')[0].value=days;
					}

					$('#datemodal').on('hidden.bs.modal', function () {
						alert("hi");
						 //location.reload();
						});

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
					function numtoword(amount) {
    var words = new Array();
    words[0] = '';
    words[1] = 'One';
    words[2] = 'Two';
    words[3] = 'Three';
    words[4] = 'Four';
    words[5] = 'Five';
    words[6] = 'Six';
    words[7] = 'Seven';
    words[8] = 'Eight';
    words[9] = 'Nine';
    words[10] = 'Ten';
    words[11] = 'Eleven';
    words[12] = 'Twelve';
    words[13] = 'Thirteen';
    words[14] = 'Fourteen';
    words[15] = 'Fifteen';
    words[16] = 'Sixteen';
    words[17] = 'Seventeen';
    words[18] = 'Eighteen';
    words[19] = 'Nineteen';
    words[20] = 'Twenty';
    words[30] = 'Thirty';
    words[40] = 'Forty';
    words[50] = 'Fifty';
    words[60] = 'Sixty';
    words[70] = 'Seventy';
    words[80] = 'Eighty';
    words[90] = 'Ninety';
    amount = amount.toString();
    var atemp = amount.split(".");
    var number = atemp[0].split(",").join("");
    var n_length = number.length;
    var words_string = "";
    if (n_length <= 9) {
        var n_array = new Array(0, 0, 0, 0, 0, 0, 0, 0, 0);
        var received_n_array = new Array();
        for (var i = 0; i < n_length; i++) {
            received_n_array[i] = number.substr(i, 1);
        }
        for (var i = 9 - n_length, j = 0; i < 9; i++, j++) {
            n_array[i] = received_n_array[j];
        }
        for (var i = 0, j = 1; i < 9; i++, j++) {
            if (i == 0 || i == 2 || i == 4 || i == 7) {
                if (n_array[i] == 1) {
                    n_array[j] = 10 + parseInt(n_array[j]);
                    n_array[i] = 0;
                }
            }
        }
        value = "";
        for (var i = 0; i < 9; i++) {
            if (i == 0 || i == 2 || i == 4 || i == 7) {
                value = n_array[i] * 10;
            } else {
                value = n_array[i];
            }
            if (value != 0) {
                words_string += words[value] + " ";
            }
            if ((i == 1 && value != 0) || (i == 0 && value != 0 && n_array[i + 1] == 0)) {
                words_string += "Crores ";
            }
            if ((i == 3 && value != 0) || (i == 2 && value != 0 && n_array[i + 1] == 0)) {
                words_string += "Lakhs ";
            }
            if ((i == 5 && value != 0) || (i == 4 && value != 0 && n_array[i + 1] == 0)) {
                words_string += "Thousand ";
            }
            if (i == 6 && value != 0 && (n_array[i + 1] != 0 && n_array[i + 2] != 0)) {
                words_string += "Hundred and ";
            } else if (i == 6 && value != 0) {
                words_string += "Hundred ";
            }
        }
        words_string = words_string.split("  ").join(" ");
    }
    return words_string;
}
					</script>
					<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  				<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
