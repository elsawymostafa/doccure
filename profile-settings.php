<?php
include("include/conn.php");
include("include/header.html");
session_start();
if ($_SESSION['login']==0)
	{header("Location: login.php");
	$_SESSION['errorl']="You Must login first";	
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
	$zip= $conn -> real_escape_string($_POST['zip']);
	$address= $conn -> real_escape_string($_POST['address']);
	$blood= $conn -> real_escape_string($_POST['blood']);
	$city= $conn -> real_escape_string($_POST['city']);
	$state= $conn -> real_escape_string($_POST['state']);
	$birthdate= $conn -> real_escape_string($_POST['birthdate']);
	$q="UPDATE patient SET name='$name',phone='$phone',country='$country',
	zip='$zip',address='$address',blood='$blood',city='$city',state='$state',birthdate='$birthdate' WHERE id = $id";
	$conn->query($q);
	if($temp=$_FILES['image']['error']==0){
        $q2="UPDATE patient SET image ='$newloc' WHERE id =$id";
		$conn->query($q2);
	}
	//header("Refresh:0");

}
$q="SELECT * FROM patient WHERE id = $id";
$result=$conn->query($q);
?>
<!DOCTYPE html> 
<html lang="en">
	
<!-- doccure/profile-settings.html  30 Nov 2019 04:12:18 GMT -->
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
					<?php
include("include/sidebar.php");
?>
						
						<!-- /Profile Sidebar -->
						<?php
						foreach($result as $r){
							$name=explode(" ",$r['name']);
							$first=$name[0];
							$last=" ";
							if (sizeof($name)!=1)
								$last=end($name);

							?>
						
						<div class="col-md-7 col-lg-8 col-xl-9">
							<div class="card">
								<div class="card-body">
									
									<!-- Profile Settings Form -->
									<form  method="POST" enctype="multipart/form-data">
										<div class="row form-row">
											<div class="col-12 col-md-12">
												<div class="form-group">
													<div class="change-avatar">
														<div class="profile-img">
															<img src="<?=$r['image']?>" alt="User Image">
														</div>
														<div class="upload-img">
															<div class="change-photo-btn">
																<span><i class="fa fa-upload"></i> Upload Photo</span>
																<input type="file" class="upload" name="image">
															</div>
															<small class="form-text text-muted">Allowed JPG, GIF or PNG. Max size of 2MB</small>
														</div>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>First Name</label>
													<input type="text" class="form-control" value="<?=$first?> "name="first">
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Last Name</label>
													<input type="text" class="form-control" value="<?=$last?>" name="last">
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Date of Birth</label>
													<div class="cal-icon">
														<input type="text" class="form-control datetimepicker" value="<?=$r['birthdate']?>" name="birthdate">
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Blood Group</label>
													<select class="form-control select"  name="blood" >
														<option <?php  if($r['blood']=='A-') echo'selected'; ?>>A- </option>
														<option <?php  if($r['blood']=='A+') echo'selected'; ?>>A+ </option>
														<option <?php  if($r['blood']=='B-') echo'selected'; ?>>B- </option>
														<option <?php  if($r['blood']=='B+') echo'selected'; ?>>B+ </option>
														<option <?php if($r['blood']=='AB-') echo'selected'; ?>>AB-</option>
														<option <?php if($r['blood']=='AB+') echo'selected'; ?>>AB+</option>
														<option <?php  if($r['blood']=='O-') echo'selected'; ?>>O- </option>
														<option <?php  if($r['blood']=='O+') echo'selected'; ?>>O+ </option>
													</select>
												</div>
											</div>
											
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Mobile</label>
													<input type="text" value="<?=$r['phone']?>" class="form-control" name="phone">
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
												<label>Address</label>
													<input type="text" class="form-control" value="<?=$r['address']?>" name="address">
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>City</label>
													<input type="text" class="form-control" value="<?=$r['city']?>" name="city">
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>State</label>
													<input type="text" class="form-control" value="<?=$r['state']?>" name="state">
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Zip Code</label>
													<input type="text" class="form-control" value="<?=$r['zip']?>" name ="zip">
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Country</label>
													<input type="text" class="form-control" value="<?=$r['country']?>" name="country">
												</div>
											</div>
										</div>
										<div class="submit-section">
											<button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
										</div>
									</form>
									<!-- /Profile Settings Form -->
									
								</div>
							</div>
						</div>	
					</div>

				</div>	
			</div>	
			<?php
			}
			?>
			<!-- /Page Content -->
       
			
		   
		</div>
		<!-- /Main Wrapper -->
	  
		<!-- jQuery -->
		<script src="assets/js/jquery.min.js"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="assets/js/popper.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		
		<!-- Select2 JS -->
		<script src="assets/plugins/select2/js/select2.min.js"></script>
		
		<!-- Datetimepicker JS -->
		<script src="assets/js/moment.min.js"></script>
		<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
		
		<!-- Sticky Sidebar JS -->
        <script src="assets/plugins/theia-sticky-sidebar/ResizeSensor.js"></script>
        <script src="assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>
		
	</body>

<!-- doccure/profile-settings.html  30 Nov 2019 04:12:18 GMT -->
</html>