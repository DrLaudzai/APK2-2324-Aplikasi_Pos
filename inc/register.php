<?php
@session_start();
require_once 'functions.php';

// Cek Apakah sudah Login sebagai admin
/*if (@$_SESSION['email']) {;
	if (@$_SESSION['email']=="Admin") {;
		header("location:../inc/register.php");
	} else {;
		if (@$_SESSION['level']=="Petugas") {;
			header("location:../petugas/index.php");
		} elseif (@$_SESSION['level']=="Penyewa") {;
			header("location:../penyewa/index.php");
        } elseif (@$_SESSION['level']=="Owner") {;
			header("location:../owner/index.php");
        } elseif (@$_SESSION['level']=="Karyawan") {;
			header("location:../karyawan/index.php");
		};
	};
	} else {;
		header("location:../inc/login.php");
	
};
*/


// Registrasi
if(isset($_POST["registrasi"])){
if(registrasi($_POST)>0){
    echo "<script>
    alert('User Baru berhasil ditambahkan!!!');
    document.location.href='login.php';
    </script>";
}else{
    echo mysqli_error($KONEKSI);
}
}

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
  
<!-- Mirrored from demos.pixinvent.com/stack-html-admin-template/html/ltr/vertical-modern-menu-template/register-with-bg-image.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 14 Sep 2024 11:41:57 GMT -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Stack admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, stack admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Register with Background Color - Stack Responsive Bootstrap 4 Admin Template</title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="https://demos.pixinvent.com/stack-html-admin-template/app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/forms/icheck/icheck.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/forms/icheck/custom.css">
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/login-register.min.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

  </head>
  <!-- END: Head-->

  <!-- BEGIN: Body-->
  <body class="vertical-layout vertical-menu-modern 1-column  bg-full-screen-image blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
    <!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body"><section class="row flexbox-container">
    <div class="col-12 d-flex align-items-center justify-content-center">
        <div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0">
            <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                <div class="card-header border-0 pb-0">
                    <div class="card-title text-center">
                        <img src="../../../app-assets/images/logo/stack-logo-dark.png" alt="branding logo">
                    </div>
                    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2"><span>Easily
                            Using</span></h6>
                </div>
                <div class="card-content">
                    <div class="text-center">
                        <a href="#" class="btn btn-social-icon mr-1 mb-1 btn-outline-facebook"><span
                                class="fa fa-facebook"></span></a>
                        <a href="#" class="btn btn-social-icon mr-1 mb-1 btn-outline-twitter"><span
                                class="fa fa-twitter"></span></a>
                        <a href="#" class="btn btn-social-icon mr-1 mb-1 btn-outline-linkedin"><span
                                class="fa fa-linkedin font-medium-4"></span></a>
                        <a href="#" class="btn btn-social-icon mr-1 mb-1 btn-outline-github"><span
                                class="fa fa-github font-medium-4"></span></a>
                    </div>
                    <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-1"><span>OR Using
                            Email</span></p>
                    <div class="card-body">
                        <form method="post"> 
                    <label for="InputName" class="">NAMA</label>
                    <input type="hidden" class="form-control mb-4" name="id_user" value="<?php echo autonumber("tbl_users","id_user",7,"USR");?>">
                    <input type="text" id="inputName" class="form-control mb-4" name="nama" placeholder="Login" required>

                    <label for="InputEmail" class="">EMAIL</label>
                    <input type="email" id="inputEmail" class="form-control mb-4" name="email" placeholder="Login" required>

                    <label for="InputPassword" class="">PASSWORD</label>
                    <input type="password" id="inputPassword" class="form-control mb-4" name="password" placeholder="Password" required>

                    <label for="InputRepeatPassword" class="">REPEAT PASSWORD</label>
                    <input type="password" id="inputRepeatPassword" class="form-control mb-4" name="password2" placeholder="Password" required>
                    
                    <button type="submit" class="btn btn-outline-danger btn-block mt-2" name="registrasi">Register</button>
                    <a href="login.php" class="btn btn-outline-danger btn-block mt-2"><i
                                class="feather icon-unlock"></i> Login</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
        </div>
</div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="../../../app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="../../../app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"></script>
    <script src="../../../app-assets/vendors/js/forms/icheck/icheck.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/core/app-menu.min.js"></script>
    <script src="../../../app-assets/js/core/app.min.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/forms/form-login-register.min.js"></script>
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

<!-- Mirrored from demos.pixinvent.com/stack-html-admin-template/html/ltr/vertical-modern-menu-template/register-with-bg-image.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 14 Sep 2024 11:41:57 GMT -->
</html>