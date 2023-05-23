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
</style>
<body class="hold-transition w3-bar label-success w3-card-4  layout-top-nav">
<div class="wrapper">
	<?php include 'includes/navbar.php'; ?>
	  <div class="content-wrapper ">
	  <br>
	    <div class="container ">

	      <!-- Main content -->
	    <section class="content w3-animate-top ">
	        <div class="row ">
	        	<div class="col-sm-8 col-sm-offset-2 " >
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
	        		<div class="box w3-card-4 border-radius">
	        			<div class="box-header with-border">
	        				<div class="input-group">
				                <input type="text" class="form-control input-lg" id="searchBox" placeholder="Search for ISBN, Title or Author">
				                <span class="input-group-btn">
				                    <button type="button" class="btn label-success btn-flat btn-lg"><i class="fa fa-search"></i> </button>
				                </span>
				            </div>
	        			</div>
	        			<div class="box-body" style="color:#000;">
	        				<div class="input-group col-sm-5">
				                <span class="input-group-addon">Category:</span>
				                <select class="form-control" id="catlist">
				                	<option value=0>ALL</option>
				                	<?php
				                		$sql = "SELECT * FROM category";
				                		$query = $conn->query($sql);
				                		while($catrow = $query->fetch_assoc()){
				                			$selected = ($catid == $catrow['id']) ? " selected" : "";
				                			echo "
				                				<option value='".$catrow['id']."' ".$selected.">".$catrow['name']."</option>
				                			";
				                		}
				                	?>
				                </select>
				             </div>
	        				<table class="table table-bordered table-striped" id="booklist">
			        			<thead>
			        				<th>ISBN</th>
			        				<th>Title</th>
			        				<th>Author</th>
			        				<th>Status</th>
			        			</thead>
			        			<tbody>
			        			<?php
			        				$sql = "SELECT * FROM books $where";
			        				$query = $conn->query($sql);
			        				while($row = $query->fetch_assoc()){
			        					$status = ($row['status'] == 0) ? '<div class="w3-status label-success border-radius"><span class="w3-status label label-success">available</span></div>' : '<div class="w3-status label-danger border-radius"><span class="w3-status label label-danger">not available</span></div>';
			        					echo "
			        						<tr>
			        							<td>".$row['isbn']."</td>
			        							<td>".$row['title']."</td>
			        							<td>".$row['author']."</td>
			        							<td>".$status."</td>
			        						</tr>
			        					";
			        				}
			        			?>
			        			</tbody>
			        		</table>
	        			</div>
	        		</div>
	        	</div>
	        </div>
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
    url: 'student_row.php',
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