<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?> | Allux Dental Care</title>

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
    <!-- daterange picker -->
    <link rel="stylesheet" href="/assets/plugins/daterangepicker/daterangepicker.css">
    <!-- <link rel="stylesheet" href="/assets/css/styles.css"> -->
    <!-- jQuery -->
    <!-- <script src="/assets/plugins/jquery/jquery.min.js"></script> -->
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <h5 class="nav-link text-dark"><?= $title ?></h5>
                </li>
                <!-- <li class="nav-item d-none d-sm-inline-block">
                    <a href="index3.html" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li> -->
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Store -->
                <li class="nav-item d-none d-sm-inline-block">
                    <h6 class="nav-link text-dark text-bold">A</h6>
                </li>
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
                <!-- User Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-user"></i>
                        <!-- <span class="badge badge-warning navbar-badge">15</span> -->
                    </a>
                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">User Menu</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-user mr-2"></i> Profil
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="/bo-auth/logout" class="dropdown-item">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </a>
                        <div class="dropdown-divider"></div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-teal elevation-1">
            <!-- Brand Logo -->
            <a href="/backoffice" class="brand-link bg-teal">
                <img src="/assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-1" style="opacity: 1">
                <span class="brand-text font-weight-light">Allux Dentalcare</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="info">
                        <a href="#" class="d-block"><?= session('name_user') ?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-legacy nav-flat" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="/backoffice" class="nav-link <?= $menu == 'Dashboard' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <?php if (session('level_user') == 'Superadmin'): ?>
                            <li class="nav-item <?= $menuGroup == 'Master' ? 'menu-open' : '' ?>">
                                <a href="#" class="nav-link <?= $menuGroup == 'Master' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-box"></i>
                                    <p>
                                        Master
                                        <i class="fas fa-angle-left right"></i>
                                        <!-- <span class="badge badge-info right">6</span> -->
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="/backoffice/user" class="nav-link <?= $menu == 'User' ? 'active bg-teal' : '' ?>">
                                            <i class="fas fa-user nav-icon"></i>
                                            <p>User</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/backoffice/dokter" class="nav-link <?= $menu == 'Dokter' ? 'active bg-teal' : '' ?>">
                                            <i class="fas fa-user nav-icon"></i>
                                            <p>Dokter</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/backoffice/layanan" class="nav-link <?= $menu == 'Layanan' ? 'active bg-teal' : '' ?>">
                                            <i class="fas fa-user-md nav-icon"></i>
                                            <p>Layanan</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/backoffice/obat" class="nav-link <?= $menu == 'Obat' ? 'active bg-teal' : '' ?>">
                                            <i class="fas fa-pills nav-icon"></i>
                                            <p>Obat</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item <?= $menuGroup == 'Data' ? 'menu-open' : '' ?>">
                            <a href="#" class="nav-link <?= $menuGroup == 'Data' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-table"></i>
                                <p>
                                    Data
                                    <i class="fas fa-angle-left right"></i>
                                    <!-- <span class="badge badge-info right">6</span> -->
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/backoffice/jadwal" class="nav-link <?= $menu == 'Jadwal' ? 'active bg-teal' : '' ?>">
                                        <i class="fas fa-calendar-alt nav-icon"></i>
                                        <p>Jadwal</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/backoffice/pasien" class="nav-link <?= $menu == 'Pasien' ? 'active bg-teal' : '' ?>">
                                        <i class="fas fa-user-alt nav-icon"></i>
                                        <p>Pasien</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <?php if (session('level_user') != 'Superadmin'): ?>
                            <li class="nav-item <?= $menuGroup == 'Booking' ? 'menu-open' : '' ?>">
                                <a href="#" class="nav-link <?= $menuGroup == 'Booking' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-list"></i>
                                    <p>
                                        Booking
                                        <i class="fas fa-angle-left right"></i>
                                        <!-- <span class="badge badge-info right">6</span> -->
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <?php if (session('level_user') == 'Kasir'): ?>
                                        <li class="nav-item">
                                            <a href="/backoffice/booking-masuk" class="nav-link <?= $menu == 'Booking Masuk' ? 'active bg-teal' : '' ?>">
                                                <i class="fas fa-calendar nav-icon"></i>
                                                <p>Booking Masuk</p>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (session('level_user') == 'Dokter'): ?>
                                        <li class="nav-item">
                                            <a href="/backoffice/booking-pasien" class="nav-link <?= $menu == 'Booking Pasien' ? 'active bg-teal' : '' ?>">
                                                <i class="fas fa-user-alt nav-icon"></i>
                                                <p>Pasien</p>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                        <?php endif; ?>
                        <?php if (session('level_user') == 'Kasir'): ?>
                            <li class="nav-item">
                                <a href="/backoffice/kasir" class="nav-link <?= $menu == 'Kasir' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-cash-register"></i>
                                    <p>
                                        Kasir
                                    </p>
                                </a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item <?= $menuGroup == 'Riwayat' ? 'menu-open' : '' ?>">
                            <a href="#" class="nav-link <?= $menuGroup == 'Riwayat' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>
                                    Riwayat
                                    <i class="fas fa-angle-left right"></i>
                                    <!-- <span class="badge badge-info right">6</span> -->
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/backoffice/riwayat/booking" class="nav-link <?= $menu == 'Riwayat Booking' ? 'active bg-teal' : '' ?>">
                                        <i class="fas fa-calendar nav-icon"></i>
                                        <p>Booking</p>
                                    </a>
                                </li>
                                <?php if (session('level_user') == 'Superadmin' || session('level_user') == 'Admin' || session('level_user') == 'Kasir'): ?>
                                    <li class="nav-item">
                                        <a href="/backoffice/riwayat/pembayaran" class="nav-link <?= $menu == 'Riwayat Pembayaran' ? 'active bg-teal' : '' ?>">
                                            <i class="fas fa-money-bill-alt nav-icon"></i>
                                            <p>Pembayaran</p>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <?= $this->renderSection('content') ?>

        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2025 <a href="https://adminlte.io">Allux Dentalcare</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->


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
    <!-- date-range-picker -->
    <script src="/assets/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Custom Script -->
    <script>
        // Daterange
        //Date range picker
        $('.daterange').daterangepicker()
        // Input Mask
        //time dd/mm/yyyy
        // $('#datetime').inputmask('HH:MM', {
        //     'placeholder': 'hh:mm'
        // })
        $('[data-mask]').inputmask()
        // DataTable
        $("#table-button").DataTable({
            "lengthMenu": [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
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
            "paging": true,
            "searching": true,
        }).buttons().container().appendTo('#tabel-button_wrapper .col-md-6:eq(0)');
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
        // Tabel print new
        $("#table-print").DataTable({
            "lengthMenu": [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            "paging": true,
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            'footer': true,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#table-print_wrapper .col-md-6:eq(0)');
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

        // Modal
        window.onload = function() {
            // Modal Open
            let MODAL_OPEN = "<?= session('modalOpen') ?>";

            if (MODAL_OPEN) {
                $('#' + MODAL_OPEN).modal('show');
            }

            // Toast
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