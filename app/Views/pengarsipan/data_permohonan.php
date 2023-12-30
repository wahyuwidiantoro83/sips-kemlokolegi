<?= $this->extend('template/body') ?>

<?= $this->section('page-content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <?php if (session()->getFlashdata('pesan')) : ?>
        <script>
            Swal.fire(
                'Good job!',
                '<?= session()->getFlashdata('pesan'); ?>',
                'success'
            )
        </script>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-auto mr-auto">
                    <h5 class="m-0 font-weight-bold text-primary">Permohonan Baru</h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataPermohonan" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Jenis Surat</th>
                            <th>No. Surat</th>
                            <th>NIK Pemohon</th>
                            <th>Keperluan</th>
                            <th>Tgl. Pengajuan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($permohonan as $p) :
                        ?>
                            <tr>
                                <th scope="row"><?= $i++ ?></th>
                                <td><?= $p['nama_surat']; ?></td>
                                <td class="text-center"><?= ($p['no_srt']) ? $p['no_srt'] : '-' ?></td>
                                <td><?= $p['nik_pemohon']; ?></td>
                                <td><?= $p['keperluan']; ?></td>
                                <td><?= $p['tgl_pengajuan']; ?></td>
                                <td><span class="badge badge-<?= ($p['status_verif'] == 'Menunggu') ? 'warning' : 'success' ?>"><?= $p['status_verif']; ?></span></td>
                                <td>
                                    <a href="/permohonan-baru/verifikasi/<?= $p['id']; ?>" class="btn btn-primary btn-icon-split btn-sm">
                                        <span class="icon text-white-50">
                                            <i class="fa-solid fa-check-to-slot"></i>
                                        </span>
                                        <span class="text">Verifikasi</span>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>



<script>
    $(function() {
        $("#dataPermohonan").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
        }).buttons().container().appendTo('#dataPermohonan_wrapper .col-md-6:eq(0)');
    });
</script>
<!-- /.container-fluid -->
<?= $this->endSection() ?>