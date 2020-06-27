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
                    Get Help Confirm List
                </h1>
                <ol class="breadcrumb">
                    <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active"> Save For Later </li>
                    <li class=""> Get Help Confirm List </li>
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
                                <table class="table table-bordered">
                                    <thead>
                                        <th>S no.</th>
                                        <th>Memberd Id</th>
                                        <th>Member Name</th>
                                        <th>Sponcer Id</th>
                                        <th>Sponcer Name</th>
                                        <th>Amount</th>
                                        <th>Get Count</th>
                                        <th>Date</th>
                                    </thead>
                                    <?php
                                    $count = 1;
                                    $sql = "SELECT * FROM provide_help WHERE status='approved' AND complete='false'";
                                    $query = $conn->query($sql);
                                    if ($query->num_rows > 0) {
                                        while ($row = $query->fetch_assoc()) {
                                    ?>
                                            <tr>
                                                <td><?php echo $count++; ?></td>
                                                <td><?php echo $row['member_id'] ?></td>
                                                <td><?php echo $row['name'] ?></td>
                                                <td><?php echo $row['sponcer_id'] ?></td>
                                                <td><?php echo $row['sponcer_name'] ?></td>
                                                <td>200</td>
                                                <td><?php echo $row['get_count'] ?></td>
                                                <td>
                                                    <?php $newdate = $row['date'];
                                                    echo date("d-m-Y", strtotime($newdate)); ?>
                                                    <a href="oneclick_sendlist.php?id=<?php echo $row['member_id']; ?>&pno=<?php echo $row['provide_help_no']; ?>" class="btn btn-success my-2">Select</a>
                                                </td>
                                            </tr>
                                            </tbody>
                                    <?php
                                        }
                                    } else {
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