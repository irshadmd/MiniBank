<?php include 'includes/session.php'; ?>
<div class="modal fade" id="register">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b><span>Register</span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="addmemberdata.php">
                <div class="form-group">
                    <label for="id_pin" class="col-sm-3 control-label">Pin</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="pin" id="id_pin" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="memberid" class="col-sm-3 control-label">Member ID</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="memberid" id="memberid" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="id_sponcer" class="col-sm-3 control-label">Sponcer Id</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" value="<?php echo $user['member_id']; ?>" id="id_sponcer" name="sponcer" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Name</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone" class="col-sm-3 control-label">Phone no</label>
                    <div class="col-sm-9">
                      <input type="number" class="form-control" id="phone" name="phone" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">Password</label>
                    <div class="col-sm-9">
                      <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                </div>
            </div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-success btn-flat" name="register"><i class="fa fa-check-square-o"></i> Register</button>
            	</form>
          	</div>
        </div>
    </div>
</div>
