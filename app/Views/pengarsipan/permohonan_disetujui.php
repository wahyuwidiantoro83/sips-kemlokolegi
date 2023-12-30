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
    <?php if (session()->getFlashdata('error')) : ?>
        <script>
            Swal.fire(
                'Error!',
                '<?= $validation['dokumen']; ?>',
                'error'
            )
        </script>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-auto mr-auto">
                    <h5 class="m-0 font-weight-bold text-primary">Permohonan Disetujui</h5>
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
                            <th>Tgl. Disetujui</th>
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
                                <td>
                                    <?php
                                    if ($p['id_surat'] == '8') {
                                        echo $p['nama_surat_lain'];
                                    } else {
                                        echo $p['nama_surat'];
                                    }
                                    ?>
                                </td>
                                <td><?= $p['no_instansi'] . '/' . $p['no_srt'] . '/' . $p['no_ref'] . '/' . $p['tahun_srt']; ?></td>
                                <td><?= $p['nik_pemohon']; ?></td>
                                <td><?= $p['keperluan']; ?></td>
                                <td><?= $p['tgl_pengajuan']; ?></td>
                                <td><?= $p['tgl_verif']; ?></td>
                                <td><span class="badge badge-<?= ($p['status_verif'] == 'Menunggu') ? 'warning' : 'success' ?>"><?= $p['status_verif']; ?></span></td>
                                <td>
                                    <a href="/verifikasi/cetak-surat-<?= $p['id_surat']; ?>/<?= $p['id']; ?>" class="btn btn-primary btn-icon-split btn-sm mb-2">
                                        <span class="icon text-white-50">
                                            <i class="fa-solid fa-print"></i>
                                        </span>
                                        <span class="text">Print</span>
                                    </a>
                                    <a href="" class="btn btn-info btn-icon-split btn-sm" data-toggle="modal" data-target="#modalUpload<?= $p['id']; ?>">
                                        <span class="icon text-white-50">
                                            <i class="fa-solid fa-file-arrow-up"></i>
                                        </span>
                                        <span class="text">Upload Scan</span>
                                    </a>
                                </td>
                            </tr>
                            <!-- modal upload -->
                            <div class="modal fade" id="modalUpload<?= $p['id']; ?>" tabindex="-1" aria-labelledby="modalUpdateLabel<?= $p['id']; ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalUpdateLabel<?= $p['id']; ?>">Upload Scan Surat</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="<?= base_url('permohonan-disetujui/upload'); ?>" method="post" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                <?= csrf_field(); ?>
                                                <div class="form-group">
                                                    <label for="dokumen">Scan Surat</label>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="customFile" name="dokumen" accept=".jpg, .jpeg, .png">
                                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="id" value="<?= $p['id']; ?>">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary btn-icon-split">
                                                    <span class="icon text-white-50">
                                                        <i class="fa-solid fa-file-arrow-up"></i>
                                                    </span>
                                                    <span class="text">Upload</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>


<script>
    $(document).ready(function() {
        bsCustomFileInput.init()
    });
</script>
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