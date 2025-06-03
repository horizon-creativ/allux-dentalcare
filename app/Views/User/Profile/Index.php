<?= $this->extend('Layout/Template_User') ?>
<?= $this->section('content') ?>

<?php
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
    }
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper bg-white">
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <!-- <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Profile</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">User Profile</li>
                        </ol>
                    </div>
                </div>
            </div> -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <!-- Profile Image -->
                        <div class="card card-teal card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="/uploads/img_user/<?= $user['img_user'] ?>"
                                        alt="User profile picture">
                                </div>

                                <h3 class="profile-username text-center"><?= $user['name_user'] ?></h3>

                                <p class="text-muted text-center"><?= $user['level_user'] ?></p>

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Followers</b> <a class="float-right">1,322</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Following</b> <a class="float-right">543</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Friends</b> <a class="float-right">13,287</a>
                                    </li>
                                </ul>

                                <a href="#" class="btn bg-teal btn-block rounded-pill"><b>Follow</b></a>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- About Me Box -->
                        <div class="card card-teal">
                            <div class="card-header">
                                <h3 class="card-title">About Me</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <strong><i class="fas fa-book mr-1"></i> Education</strong>

                                <p class="text-muted">
                                    B.S. in Computer Science from the University of Tennessee at Knoxville
                                </p>

                                <hr>

                                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                                <p class="text-muted">Malibu, California</p>

                                <hr>

                                <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                                <p class="text-muted">
                                    <span class="tag tag-danger">UI Design</span>
                                    <span class="tag tag-success">Coding</span>
                                    <span class="tag tag-info">Javascript</span>
                                    <span class="tag tag-warning">PHP</span>
                                    <span class="tag tag-primary">Node.js</span>
                                </p>

                                <hr>

                                <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card card-teal card-tabs">
                            <div class="card-header p-0 pt-1">
                                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tabs-one-booking-tab" data-toggle="pill" href="#custom-tabs-one-booking" role="tab" aria-controls="custom-tabs-one-booking" aria-selected="true">Booking Aktif</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-history-tab" data-toggle="pill" href="#custom-tabs-one-history" role="tab" aria-controls="custom-tabs-one-history" aria-selected="false">History Booking</a>
                                    </li>
                                    <!-- <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Messages</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-settings-tab" data-toggle="pill" href="#custom-tabs-one-settings" role="tab" aria-controls="custom-tabs-one-settings" aria-selected="false">Settings</a>
                                    </li> -->
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-one-tabContent">
                                    <div class="tab-pane fade show active" id="custom-tabs-one-booking" role="tabpanel" aria-labelledby="custom-tabs-one-booking-tab">
                                        <?php foreach ($bookings as $booking): ?>
                                            <!-- Hanya ambil booking aktiff saja -->
                                            <?php if (array_search($booking['status_booking'], ['Completed', 'Cancelled']) == ''): ?>
                                                <?php
                                                // Ambil layanan
                                                $layanan = $layananModel->where('id_layanan', $booking['id_layanan'])->first();
                                                // Ambil slot jadwal
                                                $slotJadwal = $slotJadwalModel->where('id_slot_jadwal', $booking['id_slot_jadwal'])->first();
                                                // Ambil jadwal
                                                $jadwal = $jadwalModel->where('id_jadwal', $slotJadwal['id_jadwal'])->first();
                                                // Ambil dokter
                                                $dokter = $userModel->where('id_user', $jadwal['id_user'])->first();
                                                ?>
                                                <!-- Booking -->
                                                <div class="post">
                                                    <div class="user-block">
                                                        <img class="img-circle img-bordered-sm" src="/uploads/img_user/<?= $dokter['img_user'] ?>" alt="user image">
                                                        <span class="username">
                                                            <a href="#" class="text-teal"><?= $dokter['name_user'] ?></a>
                                                            <a href="#" class="float-right"><span class="badge rounded-pill px-3 bg-<?= statusColor($booking['status_booking']) ?>"><?= $booking['status_booking'] ?></span></a>
                                                        </span>
                                                        <span class="description"><?= date('l, d F Y', strtotime($booking['date_booking'])) ?> - <?= date('H:i', strtotime($slotJadwal['time_slot'])) ?></span>
                                                    </div>
                                                    <!-- /.user-block -->
                                                    <p>
                                                        Layanan: <?= $layanan['name_layanan'] ?>
                                                        <br>
                                                        Keluhan: <?= $booking['keluhan_booking'] ?>
                                                    </p>

                                                    <p>
                                                        <!-- <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                                                        <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a> -->
                                                        <span class="float-right">
                                                            <a href="/booking/<?= $booking['id_booking'] ?>" class="btn btn-success rounded-pill px-3">
                                                                <i class="fas fa-qrcode mr-1"></i> Lihat Kode Booking
                                                            </a>
                                                        </span>
                                                    </p>

                                                    <!-- <input class="form-control form-control-sm" type="text" placeholder="Type a comment"> -->
                                                </div>
                                                <!-- /.post -->
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-one-history" role="tabpanel" aria-labelledby="custom-tabs-one-history-tab">
                                        <?php foreach ($bookings as $booking): ?>
                                            <!-- Hanya ambil booking aktiff saja -->
                                            <?php if (array_search($booking['status_booking'], ['Completed', 'Cancelled']) != ''): ?>
                                                <?php
                                                // Ambil layanan
                                                $layanan = $layananModel->where('id_layanan', $booking['id_layanan'])->first();
                                                // Ambil slot jadwal
                                                $slotJadwal = $slotJadwalModel->where('id_slot_jadwal', $booking['id_slot_jadwal'])->first();
                                                // Ambil jadwal
                                                $jadwal = $jadwalModel->where('id_jadwal', $slotJadwal['id_jadwal'])->first();
                                                // Ambil dokter
                                                $dokter = $userModel->where('id_user', $jadwal['id_user'])->first();
                                                ?>
                                                <!-- Booking -->
                                                <div class="post">
                                                    <div class="user-block">
                                                        <img class="img-circle img-bordered-sm" src="/uploads/img_user/<?= $dokter['img_user'] ?>" alt="user image">
                                                        <span class="username">
                                                            <a href="#" class="text-teal"><?= $dokter['name_user'] ?></a>
                                                            <a href="#" class="float-right"><span class="badge rounded-pill px-3 bg-<?= statusColor($booking['status_booking']) ?>"><?= $booking['status_booking'] ?></span></a>
                                                        </span>
                                                        <span class="description"><?= date('l, d F Y', strtotime($booking['date_booking'])) ?> - <?= date('H:i', strtotime($slotJadwal['time_slot'])) ?></span>
                                                    </div>
                                                    <!-- /.user-block -->
                                                    <p>
                                                        Layanan: <?= $layanan['name_layanan'] ?>
                                                        <br>
                                                        Keluhan: <?= $booking['keluhan_booking'] ?>
                                                    </p>

                                                    <p>
                                                        <!-- <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                                                        <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a> -->
                                                        <!-- <span class="float-right">
                                                            <a href="#" class="btn btn-success rounded-pill px-3">
                                                                <i class="fas fa-qrcode mr-1"></i> Lihat Kode Booking
                                                            </a>
                                                        </span> -->
                                                    </p>

                                                    <!-- <input class="form-control form-control-sm" type="text" placeholder="Type a comment"> -->
                                                </div>
                                                <!-- /.post -->
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>
                                    <!-- <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                                        Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-one-settings" role="tabpanel" aria-labelledby="custom-tabs-one-settings-tab">
                                        Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
                                    </div> -->
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
</div>
<!-- /.content-wrapper -->
<?= $this->endSection() ?>