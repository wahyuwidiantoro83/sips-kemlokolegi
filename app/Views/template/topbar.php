<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-gray-100 topbar mb-4 static-top shadow">
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">


        <!-- Nav Item - Messages -->
        <?php if (in_groups('admin')) : ?>
            <?php if (service('uri')->getSegment(1) == '') : ?>
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell fa-fw"></i>
                        <!-- Counter - Alerts -->
                        <span class="badge badge-danger badge-counter"><?= $ditangguhkan ?></span>
                    </a>
                    <!-- Dropdown - Alerts -->
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                        <h6 class="dropdown-header">
                            Permohonan Baru
                        </h6>
                        <?php foreach ($notifPermohonan as $n) : ?>
                            <a class="dropdown-item d-flex align-items-center" href="<?= base_url('permohonan-baru/verifikasi/' . $n['id']) ?>">
                                <div class="mr-3">
                                    <div class="icon-circle bg-primary">
                                        <i class="fas fa-file-alt text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500"><?= $n['tgl_pengajuan']; ?>, <?= $n['nama_pemohon']; ?></div>
                                    <span class="font-weight-bold"><?= $n['nama_surat']; ?>: <?= $n['keperluan']; ?></span>
                                </div>
                            </a>
                        <?php endforeach; ?>

                        <a class="dropdown-item text-center small text-gray-500" href="<?= base_url('permohonan-baru') ?>">Lihat Semua</a>
                    </div>
                </li>
            <?php endif; ?>
        <?php endif; ?>



        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-lg-inline text-gray-700 small"><?= user()->nama ?></span>
                <img class="img-profile rounded-circle" src="/img/undraw_profile.svg">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?= base_url('profil') ?>">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="" onclick="confimLogout(event)">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>

    </ul>

</nav>
<!-- End of Topbar -->