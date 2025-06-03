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
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper bg-white">
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <!-- <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Booking</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Booking</li>
                        </ol>
                    </div>
                </div>
            </div> -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-md-6 mx-auto">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="text-center">Pilih Jam Booking</h5>
                                <br>
                                <p>Silahkan pilih jam untuk booking pada hari <b><?= convertDay($day_booking) ?></b> tanggal <b><?= date('d F Y', strtotime($date_booking)) ?></b></p>
                                <br>
                                <div class="row">
                                    <?php foreach ($slots as $slot): ?>
                                        <?php
                                        // Cek booking pada tanggal dan slot, apabila sudah ada maka tombol akan disable
                                        $booking = $bookingModel->where('id_slot_jadwal', $slot['id_slot_jadwal'])->where('date_booking', $date_booking)->where('status_booking !=', 'Cancelled')->first();
                                        ?>
                                        <div class="col-4 mx-auto">
                                            <form action="/booking/layanan" method="get">
                                                <input type="hidden" name="date_booking" value="<?= $date_booking ?>">
                                                <input type="hidden" name="slt" value="<?= $slot['id_slot_jadwal'] ?>">
                                                <div class="form-group">
                                                    <button type="submit" class="btn bg-teal btn-block rounded-pill" <?= $booking ? 'disabled' : '' ?>><?= date("H:i", strtotime($slot['time_slot'])) ?></button>
                                                </div>
                                            </form>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <br>
                                <a href="/booking/date" class="btn btn-sm btn-danger rounded-pill px-3"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp; Kembali</a>
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