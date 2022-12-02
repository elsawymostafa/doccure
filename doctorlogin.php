<?php
session_start();
$_SESSION['login']=0;
include("include/conn.php");
include("include/header.html");
if ($_SERVER["REQUEST_METHOD"] == "POST") 
   {
	$email=$conn -> real_escape_string($_POST['email']);
	$pass= $conn -> real_escape_string($_POST['password']);
	$pasword=md5($pass);
	$q="SELECT * FROM doctors WHERE email ='$email' ";
	$result=$conn->query($q);
	$p;
	$id;
	$row = mysqli_num_rows($result);
	foreach ($result as $r)
	        {$p1=$r['password'];
			 $id=$r['id'];
			}
	if($row&&$p1==$pasword)
		{	
			session_destroy();
			session_start();
			$_SESSION['login']=$id;
			header("Location: doctor-dashboard.php?id=$id");


	    }
	else
		{
			$_SESSION['errord']="Email or Password Dosn't Correct";	
		}	
}
?>
<!DOCTYPE html> 
<html lang="en">
	
<!-- doccure/login.html  30 Nov 2019 04:12:20 GMT -->

	<body class="account-page">

		<!-- Main Wrapper -->
		<div class="main-wrapper">
			<!-- Page Content -->
			<div class="content" >
				<div class="container-fluid">
					
					<div class="row">
						<div class="col-md-8 offset-md-2">
							<?php
								if (isset($_SESSION['errord']))
									{?>
										<div class="alert alert-danger" role="alert">
											<?=$_SESSION['errord']?>
										</div>
								<?php }
								?>	
							<!-- Login Tab Content -->
							<div class="account-content">
								<div class="row align-items-center justify-content-center">
									<div class="col-md-7 col-lg-6 login-left">
										<img src="assets/img/login-banner.png" class="img-fluid" alt="Doccure Login">	
									</div>
									<div class="col-md-12 col-lg-6 login-right">
										<div class="login-header">
											<h3>Login <span>Doccure</span> DOCTORS</h3>
										</div>
										<form action="doctorlogin.php" method="POST">
											<div class="form-group form-focus">
												<input type="email" class="form-control floating" name="email">
												<label class="focus-label">Email</label>
											</div>
											<div class="form-group form-focus">
												<input type="password" class="form-control floating" name="password">
												<label class="focus-label">Password</label>
											</div>
											
											<button class="btn btn-primary btn-block btn-lg login-btn" type="submit">Login</button>
											
											
											<div class="text-center dont-have">Don’t have an account? <a href="doctor-register.php">Register</a></div>
										</form>
									</div>
								</div>
							</div>
							<!-- /Login Tab Content -->
								
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

<!-- doccure/login.html  30 Nov 2019 04:12:20 GMT -->
</html>