<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?> - Allux Dental Care</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="/assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/assets/dist/css/adminlte.min.css">
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <a href="/assets/index3.html" class="navbar-brand">
                    <img src="/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle" style="opacity: 1">
                    <span class="brand-text font-weight-light">Allux Dental Care</span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="/" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Layanan</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Testimoni</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="btn bg-teal rounded-pill px-3">Booking</a>
                        </li>
                    </ul>
                </div>

                <!-- Right navbar links -->
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <!-- Notifications Dropdown Menu -->
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-bell"></i>
                            <span class="badge badge-warning navbar-badge">15</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-header">15 Notifications</span>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-envelope mr-2"></i> 4 new messages
                                <span class="float-right text-muted text-sm">3 mins</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-users mr-2"></i> 8 friend requests
                                <span class="float-right text-muted text-sm">12 hours</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-file mr-2"></i> 3 new reports
                                <span class="float-right text-muted text-sm">2 days</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                        </div>
                    </li> -->
                    <!-- Account Dropdown -->
                    <?php if (session('logged_in_user')): ?>
                        <li class="nav-item dropdown">
                            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fas fa-user"></i></a>
                            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                <li><a href="/profile" class="dropdown-item">Profil</a></li>
                                <div class="dropdown-divider"></div>
                                <li><a href="/logout" class="dropdown-item"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <?php if (!session('logged_in_user')): ?>
                        <li class="nav-item">
                            <a href="/login" class="btn bg-teal rounded-pill px-3 py-1">Login</a>
                        </li>
                    <?php endif; ?>
                    <!-- <li class="nav-item">
                        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                            <i class="fas fa-th-large"></i>
                        </a>
                    </li> -->
                </ul>
            </div>
        </nav>
        <!-- /.navbar -->

        <?= $this->renderSection('content') ?>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer bg-dark">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-4 col-lg-4 mx-auto">
                        <a href="/" class="text-dark text-bold">
                            <!-- <h1>Allux Dental Care</h1> -->
                            <img src="/img/logo.png" alt="" class="img-fluid" width="150">
                        </a>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4 mx-auto">
                        <h3 class="text-bold">Menu</h3>
                        <ul>
                            <li>Home</li>
                            <li>Layanan</li>
                            <li>Tentang Kami</li>
                            <li>Booking Sekarang</li>
                        </ul>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4 mx-auto">
                        <h3 class="text-bold">Lokasi</h3>
                        <div class="row d-flex">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3951.430026976419!2d112.61759027934569!3d-7.954434399999994!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd629fe9a7a77e3%3A0x16850452a0c6966a!2sPraktek%20Dokter%20Gigi%20Malang%20-%20Allux%20Dental%20Care!5e0!3m2!1sid!2sid!4v1747835995938!5m2!1sid!2sid" style="border:0;position: relative; height: 100%; width: 100%;" allowfullscreen="true" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container mt-3">
                <!-- To the right -->
                <div class="float-right d-none d-sm-inline">
                    <a href="#">Terms and Condition</a> and <a href="#">Privacy Policy</a>
                </div>
                <!-- Default to the left -->
                <strong>Copyright &copy; 2025 <a href="https://adminlte.io">Allux Dental Care</a>.</strong> All rights reserved.
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="/assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/assets/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="/assets/dist/js/demo.js"></script>

    <!-- Script -->
    <script>
        // Toast Success
        window.onload = function() {
            let FLASHDATA_SUCCESS = "<?= session()->getFlashdata('success') ?>"
            let FLASHDATA_FAILED = "<?= session()->getFlashdata('failed') ?>"

            if (FLASHDATA_SUCCESS) {
                $(document).Toasts('create', {
                    class: 'bg-success m-3',
                    title: 'Success',
                    autohide: true,
                    delay: 5000,
                    body: FLASHDATA_SUCCESS,
                    icon: 'fas fa-check-circle fa-lg',
                })
            } else if (FLASHDATA_FAILED) {
                $(document).Toasts('create', {
                    class: 'bg-danger m-3',
                    title: 'Failed',
                    autohide: true,
                    delay: 5000,
                    body: FLASHDATA_FAILED,
                    icon: 'fas fa-exclamation-triangle fa-lg',
                })
            }
        }
    </script>
</body>

</html>