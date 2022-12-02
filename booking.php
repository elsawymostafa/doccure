<?php
include("include/conn.php");
include("include/header.html");
session_start();
if ($_SESSION['login']==0)
	{header("Location: login.php");
	$_SESSION['errorl']="You Must login first";	
	}
$id=	$_SESSION['login'];
$idd =$_GET['id'];
$q ="SELECT name, image, address, postion, price from doctors WHERE id=$idd";
$result=$conn->query($q);
if (!$result->num_rows)
	header("Location: index.php");
?>
<!DOCTYPE html> 
<html lang="en">
	
<!-- doccure/booking.html  30 Nov 2019 04:12:16 GMT -->
			<!-- /Header -->
			
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
			<div class="content">
				<div class="container">
				
					<div class="row">
						<div class="col-12">
						
							<div class="card">
								<div class="card-body">
									<div class="booking-doc-info">
										<?php
										foreach($result as $r){
										?>	
										<a href="doctor-profile.php?id=<?=$idd?>" class="booking-doc-img">
											<img src=<?=$r['image']?> alt="User Image">
										</a>
										<div class="booking-info">
											<h4><a href="doctor-profile.php?id=<?=$idd?>">Dr. <?=$r['name']?></a></h4>
										
											<p class="text-muted mb-3"><i class="fas fa-map-marker-alt"></i> <?=$r['address']?></p>
											<p class="doc-location">
												<i class="far fa-money-bill-alt"></i> <?=$r['price']?>
											</p>
										</div>
										<?php
										}?>
									</div>
								</div>
							</div>
							<form  action="booking-success.php" method="post">
								<input type="text" name="doctorid" value="<?=$idd?>" hidden>
								<input type="text" name="patientid" value="<?=$id?>" hidden>
								<div class="row">
									<div class="col-md-6">
										<div class="card">
										<div class="card-body">
											<h3>Choose your Appointment Date</h3>
											<input type="date" class="form-control" required name="date">
										</div>
									</div>
									</div>
									<div class="col-md-6">
										<div class="card">
										<div class="card-body">
											<h3>Choose your Appointment Time</h3>
											<input type="time" class="form-control" required name="time">
										</div>
									</div>
									</div>
								</div>
								
							
							
							<!-- Schedule Widget -->
							
							<!-- /Schedule Widget -->
							
							<!-- Submit Section -->
							<div class="submit-section proceed-btn text-right">
								<button type="submit" class="btn btn-primary submit-btn">Make Appointment</button>
							</div>
							<!-- /Submit Section -->
						</form>
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

<!-- doccure/booking.html  30 Nov 2019 04:12:16 GMT -->
</html>