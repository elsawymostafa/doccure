<?php
include("include/conn.php");
include("include/header.html");
if ($_SERVER["REQUEST_METHOD"] == "POST") 
   {
	
	$name= $conn -> real_escape_string($_POST['name']);
	$email=$conn -> real_escape_string($_POST['email']);
	$pass= $conn -> real_escape_string($_POST['password']);
	if($name!=''&&$email!=''&&$pass!='')
		{$pasword=md5($pass);
		$q="INSERT INTO doctors (name,email,password) VALUES ('$name','$email','$pasword') ";
		
		try {
			$insert=$conn->query($q);
			header("Location: doctorlogin.php");
			session_destroy();
			}

			catch(Exception $e) {
			$_SESSION['error']="This Email Is Used Try Another";
			}		

	    }
	else
		{
			$_SESSION['error']="Name,Email And Password Mustn't Be Null";	
		}	
}

?>
<!DOCTYPE html> 
<html lang="en">
	
<!-- doccure/doctor-register.html  30 Nov 2019 04:12:15 GMT -->

	<body class="account-page">
		

		<!-- Main Wrapper -->
		<div class="main-wrapper">
		
						
			
			<!-- Page Content -->
			<div class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-8 offset-md-2">
						<?php
							if (isset($_SESSION['error']))
							    {?>
									<div class="alert alert-danger" role="alert">
										<?=$_SESSION['error']?>
									</div>
							<?php }
							?>	
							<!-- Account Content -->
							<div class="account-content">
								<div class="row align-items-center justify-content-center">
									<div class="col-md-7 col-lg-6 login-left">
										<img src="assets/img/login-banner.png" class="img-fluid" alt="Login Banner">	
									</div>
									<div class="col-md-12 col-lg-6 login-right">
										<div class="login-header">
											<h3>Doctor Register <a href="register.php">Not a Doctor?</a></h3>
										</div>
										
										<!-- Register Form -->
										<form action="doctor-register.php" method="POST">
											<div class="form-group form-focus">
												<input type="text" class="form-control floating" name="name">
												<label class="focus-label">Name</label>
											</div>
											<div class="form-group form-focus">
												<input type="email" class="form-control floating" name="email">
												<label class="focus-label">Email Address</label>
											</div>
											<div class="form-group form-focus">
												<input type="password" class="form-control floating" name="password">
												<label class="focus-label">Create Password</label>
											</div>
											<div class="text-right">
												<a class="forgot-link" href="doctorlogin.php">Already have an account?</a>
											</div>
											<button class="btn btn-primary btn-block btn-lg login-btn" type="submit">Signup</button>
											
										</form>
										<!-- /Register Form -->
										
									</div>
								</div>
							</div>
							<!-- /Account Content -->
								
						</div>
					</div>

				</div>

			</div>		
			<!-- /Page Content -->
   
			
		   
		</div>
		<!-- /Main Wrapper -->
	  
		<!-- jQuery -->
		<script src="assets/js/jquery.min.js"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="assets/js/popper.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>
		
	</body>

<!-- doccure/doctor-register.html  30 Nov 2019 04:12:16 GMT -->
</html>