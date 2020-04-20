<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<style>
 .mypins{
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
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Generate PINs From working Wallet
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li> My Team</li>
        <li class="active"> Generate Pins</li>
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
            <div class="mypins">
              <form class="form" action="generatepinwithwallet.php" name="generatepinwithwallet" method="POST" style="margin-left:20px; width: 97%;">
                <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Wallet Balance</label>
                    <div class="col-sm-10">
                        <p id="id_balance">
                          <?php
                          $member=$user['member_id'];
                          $sql = "SELECT * FROM wallet WHERE member_id = '$member'";
                          $query = $conn->query($sql);
                          while($row = $query->fetch_assoc()){
                            echo $row['money'];
                          }
                        ?>
                        </p>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Pin Cost</label>
                    <div class="col-sm-10">
                        <p>Rs.100</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Max pin generation</label>
                    <div class="col-sm-10">
                        <p id="id_maxpin">0</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">No of PINs</label>
                    <div class="col-sm-10">
                        <input type="number" name="noofpins" min="1" id="id_noofpins" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Total PIN Cost</label>
                    <div class="col-sm-10">
                        <input type="number" name="totalcost" id="id_totalcost" readonly required>
                    </div>
                </div>
                <button class="btn btn-primary" id="id_submit" type="submit" name="generatepinwithwallet">Generate</button>
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
<script type="text/javascript">
  $(function(){
   var bal=$('#id_balance').text();
   var cal=bal/100;
   var a=cal.toString().split(".")[0];
   $('#id_maxpin').text(a);
   $("#id_noofpins").attr({
      "max" : a,
   });
  });
  $("#id_noofpins").change(function () {
    var no=$("#id_noofpins").val();
    var max=$('#id_maxpin').text();
    var total=no*100;
    $('#id_totalcost').val(total);
    if(no>max){
      alert("You can't generate more than "+max);
      $('#id_totalcost').val("");
    }
  });
</script>
</body>
</html>
