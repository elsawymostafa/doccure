<?php
include("include/conn.php");
include("include/header.html");
session_start();
if ($_SESSION['login']==0)
	{header("Location: login.php");
	$_SESSION['errorl']="You Must login first";	
	}
$doctorid=$_POST['doctorid'];
$patientid=$_POST['patientid'];
$date=$_POST['date'];	
$time=$_POST['time'];	
$q="INSERT INTO booking( dateofbooking, patientid, 
doctorid, time,date) VALUES ('$date','$patientid','$doctorid','$time',now())";
$conn->query($q);
?>

<!DOCTYPE html> 
<html lang="en">
	
<!-- doccure/booking-success.html  30 Nov 2019 04:12:16 GMT -->

	<body>

		<!-- Main Wrapper -->
		<div class="main-wrapper">
		
		
			
			<!-- Breadcrumb -->
			<div class="breadcrumb-bar">
				<div class="container-fluid">
					<div class="row align-items-center">
						<div class="col-md-12 col-12">
							<nav aria-label="breadcrumb" class="page-breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Booking</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Booking</h2>
						</div>
					</div>
				</div>
			</div>
			<!-- /Breadcrumb -->
			
			<!-- Page Content -->
			<div class="content success-page-cont">
				<div class="container-fluid">
				
					<div class="row justify-content-center">
						<div class="col-lg-6">
						
							<!-- Success Card -->
							<div class="card success-card">
								<div class="card-body">
									<div class="success-cont">
										<i class="fas fa-check"></i>
										<h3>Appointment booked Successfully!</h3>
										<a href="doctors.php" class="btn btn-primary view-inv-btn">Go To Doctors</a>
									</div>
								</div>
							</div>
							<!-- /Success Card -->
							
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

<!-- doccure/booking-success.html  30 Nov 2019 04:12:16 GMT -->
</html>