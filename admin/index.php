<?php
  	session_start();
  	if(isset($_SESSION['admin'])){
    	header('location:home.php');
  	}
?>
<style>
	/body{
		background:#FFF;
	}
	/login-con{
		margin:0 auto;
		border-radius:10px;
		/border:1px solid red;
	}
</style>
<?php include 'includes/header.php'; ?>
<body class="hold-transition login-page " style="background:rgb(240,242,245);">
<a href="../" class="btn  w3-button w3-left label-success" name="" style="margin:30px 30px;"> Back</a>
<div class="login-box">

  	<div class="login-logo">
  		<b></b>
  	</div>
	  
  	<div class="login-box-body w3-card-4 login-con w3-animate-top">
    	<p class="login-box-msg">Sign in</p>
		<p class="login-box-msg"><?php ?></p>
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
</div>
	
<?php include 'includes/scripts.php' ?>
</body>
</html>