<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'afterhundredhours.php'; ?>
<style>
  .mytable {
    background: white;
    padding: 0.5%;
    color: black;
    font-weight: bold;
    border: 1px solid black;
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

  .count {
    list-style-type: none;
    text-align: center;
  }

  .count li {
    display: inline-block;
  }

  .dot::after {
    content: ":";
  }

  .senddonation {
    border: 1px solid black;
    border-radius: 10px;
    background-color: blueviolet;
    padding: 1.5%;
    text-align: center;
  }

  .senddonation h3 {
    border-bottom: 1px solid black;
    color: white;
  }

  .senddonation h4 {
    color: white;
  }

  .getdonation {
    border: 1px solid black;
    border-radius: 10px;
    background-color: green;
    padding: 1.5%;
    text-align: center;
  }

  .getdonation h3 {
    border-bottom: 1px solid black;
    color: white;
  }

  .getdonation h4 {
    color: white;
  }

  .senddonation ul li {
    color: red;
    font-size: 20px;
  }

  .getdonation ul li {
    color: red;
    font-size: 20px;
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
        $sql = "SELECT * FROM news";
        $query = $conn->query($sql);
        while ($row = $query->fetch_assoc()) {
          echo "
            <div class='alert alert-info alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-forward'></i>" . $row['title'] . "</h4>
              " . $row['message'] . "
            </div>
          ";
        }
        ?>
        <hr>
        <div class="row">
          <div class="col-md-6 col-sm-6 col-xs-6">
            <a href="mypins.php" class="btn btn-block btn-google"><i class="fa fa-users"></i> &nbsp Add Member</a>
          </div>
          <div class="col-md-6 col-sm-6 col-xs-6">
            <a href="providehelp.php" class="btn btn-block btn-facebook"><i class='icon fa fa-check'></i> &nbsp Help Again</a>
          </div>
        </div>
        <hr>
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
                <?php
                $member = $user['member_id'];
                $sql = "SELECT * FROM wallet WHERE member_id = '$member'";
                $query = $conn->query($sql);
                $row=$query->fetch_assoc();
                echo "<h3>" . $row['growth'] . "</h3>";
                ?>
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
              <a href="downlinemembers.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
        <!-- Send Donation -->
        <?php
        $memberid = $user['member_id'];
        $sql = "SELECT * FROM send_donation WHERE member_id='$memberid' AND status='notapproved'";
        $query = $conn->query($sql);
        if ($query->num_rows > 0) {
        ?>
          <div class="row">

            <?php
            while ($row = $query->fetch_assoc()) {
              $prevdate = $row['date'];
              $date = new DateTime($prevdate);
              $date->add(new DateInterval('P1DT0H'));
              $date = $date->format('Y-m-d H:i:s');
            ?>
              <div class="col-md-4">
                <div class="senddonation">
                  <h3>Send Donation</h3>
                  <ul data-countdown="<?php echo $date; ?>" class="count">
                    <li data-hours="00" class="dot">00</li>
                    <li data-minuts="00" class="dot">00</li>
                    <li data-seconds="00">00</li>
                  </ul>
                  <h4><i class="fa fa-user"></i> <?php echo $row['name']; ?></h4>
                  <h4><i class="fa fa-money"></i> <?php echo $row['amount']; ?></h4>
                  <h4><i class="fa fa-phone"></i> <?php echo $row['phoneno']; ?></h4>
                  <a href="senddonation.php?id=<?php echo $row['id']; ?>" class="btn btn-block btn-primary"><i class="fa fa-send"></i> Send Donation</a>
                </div>
              </div>
            <?php
            }
            ?>
          </div>
        <?php
        }
        ?>
        <!-- Get Donation -->
        <?php
        $memberid = $user['member_id'];
        $sql = "SELECT * FROM get_donation WHERE member_id='$memberid' AND status='notapproved'";
        $query = $conn->query($sql);
        if ($query->num_rows > 0) {
        ?>
          <div class="row">

            <?php
            while ($row = $query->fetch_assoc()) {
              $prevdate = $row['date'];
              $date = new DateTime($prevdate);
              $date->add(new DateInterval('P1DT0H'));
              $date = $date->format('Y-m-d H:i:s');
            ?>
              <div class="col-md-4">
                <div class="getdonation">
                  <h3>Get Donation</h3>
                  <ul data-countdown="<?php echo $date; ?>" class="count">
                    <li data-hours="00" class="dot">00</li>
                    <li data-minuts="00" class="dot">00</li>
                    <li data-seconds="00">00</li>
                  </ul>
                  <h4><i class="fa fa-user"></i> <?php echo $row['name']; ?></h4>
                  <h4><i class="fa fa-money"></i> <?php echo $row['amount']; ?></h4>
                  <h4><i class="fa fa-phone"></i> <?php echo $row['phoneno']; ?></h4>
                  <a href="getdonation.php?id=<?php echo $row['id']; ?>" class="btn btn-block btn-primary"><i class="fa fa-download"></i> Accept Donation</a>
                </div>
              </div>
            <?php
            }
            ?>
          </div>
        <?php
        }
        ?>
        <hr>
        <!-- provide help tables with timers -->
        <?php
        $memberid = $user['member_id'];
        $sno = 1;
        $sql = "SELECT * FROM provide_help WHERE member_id='$memberid' AND status='pendingGet'";
        $query = $conn->query($sql);
        if ($query->num_rows > 0) {
        ?>
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
                $sql = "SELECT * FROM provide_help WHERE member_id='$memberid' AND status='pendingGet'";
                $query = $conn->query($sql);
                if ($query->num_rows > 0) {
                  while ($row = $query->fetch_assoc()) {
                ?>
                    <tr>
                      <td><?php echo $sno;
                          $sno = $sno + 1; ?></td>
                      <td><?php echo $row['amount']; ?></td>
                      <td><?php $newdate = $row['date'];
                          echo date("d-m-Y", strtotime($newdate)); ?></td>
                      <td><?php echo $row['status']; ?></td>
                      <td>
                        <ul data-countdown="<?php echo $row['approved_datetime']; ?>" class="count">
                          <li data-hours="00" class="dot">00</li>
                          <li data-minuts="00" class="dot">00</li>
                          <li data-seconds="00">00</li>
                        </ul>
                      </td>
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
        <?php
        }
        ?>
    </div>
    <?php include 'includes/footer.php'; ?>
    </section>
  </div>
  </div>
  <?php include 'includes/scripts.php'; ?>
  <script>
    $(function() {
      $('[data-countdown]').each(function() {
        var $deadline = new Date($(this).data('countdown'));
        var $this = $(this);
        console.log($deadline);
        var x = setInterval(function() {
          var now = new Date().getTime();
          var t = $deadline - now;

          var $dataHours = $this.children('[data-hours]');
          var $dataMinuts = $this.children('[data-minuts]');
          var $dataSeconds = $this.children('[data-seconds]');

          var hours = Math.floor(t % (1000 * 60 * 60 * 24) / (1000 * 60 * 60)) + (Math.floor(t / (1000 * 60 * 60 * 24)) * 24);
          var minuts = Math.floor(t % (1000 * 60 * 60) / (1000 * 60));
          var seconds = Math.floor(t % (1000 * 60) / (1000));

          if (hours < 10) {
            hours = '0' + hours;
          }
          if (minuts < 10) {
            minuts = '0' + minuts;
          }
          if (seconds < 10) {
            seconds = '0' + seconds;
          }

          $dataHours.html(hours);
          $dataMinuts.html(minuts);
          $dataSeconds.html(seconds);
          console.log(hours + ':' + minuts + ':' + seconds)
          if (t <= 0) {
            clearInterval(x);
            $dataHours.html('00');
            $dataMinuts.html('00');
            $dataSeconds.html('00');
          }

        }, 1000);
      })
    });
  </script>
</body>

</html>