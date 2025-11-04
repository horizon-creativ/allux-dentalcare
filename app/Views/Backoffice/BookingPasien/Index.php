<?= $this->extend('Layout/Template_Bo') ?>
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
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#"><?= $menuGroup ?></a></li>
                        <li class="breadcrumb-item active"><?= $menu ?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <?php if ($bookingPerawatan): ?>
                        <?php
                        $pasienPerawatan = $pasienModel->where('id_pasien', $bookingPerawatan['id_user'])->first();
                        $layananPerawatan = $layananModel->where('id_layanan', $bookingPerawatan['id_layanan'])->first();
                        ?>
                        <div class="card rounded-pill bg-primary" style="padding-left: 50px; padding-right: 50px;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <h4><span class="badge bg-teal"><?= $layananPerawatan['name_layanan'] ?></span>&nbsp; <?= $pasienPerawatan['name_pasien'] ?></h4>
                                        <p>Keluhan: <?= $bookingPerawatan['keluhan_booking'] ?></p>
                                        <p>
                                            <span class="badge bg-warning"><?= date('d F Y', strtotime($bookingPerawatan['date_booking'])) ?></span>
                                            <span class="badge bg-success"><?= date('H:i', strtotime($bookingPerawatan['date_booking'])) ?></span>
                                        </p>
                                    </div>
                                    <div class="col-6">
                                        <a href="/backoffice/booking-pasien/<?= $bookingPerawatan['id_booking'] ?>" class="btn bg-light rounded-pill float-right">Lihat Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <!-- Main row -->
            <div class="row">
                <div class="col-12">
                    <?php foreach ($bookings as $booking): ?>
                        <?php
                        $pasien = $pasienModel->where('id_pasien', $booking['id_user'])->first();
                        $layanan = $layananModel->where('id_layanan', $booking['id_layanan'])->first();
                        $slotJadwal = $slotJadwalModel->where('id_slot_jadwal', $booking['id_slot_jadwal'])->first();
                        $jadwal = $jadwalModel->where('id_jadwal', $slotJadwal['id_jadwal'])->first();
                        $dokter = $dokterModel->where('id_dokter', $jadwal['id_dokter'])->first();
                        ?>
                        <?php if ($dokter['id_dokter'] == session('id_user')): ?>
                            <div class="card rounded-pill" style="padding-left: 50px; padding-right: 50px;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <h4><span class="badge bg-teal"><?= $layanan['name_layanan'] ?></span>&nbsp; <?= $pasien['name_pasien'] ?></h4>
                                            <p>Keluhan: <?= $booking['keluhan_booking'] ?></p>
                                            <p>
                                                <span class="badge bg-blue"><?= date('d F Y', strtotime($booking['date_booking'])) ?></span>
                                                <span class="badge bg-success"><?= date('H:i', strtotime($booking['date_booking'])) ?></span>
                                            </p>
                                        </div>
                                        <div class="col-6">
                                            <form action="/backoffice/booking-pasien" method="POST">
                                                <input type="hidden" name="id_booking" value="<?= $booking['id_booking'] ?>">
                                                <button type="submit" class="btn bg-teal rounded-pill float-right">Mulai Perawatan</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<?= $this->endSection() ?>