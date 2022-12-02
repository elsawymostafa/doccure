<?php
session_start();
if ($_SESSION['login']==0)
	{header("Location: login.php");
	$_SESSION['errorl']="You Must login first";	
	}
include("include/header.html");
include("include/conn.php");
$q ="SELECT * FROM doctors";
$result=$conn->query($q);
?>
<!DOCTYPE html> 
<html lang="en">
	
<!-- doccure/favourites.html  30 Nov 2019 04:12:16 GMT -->
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
									<li class="breadcrumb-item active" aria-current="page">Doctors</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Doctors</h2>
						</div>
					</div>
				</div>
			</div>
			<!-- /Breadcrumb -->
			
			<!-- Page Content -->
			<div class="content">
				<div class="container-fluid">
					<div class="row">
					<?php
include("include/sidebar.php");
?>
						<div class="col-md-7 col-lg-8 col-xl-9">
							<div class="row row-grid">
								<!--  -->
								<?php
								foreach($result as $r){
								?>
								<div class="col-md-6 col-lg-4 col-xl-3">
									<div class="profile-widget">
										<div class="doc-img">
											<a href="doctor-profile.php?id=<?=$r['id']?>">
												<img class="img-fluid" alt="User Image" src="<?=$r['image']?>">
											</a>
											<a href="javascript:void(0)" class="fav-btn">
												<i class="far fa-bookmark"></i>
											</a>
										</div>
										<div class="pro-content">
											<h3 class="title">
												<a href="doctor-profile.php?id=<?=$r['id']?>"><?=$r['name']?></a> 
												<i class="fas fa-check-circle verified"></i>
											</h3>
											<p class="speciality"><?=$r['postion']?></p>
											
											<ul class="available-info">
												<li>
													<i class="fas fa-map-marker-alt"></i> <?=$r['address']?>
												</li>
												
												<li>
													<i class="far fa-money-bill-alt"></i><?=$r['price']?> <i class="fas fa-info-circle" data-toggle="tooltip" title="Lorem Ipsum"></i>
												</li>
											</ul>
											<div class="row row-sm">
												<div class="col-6">
													<a href="doctor-profile.php?id=<?=$r['id']?>" class="btn view-btn">View Profile</a>
												</div>
												<div class="col-6">
													<a href="booking.php?id=<?=$r['id']?>" class="btn book-btn">Book Now</a>
												</div>
											</div>
										</div>
									</div>
								</div>								
								<?php
								}
								?>			
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
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>
		
	</body>

<!-- doccure/favourites.html  30 Nov 2019 04:12:17 GMT -->
</html>