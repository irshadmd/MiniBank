<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<style>
  .mytable {
    background: white;
    padding: 2%;
    color: black;
    font-weight: bold;
    border: 2px solid black;
    border-radius: 10px;
  }

  .mytable caption {
    text-transform: uppercase;
    color: black;
    font-size: 17px;
  }

  th {
    background: black;
    color: white;
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
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-orange">
              <div class="inner">
                <h3>200</h3>
                <p>JOINING</p>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h3>2400</h3>
                <p>GROWTH</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <?php
                $member = $user['member_id'];
                $sql = "SELECT * FROM members WHERE sponcer = '$member'";
                $query = $conn->query($sql);
                echo "<h3>" . $query->num_rows . "</h3>";
                ?>
                <p>MY DIRECT</p>
              </div>
              <div class="icon">
                <i class="ion ion-clock"></i>
              </div>
              <a href="directmembers.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
              <div class="inner">
                <?php
                $member = $user['member_id'];
                $sql = "SELECT * FROM members WHERE sponcer_info LIKE '%$member%'";
                $query = $conn->query($sql);
                echo "<h3>" . $query->num_rows . "</h3>";
                ?>
                <p>DOWNLINE</p>
              </div>
              <div class="icon">
                <i class="ion ion-alert-circled"></i>
              </div>
              <a href="downline.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-blue">
              <div class="inner">
                <?php
                $member = $user['member_id'];
                $sql = "SELECT * FROM pins WHERE member_id = '$member'";
                $query = $conn->query($sql);
                echo "<h3>" . $query->num_rows . "</h3>";
                ?>
                <p>MY PINS</p>
              </div>
              <div class="icon">
                <i class="ion ion-clock"></i>
              </div>
              <a href="mypins.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-pink">
              <div class="inner">
                <?php
                $member = $user['member_id'];
                $sql = "SELECT * FROM wallet WHERE member_id = '$member'";
                $query = $conn->query($sql);
                while ($row = $query->fetch_assoc()) {
                  echo "<h3>" . $row['money'] . "</h3>";
                }
                ?>
                <p>WALLET</p>
              </div>
              <div class="icon">
                <i class="ion ion-clock"></i>
              </div>
              <a href="wallet.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <div class="table-responsive mytable">
          <table class="table table-striped table-bordered">
            <caption>help Logs</caption>
            <thead>
              <th>S.no</th>
              <th>Amount</th>
              <th>Date</th>
              <th>Status</th>
              <th>Time</th>
            </thead>
            <tbody>
              <?php
              $memberid = $user['member_id'];
              $sno = 1;
              $sql = "SELECT * FROM provide_help WHERE member_id='$memberid'";
              $query = $conn->query($sql);
              if ($query->num_rows > 0) {
                while ($row = $query->fetch_assoc()) {
              ?>
                  <tr>
                    <td><?php echo $sno;
                        $sno = $sno + 1; ?></td>
                    <td>200</td>
                    <td><?php $newdate = $row['date'];
                        echo date("d-m-Y", strtotime($newdate)); ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td id="time">00:00:00</td>
                    <iframe src="../images/bank.png" style="display: none;" onload="getRow('<?php echo $row['approved_datetime']; ?>')"></iframe>
                  </tr>
              <?php
                }
              } else {
                echo "empty";
              }
              ?>
            </tbody>
          </table>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
    </section>
  </div>
  </div>
  <?php include 'includes/scripts.php'; ?>
  <script>

    function getRow(approved_datetime) {
      //got approved_datetime as string
      console.log("hello")

      var deadline = new Date(approved_datetime);
      console.log(typeof(deadline))
      deadline.setHours(deadline.getHours()+4);
      deadline.setDate(deadline.getDate()+4)


      var x = setInterval(function() {
        var now = new Date().getTime();
        console.log(deadline, now)
        var t = deadline - now;
        var days = Math.floor(t / (1000 * 60 * 60 * 24));
        var hours = Math.floor((t % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((t % (1000 * 60)) / 1000);
        
        let newhour=hours+(days*24);
        document.getElementById("time").innerHTML = 
          newhour + ":" + minutes + ":" + seconds ;
        if (t < 0) {
          clearInterval(x);
          document.getElementById("time").innerHTML = "Finished";
        }
      }, 1000);
    }
  </script>
</body>

</html>