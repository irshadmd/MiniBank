<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<style>
 .mypins{
   padding: 2%;
   background-color: white;
 }
 select{ 
    appearance: none; 
    outline: 0; 
    width: 40%; 
    height: 30px; 
    color: black; 
    cursor: pointer; 
    border:1px solid black; 
    border-radius:10px; 
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
        Provide Help
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li> My Team</li>
        <li class="active"> Provide Help</li>
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
          <div class="mypins">
            <form action="providehelp_data.php" method="POST" onsubmit="return validate();" name="providehelp">
                <select name="selectPin" id="selectPin" required>
                    <option value="0">Select pin</option>
                <?php
                    $member=$user['member_id'];
                    $sql = "SELECT * FROM pins WHERE member_id = '$member'";
                    $query = $conn->query($sql);
                    if($query->num_rows > 0){
                    while($row = $query->fetch_assoc()){
                    ?>
                        <option value="<?php echo $row['pin'] ?>"><?php echo $row['pin'] ?></option>
                    <?php
                            }
                    }
                    ?>
                </select>
                <br>
                <br>
                <input type="submit" class="btn btn-primary" name="providehelp">
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>
  <?php include 'includes/footer.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script type="text/javascript">
    function validate(){
        let val=$('#selectPin option:selected').val()
        if(val==0){
            alert("Select Pin")
            return false
        }else{
            return true
        }
    }
</script>
</body>
</html>
