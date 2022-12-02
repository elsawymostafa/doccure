<?php
session_start();
if ($_SESSION['login']==0)
	{header("Location: login.php");
	$_SESSION['errorl']="You Must login first";	
	}
include("include/header.html");
include("include/conn.php");
if ($_SERVER['REQUEST_METHOD']=='POST'){
	$iddelet=$_POST['iddelet'];
	$q="DELETE FROM `booking` WHERE id=$iddelet";
	$conn->query($q);


}

$id=$_SESSION['login'];	
$q="SELECT * FROM booking where patientid=$id ORDER BY id DESC"	;
$result=$conn->query($q);

?>
<!DOCTYPE html> 
<html lang="en">
	
<!-- doccure/patient-dashboard.html  30 Nov 2019 04:12:16 GMT -->
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
									<li class="breadcrumb-item"><a href="index.php">Home</a></li>
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
						
					<?php
							include("include/sidebar.php");
							?>
						
						
						<div class="col-md-7 col-lg-8 col-xl-9">
							<div class="card">
								<div class="card-body pt-0">
								
									<!-- Tab Menu -->
									<nav class="user-tabs mb-4">
										<ul class="nav nav-tabs nav-tabs-bottom nav-justified">
											<li class="nav-item">
												<a class="nav-link active" href="#pat_appointments" data-toggle="tab">Appointments</a>
											</li>
											
										</ul>
									</nav>
									<!-- /Tab Menu -->
									
									<!-- Tab Content -->
									<div class="tab-content pt-0">
										
										<!-- Appointment Tab -->
										<div id="pat_appointments" class="tab-pane fade show active">
											<div class="card card-table mb-0">
												<div class="card-body">
													<div class="table-responsive">
														<table class="table table-hover table-center mb-0">
															<thead>
																<tr>
																	<th>Doctor</th>
																	<th>Appt Date</th>
																	<th>Booking Date</th>
																	<th>Amount</th>
																	<th>Status</th>
																	<th></th>
																</tr>
															</thead>
															<tbody>
																<?php
																foreach($result as $r)
																{
																	$idd=$r['doctorid']	;
																	$q="SELECT * FROM doctors where id=$idd"	;
																	$resultd=$conn->query($q);

																?>	
																<tr>
																	<td>
																		<h2 class="table-avatar">
																		<?php
																		foreach($resultd as $rd)
																		{	
																		?>
																			<a href="doctor-profile.php?id=<?=$rd['id']?>" class="avatar avatar-sm mr-2">
																				<img class="avatar-img rounded-circle" src="<?=$rd['image']?>" alt="User Image">
																			</a>
																			<a href="doctor-profile.php?id=<?=$rd['id']?>">Dr. <?=$rd['name']?> <span><?=$rd['postion']?></span></a>
																		</h2>
																	</td>
																	<td><?=$r['dateofbooking']?> <span class="d-block text-info"><?=$r['time']?></span></td>
																	<td><?=$r['date']?></td>
																	<td><?=$rd['price']?></td>
																	<?php
																		}
																		?>
																	<?php
																	if ($r['status']=="Accepted")
																	{?>	
																	<td><span class="badge badge-pill bg-success-light"><?=$r['status']?></span></td>
																	<?php
																	}
																	else if($r['status']=="Canseld") 
																	{
																	?>
																	<td><span class="badge badge-pill bg-danger-light"><?=$r['status']?></span></td>
																	<?php
																	}
																	else
																	{
																	?>
																	<td><span class="badge badge-pill bg-warning-light"><?=$r['status']?></span></td>
																	<?php
																	}
																	?>

																	<td class="text-right">
																		<!-- <div class="table-action">
																			<a href="javascript:void(0);" class="btn btn-sm bg-danger-light">
																				<i class="far fa-trash-alt"></i> Cancel
																			</a>
																		</div> -->
																		<?php
																		if ($r['status']=='pending'){
																		?>
																		<form method="Post">
																			
																			<input type="text" value="<?=$r['id']?>"name ="iddelet" hidden>
																			<div class="submit-section">
																				<button type="submit" class="btn btn-sm bg-danger-light"><i class="far fa-trash-alt"></i> Cancel</button>
																			</div>
																		</form>	
																		<?php
																		}
																		?>
																	</td>
																</tr>
																
															<?php
																}
															?>
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
										<!-- /Appointment Tab -->
										
										
									</div>
									<!-- Tab Content -->
									
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
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>
		
	</body>

<!-- doccure/patient-dashboard.html  30 Nov 2019 04:12:16 GMT -->
</html>