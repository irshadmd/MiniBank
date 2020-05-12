<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<style>
    .myprofile {
        padding: 2%;
        background-color: white;
        border-radius: 10px;
        padding: 3%;
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
                    Send Links
                </h1>
                <ol class="breadcrumb">
                    <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active"> Send Links </li>
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
                            <?php
                            $sql = "SELECT * FROM provide_help WHERE status='approved' AND complete='false' ORDER BY approved_datetime ASC";
                            $query = $conn->query($sql);
                            if ($query->num_rows > 0) {
                                while ($row = $query->fetch_assoc()) {
                            ?>
                                    <p>
                                        <h3 class="heading"><?php echo $row['name']; ?></h3>
                                        <span class="lead text-muted"><?php echo $row['member_id']; ?></span>
                                        <ul data-countdown="<?php echo $row['approved_datetime']; ?>" class="count">
                                            <li data-hours="00" class="dot">00</li>
                                            <li data-minuts="00" class="dot">00</li>
                                            <li data-seconds="00">00</li>
                                        </ul>
                                        <a href="sendlink_person.php?id=<?php echo $row['member_id']; ?>&pno=<?php echo $row['provide_help_no']; ?>" class="btn btn-primary my-2">Send Link</a>
                                        <hr>
                                    </p>
                            <?php
                                }
                            } else {
                                echo "No Pending Requests.";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <?php include 'includes/footer.php'; ?>
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