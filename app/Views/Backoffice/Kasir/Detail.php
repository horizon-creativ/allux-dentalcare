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
                                            <th><?= $invoice['name_dokter'] ?></th>
                                        </tr>
                                        <tr>
                                            <td>Pasien</td>
                                            <td>:</td>
                                            <th><?= $invoice['name_pasien'] ?></th>
                                        </tr>
                                        <tr>
                                            <td>Tgl. Perawatan</td>
                                            <td>:</td>
                                            <th><?= date("d F Y - H:i", strtotime($booking['date_booking'])) ?></th>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-3">
                                    <table>
                                        <tr>
                                            <td>No. Trans</td>
                                            <td>:</td>
                                            <th><?= $invoice['no_invoice'] ?></th>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-6 bg-secondary rounded px-3 pt-2">
                                    <div class="d-flex justify-content-between">
                                        <div class="text-left">
                                            <h1>Rp</h1>
                                        </div>
                                        <div class="text-right">
                                            <h1><?= number_format($invoice['total_invoice'], 0, ',', '.') ?></h1>
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
                            <a href="#" class="btn bg-purple float-right" data-toggle="modal" data-target="#pay-modal" title="Bayar"><i class="fas fa-money-bill-alt"></i>&nbsp; <b>Bayar</b></a>
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
                                            <!-- <th>Aksi</th> -->
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
                                                <!-- <td>
                                                    <a href="#" data-toggle="modal" data-target="#edit-modal<?= $invoiceItem['id_invoice_item'] ?>" class="btn bg-teal" title="Edit"><i class="fas fa-edit"></i></a>
                                                    <a href="#" data-toggle="modal" data-target="#delete-modal<?= $invoiceItem['id_invoice_item'] ?>" class="btn bg-danger" title="Hapus"><i class="fas fa-trash"></i></a>
                                                </td> -->
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
<div class="modal fade" id="pay-modal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pembayaran <?= $title ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/backoffice/kasir/pay" method="post">
                <input type="hidden" name="id_booking" value="<?= $booking['id_booking'] ?>">
                <input type="hidden" name="id_invoice" value="<?= $invoice['id_invoice'] ?>">
                <input type="hidden" name="total_invoice" id="total_invoice" value="<?= $invoice['total_invoice'] ?>">
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
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div class="text-left">
                                                <h1>Rp</h1>
                                            </div>
                                            <div class="text-right">
                                                <h1><?= number_format($invoice['total_invoice'], 0, ',', '.') ?></h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-4 col-form-label text-right">Metode Pembayaran</label>
                                <div class="col-sm-8">
                                    <select name="type_payment" id="" class="form-control select2bs4">
                                        <option value="TUNAI">TUNAI</option>
                                        <option value="QRIS">QRIS</option>
                                        <option value="DEBIT">DEBIT</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-4 col-form-label text-right">Jumlah Pembayaran</label>
                                <div class="col-sm-8">
                                    <input type="text" name="amount_payment" id="amount_payment" class="form-control <?= (validation_show_error('amount_payment')) ? 'is-invalid' : '' ?>" value="<?= old('amount_payment') ?>">
                                    <div id="amount_payment_error" class="invalid-feedback">
                                        <?= validation_show_error('amount_payment') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-4 col-form-label text-right">Kembalian</label>
                                <div class="col-sm-8">
                                    <input type="text" name="change_payment" id="change_payment" class="form-control" readonly>
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

<script>
    // Hitung Kembalian
    document.getElementById("amount_payment").addEventListener("input", function() {
        // Ambil nilai dari input
        let jumlah = parseFloat(this.value) || 0; // Jumlah pembayaran, default 0 jika kosong
        let total = parseFloat(document.getElementById("total_invoice").value) || 0; // Total pembayaran

        // Hitung kembalian
        let kembali = jumlah - total;

        // Tampilkan hasil ke input 'kembali'
        document.getElementById("change_payment").value = kembali > 0 ? kembali.toFixed(0) : 0;
    });
</script>

<?= $this->endSection() ?>