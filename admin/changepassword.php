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
          Change Password
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active"> Change Password</li>
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
                <form method="POST" action="passwordupdate.php" name="changepassword" onSubmit="return valid();">
                  <div class="form-group row">
                    <label for="newpassword" class="col-md-4 col-form-label text-md-right">New Password </label>
                    <div class="col-md-6">
                      <input type="text" id="newpassword" class="form-control" name="newpassword" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="confirmpassword" class="col-md-4 col-form-label text-md-right">Confirm Password* </label>
                    <div class="col-md-6">
                      <input type="text" id="confirmpassword" class="form-control" name="confirmpassword" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="currentpassword" class="col-md-4 col-form-label text-md-right">Current Password* </label>
                    <div class="col-md-6">
                      <input type="password" id="currentpassword" class="form-control" name="currentpassword" required>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-success btn-flat" name="adminpassupdate"><i class="fa fa-check-square-o"></i> Update</button>
                </form>
            </div>
          </div>
        </div>
      </section>
    </div>

    <?php include 'includes/footer.php'; ?>
  </div>
  <script type="text/javascript">
    function valid() {
      if (document.changepassword.currentpassword.value == "") {
        alert("Current Password Filed is Empty !!");
        document.changepassword.currentpassword.focus();
        return false;
      } else if (document.changepassword.newpassword.value == "") {
        alert("New Password Filed is Empty !!");
        document.changepassword.newpassword.focus();
        return false;
      } else if (document.changepassword.confirmpassword.value == "") {
        alert("Confirm Password Filed is Empty !!");
        document.changepassword.confirmpassword.focus();
        return false;
      } else if (document.changepassword.newpassword.value != document.changepassword.confirmpassword.value) {
        alert("Password and Confirm Password Field do not match  !!");
        document.changepassword.confirmpassword.focus();
        return false;
      }
      return true;
    }
  </script>
  <?php include 'includes/scripts.php'; ?>
</body>

</html>