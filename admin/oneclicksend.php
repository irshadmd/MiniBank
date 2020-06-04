<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<style>
    .myprofile {
        padding: 2%;
        background-color: white;
        border-radius: 10px;
        padding: 3%;
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
                    Save For Later
                </h1>
                <ol class="breadcrumb">
                    <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active"> Save For Later </li>
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
                            <div class="table-responsive">
                                <br>
                                <?php
                                $sql = "SELECT * FROM saved";
                                $query = $conn->query($sql);
                                if ($query->num_rows > 0) {
                                ?>
                                    <table class="table table-bordered">
                                        <thead>
                                            <th>S no.</th>
                                            <th>Get Id</th>
                                            <th>Get Name</th>
                                            <th>Get Phone</th>
                                            <th>Provide Id</th>
                                            <th>Provide Name</th>
                                            <th>Provide Phone</th>
                                            <th>Amount</th>
                                        </thead>
                                        <?php
                                        $count = 1;
                                        $sql = "SELECT * FROM saved";
                                        $query = $conn->query($sql);
                                        if ($query->num_rows > 0) {
                                            while ($row = $query->fetch_assoc()) {
                                        ?>
                                                <tr>
                                                    <td><?php echo $count++; ?></td>
                                                    <td><?php echo $row['get_id'] ?></td>
                                                    <td><?php echo $row['get_name'] ?></td>
                                                    <td><?php echo $row['get_phone'] ?></td>
                                                    <td><?php echo $row['send_id'] ?></td>
                                                    <td><?php echo $row['send_name'] ?></td>
                                                    <td><?php echo $row['send_phone'] ?></td>
                                                    <td><?php echo $row['amount'] ?></td>
                                                </tr>
                                                </tbody>
                                        <?php
                                            }
                                        }
                                        ?>
                                        <tbody>
                                        <tfoot>
                                            <tr>
                                                <th>
                                                    <a href="oneclick_sendtoall.php" class="btn btn-success"><i class='icon fa fa-send'></i> Send To All</a>
                                                </th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                <?php
                                } else {
                                    echo "No Saved.";
                                }
                                ?>
                            </div>
                            <hr>
                            <a href="oneclick_getlist.php" class="btn btn-primary btn-block"><i class='icon fa fa-plus'></i> Add</a>
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