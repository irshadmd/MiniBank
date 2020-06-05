<?php
session_start();
if (isset($_SESSION['members'])) {
	header('location:home.php');
}
?>
<?php include 'includes/header.php'; ?>
<style>
	.backhome {
		margin: 2%;
	}
</style>

<body class="hold-transition login-page">
	<div class="limiter">
		<div class="container-login100" style="background-image: url('../images/bg-01.jpg');">
			<div class="container-fluid" style="text-align:center">
				<hr>
				<h3>Welcome to MiniBank!</h3>
				<h4>Login Here <i class="fa fa-forward"></i></h4>
				<hr>
			</div>
			<div class="wrap-login100" style="background: linear-gradient(90deg, rgba(68,13,105,1) 0%, rgba(91,28,128,1) 6%, rgba(136,57,174,1) 32%, rgba(197,42,98,1) 62%, rgba(226,35,62,1) 91%, rgba(237,33,49,1) 100%, rgba(253,29,29,0.9500175070028011) 100%);">
				<form class="login100-form validate-form" form action="login.php" method="POST">
					<span class="login100-form-logo">
						<i class="ion ion-android-person" style="color: grey;"></i>
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						Login
					</span>
					<?php
					if (isset($_SESSION['error'])) {
						echo "
        				<div class='callout callout-danger text-center mt20'>
      			  		<p style='color:white' >" . $_SESSION['error'] . "</p>
      			  	</div>
        			";
						unset($_SESSION['error']);
					}
					?>
					<div class="wrap-input100 validate-input" data-validate="Enter member">
						<input class="input100" type="text" name="memberid" placeholder="Member ID">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

					<div class="container-login100-form-btn">
						<button type="submit" name="login" class="login100-form-btn backhome"><i class="fa fa-user"></i> &nbsp Login</button>&nbsp&nbsp
						<a href="../index.html" class="login100-form-btn backhome"><i class="fa fa-sign-out"></i>&nbsp Back To Website</a>
					</div>

				</form>
			</div>
		</div>
		<div class="container-fluid" style="text-align:center">
			<p>© 2020 MiniBank. All Rights Reserved</p>
		</div>
	</div>
	</div>
	<?php include 'includes/scripts.php' ?>
</body>

</html>