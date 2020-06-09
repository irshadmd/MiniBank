<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<style>
  .myprofile {
    padding: 2%;
    background-color: white;
    border-radius: 10px;
    padding: 3%;
  }

  input:active {
    border: 1px solid black;
  }

  input {
    border: 1px solid black;
  }
</style>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <?php include 'includes/navbar.php'; ?>
    <?php include 'includes/menubar.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          My profile
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">My Profile</li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content">
        <?php
        if (isset($_SESSION['error'])) {
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              " . $_SESSION['error'] . "
            </div>
          ";
          unset($_SESSION['error']);
        }
        if (isset($_SESSION['success'])) {
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              " . $_SESSION['success'] . "
            </div>
          ";
          unset($_SESSION['success']);
        }
        ?>
        <div class="row">
          <div class="col-xs-12">
            <div class="myprofile">
              <form method="POST" action="profileupdate.php">
                <div class="form-group row">
                  <label for="memberid" class="col-md-4 col-form-label text-md-right">Member ID </label>
                  <div class="col-md-6">
                    <input type="text" id="memberid" class="form-control" name="memberid" value="<?php echo $user['member_id'] ?>" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="name" class="col-md-4 col-form-label text-md-right">Name </label>
                  <div class="col-md-6">
                    <input type="text" id="name" class="form-control" name="name" value="<?php echo $user['name'] ?>" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="mobile" class="col-md-4 col-form-label text-md-right">Mobile </label>
                  <div class="col-md-6">
                    <input type="text" id="mobile" class="form-control" name="mobile" value="<?php echo $user['mobile'] ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail </label>
                  <div class="col-md-6">
                    <input type="text" id="email" class="form-control" name="email" value="<?php echo $user['email'] ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="gender" class="col-md-4 col-form-label text-md-right">Gender </label>
                  <div class="col-md-6">
                    <?php
                    $gen = $user['gender'];
                    if ($gen == "male") {
                    ?>
                      <input type='radio' id='male' name='gender' value='male' checked>
                      <span for="male">Male</span>
                      <input type="radio" id="female" name="gender" value="female">
                      <span for="female">Female</span>
                    <?php
                    } else if ($gen == "female") {
                    ?>
                      <input type='radio' id='male' name='gender' value='male'>
                      <span for="male">Male</span>
                      <input type="radio" id="female" name="gender" value="female" checked>
                      <span for="female">Female</span>
                    <?php
                    } else {
                    ?>
                      <input type='radio' id='male' name='gender' value='male'>
                      <span for="male">Male</span>
                      <input type="radio" id="female" name="gender" value="female">
                      <span for="female">Female</span>
                    <?php
                    }
                    ?>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="phonepay" class="col-md-4 col-form-label text-md-right">Phone Pay No </label>
                  <div class="col-md-6">
                    <input type="text" id="phonepay" class="form-control" name="phonepay" value="<?php echo $user['phone_pay_no'] ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="googlepay" class="col-md-4 col-form-label text-md-right">Google Pay No </label>
                  <div class="col-md-6">
                    <input type="text" id="googlepay" class="form-control" name="googlepay" value="<?php echo $user['google_pay_no'] ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="paytmno" class="col-md-4 col-form-label text-md-right">Paytm No </label>
                  <div class="col-md-6">
                    <input type="text" id="paytmno" class="form-control" name="paytmno" value="<?php echo $user['paytm_no'] ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="bankname" class="col-md-4 col-form-label text-md-right">Bank Name </label>
                  <div class="col-md-6">
                    <input type="text" id="bankname" class="form-control" name="bankname" value="<?php echo $user['bank_name'] ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="accno" class="col-md-4 col-form-label text-md-right">Account No </label>
                  <div class="col-md-6">
                    <input type="text" id="accno" class="form-control" name="accno" value="<?php echo $user['acc_no'] ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="branch" class="col-md-4 col-form-label text-md-right">Branch </label>
                  <div class="col-md-6">
                    <input type="text" id="branch" class="form-control" name="branch" value="<?php echo $user['branch'] ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="ifsccode" class="col-md-4 col-form-label text-md-right">IFSC Code </label>
                  <div class="col-md-6">
                    <input type="text" id="ifsccode" class="form-control" name="ifsccode" value="<?php echo $user['ifsc_code'] ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="sponcer" class="col-md-4 col-form-label text-md-right">Sponcer </label>
                  <div class="col-md-6">
                    <input type="text" id="sponcer" class="form-control" name="sponcer" value="<?php echo $user['sponcer'] ?>" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="joiningdate" class="col-md-4 col-form-label text-md-right">Joining Date </label>
                  <div class="col-md-6">
                    <input type="text" id="joiningdate" class="form-control" name="joiningdate" value="<?php echo $user['joining_date'] ?>" readonly>
                  </div>
                </div>
                <button type="submit" class="btn btn-success btn-flat" name="update"><i class="fa fa-check-square-o"></i> Update</button>
              </form>
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