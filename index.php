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
			<div class="login-box">
				<div class="login-logo">
					<b></b>
				</div>
				<div class="login-box-body w3-card-4 login-con w3-animate-top">
					<p class="login-box-msg">Sign in</p>
					<p class="login-box-msg">
						<?php
							if(isset($_SESSION['error'])){
								echo "
									<div class='callout callout-danger text-center mt20'>
										<p>".$_SESSION['error']."</p> 
									</div>
								";
								unset($_SESSION['error']);
							}
						?>
					</p>
					<form action="login.php" method="POST">
						<div class="form-group has-feedback">
							<input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
							<span class="glyphicon glyphicon-user form-control-feedback"></span>
						</div>
					  <div class="form-group has-feedback">
						<input type="password" class="form-control" name="password" placeholder="Password" required>
						<span class="glyphicon glyphicon-lock form-control-feedback"></span>
					  </div>
						<div class="row">
							<div class="col-xs-4">
								<button type="submit" class="btn w3-button label-success" name="login"> Sign In</button>
							</div>
						</div>
					</form>
					
				</div>
			</div>
		
	    </div>
	  </div>
	<?php include 'admin/includes/scripts.php' ?>
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
</body>
</html>