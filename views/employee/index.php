<!DOCTYPE html>
<html>
<?php
session_start(); ?>
<script>
<?php if(!isset($_SESSION['dname']))
	header('Location: /skopsys/');

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
	<link href="/skopsys/js/toastr.css" rel="stylesheet"/>
	<script type="text/javascript" src="/skopsys/js/toastr.min.js"></script>
</head>
  <body>

		<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">

			<a class="navbar-brand" href="/skopsys/views/employee">
				<img src="/skopsys/static/favicon.png" width="30" height="30" alt="">
			</a>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler1" aria-controls="navbarToggler1" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarToggler1">
				<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
				<li class="nav-item">
					<a class="nav-link" href="/skopsys/views/employee/index.php">Dashboard</a>
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
    <br><br>
    <div class="container mt-5">
      <p style="color: royalblue;font-size:1.5rem">Jobs InComplete</p>
      <hr>
      <?php  ?>
        <div class="row">
          <?php ?>
            <div class="col-lg-4 col-md-12 col-sm-12">
              <div class="card" style="width: 18rem;background-color:lightgray;">
                <div class="card-body">
                  <h5 class="card-title"><?php echo 'Customer name'; ?></h5>
                  <?php echo 'job description'; ?><br><br>
                  <?php echo 'job address'; ?><br><br>
                  <a href="#" class="card-link btn btn-dark">Another link</a>
                </div>
              </div>
            </div>
          <?php ?>
        </div>
      <?php ?>
    </div>
    <div class="container mt-5">
      <p style="color: royalblue;font-size:1.5rem">Jobs Complete</p>
      <hr>
      <?php  ?>
        <div class="row">
          <?php ?>
            <div class="col-lg-4 col-md-12 col-sm-12">
              <div class="card" style="width: 18rem;background-color:lightgray;">
                <div class="card-body">
                  <h5 class="card-title"><?php echo 'Customer name'; ?></h5>
                  <?php echo 'job description'; ?><br><br>
                  <?php echo 'job address'; ?><br><br>
                  <a href="#" class="card-link btn btn-dark">Another link</a>
                </div>
              </div>
            </div>
          <?php ?>
        </div>
      <?php ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
