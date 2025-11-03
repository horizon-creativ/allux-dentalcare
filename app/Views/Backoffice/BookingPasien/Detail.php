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
                        <li class="breadcrumb-item"><a href="/backoffice/booking-pasien"><?= $menu ?></a></li>
                        <li class="breadcrumb-item active"><?= $booking['code_booking'] ?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <?php
            $totalInvoice = 0;
            foreach ($invoiceItems as $invoiceItemTotal) {
                $totalInvoice += $invoiceItemTotal['total_item'];
            }
            ?>
            <!-- Main row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <table>
                                        <tr>
                                            <td>Dokter</td>
                                            <td>:</td>
                                            <th><?= $dokter['name_dokter'] ?></th>
                                        </tr>
                                        <tr>
                                            <td>Pasien</td>
                                            <td>:</td>
                                            <th><?= $pasien['name_user'] ?></th>
                                        </tr>
                                        <tr>
                                            <td>Tanggal</td>
                                            <td>:</td>
                                            <th><?= date("d F Y - H:i", strtotime($booking['date_booking'])) ?></th>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-3">
                                    <table>
                                        <tr>
                                            <th>Keluhan</th>
                                            <td>:</td>
                                            <td><?= $booking['keluhan_booking'] ?></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-3">
                                    <table>
                                        <tr>
                                            <th>Total</th>
                                            <td>:</td>
                                            <td>Rp. <?= number_format($totalInvoice, 0, ',', '.') ?></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-3">
                                    <a href="#" class="btn bg-teal float-right" data-toggle="modal" data-target="#finish-modal">Selesai</a>
                                    <div class="modal fade" id="finish-modal" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
                                        <div class="modal-dialog modal modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-exclamation-triangle text-teal"></i></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah anda yakin proses perawatan sudah selesai?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                    <form action="/backoffice/booking-pasien/finish" method="post" class="d-inline">
                                                        <?= csrf_field() ?>
                                                        <input type="hidden" name="id_booking" value="<?= $booking['id_booking'] ?>">
                                                        <input type="hidden" name="id_invoice" value="<?= $invoice['id_invoice'] ?>">
                                                        <input type="hidden" name="total_invoice" value="<?= $totalInvoice ?>">
                                                        <button type="submit" class="btn bg-teal">Ya, Selesai</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row (main row) -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="#" class="btn bg-primary float-right ml-3" data-toggle="modal" data-target="#add-obat-modal" title="Tambah Data"><i class="fas fa-pills"></i>&nbsp; <b>Tambah Obat</b></a>
                            <a href="#" class="btn bg-teal float-right" data-toggle="modal" data-target="#add-layanan-modal" title="Tambah Data"><i class="fas fa-user-md"></i>&nbsp; <b>Tambah Layanan</b></a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-sm table-bordered" id="table-global">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>Nama</th>
                                            <th>Tipe</th>
                                            <th>Deskripsi</th>
                                            <th>Harga</th>
                                            <th>Qty</th>
                                            <th>Total</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($invoiceItems as $invoiceItem): ?>
                                            <tr>
                                                <td class="text-center"><?= $no++ ?></td>
                                                <td><?= $invoiceItem['name_item'] ?></td>
                                                <td><?= $invoiceItem['type_item'] ?></td>
                                                <td><?= $invoiceItem['desc_item'] ?></td>
                                                <td>
                                                    <div class="d-flex justify-content-between">
                                                        <div class="text-left">Rp</div>
                                                        <div class="text-right"><?= number_format($invoiceItem['price_item'], 0, ',', '.') ?></div>
                                                    </div>
                                                </td>
                                                <td class="text-center"><?= $invoiceItem['qty_item'] ?></td>
                                                <td>
                                                    <div class="d-flex justify-content-between">
                                                        <div class="text-left">Rp</div>
                                                        <div class="text-right"><?= number_format($invoiceItem['total_item'], 0, ',', '.') ?></div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#" data-toggle="modal" data-target="#edit-modal<?= $invoiceItem['id_invoice_item'] ?>" class="btn bg-teal" title="Edit"><i class="fas fa-edit"></i></a>
                                                    <a href="#" data-toggle="modal" data-target="#delete-modal<?= $invoiceItem['id_invoice_item'] ?>" class="btn bg-danger" title="Hapus"><i class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            <!-- Modal Delete -->
                                            <div class="modal fade" id="delete-modal<?= $invoiceItem['id_invoice_item'] ?>" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
                                                <div class="modal-dialog modal-sm modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-exclamation-triangle text-danger"></i></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Item akan dihapus secara permanen. Apakah anda yakin akan menghapus data item?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="/backoffice/booking-pasien/item" method="post" class="d-inline">
                                                                <?= csrf_field() ?>
                                                                <input type="hidden" name="id_invoice_item" value="<?= $invoiceItem['id_invoice_item'] ?>">
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
                                            <div class="modal fade" id="edit-modal<?= $invoiceItem['id_invoice_item'] ?>" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Detail Item</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <!-- Hidden Form untuk merubah method menjadi PATCH -->
                                                        <form action="/backoffice/booking-pasien/item" method="post">
                                                            <!-- Hidden Form untuk merubah method menjadi PATCH -->
                                                            <input type="hidden" name="id_invoice_item" value="<?= $invoiceItem['id_invoice_item'] ?>">
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
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="name_item" class="col-form-label">Nama</label>
                                                                            <input type="text" name="name_item" id="name_item" class="form-control <?= (validation_show_error('name_item')) ? 'is-invalid' : '' ?>" value="<?= $invoiceItem['name_item'] ?>" readonly>
                                                                            <!-- Validation Error Msg -->
                                                                            <div id="name_item_error" class="invalid-feedback">
                                                                                <?= validation_show_error('name_item') ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="qty_item" class="col-form-label">Jumlah</label>
                                                                            <input type="number" name="qty_item" id="qty_item" class="form-control <?= (validation_show_error('qty_item')) ? 'is-invalid' : '' ?>" value="<?= $invoiceItem['qty_item'] ?>">
                                                                            <!-- Validation Error Msg -->
                                                                            <div id="qty_item_error" class="invalid-feedback">
                                                                                <?= validation_show_error('qty_item') ?>
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
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<!-- Add Modal -->
<div class="modal fade" id="add-layanan-modal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Layanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/backoffice/booking-pasien/layanan" method="post">
                <input type="hidden" name="id_booking" value="<?= $booking['id_booking'] ?>">
                <input type="hidden" name="id_invoice" value="<?= $invoice['id_invoice'] ?>">
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
                                <label for="id_layanan" class="col-form-label">Layanan</label>
                                <select name="id_layanan" id="" class="form-control select2bs4" <?= (validation_show_error('id_layanan')) ? 'is-invalid' : '' ?>>
                                    <?php foreach ($layanans as $layanan): ?>
                                        <option value="<?= $layanan['id_layanan'] ?>"><?= $layanan['name_layanan'] . ' - ' . number_format($layanan['price_layanan'], 0, ',', '.') ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <!-- Validation Error Msg -->
                                <div id="id_layanan_error" class="invalid-feedback">
                                    <?= validation_show_error('id_layanan') ?>
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <label for="qty_layanan" class="col-form-label">Jumlah</label> -->
                            <input type="hidden" name="qty_layanan" id="qty_layanan" class="form-control <?= (validation_show_error('qty_layanan')) ? 'is-invalid' : '' ?>" value="<?= 1 ?>">
                            <!-- Validation Error Msg -->
                            <!-- <div id="qty_layanan_error" class="invalid-feedback">
                                    <?= validation_show_error('qty_layanan') ?>
                                </div>
                            </div> -->
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

