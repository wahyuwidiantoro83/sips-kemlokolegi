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
                    <h5 class="m-0 font-weight-bold text-primary">Riwayat Permohonan</h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataRiwayat" class="display" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nomor Surat</th>
                            <th>Jenis Surat</th>
                            <th>Keperluan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($riwayat as $r) :
                        ?>
                            <tr>
                                <th scope="row"><?= $i++ ?></th>
                                <td class="text-center"><?= $r['no_srt'] ? $r['no_instansi'] . '/' . $r['no_srt'] . '/' . $r['no_ref'] . '/' . $r['tahun_srt'] : '-'; ?></td>
                                <td><?= $r['nama_surat']; ?></td>
                                <td><?= $r['keperluan']; ?></td>
                                <td><span class="badge badge-<?= ($r['status_verif'] == 'Disetujui') ? 'success' : (($r['status_verif'] == 'Ditangguhkan') ? 'warning' : 'danger') ?>"><?= $r['status_verif'] ?></span></td>
                                <td>
                                    <?php if ($r['scan_surat']) : ?>
                                        <a href="/riwayat/download/<?= $r['scan_surat']; ?>" class="btn btn-primary btn-icon-split btn-sm mb-2">
                                            <span class="icon text-white-50">
                                                <i class="fa-solid fa-download"></i>
                                            </span>
                                            <span class="text">Download Scan</span>
                                        </a>
                                    <?php endif; ?>
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
        $("#dataRiwayat").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": true,
        }).buttons().container().appendTo('#dataRiwayat_wrapper .col-md-6:eq(0)');
    });
</script>
<!-- /.container-fluid -->
<?= $this->endSection() ?>