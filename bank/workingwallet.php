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
                    Working Wallet
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li> Wallet</li>
                    <li class="active"> Working Wallet</li>
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
                            <div class="form-group row">
                                <label for="amount" class="col-md-4 col-form-label text-md-right">Wallet Amount </label>
                                <div class="col-md-6">
                                <?php
                                    $member = $user['member_id'];
                                    $sql = "SELECT * FROM wallet WHERE member_id = '$member'";
                                    $query = $conn->query($sql);
                                    $row = $query->fetch_assoc();
                                    $mon=$row['money'];
                                ?>
                                    <input type="text" id="amount" class="form-control" name="amount" value="<?php echo $mon;?>" readonly>
                                </div>
                            </div>
                            <hr>
                            <?php
                                $member = $user['member_id'];
                                $sql = "SELECT * FROM working_wallet WHERE member_id = '$member'";
                                $query = $conn->query($sql);
                                if ($query->num_rows > 0) {
                                ?>
                            <table class="table table-bordered">
                                <thead>
                                    <th>S.No</th>
                                    <th>Date</th>
                                    <th>Credit</th>
                                    <th>Debit</th>
                                    <th>Narration</th>
                                </thead>
                                <?php
                                $counter = 0;
                                $member = $user['member_id'];
                                $sql = "SELECT * FROM working_wallet WHERE member_id = '$member'";
                                $query = $conn->query($sql);
                                if ($query->num_rows > 0) {
                                    while ($row = $query->fetch_assoc()) {
                                ?>
                                        <tr>
                                            <td><?php echo ++$counter; ?></td>
                                            <td><?php echo $row['date'] ?></td>
                                            <td><?php echo $row['credit'] ?></td>
                                            <td><?php echo $row['debit'] ?></td>
                                            <td><?php echo $row['narration'] ?></td>
                                        </tr>
                                        </tbody>
                                <?php
                                    }
                                }
                                ?>
                                <tbody>
                            </table>
                            <?php
                                } else {
                                    echo "No Entries.";
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