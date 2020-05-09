<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-yellow sidebar-mini">
<div class="wrapper">

  	<?php include 'includes/navbar.php'; ?>
  	<?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
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
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-orange">
            <div class="inner">
              <?php
                $sql = "SELECT * FROM employees";
                $query = $conn->query($sql);
                echo "<h3>".$query->num_rows."</h3>";
              ?>
              <p>Total Employees</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-stalker"></i>
            </div>
            <a href="employee.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <?php
                $sql = "SELECT * FROM attendance";
                $query = $conn->query($sql);
                $total = $query->num_rows;
                $sql = "SELECT * FROM attendance WHERE status = 1";
                $query = $conn->query($sql);
                $early = $query->num_rows;
                $percentage = ($early/$total)*100;
                echo "<h3>".number_format($percentage, 2)."<sup style='font-size: 20px'>%</sup></h3>";
              ?>
              <p>On Time Percentage</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <?php
                $sql = "SELECT * FROM attendance WHERE date = '$today' AND status = 0";
                $query = $conn->query($sql);
                echo "<h3>".$query->num_rows."</h3>"
              ?>
              <p>Late Today</p>
            </div>
            <div class="icon">
              <i class="ion ion-alert-circled"></i>
            </div>
            <a href="attendance.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      </div>
      <?php include 'includes/footer.php'; ?>
    </section>
    </div>
</div>
<?php include 'includes/scripts.php'; ?>
</body>
</html>
