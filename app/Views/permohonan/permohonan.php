<?= $this->extend('template/body') ?>

<?= $this->section('page-content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <?php if (session()->getFlashdata('success')) : ?>
        <script>
            Swal.fire(
                'Good job!',
                '<?= session()->getFlashdata('success'); ?>',
                'success'
            )
        </script>
    <?php endif; ?>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Menu Permohonan</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <?php foreach ($surat as $srt) : ?>
            <?php if ($srt['id_surat'] == '8') : ?>
                <?php if (in_groups('admin')) : ?>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-bottom-primary shadow py-2 px-2 h-100" style="width: 18rem;">
                            <img class="card-img-top d-none d-sm-block" src="/img/mail_list.jpg" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title"><?= $srt['nama_surat'] ?></h5>
                                <p class="card-text"><?= $srt['deskripsi'] ?></p>
                            </div>
                            <div class="card-footer">
                                <a href="/permohonan/form_<?= $srt['id_surat'] ?>" class="btn btn-primary btn-icon-split">
                                    <span class="icon text-white-50">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </span>
                                    <span class="text">Buat Permohonan</span>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php else : ?>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-bottom-primary shadow py-2 px-2 h-100" style="width: 18rem;">
                        <img class="card-img-top d-none d-sm-block" src="/img/mail_list.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"><?= $srt['nama_surat'] ?></h5>
                            <p class="card-text"><?= $srt['deskripsi'] ?></p>
                        </div>
                        <div class="card-footer">
                            <a href="/permohonan/form_<?= $srt['id_surat'] ?>" class="btn btn-primary btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </span>
                                <span class="text">Buat Permohonan</span>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach ?>
    </div>

    <div class="row mb-3">
        <div class="col">
            <div class="card border-warning mb-3">
                <div class="card-header">
                    <h4 class="mb-0 card-title font-weight-bold text-warning">INFO!</h4>
                </div>
                <div class="card-body">
                    <p class="card-text font-weight-bold text-secondary">Jika surat yang ingin anda ajukan tidak ada dalam daftar surat yang dapat dimohon,
                        Anda dapat langsung datang ke kantor desa dengan membawa dokumen-dokumen pendukung untuk surat yang ingin anda ajukan.</p>
                </div>
                <div class="card-footer">
                    <p class="card-text font-weight-bold text-secondary">Admin Desa Kemlokolegi</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->

</div>
<!-- /.container-fluid -->
<?= $this->endSection() ?>