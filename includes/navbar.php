<style>
  .btn-log{
    /float:right;
    width:130px;
    height:40px;
    margin-top:5px;
  }
  .name-system{
    font-size:20px;
    font-family: "Times New Roman", Times, serif;
  }
</style>
<header class="main-header">
  <nav class="navbar navbar-static-top label-success">
    <div class="container ">
      <div class="navbar-header " style="padding:1px 1px;">
        <a href="./" class="navbar-brand name-system"> <img class="pull-left" style="margin:-15px 10px;" src="images/logo.png" width="39px" height="49px" /> Library Management System</a>
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
          <i class="fa fa-bars"></i>
        </button>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse label-success navbar-collapse pull-left" id="navbar-collapse">
        <ul class="nav navbar-nav">
          <?php
            if(isset($_SESSION['student'])){
              echo "
                <li><a href='index.php'>HOME</a></li>
                <li><a href='transaction.php'>TRANSACTION</a></li>
              ";
            } 
          ?>
        </ul>
      </div>
      <!-- /.navbar-collapse -->
      <!-- Navbar Right Menu -->
     <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <?php
              echo '
              <div class="navbar-custom-menu label-success">
              <ul class="nav navbar-nav label-success">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu label-success">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-sign-in"></i>LOGIN
                  </a>
                  <ul class="dropdown-menu w3-card-4" style="width:150px;">
                    <li class="user-footer">
                      <div class="">
                       <!-- <a href="#login" data-toggle="modal" class="btn-log btn btn-default btn-flat">Student</a>-->
                      </div>
                      <div class="">
                        <a href="admin/" class="btn-log btn btn-default btn-flat">Administrator</a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
              ';
          ?>
        </ul>
      </div>
   
      <!-- /.navbar-custom-menu -->
    </div>
    <!-- /.container-fluid -->
  </nav>
</header>
<?php include 'includes/login_modal.php'; ?>