<?php include 'includes/head.php';

?>

<div class="container">
  <p style="color: royalblue;">User details</p><hr>
  <div class="row">
    <div class="col-lg-4 col-sm-12 col-md-12">
      <div class="form-group">
        <label for="code">Emp Code:</label>
        <input type="text" name="" value="<?php echo $_SESSION['code'];?>" class="form-control" readonly>
      </div>
    </div>
    <div class="col-lg-4 col-sm-12 col-md-12">
      <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" name="" value="<?php echo $_SESSION['dname'];?>" class="form-control" readonly>
      </div>
    </div>
    <div class="col-lg-4 col-sm-12 col-md-12">
      <div class="form-group">
        <label for="mobileno">Mobile no:</label>
        <input type="text" name="" value="<?php echo $_SESSION['mobile'];?>" class="form-control" readonly>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-4 col-sm-12 col-md-12">
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="" value="<?php echo $_SESSION['email'];?>" class="form-control" readonly>
      </div>
    </div>
    <div class="col-lg-4 col-sm-12 col-md-12">
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" name="" value="<?php echo $_SESSION['password'];?>" class="form-control">
      </div>
    </div>
    <div class="col-lg-4 col-sm-12 col-md-12">

    </div>
  </div>
</div>
<hr>
<div class="container">
  <p style="color: royalblue;">Change password</p><hr>
  <div class="row">
    <div class="col-lg-4 col-sm-12 col-md-12">
      <div class="form-group">
        <label>Enter Old password:</label>
        <input type="password" name="oldpassword" class="form-control">
      </div>
    </div>
    <div class="col-lg-4 col-sm-12 col-md-12">
      <div class="form-group">
        <label>Enter new password:</label>
        <input type="password" name="newpassword" class="form-control">
      </div>
    </div>
    <div class="col-lg-4 col-sm-12 col-md-12">
      <div class="form-group">
        <label>Re-enter new password:</label>
        <input type="password" name="repassword" class="form-control">
      </div>
    </div>
  </div>
  <center>
     <input type="button" name="button" class="btn btn-success" value="Submit" />
  </center>
</div>
<hr>

<?php include 'includes/foot.php'; ?>
