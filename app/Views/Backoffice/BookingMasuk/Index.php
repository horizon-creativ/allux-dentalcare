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
                            <!-- <a href="#" class="btn bg-teal float-right" data-toggle="modal" data-target="#add-modal" title="Tambah Data"><i class="fas fa-plus"></i>&nbsp; <b>Tambah Data</b></a> -->
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-sm table-bordered" id="table-global">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>Kode</th>
                                            <th>Tanggal</th>
                                            <th>Jam</th>
                                            <th>Pasien</th>
                                            <th>Dokter</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
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
                                            $dokter = $dokterModel->where('id_dokter', $jadwal['id_dokter'])->first();
                                            ?>
                                            <tr>
                                                <td class="text-center"><?= $no++ ?></td>
                                                <td><?= $booking['code_booking'] ?></td>
                                                <td><?= date('d F Y', strtotime($booking['date_booking'])) ?></td>
                                                <td><?= date('H:i', strtotime($booking['date_booking'])) ?></td>
                                                <td><?= $pasien['name_user'] ?></td>
                                                <td><?= $dokter['name_user'] ?></td>
                                                <td><span class="badge bg-<?= statusColor($booking['status_booking']) ?>"><?= $booking['status_booking'] ?></span></td>
                                                <td>
                                                    <a href="#" data-toggle="modal" data-target="#detail-modal<?= $booking['id_booking'] ?>" class="btn bg-teal" title="Detail"><i class="fas fa-eye"></i></a>
                                                </td>
                                            </tr>
                                            <!-- Modal Delete -->
                                            <div class="modal fade" id="delete-modal<?= $booking['id_booking'] ?>" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
                                                <div class="modal-dialog modal-sm modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-exclamation-triangle text-danger"></i></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Apakah anda yakin akan menghapus data <?= $title ?>?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="/backoffice/booking" method="post" class="d-inline">
                                                                <?= csrf_field() ?>
                                                                <input type="hidden" name="id_booking" value="<?= $booking['id_booking'] ?>">
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <button type="submit" class="btn bg-danger">Ya, Hapus</button>
                                                            </form>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal Edit -->
                                            <div class="modal fade" id="detail-modal<?= $booking['id_booking'] ?>" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Detail <?= $title ?></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <!-- Hidden Form untuk merubah method menjadi PATCH -->
                                                        <input type="hidden" name="id_booking" value="<?= $booking['id_booking'] ?>">
                                                        <input type="hidden" name="_method" value="PATCH">
                                                        <?= csrf_field() ?>
                                                        <div class="modal-body">
                                                            <?php if (session()->getFlashdata('failed')) : ?>
                                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                                    <strong><i class="fas fa-exclamation-triangle"></i></strong> &nbsp; <?= session()->getFlashdata('failed') ?>
                                                                </div>
                                                            <?php endif; ?>
                                                            <div class="row">
                                                                <div class="col-4">
                                                                    <h1 class="text-center"><span class="badge bg-secondary"><?= $booking['code_booking'] ?></span></h1>
                                                                </div>
                                                                <div class="col-8">
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
                                                                            <div class="float-right"><?= date('d F Y', strtotime($booking['date_booking'])) ?> - <?= date('H:i', strtotime($slotJadwal['time_slot'])) ?></div>
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
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <?php

                                                            $btnConfirmStatus = '';
                                                            $btnCancelStatus = '';
                                                            if (array_search($booking['status_booking'], ['Completed', 'Cancelled', 'On Progress', 'Confirmed']) != '') {
                                                                $btnConfirmStatus = 'disabled';
                                                            }

                                                            if (array_search($booking['status_booking'], ['Completed', 'Cancelled', 'On Progress']) != '') {
                                                                $btnCancelStatus = 'disabled';
                                                            }
                                                            ?>
                                                            <form action="/backoffice/booking-masuk" method="post">
                                                                <input type="hidden" name="_method" value="PATCH">
                                                                <input type="hidden" name="id_booking" value="<?= $booking['id_booking'] ?>">
                                                                <input type="hidden" name="status_booking" value="Cancelled">
                                                                <button type="submit" class="btn bg-danger" <?= $btnCancelStatus ?>>Tolak Booking</button>
                                                            </form>
                                                            <form action="/backoffice/booking-masuk" method="post">
                                                                <input type="hidden" name="_method" value="PATCH">
                                                                <input type="hidden" name="id_booking" value="<?= $booking['id_booking'] ?>">
                                                                <input type="hidden" name="status_booking" value="Confirmed">
                                                                <button type="submit" class="btn bg-teal" <?= $btnConfirmStatus ?>>Konfirmasi Booking</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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

<!-- Add Modal -->
<div class="modal fade" id="add-modal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah <?= $title ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/backoffice/booking" method="post">
                <div class="modal-body">
                    <?php if (session()->getFlashdata('failed')) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><i class="fas fa-exclamation-triangle"></i></strong> &nbsp; <?= session()->getFlashdata('failed') ?>
                            <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button> -->
                        </div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name_booking" class="col-form-label">Nama</label>
                                <input type="text" name="name_booking" id="name_booking" class="form-control <?= (validation_show_error('name_booking')) ? 'is-invalid' : '' ?>" value="<?= old('name_booking') ?>">
                                <!-- Validation Error Msg -->
                                <div id="name_booking_error" class="invalid-feedback">
                                    <?= validation_show_error('name_booking') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email_booking" class="col-form-label">Email</label>
                                <input type="text" name="email_booking" id="email_booking" class="form-control <?= (validation_show_error('email_booking')) ? 'is-invalid' : '' ?>" value="<?= old('email_booking') ?>">
                                <!-- Validation Error Msg -->
                                <div id="email_booking_error" class="invalid-feedback">
                                    <?= validation_show_error('email_booking') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password_booking" class="col-form-label">Password</label>
                                <input type="password" name="password_booking" id="password_booking" class="form-control <?= (validation_show_error('password_booking')) ? 'is-invalid' : '' ?>" value="<?= old('password_booking') ?>">
                                <!-- Validation Error Msg -->
                                <div id="password_booking_error" class="invalid-feedback">
                                    <?= validation_show_error('password_booking') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="phone_booking" class="col-form-label">No. Telp</label>
                                <input type="text" name="phone_booking" id="phone_booking" class="form-control <?= (validation_show_error('phone_booking')) ? 'is-invalid' : '' ?>" value="<?= old('phone_booking') ?>">
                                <!-- Validation Error Msg -->
                                <div id="phone_booking_error" class="invalid-feedback">
                                    <?= validation_show_error('phone_booking') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="level_booking" class="col-form-label">Level</label>
                                <select name="level_booking" id="" class="form-control select2bs4 <?= (validation_show_error('level_booking')) ? 'is-invalid' : '' ?>">
                                    <option></option>
                                    <option value="Kasir" <?= old('level_booking') == 'Kasir' ? 'selected' : '' ?>>Kasir</option>
                                    <option value="Dokter" <?= old('level_booking') == 'Dokter' ? 'selected' : '' ?>>Dokter</option>
                                    <option value="Superadmin" <?= old('level_booking') == 'Superadmin' ? 'selected' : '' ?>>Superadmin</option>
                                </select>
                                <!-- Validation Error Msg -->
                                <div id="level_booking_error" class="invalid-feedback">
                                    <?= validation_show_error('level_booking') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn bg-teal">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>