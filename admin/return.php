<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Return Books
      </h1>
      <ol class="breadcrumb">
        <li><a href="./"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Transaction</li>
        <li class="active">Return</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          ?>
            <div class="alert w3-pale-red alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-warning"></i> Error!</h4>
                <ul>
                <?php
                  foreach($_SESSION['error'] as $error){
                    echo "
                      <li>".$error."</li>
                    ";
                  }
                ?>
                </ul>
            </div>
          <?php
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
      <div class="row w3-animate-top">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <a href="#addnew" data-toggle="modal" class="btn w3-button label-success btn-sm btn-flat"><i class="fa fa-plus"></i> Returns</a>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
				<?php
				
				?>
                  <th class="hidden"></th>
                  <th>Date</th>
                  <th>Student ID</th>
                  <th>Name</th>
                  <th>ISBN</th>
                  <th>Title</th>
                  <th>Date Returned</th>
                  <th>Penalty</th>
                  <th>Action</th>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT *, returns.id AS return_id , students.student_id AS stud FROM returns LEFT JOIN students ON students.id=returns.student_id LEFT JOIN books ON books.id=returns.book_id ORDER BY date_return DESC";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      if($row['status']){
                        $status = '<span class="label label-danger">borrowed</span>';
                      }
                      else{
                        $status = '<span class="label label-success">returned</span>';
                      }
                      
                        if($row['penalty']!=0){
                         echo "<tr class='w3-pale-red'>";
                        }else{
                          echo "<tr class=' '>";
                        }
                      
                      echo "
                          <td class='hidden'></td>
                          <td>".date('M d, Y', strtotime($row['date_return']))."</td>
                          <td>".$row['stud']."</td>
                          <td>".$row['firstname'].' '.$row['lastname']."</td>
                          <td>".$row['isbn']."</td>
                          <td>".$row['title']."</td>
                          <td>".$row['date_return']."</td>
                          <td>P".$row['penalty']."</td>";
                          if($row['penalty']!=0){
                          echo '<td><button data-toggle="modal" class="label label-danger w3-button pay" data-id="'.$row['return_id'].'">Pay</button></td></tr>';
                          }else{
                            echo "<td><button class='label label-success w3-button'><span >Paid</span></button></td></tr>";
                          }
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div> 
      </div>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/return_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $(document).on('click', '#append', function(e){
    e.preventDefault();
    $('#append-div').append(
      '<div class="form-group"><label for="" class="col-sm-3 control-label">ISBN</label><div class="col-sm-9"><input type="text" class="form-control" name="isbn[]"></div></div>'
    );
  });
  $(document).on('click', '.pay', function(e){
    e.preventDefault();
    $('#pay').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'return_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.return_id').val(response.id);
      $('#pay_penalty').val(response.penalty);
      $('#pay_stud').val(response.student_id);
     
    }
  });
}

</script>
</body>
</html>
