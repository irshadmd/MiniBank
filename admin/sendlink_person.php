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
                    Send To
                </h1>
                <ol class="breadcrumb">
                    <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active"><a href="gethelpconfirm_list.php"> Get Help Confirm List</a></li>
                    <li> Send To </li>
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
                            <h3><?php echo 'Send ' . $_GET['id'] . ' To'; ?></h3>
                            <hr>
                            <form action="sendlink_persondata.php?id=<?php echo $_GET['id']; ?>&pno=<?php echo $_GET['pno']; ?>" method="POST">
                                <div class="form-group row">
                                    <label for="sendmember" class="col-md-4 col-form-label text-md-right">Select</label>
                                    <div class="col-md-6">
                                        <select id="sendmember" class="form-control" name="sendmember" required>
                                            <?php
                                            $sql = "SELECT * FROM provide_help WHERE status='pending'";
                                            $query = $conn->query($sql);
                                            if ($query->num_rows > 0) {
                                                while ($row = $query->fetch_assoc()) {
                                            ?>
                                                    <option value="<?php echo $row['member_id'] . '_' . $row['id']; ?>"><?php echo $row['member_id'] . ' - ' . $row['name'] . ' - ' . '200'; ?></option>
                                            <?php
                                                }
                                            } else {
                                                echo "NoMembers.";
                                            }
                                            ?>
                                        </select>
                                        <br>
                                    </div>
                                </div>
                                <button type="submit" name="sendlink" class="btn btn-primary">Send</button>
                            </form>
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