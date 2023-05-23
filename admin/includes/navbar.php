<style>
 .name-system{
    font-size:17px;
    font-family: "Times New Roman", Times, serif;
  }
</style>
<header class="main-header w3-card-2">
  <!-- Logo -->
  <a href="index.php" class="logo label-success">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini name-system"><b>LMS</b></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg name-system"><strong style="">Library Management System</strong></span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top label-success ">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle label-success" data-toggle="push-menu" role="button" style="">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <div class="navbar-custom-menu label-success">
      <ul class="nav navbar-nav label-success">
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu label-success">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="<?php echo (!empty($user['photo'])) ? '../images/'.$user['photo'] : '../images/profile.jpg'; ?>" class="user-image" alt="User Image">
            <span class="hidden-xs"><?php echo $user['firstname'].' '.$user['lastname']; ?></span>
          </a>
          <ul class="dropdown-menu w3-card-4">
            <!-- User image -->
            <li class="user-header label-success">
              <img src="<?php echo (!empty($user['photo'])) ? '../images/'.$user['photo'] : '../images/profile.jpg'; ?>" class="img-circle w3-card-4" alt="User Image">

              <p>
                <?php echo $user['firstname'].' '.$user['lastname']; ?>
                <small>Member since <?php echo date('M. Y', strtotime($user['created_on'])); ?></small>
              </p>
            </li>
            <li class="user-footer">
              <div class="pull-left">
                <a href="#profile" data-toggle="modal" class="btn btn-default btn-flat" id="admin_profile">Update</a>
              </div>
              <div class="pull-right">
                <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>
<?php include 'includes/profile_modal.php'; ?>