<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<style>
 .generate{
   padding: 2%;
   background-color: white;
 }
 input:active{
   border: 1px solid black;
 }
 input{
   border: 1px solid black;
 }
</style>
<body class="hold-transition skin-yellow sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Generate Pin
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Generate Pin</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="container">
            <div class="generate">
              <form method="POST" action="generatepindata.php" name="generatepin">
                <div class="form-group row">
                    <label for="memberid" class="col-md-4 col-form-label text-md-right">Member Id </label>
                    <div class="col-md-6">
                      <input type="text" id="memberid" class="form-control" name="memberid" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="noofpins" class="col-md-4 col-form-label text-md-right">No of Pins </label>
                    <div class="col-md-6">
                      <input type="number" id="noofpins" class="form-control" name="noofpins" min="1" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-success btn-flat" name="generatepin"><i class="fa fa-check-square-o"></i> Generate</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <?php include 'includes/footer.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
</body>
</html>
