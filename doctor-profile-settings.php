<?php
include("include/conn.php");
include("include/header.html");
session_start();
if ($_SESSION['login']==0)
	{header("Location: doctorlogin.php");
	$_SESSION['errord']="You Must login first";	
	}
$id=	$_SESSION['login'];
if ($_SERVER["REQUEST_METHOD"] == "POST") 
   {
	$imagename=$_FILES['image']['name'];
	$temp=$_FILES['image']['tmp_name'];
	$t=time();
	$newloc="images/$t$imagename";
	move_uploaded_file($temp,$newloc);
	$first= $conn -> real_escape_string($_POST['first']);
	$last= $conn -> real_escape_string($_POST['last']);
	$name=$first." ".$last;
	$phone=$conn -> real_escape_string($_POST['phone']);
	$country= $conn -> real_escape_string($_POST['country']);
	$postion= $conn -> real_escape_string($_POST['postion']);
	$address= $conn -> real_escape_string($_POST['address']);
	$bio= $conn -> real_escape_string($_POST['bio']);
	$price= $conn -> real_escape_string($_POST['price']);
	$q="UPDATE doctors SET name='$name',phone='$phone',country='$country',
	postion='$postion',address='$address',bio='$bio',price='$price' WHERE id = $id";
	$conn->query($q);
	if($temp=$_FILES['image']['error']==0){
        $q2="UPDATE doctors SET image ='$newloc' WHERE id =$id";
		$conn->query($q2);
	}
	//header("Refresh:0");

}
$q="SELECT * FROM doctors WHERE id = $id";
$result=$conn->query($q);
?>
<!DOCTYPE html> 
<html lang="en">

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
									<li class="breadcrumb-item active" aria-current="page">Profile Settings</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Profile Settings</h2>
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
								include("include/sidebard.php")
								?>
							<!-- /Profile Sidebar -->
							
						</div>
						<?php
						foreach($result as $r){
							$name=explode(" ",$r['name']);
							$first=$name[0];
							$last=" ";
							if (sizeof($name)!=1)
								$last=end($name);

							?>
						<div class="col-md-7 col-lg-8 col-xl-9">
							<form action="doctor-profile-settings.php" method="POST" enctype="multipart/form-data">						
								<!-- Basic Information -->
								<div class="card">
									<div class="card-body">
										<h4 class="card-title">Basic Information</h4>
										<div class="row form-row">
											<div class="col-md-12">
												<div class="form-group">
													<div class="change-avatar">
														<div class="profile-img">
															<img src="<?=$r['image']?>" alt="User Image">
														</div>
														<div class="upload-img">
															<div class="change-photo-btn">
																<span><i class="fa fa-upload"></i> Upload Photo</span>
																<input type="file"  name="image" class="upload">
															</div>
															<small class="form-text text-muted">Allowed JPG, GIF or PNG. Max size of 2MB</small>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Username <span class="text-danger">*</span></label>
													<input type="text" class="form-control" readonly value="<?=$r['name']?>">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Email <span class="text-danger">*</span></label>
													<input type="email" class="form-control" readonly value="<?=$r['email']?>">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>First Name <span class="text-danger">*</span></label>
													<input type="text" class="form-control" name="first" value="<?=$first?>">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Last Name <span class="text-danger">*</span></label>
													<input type="text" class="form-control"name="last" value="<?=$last?>">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Phone Number</label>
													<input type="text" class="form-control" name="phone" value="<?=$r['phone']?>">
												</div>
											</div>
											
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">Country</label>
													<input type="text" class="form-control" name="country" value="<?=$r['country']?>">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">Postion</label>
													<input type="text" class="form-control" name="postion" value="<?=$r['postion']?>">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">Address</label>
													<input type="text" class="form-control" name="address" value="<?=$r['address']?>">
												</div>
											</div>
											
										</div>
									</div>
								</div>
								<!-- /Basic Information -->
								
								<!-- About Me -->
								<div class="card">
									<div class="card-body">
										<h4 class="card-title">About Me</h4>
										<div class="form-group mb-0">
											<label>Biography</label>
											<textarea class="form-control" rows="5" name="bio"> <?=$r['bio']?></textarea>
										</div>
									</div>
								</div>
								<!-- /About Me -->
								
								

								
								
								<!-- Pricing -->
								<div class="card">
									<div class="card-body">
										<h4 class="card-title">Pricing</h4>
										
										<div class="form-group mb-0">
											<div id="pricing_select">
												<input type="text" class="form-control" id="custom_rating_input" name="price" value="<?=$r['price']?>" placeholder="20">
											</div>

										</div>
										
										
										
									</div>
								</div>
								<!-- /Pricing -->
								
								
							
								
								
								<div class="submit-section submit-btn-bottom">
									<button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
								</div>
							</form>	
						</div>
						<?php
						}
						?>
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
		
		<!-- Select2 JS -->
		<script src="assets/plugins/select2/js/select2.min.js"></script>
		
		<!-- Dropzone JS -->
		<script src="assets/plugins/dropzone/dropzone.min.js"></script>
		
		<!-- Bootstrap Tagsinput JS -->
		<script src="assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.js"></script>
		
		<!-- Profile Settings JS -->
		<script src="assets/js/profile-settings.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>
		
	</body>

<!-- doccure/doctor-profile-settings.html  30 Nov 2019 04:12:15 GMT -->
</html>