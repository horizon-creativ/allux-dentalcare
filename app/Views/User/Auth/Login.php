<?= $this->extend('Layout/Template_AuthUser') ?>
<?= $this->section('content') ?>

<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="row vh-100 d-flex align-items-center">
                    <div class="col-6 mx-auto">
                        <div class="card-header text-center">
                            <a href="<?= base_url() ?>" class="h1"><b>Login</b></a>
                        </div>
                        <form action="/login/validate" method="post" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control <?= (validation_show_error('email_pasien')) ? 'is-invalid' : '' ?>" name="email_pasien" placeholder="Email">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                                <!-- Validation Error Msg -->
                                <div id="email_pasien_error" class="invalid-feedback">
                                    <?= validation_show_error('email_pasien') ?>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control <?= (validation_show_error('password_pasien')) ? 'is-invalid' : '' ?>" name="password_pasien" placeholder="Password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                                <!-- Validation Error Msg -->
                                <div id="password_pasien_error" class="invalid-feedback">
                                    <?= validation_show_error('password_pasien') ?>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn bg-teal btn-block rounded-pill">Login</button>
                            </div>
                            <hr>
                            <div class="col-12">
                                <a href="/register" class="btn btn-outline-info btn-block rounded-pill">Daftar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="row vh-100">
                    <img src="/img/page/about.jpg" alt="" class="w-100" style="object-fit: cover;">
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>