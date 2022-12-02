<?php
include ("include/conn.php");
$id=	$_SESSION['login'];
$q="SELECT * FROM doctors WHERE id = $id";
$rusalt =$conn->query($q);

?>
<div class="profile-sidebar">
                <?php
					foreach($rusalt as $r){
				?>
								<div class="widget-profile pro-widget-content">
									<div class="profile-info-widget">
										<a href="#" class="booking-doc-img">
											<img src="<?=$r['image']?>" alt="User Image">
										</a>
										<div class="profile-det-info">
											<h3>Dr. <?=$r['name']?></h3>
											
											<div class="patient-details">
												<h5 class="mb-0"><?=$r['postion']?></h5>
											</div>
										</div>
									</div>
								</div>
				<?php
					}
				?>				
								<div class="dashboard-widget">
									<nav class="dashboard-menu">
										<ul>
											<li>
												<a href="doctor-dashboard.php">
													<i class="fas fa-columns"></i>
													<span>Dashboard</span>
												</a>
											</li>
											<li>
												<a href="appointments.php">
													<i class="fas fa-calendar-check"></i>
													<span>Appointments</span>
												</a>
											</li>
											
										
											<li>
												<a href="doctor-profile-settings.php">
													<i class="fas fa-user-cog"></i>
													<span>Profile Settings</span>
												</a>
											</li>
											<li>
                                                <a href="doctor-change-password.php">
                                                    <i class="fas fa-lock"></i>
                                                    <span>Change Password</span>
                                                </a>
                                            </li>
											<li>
												<a href="doctorlogin.php">
													<i class="fas fa-sign-out-alt"></i>
													<span>Logout</span>
												</a>
											</li>
										</ul>
									</nav>
								</div>
							</div>