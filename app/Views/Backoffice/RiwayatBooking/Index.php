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
            <!-- Main row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-10">
                                    <form action="/backoffice/riwayat/booking" method="GET">
                                        <div class="row">
                                            <label>Date range:</label>
                                            <div class="form-group ml-3">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="far fa-calendar-alt"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control float-right daterange" name="daterange">
                                                </div>
                                                <!-- /.input group -->
                                            </div>
                                            <div class="form-group ml-3">
                                                <button type="submit" class="btn btn-primary">Filter</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-sm table-bordered" id="table-print">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>Kode</th>
                                            <th>Tanggal</th>
                                            <th>Jam</th>
                                            <th>Pasien</th>
                                            <th>Dokter</th>
                                            <th>Layanan</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($bookings as $booking): ?>
                                            <?php
                                            $pasien = $userModel->where('id_user', $booking['id_user'])->first();
                                            $layanan = $layananModel->where('id_layanan', $booking['id_layanan'])->first();
                                            $slotJadwal = $slotJadwalModel->where('id_slot_jadwal', $booking['id_slot_jadwal'])->first();
                                            $jadwal = $jadwalModel->where('id_jadwal', $slotJadwal['id_jadwal'])->first();
                                            $dokter = $userModel->where('id_user', $jadwal['id_user'])->first();
                                            ?>
                                            <tr>
                                                <td class="text-center"><?= $no++ ?></td>
                                                <td><?= $booking['code_booking'] ?></td>
                                                <td><?= date('d F Y', strtotime($booking['date_booking'])) ?></td>
                                                <td><?= date('H:i', strtotime($booking['date_booking'])) ?></td>
                                                <td><?= $pasien['name_user'] ?></td>
                                                <td><?= $dokter['name_user'] ?></td>
                                                <td><?= $layanan['name_layanan'] ?></td>
                                                <td><span class="badge bg-<?= statusColor($booking['status_booking']) ?>"><?= $booking['status_booking'] ?></span></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<?= $this->endSection() ?>