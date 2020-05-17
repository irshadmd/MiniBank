<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="../images/profile.jpg" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $user['username']; ?></p>
        <a><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class=""><a href="home.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
      <li><a href="changepassword.php"><i class="fa fa-key"></i> <span>Change Password</span></a></li>
      <li><a href="addmember.php"><i class="fa fa-key"></i> <span>Add Member</span></a></li>
      <li><a href="generatepin.php"><i class="fa fa-key"></i> <span>Generate Pin</span></a></li>
      <li><a href="providerequests.php"><i class="fa fa-key"></i> <span>Pending Provide Help List</span></a></li>
      <li><a href="confirmprovide_list.php"><i class="fa fa-key"></i> <span>Confirm Provide Help List</span></a></li>
      <li><a href="gethelppending_list.php"><i class="fa fa-key"></i> <span>Pending Get Help List</span></a></li>
      <li><a href="gethelpconfirm_list.php"><i class="fa fa-key"></i> <span>Get Help Confirm List</span></a></li>
      <li><a href="sendlinks.php"><i class="fa fa-key"></i> <span>Send Link</span></a></li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-users"></i>
          <span>My Team</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="employee.php"><i class="fa fa-circle-o"></i> Direct Members</a></li>
          <li><a href="overtime.php"><i class="fa fa-circle-o"></i> Downline Members</a></li>
          <li><a href="cashadvance.php"><i class="fa fa-circle-o"></i> My Pins/Registration</a></li>
          <li><a href="schedule.php"><i class="fa fa-circle-o"></i> Generate Pins</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-circle-o"></i>
          <span>Pins</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="employee.php"><i class="fa fa-circle-o"></i> Pin Transfer</a></li>
          <li><a href="overtime.php"><i class="fa fa-circle-o"></i> Transfered Pin Report</a></li>
          <li><a href="cashadvance.php"><i class="fa fa-circle-o"></i> Transfered Pin Count</a></li>
          <li><a href="schedule.php"><i class="fa fa-circle-o"></i> Received Pin Count</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-circle-o"></i>
          <span>My Income</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="employee.php"><i class="fa fa-circle-o"></i> Level Income</a></li>
          <li><a href="overtime.php"><i class="fa fa-circle-o"></i> Daily Growth</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-circle-o"></i>
          <span>Wallet</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="employee.php"><i class="fa fa-circle-o"></i> Working Wallet</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-info-circle"></i>
          <span>Help History</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="employee.php"><i class="fa fa-circle-o"></i> Provide Help</a></li>
          <li><a href="overtime.php"><i class="fa fa-circle-o"></i> Get Help</a></li>
        </ul>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>