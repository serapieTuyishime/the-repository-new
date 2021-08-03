<!--
=========================================================
* Argon Dashboard - v1.2.0
=========================================================
* Product Page: https://www.creative-tim.com/product/argon-dashboard

* Copyright  Creative Tim (http://www.creative-tim.com)
* Coded by www.creative-tim.com
=========================================================
* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>The repo- <?= $title?></title>
    <!-- Favicon -->
    <link rel="icon" href=" <?php echo base_url(); ?>assets/img/brand/favicon.png" type="image/png">
    <!-- Fonts -->
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700"> -->
    <!-- Icons -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/nucleo/css/nucleo.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
    <!-- Argon CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/argon.css?v=1.2.0" type="text/css">
</head>

<body class="bg-default">
    <!-- Navbar -->
    <nav id="navbar-main" class="navbar navbar-horizontal navbar-transparent navbar-main navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="<?php echo base_url(); ?>">
                <img src="<?php echo base_url(); ?>assets/img/brand/blue.png">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse navbar-custom-collapse collapse" id="navbar-collapse">
                <div class="navbar-collapse-header">
                    <div class="row">
                        <div class="col-6 collapse-brand">
                            <a href="<?php echo base_url(); ?>">
                                <img src="<?php echo base_url(); ?>assets/img/brand/blue.png">
                            </a>
                        </div>
                        <div class="col-6 collapse-close">
                            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                                <span></span>
                                <span></span>
                            </button>
                        </div>
                    </div>
                </div>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a href="<?php echo base_url(); ?>pages/about" class="nav-link">
                            <span class="nav-link-inner--text">About</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url(); ?>pages/license" class="nav-link">
                            <span class="nav-link-inner--text">License</span>
                        </a>
                    </li>
                </ul>
                <hr class="d-lg-none" />
                <ul class="navbar-nav align-items-lg-center ml-lg-auto">
                    <li class="nav-item">
                        <a class="nav-link nav-link-icon" href="https://www.facebook.com/creativetim" target="_blank" data-toggle="tooltip" data-original-title="Like us on Facebook">
                            <i class="fab fa-facebook-square"></i>
                            <span class="nav-link-inner--text d-lg-none">Facebook</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-icon" href="https://www.instagram.com/creativetimofficial" target="_blank" data-toggle="tooltip" data-original-title="Follow us on Instagram">
                            <i class="fab fa-instagram"></i>
                            <span class="nav-link-inner--text d-lg-none">Instagram</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-icon" href="https://twitter.com/creativetim" target="_blank" data-toggle="tooltip" data-original-title="Follow us on Twitter">
                            <i class="fab fa-twitter-square"></i>
                            <span class="nav-link-inner--text d-lg-none">Twitter</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-icon" href="https://github.com/creativetimofficial" target="_blank" data-toggle="tooltip" data-original-title="Star us on Github">
                            <i class="fab fa-github"></i>
                            <span class="nav-link-inner--text d-lg-none">Github</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Main content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
            <div class="separator separator-bottom separator-skew zindex-100">
                <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div>
        </div>
        <!-- Page content -->
        <div class="container mt--8 pb-5">
            <div class="row justify-content-center">

                <div class="col-lg-12 col-md-12">
                    <div class="card bg-secondary border-0 mb-0">
                        <div class="card-body px-lg-5 py-lg-5">
                            <p class="">
                            <?php if (file_exists(getcwd()."\\application\\views\\pages\\agreement.txt")): ?>
                                <?php
                                $filename= getcwd()."\\application\\views\\pages\\agreement.txt";
                                $fp = fopen($filename, "r");
                                $contents = fread($fp, filesize($filename));
                                echo "<pre>$contents</pre>";
                                fclose($fp);
                                 ?>
                            <?php else: ?>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.

                            <?php endif; ?>
                            </p>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="py-5" id="footer-main">
        <div class="container">
            <div class="row align-items-center justify-content-xl-between">
                <div class="col-xl-6">
                    <div class="copyright text-center text-xl-left text-muted">
                        &copy; 2020 <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">Creative Tim</a>
                    </div>
                </div>
                <div class="col-xl-6">
                    <ul class="nav nav-footer justify-content-center justify-content-xl-end">
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md" class="nav-link" target="_blank">MIT License</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="<?php echo base_url(); ?>assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/js-cookie/js.cookie.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
    <!-- Argon JS -->
    <script src="<?php echo base_url(); ?>assets/js/argon.js?v=1.2.0"></script>

    <!-- form validations -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.validate.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/form-validation-script.js"></script>
</body>

</html>
