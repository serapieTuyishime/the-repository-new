<html>
<head>
	<title>The repo | <?=$this->config->config["pageTitle"]?></title>
	<link rel="icon" href=" <?php echo base_url(); ?>assets/img/brand/favicon.png" type="image/png">
	<!-- <link rel="stylesheet" href="https://bootswatch.com/4/flatly/bootstrap.min.css"> -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style_few.css">

	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/nucleo/css/nucleo.css" type="text/css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">

	<!-- datatables -->
	<!-- for datatables new -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/datatables/dataTables.bootstrap4.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/datatables/buttons.dataTables.min.css">


	<!-- Page plugins -->
	<!-- Argon CSS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/argon.css?v=1.2.0" type="text/css">
	<!-- <script src="http://cdn.ckeditor.com/4.5.11/standard/ckeditor.js"></script> -->
</head>
<body>
	<!-- Sidenav -->
	<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
		<div class="scrollbar-inner">
			<!-- Brand -->
			<div class="sidenav-header  align-items-center">
				<a class="navbar-brand" href="javascript:void(0)">
					<img src="../assets/img/brand/blue.png" class="navbar-brand-img" alt="...">
				</a>
			</div>
			<div class="navbar-inner">
				<!-- Collapse -->
				<div class="collapse navbar-collapse" id="sidenav-collapse-main">
					<!-- Nav items -->
					<ul class="navbar-nav">
						<li class="nav-item">
							<a class="nav-link" href="<?php echo base_url(); ?>">
								<i class=" fa fa-home text-primary"></i>
								<span class="nav-link-text">Home</span>
							</a>
						</li>
						<!-- check login -->
						<?php if ($this->session->userdata('logged_in')): ?>
							<!-- if-else for the logged in user -->
							<li class="nav-item">
								<a class="nav-link" href="<?php echo base_url(); ?>dashboard/index">
									<i class=" ni ni-tv-2 text-red"></i>
									<span class="nav-link-text">Dashboard</span>
								</a>
							</li>
							<?php if ($this->session->userdata('userType') == 'admin'): ?>
								<li class="nav-item">
									<a class="nav-link" href="<?php echo base_url(); ?>schools/index">
										<i class="fa fa-map text-orange"></i>
										<span class="nav-link-text">Schools</span>
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="<?php echo base_url(); ?>departments/create">
										<i class="ni ni-single-02 text-yellow"></i>
										<span class="nav-link-text">Departments</span>
									</a>
								</li>
							<?php elseif($this->session->userdata('userType')== 'researcher'): ?>
								<li class="nav-item">
									<a class="nav-link" href="<?php echo base_url(); ?>resources/create">
										<i class="fa fa-upload text-cyan"></i>
										<span class="nav-link-text">Upload</span>
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="<?php echo base_url().'researchers/profile/'.$this->session->userdata('user_id'); ?>">
										<i class="fa fa-user text-orange"></i>
										<span class="nav-link-text">My profile</span>
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="<?php echo base_url(); ?>resources/show">
										<i class="fa fa-list text-yellow"></i>
										<span class="nav-link-text">My resources</span>
									</a>
								</li>
							<?php elseif($this->session->userdata('userType')== 'client'): ?>
								<li class="nav-item">
									<a class="nav-link" href="<?php echo base_url(); ?>resources/saved_for_later">
										<i class="fa fa-save text-cyan"></i>
										<span class="nav-link-text">Saved resources</span>
									</a>
								</li>
							<?php elseif($this->session->userdata('userType')== 'student'): ?>
								<li class="nav-item">
									<a class="nav-link" href="<?php echo base_url(); ?>resources/saved_for_later">
										<i class="fa fa-save text-cyan"></i>
										<span class="nav-link-text">Saved resources</span>
									</a>
								</li>
							<?php elseif($this->session->userdata('userType')== 'school'): ?>
								<li class="nav-item">
									<a class="nav-link" href="<?php echo base_url(); ?>students/create">
										<i class="fa fa-users text-primary"></i>
										<span class="nav-link-text">Students</span>
									</a>
								</li>
							<?php else: ?>

							<?php endif; ?>
						<?php else: ?>
							<li class="nav-item">
								<a class="nav-link" href="<?php echo base_url() ?>clients/login">
									<i class="ni ni-key-25 text-info"></i>
									<span class="nav-link-text">Login</span>
								</a>
							</li>
						<?php endif; ?>
						<li class="nav-item">
							<a class="nav-link" href="<?php echo base_url(); ?>resources/index">
								<i class="fa fa-list text-default"></i>
								<span class="nav-link-text">All resources</span>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?php echo base_url(); ?>departments/show">
								<i class="fa fa-boxes text-green"></i>
								<span class="nav-link-text">Categories</span>
							</a>
						</li>

						<li class="nav-item">
							<a class="nav-link" href="<?php echo base_url(); ?>packages/index">
								<i class="fa fa-database text-default"></i>
								<span class="nav-link-text">Packages</span>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?php echo base_url() ?>researchers/index">
								<i class="fa fa-users text-cyan"></i>
								<span class="nav-link-text">Researchers</span>
							</a>
						</li>
					</ul>
					<!-- Divider -->
					<hr class="my-3">
					<!-- Heading -->
					<h6 class="navbar-heading p-0 text-muted">
						<span class="docs-normal">Documentation</span>
					</h6>
					<!-- Navigation -->
					<ul class="navbar-nav mb-md-3">
						<li class="nav-item">
							<a class="nav-link" href="<?php echo base_url() ?>pages/agreement" target="_blank">
								<i class="ni ni-spaceship"></i>
								<span class="nav-link-text">License agreement</span>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?php echo base_url() ?>pages/view/about" target="">
								<i class="ni ni-spaceship"></i>
								<span class="nav-link-text">About</span>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</nav>

	<!-- Main content -->
	<div class="main-content" id="panel">
		<!-- topnav -->
		<nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
			<div class="container-fluid">
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<!-- Search form -->
					<form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main" action="<?php echo base_url() ?>search" method="post">
						<div class="form-group mb-0">
							<div class="input-group input-group-alternative input-group-merge">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-search"></i></span>
								</div>
								<input class="form-control" placeholder="Search" type="text" name="content" required>
							</div>
						</div>
						<button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
							<span aria-hidden="true">??</span>
						</button>
					</form>
					<!-- Navbar links -->
					<ul class="navbar-nav align-items-center  ml-md-auto ">
						<li class="nav-item d-xl-none">
							<!-- Sidenav toggler -->
							<div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
								<div class="sidenav-toggler-inner">
									<i class="sidenav-toggler-line"></i>
									<i class="sidenav-toggler-line"></i>
									<i class="sidenav-toggler-line"></i>
								</div>
							</div>
						</li>
						<li class="nav-item d-sm-none">
							<a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
								<i class="ni ni-zoom-split-in"></i>
							</a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="ni ni-bell-55"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-xl  dropdown-menu-right  py-0 overflow-hidden">
								<!-- Dropdown header -->
								<div class="px-3 py-3">
									<h6 class="text-sm text-muted m-0">There are <strong class="text-primary"><?php echo !empty($this->config->config["notifications"]) ?  count($this->config->config["notifications"]) :  '0' ; ?></strong> notifications.</h6>
								</div>
								<!-- List group -->
								<div class="list-group list-group-flush">
									<?php if (!empty($this->config->config['notifications'])): ?>
										<?php $count=0; foreach ($this->config->config['notifications'] as $key => $value): ?>
											<?php if ($this->session->userdata('userType') == $value['access']): ?>
													<!-- only print messages for the current user                                        -->

												<?php
												if ($count==5) {
													break;  #limited to five so they do not fill the whole page
												}
													++$count;

												?>
												<a href="#!" class="list-group-item list-group-item-action">
													<div class="row align-items-center">
														<div class="col ml--2">
															<div class="d-flex justify-content-between align-items-center">
																<div>
																	<h4 class="mb-0 text-sm"><?php echo $value['sender'] ?></h4>
																</div>
																<div class="text-right text-muted">
																	<small><?php echo $value['timeStamp']; ?></small>
																</div>
															</div>
															<p class="text-sm mb-0"><?php echo $value['subject']; ?></p>
														</div>
													</div>
												</a>
											<?php endif ?>
										<?php endforeach ?>
									<?php endif ?>
								</div>
								<!-- View all -->
								<a href="#!" class="dropdown-item text-center text-primary font-weight-bold py-3">View all</a>
							</div>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="ni ni-ungroup"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-dark bg-default  dropdown-menu-right ">
								<div class="row shortcuts px-4">
									<a href="#!" class="col-4 shortcut-item">
										<span class="shortcut-media avatar rounded-circle bg-gradient-red">
											<i class="ni ni-calendar-grid-58"></i>
										</span>
										<small>Calendar</small>
									</a>
									<a href="#!" class="col-4 shortcut-item">
										<span class="shortcut-media avatar rounded-circle bg-gradient-orange">
											<i class="ni ni-email-83"></i>
										</span>
										<small>Email</small>
									</a>
									<a href="#!" class="col-4 shortcut-item">
										<span class="shortcut-media avatar rounded-circle bg-gradient-info">
											<i class="ni ni-credit-card"></i>
										</span>
										<small>Payments</small>
									</a>
									<a href="#!" class="col-4 shortcut-item">
										<span class="shortcut-media avatar rounded-circle bg-gradient-green">
											<i class="ni ni-books"></i>
										</span>
										<small>Reports</small>
									</a>
									<a href="#!" class="col-4 shortcut-item">
										<span class="shortcut-media avatar rounded-circle bg-gradient-purple">
											<i class="ni ni-pin-3"></i>
										</span>
										<small>Maps</small>
									</a>
									<a href="#!" class="col-4 shortcut-item">
										<span class="shortcut-media avatar rounded-circle bg-gradient-yellow">
											<i class="ni ni-basket"></i>
										</span>
										<small>Shop</small>
									</a>
								</div>
							</div>
						</li>
					</ul>
					<ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
						<li class="nav-item dropdown">
							<a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<div class="media align-items-center">
									<span class="avatar avatar-sm rounded-circle">
										<img alt="Image placeholder" src="<?php echo base_url() ?>assets/images/users/user.png">
									</span>
									<div class="media-body  ml-2  d-none d-lg-block">
										<span class="mb-0 text-sm  font-weight-bold">
											<?php if ($this->session->userdata('logged_in')) {
												echo $this->session->userdata('username');
											}else {
												echo "John Snow";
											} ?>
									</span>
									</div>
								</div>
							</a>
							<div class="dropdown-menu  dropdown-menu-right ">
								<div class="dropdown-header noti-title">
									<h6 class="text-overflow m-0">Welcome!</h6>
								</div>
								<?php if ($this->session->userdata('logged_in')): ?>
									<a href="<?php echo base_url(). $this->session->userdata('userType'); ?>s/change_password" class="dropdown-item">
										<i class="ni ni-ui-04"></i>
										<span>Change password</span>
									</a>
									<a href="<?php echo base_url() ?>dashboard/logout" class="dropdown-item">
										<i class="ni ni-user-run"></i>
										<span>Logout</span>
									</a>
								<?php endif; ?>
								<!-- <a href="#!" class="dropdown-item">
									<i class="ni ni-single-02"></i>
									<span>My profile</span>
								</a> -->
								<a href="#!" class="dropdown-item">
									<i class="ni ni-settings-gear-65"></i>
									<span>Settings</span>
								</a>
								<a href="#!" class="dropdown-item">
									<i class="ni ni-calendar-grid-58"></i>
									<span>Activity</span>
								</a>
								<a href="#!" class="dropdown-item">
									<i class="ni ni-support-16"></i>
									<span>Support</span>
								</a>
								<div class="dropdown-divider"></div>

							</div>
						</li>
					</ul>
				</div>
			</div>
		</nav>

		<!-- Header -->
		<div class="header bg-primary pb-6">
		  <div class="container-fluid">
			<div class="header-body">
			  <div class="row align-items-center py-4">
				<div class="col-lg-6 col-7">
				  <h1 class=" text-white d-inline-block mb-0"><?=$this->config->config["pageTitle"]?></h1>
				</div>
				<div class="col-lg-6 col-5 text-right">
				  <!-- <a href="#" class="btn btn-sm btn-neutral">New</a> -->
				</div>
			  </div>
			</div>
		  </div>
		</div>

		<div class="container-fluid mt--6">
			<!-- Flash messages -->
			<?php if($this->session->flashdata('user_registered')): ?>
				<?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_registered').'</p>'; ?>
			<?php endif; ?>

			<?php if($this->session->flashdata('created')): ?>
				<?php echo '<p class="alert alert-success">'.$this->session->flashdata('created').'</p>'; ?>
			<?php endif; ?>

			<?php if($this->session->flashdata('not_matching')): ?>
				<?php echo '<p class="alert alert-warning">'.$this->session->flashdata('not_matching').'</p>'; ?>
			<?php endif; ?>


			<?php if($this->session->flashdata('login_failed')): ?>
				<?php echo '<p class="alert alert-danger">'.$this->session->flashdata('login_failed').'</p>'; ?>
			<?php endif; ?>


			<?php if($this->session->flashdata('deleted')): ?>
				<?php echo '<p class="alert alert-success">'.$this->session->flashdata('deleted').'</p>'; ?>
			<?php endif; ?>
