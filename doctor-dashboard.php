<?php
session_start();
if ($_SESSION['login']==0)
	{header("Location: login.php");
	$_SESSION['errorl']="You Must login first";	
	}

   include("include/header.html");
   include("include/conn.php");
   if ($_SERVER['REQUEST_METHOD']=='POST'){
	$idupdate=$_POST['iddelet'];
	$s=$_POST['status'];
	$q="UPDATE booking SET status='$s' WHERE id=$idupdate";
	$conn->query($q);


}   
$id=$_SESSION['login'];	
$q="SELECT * FROM booking where doctorid=$id ORDER BY id DESC"	;
$result=$conn->query($q);
?>
<!DOCTYPE html> 
<html lang="en">
	
<!-- doccure/doctor-dashboard.html  30 Nov 2019 04:12:03 GMT -->
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
									<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Dashboard</h2>
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

							<div class="row">
								<div class="col-md-12">
									<div class="card dash-card">
										<div class="card-body">
											<div class="row">
												<div class="col-md-12 col-lg-6">
													<div class="dash-widget dct-border-rht">
														<div class="circle-bar circle-bar1">
															<div class="circle-graph1" data-percent="75">
																<img src="assets/img/icon-01.png" class="img-fluid" alt="patient">
															</div>
														</div>
														<div class="dash-widget-info">
															<h6>Total Patient</h6>
															<h3>1500</h3>
															<p class="text-muted">Till Today</p>
														</div>
													</div>
												</div>
												
												
												
												<div class="col-md-12 col-lg-6">
													<div class="dash-widget">
														<div class="circle-bar circle-bar3">
															<div class="circle-graph3" data-percent="50">
																<img src="assets/img/icon-03.png" class="img-fluid" alt="Patient">
															</div>
														</div>
														<div class="dash-widget-info">
															<h6>Appoinments</h6>
															<h3>85</h3>
															<p class="text-muted">06, Apr 2019</p>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-12">
									<h4 class="mb-4">Patient Appoinment</h4>
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
											<div class="appointment-action">
												<?php
												}
												?>
												<?php
												 if($r['status']=='pending'){
													?>
												<form method="Post">
													<input type="text" value="<?=$r['id']?>"name ="iddelet" hidden>
													<input type="text" value="Accepted"name ="status" hidden>
													<div class="submit-section">
														<button type="submit" class="btn btn-sm bg-success-light"><i class="fas fa-check"></i> Accept</button>
													</div>	
												</form>
												<form method="Post">
													<input type="text" value="<?=$r['id']?>"name ="iddelet" hidden>
													<input type="text" value="Canseld"name ="status" hidden>
													<div class="submit-section">
														<button type="submit" class="btn btn-sm bg-danger-light"><i class="fas fa-times"></i> Cancel</button>
													</div>
												 </form>	
												<?php
												 }
												 else if ($r['status']=='Accepted')
												 {
													?>

												<span class="badge badge-pill bg-success-light"><?=$r['status']?></span>

												<?php
												 }
												 else
												 {
												 ?>
												<span class="badge badge-pill bg-danger-light"><?=$r['status']?></span>
												<?php
												 }
												 ?>
 	
											</div>
										</div>
										<?php
										}
										?>
										<!-- /Appointment List -->
									
										
										
									</div>
								</div>
							</div>

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
		
		<!-- Sticky Sidebar JS -->
        <script src="assets/plugins/theia-sticky-sidebar/ResizeSensor.js"></script>
        <script src="assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js"></script>
		
		<!-- Circle Progress JS -->
		<script src="assets/js/circle-progress.min.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>
		
	</body>

<!-- doccure/doctor-dashboard.html  30 Nov 2019 04:12:09 GMT -->
</html>