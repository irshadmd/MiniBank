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
        Direct Members: <?php
                $member=$user['member_id'];
                $sql = "SELECT * FROM members WHERE sponcer = '$member'";
                $query = $conn->query($sql);
                echo $query->num_rows;
              ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li> My Team</li>
        <li class="active"> Direct Members</li>
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
            <div class="table-responsive">
            <br>
              <table class="table table-bordered">
                  <thead>
                    <th>Memberd Id</th>
                    <th>Member Name</th>
                    <th>Registration Date</th>
                  </thead>
                <?php
                $member=$user['member_id'];
                $sql = "SELECT * FROM members WHERE sponcer = '$member'";
                $query = $conn->query($sql);
                if($query->num_rows > 0){
                  while($row = $query->fetch_assoc()){
                ?>
                  <tr>
                    <td><?php echo $row['member_id'] ?></td>
                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo $row['joining_date'] ?></td>
                  </tr>
                </tbody>
                <?php
                		}
                  }else{
                		echo "No Members.";
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
