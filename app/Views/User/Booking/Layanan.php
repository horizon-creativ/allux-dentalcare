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
                                <h5 class="text-center">Isi Detail Booking</h5>
                                <br>
                                <div class="row">
                                    <div class="col-10 mx-auto">
                                        <form action="/booking/save" method="post">
                                            <input type="hidden" name="date_booking" value="<?= $date_booking ?>">
                                            <input type="hidden" name="id_slot_jadwal" value="<?= $slot['id_slot_jadwal'] ?>">
                                            <div class="form-group">
                                                <label for="">Hari</label>
                                                <input type="text" class="form-control" value="<?= convertDay($day_booking) ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Tanggal</label>
                                                <input type="text" class="form-control" value="<?= date('d F Y', strtotime($date_booking)) ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="id_layanan" class="col-form-label">Layanan</label>
                                                <select name="id_layanan" id="" class="form-control select2bs4 <?= (validation_show_error('id_layanan')) ? 'is-invalid' : '' ?>">
                                                    <option></option>
                                                    <?php foreach ($layanans as $layanan): ?>
                                                        <option value="<?= $layanan['id_layanan'] ?>" <?= old('id_layanan') == $layanan['id_layanan'] ? 'selected' : '' ?>><?= $layanan['name_layanan'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <!-- Validation Error Msg -->
                                                <div id="id_layanan_error" class="invalid-feedback">
                                                    <?= validation_show_error('id_layanan') ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="keluhan_booking" class="col-form-label">Deskripsi</label>
                                                    <textarea name="keluhan_booking" id="" cols="30" rows="5" class="form-control <?= (validation_show_error('keluhan_booking')) ? 'is-invalid' : '' ?>"><?= old('keluhan_booking') ?></textarea>
                                                    <!-- Validation Error Msg -->
                                                    <div id="keluhan_error" class="invalid-feedback">
                                                        <?= validation_show_error('keluhan_booking') ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn bg-teal btn-block rounded-pill">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <br>
                                <a href="/booking/slot?date_booking=<?= $date_booking ?>" class="btn btn-sm btn-danger rounded-pill px-3"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp; Kembali</a>
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