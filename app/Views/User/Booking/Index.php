<?= $this->extend('Layout/Template_User') ?>
<?= $this->section('content') ?>
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
                    <div class="col-sm-12 col-md-4 col-md-4 mx-auto">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="text-center">Pilih Tanggal Booking</h5>
                                <br>
                                <form action="/booking/slot" method="get">
                                    <div class="form-group">
                                        <input type="date" name="date_booking" id="date_booking" class="form-control <?= (validation_show_error('date_booking')) ? 'is-invalid' : '' ?>" value="<?= old('date_booking') ? old('date_booking') : date("Y-m-d") ?>">
                                        <!-- Validation Error Msg -->
                                        <div id="date_booking_error" class="invalid-feedback">
                                            <?= validation_show_error('date_booking') ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn bg-teal btn-block rounded-pill">Lanjutkan</button>
                                    </div>
                                </form>
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