<!-- Add Modal -->
<div class="modal fade" id="add-obat-modal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah <?= $title ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/backoffice/booking-pasien/obat" method="post">
                <input type="hidden" name="id_booking" value="<?= $booking['id_booking'] ?>">
                <input type="hidden" name="id_invoice" value="<?= $invoice['id_invoice'] ?>">
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
                                <label for="id_obat" class="col-form-label">Obat</label>
                                <select name="id_obat" id="" class="form-control select2bs4" <?= (validation_show_error('id_obat')) ? 'is-invalid' : '' ?>>
                                    <?php foreach ($obats as $obat): ?>
                                        <option value="<?= $obat['id_obat'] ?>"><?= $obat['name_obat'] . ' - ' . number_format($obat['price_obat'], 0, ',', '.') ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <!-- Validation Error Msg -->
                                <div id="id_obat_error" class="invalid-feedback">
                                    <?= validation_show_error('id_obat') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="qty_obat" class="col-form-label">Jumlah</label>
                                <input type="number" name="qty_obat" id="qty_obat" class="form-control <?= (validation_show_error('qty_obat')) ? 'is-invalid' : '' ?>" value="<?= 1 ?>">
                                <!-- Validation Error Msg -->
                                <div id="qty_obat_error" class="invalid-feedback">
                                    <?= validation_show_error('qty_obat') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="desc_obat" class="col-form-label">Instruksi Pemakaian Obat</label>
                                <textarea name="desc_obat" id="" cols="30" rows="3" class="form-control <?= (validation_show_error('desc_obat')) ? 'is-invalid' : '' ?>"></textarea>
                                <!-- Validation Error Msg -->
                                <div id="desc_obat_error" class="invalid-feedback">
                                    <?= validation_show_error('desc_obat') ?>
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