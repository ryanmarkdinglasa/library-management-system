<?php include 'includes/session.php'; ?>
<?php
	if(!isset($_SESSION['student']) || trim($_SESSION['student']) == ''){
		header('Location: index.php');
		exit;
	}
	$conn = new mysqli('localhost', 'root', '', 'dblms');
	//
	$id=$_SESSION['student'];
	$action = '';
	if(isset($_GET['action'])){
		
		$action = $_GET['action'];
	}
?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">
	<?php include 'includes/navbar.php'; ?>
	  <div class="content-wrapper">
	    <div class="container">
	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
				<?php //echo $stuid;?>
	        	<div class="col-sm-10 col-sm-offset-1">
	        		<div class="box">
	        			<div class="box-header with-border">
	        				<h3 class="box-title">RETURN TRANSACTIONS</h3>
	        				<div class="pull-right">
	        				</div>
	        			</div>
	        			<div class="box-body">
	        				<table class="table table-bordered table-striped" id="example1">
			        			<thead>
			        				<th class="hidden"></th>
			        				<th>Date</th>
			        				<th>ISBN</th>
			        				<th>Title</th>
			        				<th>Author</th>
									<th>Penalty</th>
			        				
			        			</thead>
			        			<tbody>
			        			<?php
									$sql = "SELECT * FROM `returns` LEFT JOIN `books` ON `books`.`id`=`returns`.`book_id` WHERE `student_id` = '$id' ORDER BY `date_return` DESC";
									$query = $conn->query($sql);
									while ($rows = $query->fetch_assoc()) {
										$date = 'date_return';
										echo "
											<tr>
												<td class='hidden'></td>
												<td>".date('M d, Y', strtotime($rows[$date]))."</td>
												<td>".$rows['isbn']."</td>
												<td>".$rows['title']."</td>
												<td>".$rows['author']."</td>";
											echo "<td>P".$rows['penalty']."</td>";
								
										echo "</tr>";
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
	$('#transelect').on('change', function(){
		var action = $(this).val();
		if(action == 'borrow'){
			window.location = 'transaction.php';
		}
		else{
			window.location = 'transaction.php?action='+action;
		}
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