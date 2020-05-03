<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<style>
  .mypins {
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
          Transfer PIN Report
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li> Pins</li>
          <li class="active"> Transfer PIN Report</li>
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
            <div class="mypins table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <th>S.No</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Used for Member ID</th>
                    <th>Used for Member Name</th>
                    <th>Used date</th>
                    <th>PIN</th>
                  </thead>
                  <?php
                  $counter = 0;
                  $member = $user['member_id'];
                  $sql = "SELECT * FROM transfer_pin WHERE member_id = '$member'";
                  $query = $conn->query($sql);
                  if ($query->num_rows > 0) {
                    while ($row = $query->fetch_assoc()) {
                  ?>
                      <tr>
                        <td><?php echo ++$counter; ?></td>
                        <td><?php echo $row['transfer_to'] ?></td>
                        <td><?php echo $row['transfer_to_name'] ?></td>
                        <td><?php echo $row['used_id'] ?></td>
                        <td><?php echo $row['used_name'] ?></td>
                        <td><?php echo $row['used_date'] ?></td>
                        <td><?php echo $row['pin'] ?></td>
                      </tr>
                      </tbody>
                  <?php
                    }
                  } else {
                    echo "No Transfer.";
                  }
                  ?>
                  <tbody>
                </table>
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