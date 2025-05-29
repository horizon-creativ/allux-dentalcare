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
                            <a href="#" class="btn bg-teal float-right" data-toggle="modal" data-target="#add-modal" title="Tambah Data"><i class="fas fa-plus"></i>&nbsp; <b>Tambah Data</b></a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-sm table-bordered" id="table-global">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>Nama</th>
                                            <th>Deskripsi</th>
                                            <th>Harga</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($layanans as $layanan): ?>
                                            <tr>
                                                <td class="text-center"><?= $no++ ?></td>
                                                <td><?= $layanan['name_layanan'] ?></td>
                                                <td><?= $layanan['desc_layanan'] ?></td>
                                                <td class="text-right">
                                                    <div class="d-flex justify-content-between">
                                                        <div class="text-left">Rp</div>
                                                        <div class="text-right"><?= number_format($layanan['price_layanan'], 0, ',', '.') ?></div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <?php if ($layanan['id_layanan'] != session('id_layanan')): ?>
                                                        <a href="#" data-toggle="modal" data-target="#edit-modal<?= $layanan['id_layanan'] ?>" class="btn bg-teal" title="Edit"><i class="fas fa-edit"></i></a>
                                                        <a href="#" data-toggle="modal" data-target="#delete-modal<?= $layanan['id_layanan'] ?>" class="btn bg-danger" title="Hapus"><i class="fas fa-trash"></i></a>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <!-- Modal Delete -->
                                            <div class="modal fade" id="delete-modal<?= $layanan['id_layanan'] ?>" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
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
                                                            <form action="/backoffice/layanan" method="post" class="d-inline">
                                                                <?= csrf_field() ?>
                                                                <input type="hidden" name="id_layanan" value="<?= $layanan['id_layanan'] ?>">
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <button type="submit" class="btn bg-danger">Ya, Hapus</button>
                                                            </form>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal Edit -->
                                            <div class="modal fade" id="edit-modal<?= $layanan['id_layanan'] ?>" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit <?= $title ?></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="/backoffice/layanan" method="post">
                                                            <!-- Hidden Form untuk merubah method menjadi PATCH -->
                                                            <input type="hidden" name="id_layanan" value="<?= $layanan['id_layanan'] ?>">
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
                                                                            <label for="name_layanan" class="col-form-label">Nama</label>
                                                                            <input type="text" name="name_layanan" id="name_layanan" class="form-control <?= (validation_show_error('name_layanan')) ? 'is-invalid' : '' ?>" value="<?= $layanan['name_layanan'] ?>">
                                                                            <!-- Validation Error Msg -->
                                                                            <div id="name_layanan_error" class="invalid-feedback">
                                                                                <?= validation_show_error('name_layanan') ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="price_layanan" class="col-form-label">Harga</label>
                                                                            <input type="text" name="price_layanan" id="price_layanan" class="form-control <?= (validation_show_error('price_layanan')) ? 'is-invalid' : '' ?>" value="<?= $layanan['price_layanan'] ?>">
                                                                            <!-- Validation Error Msg -->
                                                                            <div id="price_layanan_error" class="invalid-feedback">
                                                                                <?= validation_show_error('price_layanan') ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="desc_layanan" class="col-form-label">Deskripsi (Opsional)</label>
                                                                            <textarea name="desc_layanan" id="" cols="30" rows="5" class="form-control"><?= $layanan['desc_layanan'] ?></textarea>
                                                                            <!-- Validation Error Msg -->
                                                                            <div id="desc_layanan_error" class="invalid-feedback">
                                                                                <?= validation_show_error('desc_layanan') ?>
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
            <form action="/backoffice/layanan" method="post">
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
                                <label for="name_layanan" class="col-form-label">Nama</label>
                                <input type="text" name="name_layanan" id="name_layanan" class="form-control <?= (validation_show_error('name_layanan')) ? 'is-invalid' : '' ?>" value="<?= old('name_layanan') ?>">
                                <!-- Validation Error Msg -->
                                <div id="name_layanan_error" class="invalid-feedback">
                                    <?= validation_show_error('name_layanan') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="price_layanan" class="col-form-label">Harga</label>
                                <input type="text" name="price_layanan" id="price_layanan" class="form-control <?= (validation_show_error('price_layanan')) ? 'is-invalid' : '' ?>" value="<?= old('price_layanan') ?>">
                                <!-- Validation Error Msg -->
                                <div id="price_layanan_error" class="invalid-feedback">
                                    <?= validation_show_error('price_layanan') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="desc_layanan" class="col-form-label">Deskripsi (Opsional)</label>
                                <textarea name="desc_layanan" id="" cols="30" rows="5" class="form-control"><?= old('desc_layanan') ?></textarea>
                                <!-- Validation Error Msg -->
                                <div id="desc_layanan_error" class="invalid-feedback">
                                    <?= validation_show_error('desc_layanan') ?>
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