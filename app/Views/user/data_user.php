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
                    <h5 class="m-0 font-weight-bold text-primary">Data User</h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <a href="<?= base_url('user/create') ?>" class="btn btn-primary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fa-solid fa-plus"></i>
                </span>
                <span class="text">Tambah Data</span>
            </a>
            <div class="my-2"></div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataUser" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Username(NIK)</th>
                            <th>Email</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Level</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($users as $u) :
                        ?>
                            <tr>
                                <th scope="row"><?= $i++ ?></th>
                                <td><?= $u->username; ?></td>
                                <td>
                                    <?= ($u->email) ? $u->email : '-' ?>
                                </td>
                                <td><?= $u->nama; ?></td>
                                <td><?= $u->alamat; ?></td>
                                <td><span class="badge badge-<?= ($u->name == 'admin') ? 'success' : 'warning' ?>"><?= $u->name ?></span></td>
                                <td>
                                    <a href="/user/detail/<?= $u->userid; ?>" class="btn btn-primary btn-icon-split btn-sm">
                                        <span class="icon text-white-50">
                                            <i class="fa-solid fa-info"></i>
                                        </span>
                                        <span class="text">Detail</span>
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
        $("#dataUser").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "buttons": ["pageLength", "csv", "excel", "pdf", "colvis"]
        }).buttons().container().appendTo('#dataUser_wrapper .col-md-6:eq(0)');
    });
</script>
<!-- /.container-fluid -->
<?= $this->endSection() ?>