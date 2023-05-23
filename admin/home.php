<?php include 'includes/session.php'; ?>
<?php 
  include 'includes/timezone.php'; 
  $today = date('Y-m-d');
  $year = date('Y');
  if(isset($_GET['year'])){
    $year = $_GET['year'];
  }
?>

<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-green  sidebar-mini">
<div class="wrapper ">
  <style>
      .mid-content{
        width:500px;
        margin:0 auto;
        /border:1px solid red;
        padding:15px 15px;
        border-radius:5px;
        background:#FFF;
      }
      textarea{
        width:100%;
        height:200px;
        resize:none;
      }
  </style>
  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper w3-animate-top">
    <!-- Content Header (Page header) -->
    <div class="w3-container w3-borer-bottom">
      <section class="content-header">
        <h1>
          Dashboard
        </h1>
        <ol class="breadcrumb">
          <li><a href="./"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Dashboard</li>
        </ol>
      </section>
    </div>
    <!-- Main content -->
    <section class="content">
    <?php
          if(isset($_SESSION['error'])){
          echo "
            <div class='alert w3-pale-red alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert w3-pale-green alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
        
      ?>
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <?php
              
                $sql = "SELECT * FROM books";
                $query = $conn->query($sql);

                echo "<h3>".$query->num_rows."</h3>";
              ?>

              <p>Total Books</p>
            </div>
            <div class="icon">
              <i class="fa fa-book"></i>
            </div>
            <a href="book.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <?php
                $sql = "SELECT * FROM students";
                $query = $conn->query($sql);

                echo "<h3>".$query->num_rows."</h3>";
              ?>
          
              <p>Total Students</p>
            </div>
            <div class="icon">
              <i class="fa fa-graduation-cap"></i>
            </div>
            <a href="student.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <?php
                $sql = "SELECT * FROM returns WHERE date_return = '$today'";
                $query = $conn->query($sql);

                echo "<h3>".$query->num_rows."</h3>";
              ?>
             
              <p>Returned Today</p>
            </div>
            <div class="icon">
              <i class="fa fa-mail-reply"></i>
            </div>
            <a href="return.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <?php
                $sql = "SELECT * FROM borrow WHERE date_borrow = '$today'";
                $query = $conn->query($sql);

                echo "<h3>".$query->num_rows."</h3>";
              ?>

              <p>Borrowed Today</p>
            </div>
            <div class="icon">
              <i class="fa fa-mail-forward"></i>
            </div>
            <a href="borrow.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
     <!-- <div class="row" style="width:400px;">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Monthly Transaction Report</h3>
              <div class="box-tools pull-left">
				<br>
                <form class="form-inline">
                  <div class="form-group">
                    <label>Select Year: </label>
                    <select class="form-control input-sm" id="select_year">
                      <?php
                        for($i=2015; $i<=2065; $i++){
                          $selected = ($i==$year)?'selected':'';
                          echo "
                            <option value='".$i."' ".$selected.">".$i."</option>
                          ";
                        }
                      ?>
                    </select>
                  </div>
                </form>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <br>
                <div id="legend" class="text-center"></div>
                <canvas id="barChart" style="height:100px"></canvas>
              </div>
            </div>
          </div>
        </div>

      </div>-->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Announcement</h3>
        </div>
        <div class="box-body">
        </div>
      </div>
            <div class="mid-content w3-card-2"> 
            <form action="announcement_add.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="title">Create Post</label>
              <input type="text" class="form-control" id="title" name="title" placeholder="Announement Title" required>
            </div>
            <div class="form-group">
              <label for="context">Context</label>
              <textarea class=""  id="context" name="context" placeholder="What is in your mind?" required></textarea>
            </div>
            <!--<div class="form-group">
              <label for="photo">Photo</label>
              <input type="file" id="photo" name="photo" required>
            </div>-->
            <button type="submit" name="post" class="btn btn-success">Save</button>
          </form>
          </div>
          <br>
          <?php
           $sql = "SELECT post.*, admin.firstname, admin.lastname 
           FROM post 
           LEFT JOIN admin ON admin.id = post.posted_by 
           ORDER BY `created` DESC";
            $query = $conn->query($sql);
            $count=1;
            while($row = $query->fetch_assoc()){
              echo '
              <div class="mid-content w3-card-2"> 
              <button type="button" onclick="deletepost('.$row['id'].');" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
                <div class="form-group">
                  <label for="title">'.$row['firstname'].' '.$row['lastname'].'<br>
                  <small style="font-size:10px;color:grey;">'.$row['created'].'</small>
                  </label><br><br>
                  <h4>'.$row['title'].'</h4>
                  <p>'.$row["description"].'</p>
                </div>
              </div><br>';
            }  
                  ?>
                  <br>
       
      
    </section>
      
      <!-- right col -->
    </div>
  	<?php include 'includes/footer.php'; ?>

</div>
<!-- ./wrapper -->

<?php include 'includes/scripts.php'; ?>

<script>
 function deletepost(id) {
  if (confirm("Are you sure you want to delete this post?")) {
    window.location.href = "announcement_delete.php?id=" + id;
  }
}
$(function(){
  $('#select_year').change(function(){
    window.location.href = 'home.php?year='+$(this).val();
  });
});
</script>
</body>
</html>