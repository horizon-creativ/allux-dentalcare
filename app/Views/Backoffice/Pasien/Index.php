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
                                        foreach ($users as $user): ?>
                                            <tr>
                                                <td class="text-center"><?= $no++ ?></td>
                                                <td><?= $user['name_user'] ?></td>
                                                <td><?= $user['email_user'] ?></td>
                                                <td><?= $user['phone_user'] ?></td>
                                                <!-- <td><?= $user['level_user'] ?></td> -->
                                                <!-- <td>
                                                    <a href="#" data-toggle="modal" data-target="#edit-modal<?= $user['id_user'] ?>" class="btn bg-teal" title="Edit"><i class="fas fa-edit"></i></a>
                                                    <a href="#" data-toggle="modal" data-target="#delete-modal<?= $user['id_user'] ?>" class="btn bg-danger" title="Hapus"><i class="fas fa-trash"></i></a>
                                                </td> -->
                                            </tr>
                                            <!-- Modal Delete -->
                                            <div class="modal fade" id="delete-modal<?= $user['id_user'] ?>" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
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
                                                            <form action="/backoffice/user" method="post" class="d-inline">
                                                                <?= csrf_field() ?>
                                                                <input type="hidden" name="id_user" value="<?= $user['id_user'] ?>">
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <button type="submit" class="btn bg-danger">Ya, Hapus</button>
                                                            </form>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal Edit -->
                                            <div class="modal fade" id="edit-modal<?= $user['id_user'] ?>" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit <?= $title ?></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="/backoffice/user" method="post">
                                                            <!-- Hidden Form untuk merubah method menjadi PATCH -->
                                                            <input type="hidden" name="id_user" value="<?= $user['id_user'] ?>">
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
                                                                            <label for="name_user" class="col-form-label">Nama</label>
                                                                            <input type="text" name="name_user" id="name_user" class="form-control <?= (validation_show_error('name_user')) ? 'is-invalid' : '' ?>" value="<?= $user['name_user'] ?>">
                                                                            <!-- Validation Error Msg -->
                                                                            <div id="name_user_error" class="invalid-feedback">
                                                                                <?= validation_show_error('name_user') ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="email_user" class="col-form-label">Email</label>
                                                                            <input type="text" name="email_user" id="email_user" class="form-control <?= (validation_show_error('email_user')) ? 'is-invalid' : '' ?>" value="<?= $user['email_user'] ?>">
                                                                            <!-- Validation Error Msg -->
                                                                            <div id="email_user_error" class="invalid-feedback">
                                                                                <?= validation_show_error('email_user') ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="phone_user" class="col-form-label">No. Telp</label>
                                                                            <input type="text" name="phone_user" id="phone_user" class="form-control <?= (validation_show_error('phone_user')) ? 'is-invalid' : '' ?>" value="<?= $user['phone_user'] ?>">
                                                                            <!-- Validation Error Msg -->
                                                                            <div id="phone_user_error" class="invalid-feedback">
                                                                                <?= validation_show_error('phone_user') ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="level_user" class="col-form-label">Level</label>
                                                                            <select name="level_user" id="" class="form-control select2bs4 <?= (validation_show_error('level_user')) ? 'is-invalid' : '' ?>">
                                                                                <option></option>
                                                                                <option value="Kasir" <?= $user['level_user'] == 'Kasir' ? 'selected' : '' ?>>Kasir</option>
                                                                                <option value="Dokter" <?= $user['level_user'] == 'Dokter' ? 'selected' : '' ?>>Dokter</option>
                                                                                <option value="Superadmin" <?= $user['level_user'] == 'Superadmin' ? 'selected' : '' ?>>Superadmin</option>
                                                                            </select>
                                                                            <!-- Validation Error Msg -->
                                                                            <div id="level_user_error" class="invalid-feedback">
                                                                                <?= validation_show_error('level_user') ?>
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
            <form action="/backoffice/user" method="post">
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
                                <label for="name_user" class="col-form-label">Nama</label>
                                <input type="text" name="name_user" id="name_user" class="form-control <?= (validation_show_error('name_user')) ? 'is-invalid' : '' ?>" value="<?= old('name_user') ?>">
                                <!-- Validation Error Msg -->
                                <div id="name_user_error" class="invalid-feedback">
                                    <?= validation_show_error('name_user') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email_user" class="col-form-label">Email</label>
                                <input type="text" name="email_user" id="email_user" class="form-control <?= (validation_show_error('email_user')) ? 'is-invalid' : '' ?>" value="<?= old('email_user') ?>">
                                <!-- Validation Error Msg -->
                                <div id="email_user_error" class="invalid-feedback">
                                    <?= validation_show_error('email_user') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password_user" class="col-form-label">Password</label>
                                <input type="password" name="password_user" id="password_user" class="form-control <?= (validation_show_error('password_user')) ? 'is-invalid' : '' ?>" value="<?= old('password_user') ?>">
                                <!-- Validation Error Msg -->
                                <div id="password_user_error" class="invalid-feedback">
                                    <?= validation_show_error('password_user') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="phone_user" class="col-form-label">No. Telp</label>
                                <input type="text" name="phone_user" id="phone_user" class="form-control <?= (validation_show_error('phone_user')) ? 'is-invalid' : '' ?>" value="<?= old('phone_user') ?>">
                                <!-- Validation Error Msg -->
                                <div id="phone_user_error" class="invalid-feedback">
                                    <?= validation_show_error('phone_user') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="level_user" class="col-form-label">Level</label>
                                <select name="level_user" id="" class="form-control select2bs4 <?= (validation_show_error('level_user')) ? 'is-invalid' : '' ?>">
                                    <option></option>
                                    <option value="Kasir" <?= old('level_user') == 'Kasir' ? 'selected' : '' ?>>Kasir</option>
                                    <option value="Dokter" <?= old('level_user') == 'Dokter' ? 'selected' : '' ?>>Dokter</option>
                                    <option value="Superadmin" <?= old('level_user') == 'Superadmin' ? 'selected' : '' ?>>Superadmin</option>
                                </select>
                                <!-- Validation Error Msg -->
                                <div id="level_user_error" class="invalid-feedback">
                                    <?= validation_show_error('level_user') ?>
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