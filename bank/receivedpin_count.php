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
        Received PIN Count
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li> Pins</li>
        <li class="active"> Received PIN Count</li>
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
              <table class="table">
                  <thead>
                    <th>S.No</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>No of pins</th>
                    <th>Date</th>
                  </thead>
                <?php
                $counter = 0;
                $member=$user['member_id'];
                $sql = "SELECT * FROM pin_report WHERE member_id = '$member'";
                $query = $conn->query($sql);
                if($query->num_rows > 0){
                  while($row = $query->fetch_assoc()){
                ?>
                  <tr>
                    <td><?php echo ++$counter; ?></td>
                    <td><?php echo $row['received_from'] ?></td>
                    <td><?php echo $row['received_from_name'] ?></td>
                    <td><?php echo $row['noofpins'] ?></td>
                    <td><?php echo $row['date'] ?></td>
                  </tr>
                </tbody>
                <?php
                		}
                  }else{
                		echo "No Received.";
                    }
                ?>
                <tbody>
                </table>
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
