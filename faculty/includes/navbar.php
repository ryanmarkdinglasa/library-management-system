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
        <a href="./" class="navbar-brand name-system"> <img class="pull-left" style="margin:-15px 10px;" src="../images/logo.png" width="39px" height="49px" /> Library Management System</a>
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
          <i class="fa fa-bars"></i>
        </button>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse label-success navbar-collapse pull-left" id="navbar-collapse">
        <ul class="nav navbar-nav">
          <?php
            if(isset($_SESSION['faculty'])){
              echo "
                <li><a href='index.php'>HOME</a></li>
                <li><a href='borrow_transaction.php'>BORROW</a></li>
                <li><a href='return_transaction.php'>RETURN</a></li>
                <li><a href='books.php'>BOOKS</a></li>
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
          if(isset($_SESSION['faculty'])){
              $photo = (!empty($faculty['photo'])) ? '../images/'.$faculty['photo'] : '../images/profile.jpg';
              echo "
                <li class='user user-menu btn-profile' data-id='".$faculty['faculty_id']."'>
                  <a href='' class='profile'>
                    <img src='".$photo."' class='user-image' alt='User Image'>
                    <span class='hidden-xs'>".$faculty['firstname'].' '.$faculty['lastname']."</span>
                  </a>
                </li>
                <li><a href='logout.php'><i class='fa fa-sign-out'></i> LOGOUT</a></li>
              ";
            }
          ?>
        </ul>
      </div>
   
      <!-- /.navbar-custom-menu -->
    </div>
    <!-- /.container-fluid -->
  </nav>
</header>
<?php include 'includes/profile_modal.php'; ?>

<script>
  $(function(){


  $(document).on('click', '.profile', function(e){
    e.preventDefault();
    $('#profile').modal('show');
    var id = $(this).data('id');
   // getRow(id);
  });


  function getRow(id){
    $.ajax({
      type: 'POST',
      url: 'book_row.php',
      data: {id:id},
      dataType: 'json',
      success: function(response){
        $('.bookid').val(response.bookid);
        $('#edit_isbn').val(response.isbn);
        $('#edit_title').val(response.title);
        $('#catselect').val(response.category_id).html(response.name);
        $('#edit_author').val(response.author);
        $('#edit_publisher').val(response.publisher);
        $('#edit_quantity').val(response.quantity);
        $('#datepicker_edit').val(response.publish_date);
        $('#del_book').html(response.title);
      }
    });
  }
}
</script>