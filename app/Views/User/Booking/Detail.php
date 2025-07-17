<?= $this->extend('Layout/Template_User') ?>
<?= $this->section('content') ?>

<?php
function convertDay($dayNumber)
{
    switch ($dayNumber) {
        case 0:
            return 'Minggu';
            break;
        case 1:
            return 'Senin';
            break;
        case 2:
            return 'Selasa';
            break;
        case 3:
            return 'Rabu';
            break;
        case 4:
            return 'Kamis';
            break;
        case 5:
            return 'Jumat';
            break;
        case 6:
            return 'Sabtu';
            break;
    }
}

function statusColor($status)
{
    switch ($status) {
        case 'Waiting':
            return 'info';
            break;
        case 'Confirmed':
            return 'olive';
            break;
        case 'Completed':
            return 'teal';
            break;
        case 'Cancelled':
            return 'danger';
            break;
        case 'Dalam Perawatan':
            return 'navy';
            break;
    }
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper bg-white">
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <!-- <h1>Booking</h1> -->
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/profile">Profile</a></li>
                            <li class="breadcrumb-item active">Booking Detail</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-md-6 mx-auto">
                        <div class="card">
                            <div class="card-body">
                                <h1 class="text-center"><span class="badge bg-secondary"><?= $booking['code_booking'] ?></span></h1>
                                <br>
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Dokter</b>
                                        <div class="float-right"><?= $dokter['name_user'] ?></div>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Hari</b>
                                        <div class="float-right"><?= convertDay(date('w', strtotime($booking['date_booking']))) ?></div>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Tanggal</b>
                                        <div class="float-right"><?= date('d F Y', strtotime($booking['date_booking'])) ?></div>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Layanan</b>
                                        <div class="float-right"><?= $layanan['name_layanan'] ?></div>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Keluhan</b>
                                        <div class="float-right"><?= $booking['keluhan_booking'] ?></div>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Status</b>
                                        <div class="float-right"><span class="badge bg-<?= statusColor($booking['status_booking']) ?>"><?= $booking['status_booking'] ?></span></div>
                                        <?php if ($booking['status_booking'] == 'Confirmed'): ?>
                                            <p class="text-center font-italic">Booking anda telah dikonfirmasi, harap datang setidaknya 15 menit sebelum jadwal.</p>
                                            <p class="text-center font-italic text-danger">Apabila lebih dari 15 menit dari jadwal tidak hadir, maka booking dianggap cancel.</p>
                                        <?php endif; ?>
                                    </li>
                                </ul>
                                <br>
                                <div class="row">
                                    <?php if (array_search($booking['status_booking'], ['Completed', 'Cancelled', 'On Progress', 'Confirmed']) == ''): ?>
                                        <a href="/booking/cancel/<?= $booking['id_booking'] ?>" class="btn btn-outline-danger rounded-pill px-3 mx-auto">Batalkan Booking</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
</div>
<!-- /.content-wrapper -->
<?= $this->endSection() ?>