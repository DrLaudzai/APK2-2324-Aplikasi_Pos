<?php
@session_start();
require_once "../inc/functions.php";

/* kita akan cek apakah sudah login apa belum, jika sudah dia levelnya apa, maka harus kita arahkan sesuai levelnya
Jika Berhasil login, maka user akan kita arahkan ke halaman admin sesuai dengan level user
Jika dia level admin ===> admin/index.php
Jika dia level petugas===> petugas/index.php
Jika dia level penyewa ===> penyewa/index.php
*/

if (@$_SESSION['email']) {
	if (@$_SESSION['email'] == "Admin") {
		header("location:../admin/index.php");
	} else {
		if (@$_SESSION['level'] == "Petugas") {
			header("location:../petugas/index.php");
		} elseif (@$_SESSION['level'] == "Penyewa") {
			header("location:../penyewa/index.php");
		} elseif (@$_SESSION['level'] == "Owner") {
			header("location:../owner/index.php");
		} elseif (@$_SESSION['level'] == "Karyawan") {
			header("location:../karyawan/index.php");
		}
	}
} else {
	header("location:../inc/login.php");
}

// Ambil Data User yang Login
$email = $_SESSION['email'];
//echo $email;
$sql_login = tampil("SELECT `tbl_admin`.*, `tbl_users`.*, `tbl_tipe_user`.*FROM `tbl_admin` 
	LEFT JOIN `tbl_users` ON `tbl_admin`.`id_user` = `tbl_users`.`id_user` 
	LEFT JOIN `tbl_tipe_user` ON `tbl_users`.`role` = `tbl_tipe_user`.`id_tipe_user` WHERE tbl_users.email='$email'");
//var_dump($sql_login);

foreach ($sql_login as $user_login) {
	$nama_user = $user_login['nama_admin'];
	$tipe_user = $user_login['tipe_user'];
}

// echo $nama_user, "|" . $tipe_user;



?>












<!DOCTYPE html>
<!--
Template Name: Stack - Stack - Bootstrap 4 Admin Template
Author: PixInvent
Website: http://www.pixinvent.com/
Contact: hello@pixinvent.com
Follow: www.twitter.com/pixinvents
Like: www.facebook.com/pixinvents
Purchase: https://1.envato.market/stack_admin
Renew Support: https://1.envato.market/stack_admin
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.

-->
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<!-- Mirrored from demos.pixinvent.com/stack-html-admin-template/html/ltr/vertical-modern-menu-template/dt-basic-initialization.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 14 Sep 2024 11:43:02 GMT -->

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta name="description" content="Stack admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
	<meta name="keywords" content="admin template, stack admin template, dashboard template, flat admin template, responsive admin template, web app">
	<meta name="author" content="PIXINVENT">
	<title>ZAIS ADMIN</title>
	<link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
	<link rel="shortcut icon" type="image/x-icon" href="https://demos.pixinvent.com/stack-html-admin-template/app-assets/images/ico/favicon.ico">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

	<!-- BEGIN: Vendor CSS-->
	<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
	<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/datatables.min.css">
	<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/file-uploaders/dropzone.min.css">
	<!-- END: Vendor CSS-->

	<!-- BEGIN: Theme CSS-->
	<link rel="stylesheet" type="text/css" href="../../../app-assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../../../app-assets/css/bootstrap-extended.min.css">
	<link rel="stylesheet" type="text/css" href="../../../app-assets/css/colors.min.css">
	<link rel="stylesheet" type="text/css" href="../../../app-assets/css/components.min.css">

	<!-- END: Theme CSS-->

	<!-- BEGIN: Page CSS-->
	<link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
	<link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/colors/palette-gradient.min.css">
	<link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/file-uploaders/dropzone.min.css">
	<!-- END: Page CSS-->

	<!-- BEGIN: Custom CSS-->
	<link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
	<!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

	<!-- BEGIN: Header-->
	<nav class="header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top navbar-semi-dark navbar-shadow">
		<div class="navbar-wrapper">
			<div class="navbar-header">
				<ul class="nav navbar-nav flex-row">
					<li class="nav-item mobile-menu d-lg-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"></i></a></li>
					<li class="nav-item mr-auto"><a class="navbar-brand" href="index.html"><img class="brand-logo" alt="stack admin logo" src="../app-assets/images/logo/stack-logo-light.png">
							<h2 class="brand-text">Stack</h2>
						</a></li>
					<li class="nav-item d-none d-lg-block nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"></a></li>
					<li class="nav-item d-lg-none"><a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"></a></li>
				</ul>
			</div>
			<div class="navbar-container content">
				<div class="collapse navbar-collapse" id="navbar-mobile">
					<ul class="nav navbar-nav mr-auto float-left">
						<li class="dropdown nav-item mega-dropdown d-none d-lg-block"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">Mega</a>
							<ul class="mega-dropdown-menu dropdown-menu row p-1">
								<li class="col-md-4 bg-mega p-2">
									<h3 class="text-white mb-1 font-weight-bold">Mega Menu Sidebar</h3>
									<p class="text-white line-height-2">Candy canes bonbon toffee. Cheesecake dragée gummi bears chupa chups powder bonbon. Apple pie cookie sweet.</p>
									<button class="btn btn-outline-white">Learn More</button>
								</li>
								<li class="col-md-5 px-2">
									<h6 class="font-weight-bold font-medium-2 ml-1">Apps</h6>
									<ul class="row mt-2">
										<li class="col-6 col-xl-4"><a class="text-center mb-2 mb-xl-3" href="app-email.html" target="_blank"></i>
												<p class="font-medium-2 mt-25 mb-0">Email</p>
											</a></li>
										<li class="col-6 col-xl-4"><a class="text-center mb-2 mb-xl-3" href="app-chat.html" target="_blank"></i>
												<p class="font-medium-2 mt-25 mb-0">Chat</p>
											</a></li>
										<li class="col-6 col-xl-4"><a class="text-center mb-2 mb-xl-3 mt-75 mt-xl-0" href="app-todo.html" target="_blank"></i>
												<p class="font-medium-2 mt-25 mb-0">Todo</p>
											</a></li>
										<li class="col-6 col-xl-4"><a class="text-center mb-2 mt-75 mt-xl-0" href="app-kanban.html" target="_blank"></i>
												<p class="font-medium-2 mt-25 mb-50">Kanban</p>
											</a></li>
										<li class="col-6 col-xl-4"><a class="text-center mb-2 mt-75 mt-xl-0" href="app-contacts.html" target="_blank"></i>
												<p class="font-medium-2 mt-25 mb-50">Contacts</p>
											</a></li>
										<li class="col-6 col-xl-4"><a class="text-center mb-2 mt-75 mt-xl-0" href="invoice-template.html" target="_blank"></i>
												<p class="font-medium-2 mt-25 mb-50">Invoice</p>
											</a></li>
									</ul>
								</li>
								<li class="col-md-3">
									<h6 class="font-weight-bold font-medium-2">Components</h6>
									<ul class="row mt-1 mt-xl-2">
										<li class="col-12 col-xl-6 pl-0">
											<ul class="mega-component-list">
												<li class="mega-component-item"><a class="mb-1 mb-xl-2" href="component-alerts.html" target="_blank">Alert</a></li>
												<li class="mega-component-item"><a class="mb-1 mb-xl-2" href="component-callout.html" target="_blank">Callout</a></li>
												<li class="mega-component-item"><a class="mb-1 mb-xl-2" href="component-buttons-basic.html" target="_blank">Buttons</a></li>
												<li class="mega-component-item"><a class="mb-1 mb-xl-2" href="component-carousel.html" target="_blank">Carousel</a></li>
											</ul>
										</li>
										<li class="col-12 col-xl-6 pl-0">
											<ul class="mega-component-list">
												<li class="mega-component-item"><a class="mb-1 mb-xl-2" href="component-dropdowns.html" target="_blank">Drop Down</a></li>
												<li class="mega-component-item"><a class="mb-1 mb-xl-2" href="component-list-group.html" target="_blank">List Group</a></li>
												<li class="mega-component-item"><a class="mb-1 mb-xl-2" href="component-modals.html" target="_blank">Modals</a></li>
												<li class="mega-component-item"><a class="mb-1 mb-xl-2" href="component-pagination.html" target="_blank">Pagination</a></li>
											</ul>
										</li>
									</ul>
								</li>
							</ul>
						</li>
						<li class="nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="#"></a></li>
						<li class="nav-item nav-search"><a class="nav-link nav-link-search" href="#"></i></a>
							<div class="search-input">
								<input class="input" type="text" placeholder="Explore Stack..." tabindex="0" data-search="template-search">
								<div class="search-input-close"><i class="feather icon-x"></i></div>
								<ul class="search-list"></ul>
							</div>
						</li>
					</ul>
					<ul class="nav navbar-nav float-right">
						<li class="dropdown dropdown-language nav-item"><a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-gb"></i><span class="selected-language"></span></a>
							<div class="dropdown-menu" aria-labelledby="dropdown-flag"><a class="dropdown-item" href="#" data-language="en"><i class="flag-icon flag-icon-us"></i> English</a><a class="dropdown-item" href="#" data-language="fr"><i class="flag-icon flag-icon-fr"></i> French</a><a class="dropdown-item" href="#" data-language="pt"><i class="flag-icon flag-icon-pt"></i> Portuguese</a><a class="dropdown-item" href="#" data-language="de"><i class="flag-icon flag-icon-de"></i> German</a></div>
						</li>
						<li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"></i><span class="badge badge-pill badge-danger badge-up"></span></a>
							<ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
								<li class="dropdown-menu-header">
									<h6 class="dropdown-header m-0"><span class="grey darken-2">Notifications</span><span class="notification-tag badge badge-danger float-right m-0"></span></h6>
								</li>
								<li class="scrollable-container media-list"><a href="javascript:void(0)">
										<div class="media">
											<div class="media-left align-self-center"><i class="feather icon-plus-square icon-bg-circle bg-cyan"></i></div>
											<div class="media-body">
												<h6 class="media-heading">You have new order!</h6>
												<p class="notification-text font-small-3 text-muted">Lorem ipsum dolor sit amet, consectetuer elit.</p><small>
													<time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">30 minutes ago</time></small>
											</div>
										</div>
									</a><a href="javascript:void(0)">
										<div class="media">
											<div class="media-left align-self-center"><i class="feather icon-download-cloud icon-bg-circle bg-red bg-darken-1"></i></div>
											<div class="media-body">
												<h6 class="media-heading red darken-1">99% Server load</h6>
												<p class="notification-text font-small-3 text-muted">Aliquam tincidunt mauris eu risus.</p><small>
													<time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Five hour ago</time></small>
											</div>
										</div>
									</a><a href="javascript:void(0)">
										<div class="media">
											<div class="media-left align-self-center"><i class="feather icon-alert-triangle icon-bg-circle bg-yellow bg-darken-3"></i></div>
											<div class="media-body">
												<h6 class="media-heading yellow darken-3">Warning notifixation</h6>
												<p class="notification-text font-small-3 text-muted">Vestibulum auctor dapibus neque.</p><small>
													<time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Today</time></small>
											</div>
										</div>
									</a><a href="javascript:void(0)">
										<div class="media">
											<div class="media-left align-self-center"><i class="feather icon-check-circle icon-bg-circle bg-cyan"></i></div>
											<div class="media-body">
												<h6 class="media-heading">Complete the task</h6><small>
													<time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Last week</time></small>
											</div>
										</div>
									</a><a href="javascript:void(0)">
										<div class="media">
											<div class="media-left align-self-center"><i class="feather icon-file icon-bg-circle bg-teal"></i></div>
											<div class="media-body">
												<h6 class="media-heading">Generate monthly report</h6><small>
													<time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Last month</time></small>
											</div>
										</div>
									</a></li>
								<li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center" href="javascript:void(0)">Read all notifications</a></li>
							</ul>
						</li>
						<li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class=""></i><span class="badge badge-pill badge-warning badge-up"></span></a>
							<ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
								<li class="dropdown-menu-header">
									<h6 class="dropdown-header m-0"><span class="grey darken-2">Messages</span><span class="notification-tag badge badge-warning float-right m-0"></span></h6>
								</li>
								<li class="scrollable-container media-list"><a href="javascript:void(0)">
										<div class="media">
											<div class="media-left">
												<div class="avatar avatar-online avatar-sm rounded-circle"><img src="../app-assets/images/portrait/small/avatar-s-1.png" alt="avatar"><i></i></div>
											</div>
											<div class="media-body">
												<h6 class="media-heading">Margaret Govan</h6>
												<p class="notification-text font-small-3 text-muted">I like your portfolio, let's start.</p><small>
													<time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Today</time></small>
											</div>
										</div>
									</a><a href="javascript:void(0)">
										<div class="media">
											<div class="media-left"><span class="avatar avatar-sm avatar-busy rounded-circle"><img src="../app-assets/images/portrait/small/avatar-s-2.png" alt="avatar"><i></i></span></div>
											<div class="media-body">
												<h6 class="media-heading">Bret Lezama</h6>
												<p class="notification-text font-small-3 text-muted">I have seen your work, there is</p><small>
													<time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Tuesday</time></small>
											</div>
										</div>
									</a><a href="javascript:void(0)">
										<div class="media">
											<div class="media-left">
												<div class="avatar avatar-online avatar-sm rounded-circle"><img src="../app-assets/images/portrait/small/avatar-s-3.png" alt="avatar"><i></i></div>
											</div>
											<div class="media-body">
												<h6 class="media-heading">Carie Berra</h6>
												<p class="notification-text font-small-3 text-muted">Can we have call in this week ?</p><small>
													<time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Friday</time></small>
											</div>
										</div>
									</a><a href="javascript:void(0)">
										<div class="media">
											<div class="media-left"><span class="avatar avatar-sm avatar-away rounded-circle"><img src="../app-assets/images/portrait/small/avatar-s-6.png" alt="avatar"><i></i></span></div>
											<div class="media-body">
												<h6 class="media-heading">Eric Alsobrook</h6>
												<p class="notification-text font-small-3 text-muted">We have project party this saturday.</p><small>
													<time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">last month</time></small>
											</div>
										</div>
									</a></li>
								<li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center" href="javascript:void(0)">Read all messages</a></li>
							</ul>
						</li>
						<li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
								<div class="avatar avatar-online"><img src="../app-assets/images/portrait/small/avatar-s-1.png" alt="avatar"><i></i></div><span class="user-name"><?php echo $nama_user; ?> | <?php echo $tipe_user; ?></span>
							</a>
							<div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="user-profile.html"></i> Edit Profile</a><a class="dropdown-item" href="app-email.html"></i> My Inbox</a><a class="dropdown-item" href="user-cards.html"></i> Task</a><a class="dropdown-item" href="app-chat.html"></i> Chats</a>
								<div class="dropdown-divider"></div><a class="dropdown-item" href="../inc/logout.php"></i> Logout</a>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</nav>
	<!-- END: Header-->


	<!-- BEGIN: Main Menu-->
	<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
		<div class="main-menu-content">
			<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
				<li class=" navigation-header"><span>General</span><i class="feather icon-minus" data-toggle="tooltip" data-placement="right" data-original-title="General"></i>
				</li>
				<li class=" nav-item"><a href="index.html"></i><span class="menu-title" data-i18n="Dashboard">Dashboard</span><span class="badge badge badge-primary badge-pill float-right mr-2"></span></a>
				</li>
				<li class=" nav-item"><a href="index.html"></i><span class="menu-title" data-i18n="Dashboard">Master</span><span class="badge badge badge-primary badge-pill float-right mr-2"></span></a>
					<ul class="menu-content">
						<li><a class="menu-item" href="?pages=user_admin">User Admin</a>
						</li>
						<li><a class="menu-item" href="?pages=user_petugas">User Petugas</a>
						</li>
						<li><a class="menu-item" href="?pages=branch">Branch</a>
						</li>
						<li><a class="menu-item" href="?pages=karyawan">Karyawan</a>
						</li>
						<li><a class="menu-item" href="?pages=pemilik">Owner</a>
						</li>
						<li><a class="menu-item" href="?pages=jabatan">Jabatan</a>
						</li>
						<li><a class="menu-item" href="?pages=tahun">Tahun</a>
						</li>
						<li><a class="menu-item" href="?pages=bulan">Bulan</a>
						</li>
						<li><a class="menu-item" href="?pages=currency">Currency</a>
						</li>
						<li><a class="menu-item" href="?pages=floor">Floor</a>
						</li>
						<li><a class="menu-item" href="?pages=facility">Facility</a>
						</li>
						<li><a class="menu-item" href="?pages=tipeunit">Tipe Unit</a>
						</li>

				</li>
			</ul>
			</li>
			</ul>
		</div>
	</div>
	<!-- END: Main Menu-->

	<!-- BEGIN: Content-->
	<div class="content-body"><!-- Zero configuration table -->

		<!--/ Zero configuration table -->
		<!-- Default ordering table -->
		<?php
		include '../inc/menu.php';
		?>
		<!--/ Default ordering table -->
		<!-- Multi-column ordering table -->

	</div>
	</div>
	<!-- END: Content-->


	<!-- BEGIN: Customizer-->
	<div class="customizer border-left-blue-grey border-left-lighten-4 d-none d-xl-block"><a class="customizer-close" href="#"></i></a><a class="customizer-toggle bg-danger" href="#"></a>
		<div class="customizer-content p-2">;
			<h4 class="text-uppercase mb-0">Theme Customizer</h4>;
			<hr>
			<p>Customize & Preview in Real Time</p>

			<h5 class="mt-1 text-bold-500">Layout Options</h5>
			<ul class="nav nav-tabs nav-underline nav-justified layout-options">
				<li class="nav-item">
					<a class="nav-link layouts active" id="baseIcon-tab21-base" data-toggle="tab" aria-controls="tabIcon21-base" href="#tabIcon21-base" aria-expanded="true">Layouts</a>
				</li>
				<li class="nav-item">
					<a class="nav-link navigation" id="baseIcon-tab22-base" data-toggle="tab" aria-controls="tabIcon22-base" href="#tabIcon22-base" aria-expanded="false">Navigation</a>
				</li>
				<li class="nav-item">
					<a class="nav-link navbar" id="baseIcon-tab23-base" data-toggle="tab" aria-controls="tabIcon23-base" href="#tabIcon23-base" aria-expanded="false">Navbar</a>
				</li>
			</ul>
			<div class="tab-content px-1 pt-1">
				<div role="tabpanel" class="tab-pane active" id="tabIcon21-base" aria-expanded="true" aria-labelledby="baseIcon-tab21-base">

					<div class="custom-control custom-checkbox mb-1">
						<input type="checkbox" class="custom-control-input" name="collapsed-sidebar" id="collapsed-sidebar">
						<label class="custom-control-label" for="collapsed-sidebar">Collapsed Menu</label>
					</div>

					<div class="custom-control custom-checkbox mb-1">
						<input type="checkbox" class="custom-control-input" name="fixed-layout" id="fixed-layout">
						<label class="custom-control-label" for="fixed-layout">Fixed Layout</label>
					</div>

					<div class="custom-control custom-checkbox mb-1">
						<input type="checkbox" class="custom-control-input" name="boxed-layout" id="boxed-layout">
						<label class="custom-control-label" for="boxed-layout">Boxed Layout</label>
					</div>

					<div class="custom-control custom-checkbox mb-1">
						<input type="checkbox" class="custom-control-input" name="static-layout" id="static-layout">
						<label class="custom-control-label" for="static-layout">Static Layout</label>
					</div>

				</div>
				<div class="tab-pane" id="tabIcon22-base" aria-labelledby="baseIcon-tab22-base">

					<div class="custom-control custom-checkbox mb-1">
						<input type="checkbox" class="custom-control-input" name="native-scroll" id="native-scroll">
						<label class="custom-control-label" for="native-scroll">Native Scroll</label>
					</div>

					<div class="custom-control custom-checkbox mb-1">
						<input type="checkbox" class="custom-control-input" name="right-side-icons" id="right-side-icons">
						<label class="custom-control-label" for="right-side-icons">Right Side Icons</label>
					</div>

					<div class="custom-control custom-checkbox mb-1">
						<input type="checkbox" class="custom-control-input" name="bordered-navigation" id="bordered-navigation">
						<label class="custom-control-label" for="bordered-navigation">Bordered Navigation</label>
					</div>

					<div class="custom-control custom-checkbox mb-1">
						<input type="checkbox" class="custom-control-input" name="flipped-navigation" id="flipped-navigation">
						<label class="custom-control-label" for="flipped-navigation">Flipped Navigation</label>
					</div>

					<div class="custom-control custom-checkbox mb-1">
						<input type="checkbox" class="custom-control-input" name="collapsible-navigation" id="collapsible-navigation">
						<label class="custom-control-label" for="collapsible-navigation">Collapsible Navigation</label>
					</div>

					<div class="custom-control custom-checkbox mb-1">
						<input type="checkbox" class="custom-control-input" name="static-navigation" id="static-navigation">
						<label class="custom-control-label" for="static-navigation">Static Navigation</label>
					</div>

				</div>
				<div class="tab-pane" id="tabIcon23-base" aria-labelledby="baseIcon-tab23-base">

					<div class="custom-control custom-checkbox mb-1">
						<input type="checkbox" class="custom-control-input" name="brand-center" id="brand-center">
						<label class="custom-control-label" for="brand-center">Brand Center</label>
					</div>

					<div class="custom-control custom-checkbox mb-1">
						<input type="checkbox" class="custom-control-input" name="navbar-static-top" id="navbar-static-top">
						<label class="custom-control-label" for="navbar-static-top">Static Top</label>
					</div>

				</div>
			</div>

			<hr>

			<h5 class="mt-1 text-bold-500">Navigation Color Options</h5>
			<ul class="nav nav-tabs nav-underline nav-justified color-options">
				<li class="nav-item">
					<a class="nav-link nav-semi-light active" id="color-opt-1" data-toggle="tab" aria-controls="clrOpt1" href="#clrOpt1" aria-expanded="false">Semi Light</a>
				</li>
				<li class="nav-item">
					<a class="nav-link nav-semi-dark" id="color-opt-2" data-toggle="tab" aria-controls="clrOpt2" href="#clrOpt2" aria-expanded="false">Semi Dark</a>
				</li>
				<li class="nav-item">
					<a class="nav-link nav-dark" id="color-opt-3" data-toggle="tab" aria-controls="clrOpt3" href="#clrOpt3" aria-expanded="false">Dark</a>
				</li>
				<li class="nav-item">
					<a class="nav-link nav-light" id="color-opt-4" data-toggle="tab" aria-controls="clrOpt4" href="#clrOpt4" aria-expanded="true">Light</a>
				</li>
			</ul>
			<div class="tab-content px-1 pt-1">
				<div role="tabpanel" class="tab-pane active" id="clrOpt1" aria-expanded="true" aria-labelledby="color-opt-1">
					<div class="row">
						<div class="col-6">
							<h6>Solid</h6>

							<div class="custom-control custom-radio mb-1">
								<input type="radio" name="nav-slight-clr" class="custom-control-input bg-blue-grey" data-bg="bg-blue-grey" id="default-solid">
								<label class="custom-control-label" for="default-solid">Default</label>
							</div>

							<div class="custom-control custom-radio mb-1">
								<input type="radio" name="nav-slight-clr" class="custom-control-input bg-primary" data-bg="bg-primary" id="primary-solid">
								<label class="custom-control-label" for="primary-solid">Primary</label>
							</div>

							<div class="custom-control custom-radio mb-1">
								<input type="radio" name="nav-slight-clr" class="custom-control-input bg-danger" data-bg="bg-danger" id="danger-solid">
								<label class="custom-control-label" for="danger-solid">Danger</label>
							</div>

							<div class="custom-control custom-radio mb-1">
								<input type="radio" name="nav-slight-clr" class="custom-control-input bg-success" data-bg="bg-success" id="success-solid">
								<label class="custom-control-label" for="success-solid">Success</label>
							</div>

							<div class="custom-control custom-radio mb-1">
								<input type="radio" name="nav-slight-clr" class="custom-control-input bg-blue" data-bg="bg-blue" id="blue">
								<label class="custom-control-label" for="blue">Blue</label>
							</div>

							<div class="custom-control custom-radio mb-1">
								<input type="radio" name="nav-slight-clr" class="custom-control-input bg-cyan" data-bg="bg-cyan" id="cyan">
								<label class="custom-control-label" for="cyan">Cyan</label>
							</div>

							<div class="custom-control custom-radio mb-1">
								<input type="radio" name="nav-slight-clr" class="custom-control-input bg-pink" data-bg="bg-pink" id="pink">
								<label class="custom-control-label" for="pink">Pink</label>
							</div>

						</div>
						<div class="col-6">
							<h6>Gradient</h6>

							<div class="custom-control custom-radio mb-1">
								<input type="radio" name="nav-slight-clr" checked class="custom-control-input bg-blue-grey" data-bg="bg-gradient-x-grey-blue" id="bg-gradient-x-grey-blue">
								<label class="custom-control-label" for="bg-gradient-x-grey-blue">Default</label>
							</div>

							<div class="custom-control custom-radio mb-1">
								<input type="radio" name="nav-slight-clr" class="custom-control-input bg-primary" data-bg="bg-gradient-x-primary" id="bg-gradient-x-primary">
								<label class="custom-control-label" for="bg-gradient-x-primary">Primary</label>
							</div>

							<div class="custom-control custom-radio mb-1">
								<input type="radio" name="nav-slight-clr" class="custom-control-input bg-danger" data-bg="bg-gradient-x-danger" id="bg-gradient-x-danger">
								<label class="custom-control-label" for="bg-gradient-x-danger">Danger</label>
							</div>

							<div class="custom-control custom-radio mb-1">
								<input type="radio" name="nav-slight-clr" class="custom-control-input bg-success" data-bg="bg-gradient-x-success" id="bg-gradient-x-success">
								<label class="custom-control-label" for="bg-gradient-x-success">Success</label>
							</div>

							<div class="custom-control custom-radio mb-1">
								<input type="radio" name="nav-slight-clr" class="custom-control-input bg-blue" data-bg="bg-gradient-x-blue" id="bg-gradient-x-blue">
								<label class="custom-control-label" for="bg-gradient-x-blue">Blue</label>
							</div>

							<div class="custom-control custom-radio mb-1">
								<input type="radio" name="nav-slight-clr" class="custom-control-input bg-cyan" data-bg="bg-gradient-x-cyan" id="bg-gradient-x-cyan">
								<label class="custom-control-label" for="bg-gradient-x-cyan">Cyan</label>
							</div>

							<div class="custom-control custom-radio mb-1">
								<input type="radio" name="nav-slight-clr" class="custom-control-input bg-pink" data-bg="bg-gradient-x-pink" id="bg-gradient-x-pink">
								<label class="custom-control-label" for="bg-gradient-x-pink">Pink</label>
							</div>

						</div>
					</div>
				</div>
				<div class="tab-pane" id="clrOpt2" aria-labelledby="color-opt-2">

					<div class="custom-control custom-radio mb-1">
						<input type="radio" name="nav-sdark-clr" checked class="custom-control-input bg-default" data-bg="bg-default" id="opt-default">
						<label class="custom-control-label" for="opt-default">Default</label>
					</div>

					<div class="custom-control custom-radio mb-1">
						<input type="radio" name="nav-sdark-clr" class="custom-control-input bg-primary" data-bg="bg-primary" id="opt-primary">
						<label class="custom-control-label" for="opt-primary">Primary</label>
					</div>

					<div class="custom-control custom-radio mb-1">
						<input type="radio" name="nav-sdark-clr" class="custom-control-input bg-danger" data-bg="bg-danger" id="opt-danger">
						<label class="custom-control-label" for="opt-danger">Danger</label>
					</div>

					<div class="custom-control custom-radio mb-1">
						<input type="radio" name="nav-sdark-clr" class="custom-control-input bg-success" data-bg="bg-success" id="opt-success">
						<label class="custom-control-label" for="opt-success">Success</label>
					</div>

					<div class="custom-control custom-radio mb-1">
						<input type="radio" name="nav-sdark-clr" class="custom-control-input bg-blue" data-bg="bg-blue" id="opt-blue">
						<label class="custom-control-label" for="opt-blue">Blue</label>
					</div>

					<div class="custom-control custom-radio mb-1">
						<input type="radio" name="nav-sdark-clr" class="custom-control-input bg-cyan" data-bg="bg-cyan" id="opt-cyan">
						<label class="custom-control-label" for="opt-cyan">Cyan</label>
					</div>

					<div class="custom-control custom-radio mb-1">
						<input type="radio" name="nav-sdark-clr" class="custom-control-input bg-pink" data-bg="bg-pink" id="opt-pink">
						<label class="custom-control-label" for="opt-pink">Pink</label>
					</div>

				</div>
				<div class="tab-pane" id="clrOpt3" aria-labelledby="color-opt-3">
					<div class="row">
						<div class="col-6">
							<h3>Solid</h3>

							<div class="custom-control custom-radio mb-1">
								<input type="radio" name="nav-dark-clr" class="custom-control-input bg-blue-grey" data-bg="bg-blue-grey" id="solid-blue-grey">
								<label class="custom-control-label" for="solid-blue-grey">Default</label>
							</div>

							<div class="custom-control custom-radio mb-1">
								<input type="radio" name="nav-dark-clr" class="custom-control-input bg-primary" data-bg="bg-primary" id="solid-primary">
								<label class="custom-control-label" for="solid-primary">Primary</label>
							</div>

							<div class="custom-control custom-radio mb-1">
								<input type="radio" name="nav-dark-clr" class="custom-control-input bg-danger" data-bg="bg-danger" id="solid-danger">
								<label class="custom-control-label" for="solid-danger">Danger</label>
							</div>

							<div class="custom-control custom-radio mb-1">
								<input type="radio" name="nav-dark-clr" class="custom-control-input bg-success" data-bg="bg-success" id="solid-success">
								<label class="custom-control-label" for="solid-success">Success</label>
							</div>

							<div class="custom-control custom-radio mb-1">
								<input type="radio" name="nav-dark-clr" class="custom-control-input bg-blue" data-bg="bg-blue" id="solid-blue">
								<label class="custom-control-label" for="solid-blue">Blue</label>
							</div>

							<div class="custom-control custom-radio mb-1">
								<input type="radio" name="nav-dark-clr" class="custom-control-input bg-cyan" data-bg="bg-cyan" id="solid-cyan">
								<label class="custom-control-label" for="solid-cyan">Cyan</label>
							</div>

							<div class="custom-control custom-radio mb-1">
								<input type="radio" name="nav-dark-clr" class="custom-control-input bg-pink" data-bg="bg-pink" id="solid-pink">
								<label class="custom-control-label" for="solid-pink">Pink</label>
							</div>

						</div>

						<div class="col-6">
							<h3>Gradient</h3>

							<div class="custom-control custom-radio mb-1">
								<input type="radio" name="nav-dark-clr" class="custom-control-input bg-blue-grey" data-bg="bg-gradient-x-grey-blue" id="bg-gradient-x-grey-blue1">
								<label class="custom-control-label" for="bg-gradient-x-grey-blue1">Default</label>
							</div>

							<div class="custom-control custom-radio mb-1">
								<input type="radio" name="nav-dark-clr" checked class="custom-control-input bg-primary" data-bg="bg-gradient-x-primary" id="bg-gradient-x-primary1">
								<label class="custom-control-label" for="bg-gradient-x-primary1">Primary</label>
							</div>

							<div class="custom-control custom-radio mb-1">
								<input type="radio" name="nav-dark-clr" checked class="custom-control-input bg-danger" data-bg="bg-gradient-x-danger" id="bg-gradient-x-danger1">
								<label class="custom-control-label" for="bg-gradient-x-danger1">Danger</label>
							</div>

							<div class="custom-control custom-radio mb-1">
								<input type="radio" name="nav-dark-clr" checked class="custom-control-input bg-success" data-bg="bg-gradient-x-success" id="bg-gradient-x-success1">
								<label class="custom-control-label" for="bg-gradient-x-success1">Success</label>
							</div>

							<div class="custom-control custom-radio mb-1">
								<input type="radio" name="nav-dark-clr" checked class="custom-control-input bg-blue" data-bg="bg-gradient-x-blue" id="bg-gradient-x-blue1">
								<label class="custom-control-label" for="bg-gradient-x-blue1">Blue</label>
							</div>

							<div class="custom-control custom-radio mb-1">
								<input type="radio" name="nav-dark-clr" checked class="custom-control-input bg-cyan" data-bg="bg-gradient-x-cyan" id="bg-gradient-x-cyan1">
								<label class="custom-control-label" for="bg-gradient-x-cyan1">Cyan</label>
							</div>

							<div class="custom-control custom-radio mb-1">
								<input type="radio" name="nav-dark-clr" checked class="custom-control-input bg-pink" data-bg="bg-gradient-x-pink" id="bg-gradient-x-pink1">
								<label class="custom-control-label" for="bg-gradient-x-pink1">Pink</label>
							</div>

						</div>
					</div>
				</div>
				<div class="tab-pane" id="clrOpt4" aria-labelledby="color-opt-4">

					<div class="custom-control custom-radio mb-1">
						<input type="radio" name="nav-light-clr" class="custom-control-input bg-blue-grey" data-bg="bg-blue-grey bg-lighten-4" id="light-blue-grey">
						<label class="custom-control-label" for="light-blue-grey">Default</label>
					</div>

					<div class="custom-control custom-radio mb-1">
						<input type="radio" name="nav-light-clr" class="custom-control-input bg-primary" data-bg="bg-primary bg-lighten-4" id="light-primary">
						<label class="custom-control-label" for="light-primary">Primary</label>
					</div>

					<div class="custom-control custom-radio mb-1">
						<input type="radio" name="nav-light-clr" class="custom-control-input bg-danger" data-bg="bg-danger bg-lighten-4" id="light-danger">
						<label class="custom-control-label" for="light-danger">Danger</label>
					</div>

					<div class="custom-control custom-radio mb-1">
						<input type="radio" name="nav-light-clr" class="custom-control-input bg-success" data-bg="bg-success bg-lighten-4" id="light-success">
						<label class="custom-control-label" for="light-success">Success</label>
					</div>

					<div class="custom-control custom-radio mb-1">
						<input type="radio" name="nav-light-clr" class="custom-control-input bg-blue" data-bg="bg-blue bg-lighten-4" id="light-blue">
						<label class="custom-control-label" for="light-blue">Blue</label>
					</div>

					<div class="custom-control custom-radio mb-1">
						<input type="radio" name="nav-light-clr" class="custom-control-input bg-cyan" data-bg="bg-cyan bg-lighten-4" id="light-cyan">
						<label class="custom-control-label" for="light-cyan">Cyan</label>
					</div>

					<div class="custom-control custom-radio mb-1">
						<input type="radio" name="nav-light-clr" class="custom-control-input bg-pink" data-bg="bg-pink bg-lighten-4" id="light-pink">
						<label class="custom-control-label" for="light-pink">Pink</label>
					</div>

				</div>
			</div>

			<hr>

			<h5 class="mt-1 mb-1 text-bold-500">Menu Color Options</h5>
			<div class="form-group">
				<!-- Outline Button group -->
				<div class="btn-group customizer-sidebar-options" role="group" aria-label="Basic example">
					<button type="button" class="btn btn-outline-info" data-sidebar="menu-light">Light Menu</button>
					<button type="button" class="btn btn-outline-info" data-sidebar="menu-dark">Dark Menu</button>
				</div>
			</div>
		</div>
	</div>
	<!-- End: Customizer-->




	<!-- BEGIN: Vendor JS-->
	<script src="../../../app-assets/vendors/js/vendors.min.js"></script>
	<!-- BEGIN Vendor JS-->

	<!-- BEGIN: Page Vendor JS-->
	<script src="../../../app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
	<script src="../../../app-assets/vendors/js/extensions/dropzone.min.js"></script>
	<script src="../../../app-assets/vendors/js/ui/prism.min.js"></script>
	<!-- END: Page Vendor JS-->

	<!-- BEGIN: Theme JS-->
	<script src="../../../app-assets/js/core/app-menu.min.js"></script>
	<script src="../../../app-assets/js/core/app.min.js"></script>
	<script src="../../../app-assets/js/scripts/customizer.min.js"></script>
	<script src="../../../app-assets/js/dropify.bundle.js"></script>

	<script>
		$('dropify').dropify({
			messages: {
				'default': 'Click to Upload Or Drag n Drop',
				'remove': '<i class="flaticon-close-fill"></i>',
				'replace': 'Upload or Drag n Drop'
			}
		})
	</script>
	<!-- END: Theme JS-->

	<!-- BEGIN: Page JS-->
	<script src="../../../app-assets/js/scripts/tables/datatables/datatable-basic.min.js"></script>
	<script src="../../../app-assets/js/scripts/extensions/dropzone.min.js"></script>
	<!-- END: Page JS-->

</body>
<!-- END: Body-->

<!-- Mirrored from demos.pixinvent.com/stack-html-admin-template/html/ltr/vertical-modern-menu-template/dt-basic-initialization.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 14 Sep 2024 11:43:02 GMT -->

</html>