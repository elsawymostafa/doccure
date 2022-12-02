<?php
include("include/header.html");
include("include/conn.php");
session_start();
if ($_SESSION['login']==0)
	{header("Location: doctorlogin.php");
	$_SESSION['errord']="You Must login first";	
	}
	$id=$_SESSION['login'];	
	$q="SELECT * FROM booking where doctorid=$id and status='Accepted' ORDER BY id DESC"	;
	$result=$conn->query($q);	
?>
<!DOCTYPE html> 
<html lang="en">
	
<!-- doccure/appointments.html  30 Nov 2019 04:12:09 GMT -->
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
									<li class="breadcrumb-item active" aria-current="page">Appointments</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Appointments</h2>
						</div>
					</div>
				</div>
			</div>
			<!-- /Breadcrumb -->
			
			<!-- Page Content -->
			<div class="content">
				<div class="container-fluid">

					<div class="row">
						<div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
						
							<!-- Profile Sidebar -->
							<?php
							include("include/sidebard.php");
							?>
							<!-- /Profile Sidebar -->
							
						</div>
						
						<div class="col-md-7 col-lg-8 col-xl-9">
							<h2 class="text-center my-3">Accepted Appoinments</h2>
							<div class="appointments">
							
								<!-- Appointment List -->
								<?php
										foreach($result as $r)
										{
											$idd=$r['patientid']	;
											$q="SELECT * FROM patient where id=$idd"	;
											$resultp=$conn->query($q);

										?>	
										<div class="appointment-list">
											<div class="profile-info-widget">
												<?php
												foreach($resultp as $rp)
												{
													?>

												<a  class="booking-doc-img">
													<img src="<?=$rp['image']?>" alt="User Image">
												</a>
												<div class="profile-det-info">
													<h3><a href="patient-profile.html"><?=$rp['name']?></a></h3>
													<div class="patient-details">
														<h5><i class="far fa-clock"></i> <?=$r['dateofbooking']?>,<?=$r['time']?></h5>
														<h5><i class="fas fa-map-marker-alt"></i><?=$rp['city']?>, <?=$rp['country']?></h5>
														<h5><i class="fas fa-envelope"></i> <?=$rp['email']?></h5>
														<h5 class="mb-0"><i class="fas fa-phone"></i> <?=$rp['phone']?></h5>
													</div>
												</div>
											</div>
											
										</div>
										<?php
										}
										?>
									<?php
										}
										?>	
								<!-- /Appointment List -->
							
								
								
							</div>
						</div>
					</div>

				</div>

			</div>		
			<!-- /Page Content -->
   
		   
		</div>
		<!-- /Main Wrapper -->
		
		<!-- Appointment Details Modal -->
		<div class="modal fade custom-modal" id="appt_details">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Appointment Details</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<ul class="info-details">
							<li>
								<div class="details-header">
									<div class="row">
										<div class="col-md-6">
											<span class="title">#APT0001</span>
											<span class="text">21 Oct 2019 10:00 AM</span>
										</div>
										<div class="col-md-6">
											<div class="text-right">
												<button type="button" class="btn bg-success-light btn-sm" id="topup_status">Completed</button>
											</div>
										</div>
									</div>
								</div>
							</li>
							<li>
								<span class="title">Status:</span>
								<span class="text">Completed</span>
							</li>
							<li>
								<span class="title">Confirm Date:</span>
								<span class="text">29 Jun 2019</span>
							</li>
							<li>
								<span class="title">Paid Amount</span>
								<span class="text">$450</span>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- /Appointment Details Modal -->
	  
		<!-- jQuery -->
		<script src="assets/js/jquery.min.js"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="assets/js/popper.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		
		<!-- Sticky Sidebar JS -->
        <script src="assets/plugins/theia-sticky-sidebar/ResizeSensor.js"></script>
        <script src="assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>
		
	</body>

<!-- doccure/appointments.html  30 Nov 2019 04:12:09 GMT -->
</html>