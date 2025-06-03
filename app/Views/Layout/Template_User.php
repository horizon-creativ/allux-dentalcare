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
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="/assets/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/assets/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="/assets/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="/assets/plugins/summernote/summernote-bs4.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="/assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="/assets/plugins/daterangepicker/daterangepicker.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="/assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="/assets/plugins/daterangepicker/daterangepicker.css">
    <!-- jQuery -->
    <!-- <script src="/assets/plugins/jquery/jquery.min.js"></script> -->
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
                            <?php if (!session('logged_in_user')): ?>
                                <a href="/login" class="btn bg-teal rounded-pill px-3">Booking</a>
                            <?php endif; ?>
                            <?php if (session('logged_in_user')): ?>
                                <a href="/booking/date" class="btn bg-teal rounded-pill px-3">Booking</a>
                            <?php endif; ?>
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

    <!-- jQuery -->
    <script src="/assets/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="/assets/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="/assets/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="/assets/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="/assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="/assets/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="/assets/plugins/moment/moment.min.js"></script>
    <script src="/assets/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="/assets/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/assets/dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <!-- <script src="/assets/dist/js/demo.js"></script> -->
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!-- <script src="/assets/dist/js/pages/dashboard.js"></script> -->
    <!-- DataTables  & Plugins -->
    <script src="/assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="/assets/plugins/jszip/jszip.min.js"></script>
    <script src="/assets/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="/assets/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="/assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="/assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="/assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- Select2 -->
    <script src="/assets/plugins/select2/js/select2.full.min.js"></script>
    <!-- InputMask -->
    <script src="/assets/plugins/moment/moment.min.js"></script>
    <script src="/assets/plugins/inputmask/jquery.inputmask.min.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- date-range-picker -->
    <script src="/assets/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Script -->
    <script>
        // DataTable
        $("#table-button").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": [{
                extend: 'pdf',
                footer: true
            }, {
                extend: 'excel',
                footer: true
            }],
            "paging": false
        }).buttons().container().appendTo('#tabel-pembelian_wrapper .col-md-6:eq(0)');
        // Tabel non cetak
        $('#table-global').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": false,
        });
        // Select2
        // With Clear
        $('.select2bs4-clear').select2({
            theme: 'bootstrap4',
            placeholder: 'Pilih opsi',
            allowClear: true,
            // containerCssClass: 'rounded-0',
            // selectionCssClass: 'rounded-0'
        });
        $('.select2bs4-clear').one('select2:open', function(e) {
            $('input.select2-search__field').prop('placeholder', 'Cari...');
        });
        // No Clear
        $('.select2bs4').select2({
            theme: 'bootstrap4',
            placeholder: 'Pilih opsi',
            allowClear: false,
            // containerCssClass: 'rounded-0',
            // selectionCssClass: 'rounded-0'
        });
        $('.select2bs4').one('select2:open', function(e) {
            $('input.select2-search__field').prop('placeholder', 'Cari...');
        });
        // Tooltip
        $('#tooltip_username_user').tooltip({
            boundary: 'window'
        })
        $('#tooltip_password_user').tooltip({
            boundary: 'window'
        })
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