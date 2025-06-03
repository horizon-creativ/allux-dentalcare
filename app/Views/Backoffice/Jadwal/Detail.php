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
                        <li class="breadcrumb-item"><a href="/backoffice/jadwal"><?= $menu ?></a></li>
                        <li class="breadcrumb-item active"><?= $user['name_user'] ?></li>
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
                            <a href="#" class="btn bg-teal float-right" data-toggle="modal" data-target="#add-modal" title="Tambah Data"><i class="fas fa-plus"></i>&nbsp; <b>Tambah Data</b></a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-sm table-bordered" id="table-global">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>Hari</th>
                                            <th>Jam Mulai</th>
                                            <th>Jam Selesai</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($jadwals as $jadwal): ?>
                                            <tr>
                                                <td class="text-center"><?= $no++ ?></td>
                                                <td><?= convertDay($jadwal['day_jadwal']) ?></td>
                                                <td><?= $jadwal['start_jadwal'] ?></td>
                                                <td><?= $jadwal['end_jadwal'] ?></td>
                                                <td>
                                                    <?php if ($jadwal['id_jadwal'] != session('id_jadwal')): ?>
                                                        <a href="#" data-toggle="modal" data-target="#edit-modal<?= $jadwal['id_jadwal'] ?>" class="btn bg-teal" title="Edit"><i class="fas fa-edit"></i></a>
                                                        <a href="#" data-toggle="modal" data-target="#delete-modal<?= $jadwal['id_jadwal'] ?>" class="btn bg-danger" title="Hapus"><i class="fas fa-trash"></i></a>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <!-- Modal Delete -->
                                            <div class="modal fade" id="delete-modal<?= $jadwal['id_jadwal'] ?>" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
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
                                                            <form action="/backoffice/jadwal" method="post" class="d-inline">
                                                                <?= csrf_field() ?>
                                                                <input type="hidden" name="id_user" value="<?= $jadwal['id_user'] ?>">
                                                                <input type="hidden" name="id_jadwal" value="<?= $jadwal['id_jadwal'] ?>">
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <button type="submit" class="btn bg-danger">Ya, Hapus</button>
                                                            </form>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal Edit -->
                                            <div class="modal fade" id="edit-modal<?= $jadwal['id_jadwal'] ?>" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit <?= $title ?></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="/backoffice/jadwal" method="post">
                                                            <!-- Hidden Form untuk merubah method menjadi PATCH -->
                                                            <input type="hidden" name="id_jadwal" value="<?= $jadwal['id_jadwal'] ?>">
                                                            <input type="hidden" name="id_user" value="<?= $jadwal['id_user'] ?>">
                                                            <input type="hidden" name="_method" value="PATCH">
                                                            <?= csrf_field() ?>
                                                            <div class="modal-body">
                                                                <?php if (session()->getFlashdata('failed')) : ?>
                                                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                                        <strong><i class="fas fa-exclamation-triangle"></i></strong> &nbsp; <?= session()->getFlashdata('failed') ?>
                                                                    </div>
                                                                <?php endif; ?>
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="day_jadwal" class="col-form-label">Hari</label>
                                                                            <select name="day_jadwal" id="" class="form-control select2bs4 <?= (validation_show_error('day_jadwal')) ? 'is-invalid' : '' ?>">
                                                                                <option></option>
                                                                                <option value="0" <?= $jadwal['day_jadwal'] == '0' ? 'selected' : '' ?>>Minggu</option>
                                                                                <option value="1" <?= $jadwal['day_jadwal'] == '1' ? 'selected' : '' ?>>Senin</option>
                                                                                <option value="2" <?= $jadwal['day_jadwal'] == '2' ? 'selected' : '' ?>>Selasa</option>
                                                                                <option value="3" <?= $jadwal['day_jadwal'] == '3' ? 'selected' : '' ?>>Rabu</option>
                                                                                <option value="4" <?= $jadwal['day_jadwal'] == '4' ? 'selected' : '' ?>>Kamis</option>
                                                                                <option value="5" <?= $jadwal['day_jadwal'] == '5' ? 'selected' : '' ?>>Jumat</option>
                                                                                <option value="6" <?= $jadwal['day_jadwal'] == '6' ? 'selected' : '' ?>>Sabtu</option>
                                                                            </select>
                                                                            <!-- Validation Error Msg -->
                                                                            <div id="day_jadwal_error" class="invalid-feedback">
                                                                                <?= validation_show_error('day_jadwal') ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="start_jadwal" class="col-form-label">Mulai</label>
                                                                            <input type="text" name="start_jadwal" id="start_jadwal" class="form-control <?= (validation_show_error('start_jadwal')) ? 'is-invalid' : '' ?>" value="<?= $jadwal['start_jadwal'] ?>" data-inputmask-alias="datetime" data-inputmask-inputformat="HH:MM" data-mask>
                                                                            <!-- Validation Error Msg -->
                                                                            <div id="start_jadwal_error" class="invalid-feedback">
                                                                                <?= validation_show_error('start_jadwal') ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="end_jadwal" class="col-form-label">Selesai</label>
                                                                            <input type="text" name="end_jadwal" id="end_jadwal" class="form-control <?= (validation_show_error('end_jadwal')) ? 'is-invalid' : '' ?>" value="<?= $jadwal['end_jadwal'] ?>" data-inputmask-alias="datetime" data-inputmask-inputformat="HH:MM" data-mask>
                                                                            <!-- Validation Error Msg -->
                                                                            <div id="end_jadwal_error" class="invalid-feedback">
                                                                                <?= validation_show_error('end_jadwal') ?>
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
            <form action="/backoffice/jadwal" method="post">
                <input type="hidden" name="id_user" value="<?= $user['id_user'] ?>">
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
                                <label for="day_jadwal" class="col-form-label">Hari</label>
                                <select name="day_jadwal" id="" class="form-control select2bs4 <?= (validation_show_error('day_jadwal')) ? 'is-invalid' : '' ?>">
                                    <option></option>
                                    <option value="0" <?= old('day_jadwal') == '0' ? 'selected' : '' ?>>Minggu</option>
                                    <option value="1" <?= old('day_jadwal') == '1' ? 'selected' : '' ?>>Senin</option>
                                    <option value="2" <?= old('day_jadwal') == '2' ? 'selected' : '' ?>>Selasa</option>
                                    <option value="3" <?= old('day_jadwal') == '3' ? 'selected' : '' ?>>Rabu</option>
                                    <option value="4" <?= old('day_jadwal') == '4' ? 'selected' : '' ?>>Kamis</option>
                                    <option value="5" <?= old('day_jadwal') == '5' ? 'selected' : '' ?>>Jumat</option>
                                    <option value="6" <?= old('day_jadwal') == '6' ? 'selected' : '' ?>>Sabtu</option>
                                </select>
                                <!-- Validation Error Msg -->
                                <div id="day_jadwal_error" class="invalid-feedback">
                                    <?= validation_show_error('day_jadwal') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="start_jadwal" class="col-form-label">Mulai</label>
                                <input type="text" name="start_jadwal" id="start_jadwal" class="form-control <?= (validation_show_error('start_jadwal')) ? 'is-invalid' : '' ?>" value="<?= old('start_jadwal') ?>" data-inputmask-alias="datetime" data-inputmask-inputformat="HH:MM" data-mask>
                                <!-- Validation Error Msg -->
                                <div id="start_jadwal_error" class="invalid-feedback">
                                    <?= validation_show_error('start_jadwal') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="end_jadwal" class="col-form-label">Selesai</label>
                                <input type="text" name="end_jadwal" id="end_jadwal" class="form-control <?= (validation_show_error('end_jadwal')) ? 'is-invalid' : '' ?>" value="<?= old('end_jadwal') ?>" data-inputmask-alias="datetime" data-inputmask-inputformat="HH:MM" data-mask>
                                <!-- Validation Error Msg -->
                                <div id="end_jadwal_error" class="invalid-feedback">
                                    <?= validation_show_error('end_jadwal') ?>
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