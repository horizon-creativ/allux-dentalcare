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
                        <!-- <li class="breadcrumb-item"><a href="#"><?= $menuGroup ?></a></li> -->
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
                                            <th>No Transaksi</th>
                                            <th>Tanggal</th>
                                            <th>Nama Pasien</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($invoices as $invoice): ?>
                                            <tr>
                                                <td class="text-center"><?= $no++ ?></td>
                                                <td><?= $invoice['no_invoice'] ?></td>
                                                <td><?= date("d F Y - H:i", strtotime($invoice['created_at'])) ?></td>
                                                <td><?= $invoice['name_pasien'] ?></td>
                                                <td class="text-right">
                                                    <div class="d-flex justify-content-between">
                                                        <div class="text-left">Rp</div>
                                                        <div class="text-right"><?= number_format($invoice['total_invoice'], 0, ',', '.') ?></div>
                                                    </div>
                                                </td>
                                                <td><?= $invoice['status_invoice'] ?></td>
                                                <td>
                                                    <!-- <a href="#" data-toggle="modal" data-target="#edit-modal<?= $invoice['id_invoice'] ?>" class="btn bg-teal" title="Cetak"><i class="fas fa-edit"></i></a> -->
                                                    <a href="/backoffice/kasir/<?= $invoice['id_invoice'] ?>" class="btn bg-teal" title="Detail" target="_blank"><i class="fas fa-eye"></i></a>
                                                    <a href="#" data-toggle="modal" data-target="#delete-modal<?= $invoice['id_invoice'] ?>" class="btn bg-danger" title="Hapus"><i class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            <!-- Modal Delete -->
                                            <div class="modal fade" id="delete-modal<?= $invoice['id_invoice'] ?>" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
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
                                                            <form action="/backoffice/kasir" method="post" class="d-inline">
                                                                <?= csrf_field() ?>
                                                                <input type="hidden" name="id_invoice" value="<?= $invoice['id_invoice'] ?>">
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <button type="submit" class="btn bg-danger">Ya, Hapus</button>
                                                            </form>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal Edit -->
                                            <div class="modal fade" id="edit-modal<?= $invoice['id_invoice'] ?>" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit <?= $title ?></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="/backoffice/invoice" method="post">
                                                            <!-- Hidden Form untuk merubah method menjadi PATCH -->
                                                            <input type="hidden" name="id_invoice" value="<?= $invoice['id_invoice'] ?>">
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
            <form action="/backoffice/invoice" method="post">
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
                                <label for="name_invoice" class="col-form-label">Nama</label>
                                <input type="text" name="name_invoice" id="name_invoice" class="form-control <?= (validation_show_error('name_invoice')) ? 'is-invalid' : '' ?>" value="<?= old('name_invoice') ?>">
                                <!-- Validation Error Msg -->
                                <div id="name_invoice_error" class="invalid-feedback">
                                    <?= validation_show_error('name_invoice') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="price_invoice" class="col-form-label">Harga</label>
                                <input type="text" name="price_invoice" id="price_invoice" class="form-control <?= (validation_show_error('price_invoice')) ? 'is-invalid' : '' ?>" value="<?= old('price_invoice') ?>">
                                <!-- Validation Error Msg -->
                                <div id="price_invoice_error" class="invalid-feedback">
                                    <?= validation_show_error('price_invoice') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="desc_invoice" class="col-form-label">Deskripsi (Opsional)</label>
                                <textarea name="desc_invoice" id="" cols="30" rows="5" class="form-control"><?= old('desc_invoice') ?></textarea>
                                <!-- Validation Error Msg -->
                                <div id="desc_invoice_error" class="invalid-feedback">
                                    <?= validation_show_error('desc_invoice') ?>
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