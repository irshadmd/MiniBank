<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<style>
    .mypins {
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
                    Provide Help History
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li> Help History</li>
                    <li class="active"> Provide Help History</li>
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
                        <div class="mypins table-responsive">
                            <?php
                            $member = $user['member_id'];
                            $sql = "SELECT * FROM send_donation WHERE member_id = '$member' AND status='approved'";
                            $query = $conn->query($sql);
                            if ($query->num_rows > 0) {
                            ?>
                                <table class="table table-bordered">
                                    <thead style="background: linear-gradient(90deg, rgba(68,13,105,1) 0%, rgba(91,28,128,1) 6%, rgba(136,57,174,1) 32%, rgba(197,42,98,1) 62%, rgba(226,35,62,1) 91%, rgba(237,33,49,1) 100%, rgba(253,29,29,0.9500175070028011) 100%);color:white;">
                                        <th>S.No</th>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Amount</th>
                                        <th>Phone</th>
                                        <th>Date</th>
                                    </thead>
                                    <?php
                                    $counter = 0;
                                    $member = $user['member_id'];
                                    $sql = "SELECT * FROM send_donation WHERE member_id = '$member' AND status='approved'";
                                    $query = $conn->query($sql);
                                    if ($query->num_rows > 0) {
                                        while ($row = $query->fetch_assoc()) {
                                    ?>
                                            <tr>
                                                <td><?php echo ++$counter; ?></td>
                                                <td><?php echo $row['send_id'] ?></td>
                                                <td><?php echo $row['name'] ?></td>
                                                <td><?php echo $row['amount'] ?></td>
                                                <td><?php echo $row['phoneno'] ?></td>
                                                <td><?php echo $row['date'] ?></td>
                                            </tr>
                                            </tbody>
                                    <?php
                                        }
                                    } else {
                                        echo "No History.";
                                    }
                                    ?>
                                    <tbody>
                                </table>
                            <?php
                            } else {
                                echo "No History.";
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
</body>

</html>