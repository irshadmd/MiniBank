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
          My Pins
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li> My Team</li>
          <li class="active"> My pins</li>
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
            <div class="mypins">
                <h2>Total Pins: <?php
                                $member = $user['member_id'];
                                $sql = "SELECT * FROM pins WHERE member_id = '$member'";
                                $query = $conn->query($sql);
                                echo $query->num_rows;
                                ?></h2><br>
                <table class="table">
                  <thead>
                    <th>Pin no</th>
                    <th>Register</th>
                  </thead>
                  <?php
                  $member = $user['member_id'];
                  $sql = "SELECT * FROM pins WHERE member_id = '$member'";
                  $query = $conn->query($sql);
                  if ($query->num_rows > 0) {
                    while ($row = $query->fetch_assoc()) {
                  ?>
                      <tr>
                        <th><?php echo $row['pin'] ?></th>
                        <th><button data-id="<?php echo $row['id']; ?>" class="btn btn-success btn-sm btn-flat register">Register</button></th>
                      </tr>
                      </tbody>
                  <?php
                    }
                  } else {
                    echo "No Pins.";
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
    <?php include 'includes/register_modal.php'; ?>
  </div>
  <?php include 'includes/scripts.php'; ?>
  <script type="text/javascript">
    $(function() {
      $('.register').click(function(e) {
        e.preventDefault();
        $('#register').modal('show');
        var id = $(this).data('id');
        getRow(id);
      });
    });

    function getRow(id) {
      $.ajax({
        type: 'POST',
        url: 'pin_row.php',
        data: {
          id: id
        },
        dataType: 'json',
        success: function(response) {
          $('#id_pin').val(response.pin);
          $('#memberid').val(response.mem);
        }
      });
    }
  </script>
</body>

</html>