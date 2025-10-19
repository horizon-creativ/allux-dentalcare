<?= $this->extend('Layout/Template_Bo') ?>
<?= $this->section('content') ?>

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
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>No. Telp</th>
                                            <!-- <th>Level</th>
                                            <th>Aksi</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($pasiens as $pasien): ?>
                                            <tr>
                                                <td class="text-center"><?= $no++ ?></td>
                                                <td><?= $pasien['name_pasien'] ?></td>
                                                <td><?= $pasien['email_pasien'] ?></td>
                                                <td><?= $pasien['phone_pasien'] ?></td>
                                                <!-- <td><?= $pasien['level_pasien'] ?></td> -->
                                                <!-- <td>
                                                    <a href="#" data-toggle="modal" data-target="#edit-modal<?= $pasien['id_pasien'] ?>" class="btn bg-teal" title="Edit"><i class="fas fa-edit"></i></a>
                                                    <a href="#" data-toggle="modal" data-target="#delete-modal<?= $pasien['id_pasien'] ?>" class="btn bg-danger" title="Hapus"><i class="fas fa-trash"></i></a>
                                                </td> -->
                                            </tr>
                                            <!-- Modal Delete -->
                                            <div class="modal fade" id="delete-modal<?= $pasien['id_pasien'] ?>" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
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
                                                            <form action="/backoffice/pasien" method="post" class="d-inline">
                                                                <?= csrf_field() ?>
                                                                <input type="hidden" name="id_pasien" value="<?= $pasien['id_pasien'] ?>">
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <button type="submit" class="btn bg-danger">Ya, Hapus</button>
                                                            </form>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal Edit -->
                                            <div class="modal fade" id="edit-modal<?= $pasien['id_pasien'] ?>" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit <?= $title ?></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="/backoffice/pasien" method="post">
                                                            <!-- Hidden Form untuk merubah method menjadi PATCH -->
                                                            <input type="hidden" name="id_pasien" value="<?= $pasien['id_pasien'] ?>">
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
                                                                            <label for="name_pasien" class="col-form-label">Nama</label>
                                                                            <input type="text" name="name_pasien" id="name_pasien" class="form-control <?= (validation_show_error('name_pasien')) ? 'is-invalid' : '' ?>" value="<?= $pasien['name_pasien'] ?>">
                                                                            <!-- Validation Error Msg -->
                                                                            <div id="name_pasien_error" class="invalid-feedback">
                                                                                <?= validation_show_error('name_pasien') ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="email_pasien" class="col-form-label">Email</label>
                                                                            <input type="text" name="email_pasien" id="email_pasien" class="form-control <?= (validation_show_error('email_pasien')) ? 'is-invalid' : '' ?>" value="<?= $pasien['email_pasien'] ?>">
                                                                            <!-- Validation Error Msg -->
                                                                            <div id="email_pasien_error" class="invalid-feedback">
                                                                                <?= validation_show_error('email_pasien') ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="phone_pasien" class="col-form-label">No. Telp</label>
                                                                            <input type="text" name="phone_pasien" id="phone_pasien" class="form-control <?= (validation_show_error('phone_pasien')) ? 'is-invalid' : '' ?>" value="<?= $pasien['phone_pasien'] ?>">
                                                                            <!-- Validation Error Msg -->
                                                                            <div id="phone_pasien_error" class="invalid-feedback">
                                                                                <?= validation_show_error('phone_pasien') ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="level_pasien" class="col-form-label">Level</label>
                                                                            <select name="level_pasien" id="" class="form-control select2bs4 <?= (validation_show_error('level_pasien')) ? 'is-invalid' : '' ?>">
                                                                                <option></option>
                                                                                <option value="Kasir" <?= $pasien['level_pasien'] == 'Kasir' ? 'selected' : '' ?>>Kasir</option>
                                                                                <option value="Dokter" <?= $pasien['level_pasien'] == 'Dokter' ? 'selected' : '' ?>>Dokter</option>
                                                                                <option value="Superadmin" <?= $pasien['level_pasien'] == 'Superadmin' ? 'selected' : '' ?>>Superadmin</option>
                                                                            </select>
                                                                            <!-- Validation Error Msg -->
                                                                            <div id="level_pasien_error" class="invalid-feedback">
                                                                                <?= validation_show_error('level_pasien') ?>
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
            <form action="/backoffice/pasien" method="post">
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
                                <label for="name_pasien" class="col-form-label">Nama</label>
                                <input type="text" name="name_pasien" id="name_pasien" class="form-control <?= (validation_show_error('name_pasien')) ? 'is-invalid' : '' ?>" value="<?= old('name_pasien') ?>">
                                <!-- Validation Error Msg -->
                                <div id="name_pasien_error" class="invalid-feedback">
                                    <?= validation_show_error('name_pasien') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email_pasien" class="col-form-label">Email</label>
                                <input type="text" name="email_pasien" id="email_pasien" class="form-control <?= (validation_show_error('email_pasien')) ? 'is-invalid' : '' ?>" value="<?= old('email_pasien') ?>">
                                <!-- Validation Error Msg -->
                                <div id="email_pasien_error" class="invalid-feedback">
                                    <?= validation_show_error('email_pasien') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password_pasien" class="col-form-label">Password</label>
                                <input type="password" name="password_pasien" id="password_pasien" class="form-control <?= (validation_show_error('password_pasien')) ? 'is-invalid' : '' ?>" value="<?= old('password_pasien') ?>">
                                <!-- Validation Error Msg -->
                                <div id="password_pasien_error" class="invalid-feedback">
                                    <?= validation_show_error('password_pasien') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="phone_pasien" class="col-form-label">No. Telp</label>
                                <input type="text" name="phone_pasien" id="phone_pasien" class="form-control <?= (validation_show_error('phone_pasien')) ? 'is-invalid' : '' ?>" value="<?= old('phone_pasien') ?>">
                                <!-- Validation Error Msg -->
                                <div id="phone_pasien_error" class="invalid-feedback">
                                    <?= validation_show_error('phone_pasien') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="level_pasien" class="col-form-label">Level</label>
                                <select name="level_pasien" id="" class="form-control select2bs4 <?= (validation_show_error('level_pasien')) ? 'is-invalid' : '' ?>">
                                    <option></option>
                                    <option value="Kasir" <?= old('level_pasien') == 'Kasir' ? 'selected' : '' ?>>Kasir</option>
                                    <option value="Dokter" <?= old('level_pasien') == 'Dokter' ? 'selected' : '' ?>>Dokter</option>
                                    <option value="Superadmin" <?= old('level_pasien') == 'Superadmin' ? 'selected' : '' ?>>Superadmin</option>
                                </select>
                                <!-- Validation Error Msg -->
                                <div id="level_pasien_error" class="invalid-feedback">
                                    <?= validation_show_error('level_pasien') ?>
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