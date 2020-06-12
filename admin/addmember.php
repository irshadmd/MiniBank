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

<body class="hold-transition skin-yellow sidebar-mini">
  <div class="wrapper">

    <?php include 'includes/navbar.php'; ?>
    <?php include 'includes/menubar.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Add Member
        </h1>
        <ol class="breadcrumb">
          <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active"> Add Member</li>
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
              <form method="POST" action="addmemberdata.php" name="addmember">
                <div class="form-group row">
                  <label for="memberid" class="col-md-4 col-form-label text-md-right">Member ID</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" value="<?php $str_result = '0123456789';
                                                                    $ranid = substr(str_shuffle($str_result), 0, 6);
                                                                    $memberId = 'MB' . $ranid;
                                                                    echo $memberId; ?>" name="memberid" id="memberid" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="id_sponcer" class="col-md-4 col-form-label text-md-right">Sponcer Id</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" value="<?php echo $user['username']; ?>" id="id_sponcer" name="sponcer" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" id="name" name="name" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="phone" class="col-md-4 col-form-label text-md-right">Phone no</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" id="phone" name="phone" pattern="[1-9]{1}[0-9]{9}">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                  <div class="col-md-6">
                    <input type="password" class="form-control" id="password" name="password" required>
                  </div>
                </div>
                <button type="submit" class="btn btn-success btn-flat" name="adminaddmember"><i class="fa fa-check-square-o"></i> Add Member</button>
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