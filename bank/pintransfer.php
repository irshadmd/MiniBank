<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<style>
  .pins {
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

  .memberinfo p {
    padding: 5px;
  }

  .memberinfo {
    padding: 5px;
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
          PIN Transfer
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li> Pins</li>
          <li class="active"> Pin Transfer</li>
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
            <div class="pins">
              <div class="form-group row">
                <div class="col-sm-10">
                  <input class="form-control" type="text" id="searchin" placeholder="Enter Member Id">
                  <button class="btn btn-primary btn-sm btn searchbt" type="button">Search</button>
                </div>
              </div>

              <div class="memberinfo">

              </div>



            </div>
          </div>
        </div>
      </section>
    </div>
    <?php include 'includes/footer.php'; ?>
  </div>
  <?php include 'includes/scripts.php'; ?>
  <script type="text/javascript">
    $(document).on('change', "#pack", function() {
      var pack_val = $("#pack").val();
      var url = 'getpin.php';
      console.log("checking", pack_val);
      $.ajax({
        type: "POST",
        url: url,
        data: {
          pack_val: pack_val
        },
        dataType: 'json',
        success: function(data) {
          console.log("tested", data.total_pin);
          $("#selectPin").html(data.ops);
          $('#avpins').val(data.total_pin);
          $("#id_transferpin").attr({
            "max": data.total_pin,
          });
        }
      });
    });

    $(function() {
      $('.searchbt').click(function(e) {
        e.preventDefault();
        var key = $('#searchin').val();
        if (key == '<?php echo $user['member_id']; ?>') {
          alert("You can't Transfer yourself!");
        } else {
          getRow(key);
        }
      });
    });

    function getRow(id) {
      console.log(id);
      $.ajax({
        type: 'POST',
        url: 'pintransfer_row.php',
        data: {
          id: id
        },
        dataType: 'json',
        success: function(response) {
          console.log(response);
          $('.memberinfo').find('#det').remove();
          $('.memberinfo').find('#id_name').remove();
          $('.memberinfo').find('#id_phone').remove();
          $('.memberinfo').find('#err').remove();
          $('.form').remove();
          if (response) {
            var el = "<p id='id_name'>Name: <b>" + response.name + "</b></p>";
            var el2 = "<p id='id_phone'>Phone No: <b>" + response.mobile + "</b></p>";
            var el3 = "<h3 id='det'>Member Details</h3>";
            $('.memberinfo').append(el3);
            $('.memberinfo').append(el);
            $('.memberinfo').append(el2);

            var form = "<form class='form' action='pintransferdata.php' name='pintransfer' method='POST' style='margin-left:20px; width: 97%;'><div class='form-group row' ><h3>Available PINs</h3></div><div class='form-group row'><label  class='col-sm-2 col-form-label'>Transfer to</label><div class='col-sm-10'><input type='text' class='form-control' name='transferto' id='id_transferto' readonly></div></div><div class='form-group row'><label for='pack' class='col-sm-2 col-form-label text-md-right'>Select Pack </label> <div class='col-sm-10'><select name='amount' class='form-control' id='pack' required><option value='0'> Select Pack </option><?php $sql = 'SELECT * FROM pack';
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      $query = $conn->query($sql);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      if ($query->num_rows > 0) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        while ($row = $query->fetch_assoc()) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          echo '<option value=' . $row['amount'] . '>' . $row['amount'] . '</option>';
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      } ?></select></div></div><div class='form-group row'><label  class='col-sm-2 col-form-label'>Available PINS</label><div class='col-sm-10'><input id='avpins' class='form-control' type='number' name='availablepin' value='' readonly></div></div><div class='form-group row'><label  class='col-sm-2 col-form-label'>Transfer PINS</label><div class='col-sm-10'><input type='number' class='form-control' id='id_transferpin' name='transferpin' min='1'></div></div><button class='btn btn-primary' id='id_submit' type='submit' name='pintransfer'> Transfer </button></form>";

            $('.memberinfo').after(form);
            $('#id_transferto').val(response.member_id);
          } else {
            var err = "<p id='err' style='color:red;'>Member Not found</p>";
            $('.memberinfo').append(err);
          }
        }
      });
    }
  </script>
</body>

</html>