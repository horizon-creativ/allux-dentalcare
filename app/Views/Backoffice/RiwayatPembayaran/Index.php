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
                            <div class="row">
                                <div class="col-10">
                                    <form action="/backoffice/riwayat/pembayaran" method="GET">
                                        <div class="row">
                                            <label>Date range:</label>
                                            <div class="form-group ml-3">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="far fa-calendar-alt"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control float-right daterange" name="daterange">
                                                </div>
                                                <!-- /.input group -->
                                            </div>
                                            <div class="form-group ml-3">
                                                <button type="submit" class="btn btn-primary">Filter</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-sm table-bordered" id="table-print">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>No Transaksi</th>
                                            <th>Tanggal</th>
                                            <th>Nama Pasien</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>Metode Pembayaran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($invoices as $invoice): ?>
                                            <?php
                                            $payment = $paymentModel->where('id_invoice', $invoice['id_invoice'])->first();
                                            ?>
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
                                                <td><?= $payment['type_payment'] ?></td>
                                            </tr>
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

<?= $this->endSection() ?>