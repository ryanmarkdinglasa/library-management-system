<?php include 'includes/session.php'; ?>
<?php
	$where = '';
	if(isset($_GET['category'])){
		$catid = $_GET['category'];
		$where = 'WHERE category_id = '.$catid;
	}
?>
<?php include 'includes/header.php'; ?>
<style>
	body{
		/background:#445760;
	}
	.background{
		background:rgb(240,242,245);
	}
	.border-radius{
		border-radius:5px;
	}
      .mid-content{
        width:500px;
        margin:0 auto;
        /border:1px solid red;
        padding:15px 15px;
        border-radius:5px;
        background:#FFF;
		color:#000;
      }
      textarea{
        width:100%;
        height:200px;
        resize:none;
      }
</style>
<body class="hold-transition w3-bar label-success w3-card-4  layout-top-nav">
<div class="wrapper">
	<?php include 'includes/navbar.php'; ?>
	  <div class="content-wrapper ">
      
	  <br>
	    <div class="container ">
      <?php
	        			if(isset($_SESSION['error'])){
	        				echo "
	        					<div class='alert w3-pale-red'>
	        						".$_SESSION['error']."
	        					</div>
	        				";
	        				unset($_SESSION['error']);
	        			}
	        		?>
	      <!-- Main content -->
	    <section class="content w3-animate-top ">
		<div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Announcements</h3>
        </div>
        <div class="box-body">
        </div>
      </div>
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
                <div class="form-group">
                  <label for="title">'.$row['firstname'].' '.$row['lastname'].'<br>
                  <small style="font-size:10px;color:grey;">'.$row['created'].'</small>
                  </label><br><br>
                  <h4><b>'.$row['title'].'</b></h4>
                  <p>'.$row["description"].'</p>
                </div>
              </div><br>';
            }  
                  ?>
	      </section>
	    </div>
	  </div>
  
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
	$('#catlist').on('change', function(){
		if($(this).val() == 0){
			window.location = 'index.php';
		}
		else{
			window.location = 'index.php?category='+$(this).val();
		}
		
	});
});
</script>
<script>
$(function(){
  $(document).on('click', '.profile', function(e){
    e.preventDefault();
    $('#profile').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'faculty_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.studid').val(response.studid);
      $('#edit_firstname').val(response.firstname);
      $('#edit_lastname').val(response.lastname);
      $('#edit_contactno').val(response.contactno);
      $('#edit_email').val(response.email);
      $('#selcourse').val(response.course_id);
      $('#selcourse').html(response.code);
      $('.del_stu').html(response.firstname+' '+response.lastname);
    }
  });
}
</script>
</body>
</html>