<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon">
            <i><img src="/img/icon.png" alt="" style="max-width: 100%;"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SIPS DESA KEMLOKOLEGI</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?php if (service('uri')->getSegment(1) == '') echo 'active'; ?>">
        <a class="nav-link" href="<?= base_url('/') ?>">
            <i class="fa-solid fa-house"></i>
            <span>Dashboard</span></a>
    </li>

    <?php if (in_groups('admin')) : ?>
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Admin Side
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item <?php if (service('uri')->getSegment(1) == 'permohonan-baru' || service('uri')->getSegment(1) == 'permohonan-disetujui' || service('uri')->getSegment(1) == 'permohonan-ditolak') echo 'active'; ?>">
            <a class="nav-link <?php if (service('uri')->getSegment(1) == 'permohonan-baru' || service('uri')->getSegment(1) == 'permohonan-disetujui' || service('uri')->getSegment(1) == 'permohonan-ditolak') {
                                    echo '';
                                } else {
                                    echo 'collapsed';
                                } ?>" href="#" data-toggle="collapse" data-target="#collapsePermohonan" aria-expanded="true" aria-controls="collapsePermohonan">
                <i class="fa-regular fa-envelope"></i>
                <span>Data Permohonan</span>
            </a>
            <div id="collapsePermohonan" class="collapse <?php if (service('uri')->getSegment(1) == 'permohonan-baru' || service('uri')->getSegment(1) == 'permohonan-disetujui' || service('uri')->getSegment(1) == 'permohonan-ditolak') echo 'show'; ?>" aria-labelledby="headingPermohonan" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Data Permohonan:</h6>
                    <a class="collapse-item <?php if (service('uri')->getSegment(1) == 'permohonan-baru') echo 'active'; ?>" href="<?= base_url('/permohonan-baru') ?>">Permohonan Baru</a>
                    <a class="collapse-item <?php if (service('uri')->getSegment(1) == 'permohonan-disetujui') echo 'active'; ?>" href="<?= base_url('/permohonan-disetujui') ?>">Permohonan Disetujui</a>
                    <a class="collapse-item <?php if (service('uri')->getSegment(1) == 'permohonan-ditolak') echo 'active'; ?>" href="<?= base_url('/permohonan-ditolak') ?>">Permohonan Ditolak</a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item <?php if (service('uri')->getSegment(1) == 'arsip-surat') echo 'active'; ?>">
            <a class="nav-link" href="<?= base_url('arsip-surat') ?>">
                <i class="fa-regular fa-envelope-open"></i>
                <span>Arsip Surat</span></a>
        </li>

        <li class="nav-item <?php if (service('uri')->getSegment(1) == 'user') echo 'active'; ?>">
            <a class="nav-link" href="<?= base_url('user') ?>">
                <i class="fa-solid fa-users"></i>
                <span>Data User</span></a>
        </li>

        <li class="nav-item <?php if (service('uri')->getSegment(1) == 'setelan') echo 'active'; ?>">
            <a class="nav-link" href="<?= base_url('setelan') ?>">
                <i class="fa-solid fa-gears"></i>
                <span>Setelan Permohonan</span></a>
        </li>
    <?php endif; ?>


    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu
    </div>
    <?php if (has_permission('create-permohonan')) : ?>
        <!-- Nav Item - Charts -->
        <li class="nav-item <?php if (service('uri')->getSegment(1) == 'permohonan') echo 'active'; ?>">
            <a class="nav-link" href="<?= base_url('/permohonan') ?>">
                <i class="fa-solid fa-paper-plane"></i>
                <span>Permohonan</span></a>
        </li>
    <?php endif; ?>
    <?php if (in_groups('user')) : ?>
        <!-- Nav Item - Tables -->
        <li class="nav-item <?php if (service('uri')->getSegment(1) == 'riwayat') echo 'active'; ?>">
            <a class="nav-link" href="<?= base_url('/riwayat') ?>">
                <i class="fas fa-fw fa-table"></i>
                <span>Riwayat Permohonan</span></a>
        </li>
    <?php endif; ?>
    <?php if (has_permission('manage-profile')) : ?>
        <!-- Nav Item - Tables -->
        <li class="nav-item <?php if (service('uri')->getSegment(1) == 'profil') echo 'active'; ?>">
            <a class="nav-link" href="<?= base_url('/profil') ?>">
                <i class="fas fa-fw fa-user"></i>
                <span>Profil</span></a>
        </li>
    <?php endif; ?>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>



</ul>
<!-- End of Sidebar -->