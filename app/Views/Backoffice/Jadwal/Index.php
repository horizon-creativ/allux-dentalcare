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
                    <div class="row">
                        <?php foreach ($users as $user): ?>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="card bg-light d-flex flex-fill">
                                    <div class="card-header text-muted border-bottom-0">
                                        <?= $user['level_user'] ?>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="row">
                                            <div class="col-7">
                                                <h2 class="lead mb-3"><b><?= $user['name_user'] ?></b></h2>
                                                <!-- <p class="text-muted text-sm"><b>About: </b> Web Designer / UX / Graphic Artist / Coffee Lover </p> -->
                                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                                    <li class="small mb-3"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: <?= $user['address_user'] ?></li>

                                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> No. Telp: <?= $user['phone_user'] ?></li>
                                                </ul>
                                            </div>
                                            <div class="col-5 text-center">
                                                <img src="/uploads/img_user/<?= $user['img_user'] ?>" alt="user-avatar" class="img-circle img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="text-right">
                                            <a href="https://wa.me/<?= preg_replace('/^0?/', '62', $user['phone_user']); ?>" class="btn btn-sm bg-teal" target="_blank">
                                                <i class="fab fa-whatsapp"></i>
                                            </a>
                                            <a href="/backoffice/jadwal/<?= $user['id_user'] ?>" class="btn btn-sm btn-primary">
                                                <i class="fas fa-calendar-alt"></i>&nbsp; Lihat Jadwal
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<?= $this->endSection() ?>