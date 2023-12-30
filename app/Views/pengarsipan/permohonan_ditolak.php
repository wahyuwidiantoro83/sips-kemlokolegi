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
                    <h5 class="m-0 font-weight-bold text-primary">Permohonan Ditolak</h5>
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
                                <td>
                                    <?php
                                    if ($p['id_surat'] == '8') {
                                        echo $p['nama_surat_lain'];
                                    } else {
                                        echo $p['nama_surat'];
                                    }
                                    ?>
                                </td>
                                <td><?= $p['nik_pemohon']; ?></td>
                                <td><?= $p['keperluan']; ?></td>
                                <td><?= $p['tgl_pengajuan']; ?></td>
                                <td><span class="badge badge-danger"><?= $p['status_verif']; ?></span></td>
                                <td>
                                    <form action="/verifikasi/delete/<?= $p['id']; ?>" method="post" onsubmit="confirmDelete(event)" class="d-inline">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger btn-icon-split btn-sm">
                                            <span class="icon text-white-50">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </span>
                                            <span class="text">Hapus</span></button>
                                    </form>
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
<script>
    function confirmDelete(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda tidak akan dapat mengembalikan tindakan ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                event.target.submit();
            }
        })
    }
</script>
<!-- /.container-fluid -->
<?= $this->endSection() ?>