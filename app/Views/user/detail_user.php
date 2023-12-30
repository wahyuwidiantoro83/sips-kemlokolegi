<?= $this->extend('template/body') ?>

<?= $this->section('page-content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-auto mr-auto">
                    <h5 class="m-0 font-weight-bold text-primary">Detail User</h5>
                </div>
                <div class="col-auto">
                    <a href="/user" class="btn btn-primary btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                            <i class="fa-solid fa-angles-left"></i>
                        </span>
                        <span class="text">Kembali</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-2 font-weight-bold">Email</div>
                <div class="col-sm-8">: <?= $users['email']; ?></div>
            </div>
            <div class="my-3"></div>
            <div class="row">
                <div class="col-sm-2 font-weight-bold">NIK(Username)</div>
                <div class="col-sm-8">: <?= $users['username']; ?></div>
            </div>
            <div class="my-3"></div>
            <div class="row">
                <div class="col-sm-2 font-weight-bold">Nama</div>
                <div class="col-sm-8">: <?= $users['nama']; ?></div>
            </div>
            <div class="my-3"></div>
            <div class="row">
                <div class="col-sm-2 font-weight-bold">Tempat, Tanggal Lahir</div>
                <div class="col-sm-8">: <?= $users['tempat']; ?>, <?= $users['tgllhr']; ?></div>
            </div>
            <div class="my-3"></div>
            <div class="row">
                <div class="col-sm-2 font-weight-bold">Jenis Kelamin</div>
                <div class="col-sm-8">: <?= $users['jk']; ?></div>
            </div>
            <div class="my-3"></div>
            <div class="row">
                <div class="col-sm-2 font-weight-bold">Alamat</div>
                <div class="col-sm-8">: <?= $users['alamat']; ?></div>
            </div>
            <div class="my-3"></div>
            <div class="row">
                <div class="col-sm-2 font-weight-bold">Telp(Whatsapp)</div>
                <div class="col-sm-8">: <?= $users['telp']; ?></div>
            </div>
            <div class="my-3"></div>
            <div class="row">
                <div class="col-sm-2 font-weight-bold">Agama</div>
                <div class="col-sm-8">: <?= $users['agama']; ?></div>
            </div>
            <div class="my-3"></div>
            <div class="row">
                <div class="col-sm-2 font-weight-bold">Status Perkawinan</div>
                <div class="col-sm-8">: <?= $users['kawin']; ?></div>
            </div>
            <div class="my-3"></div>
            <div class="row">
                <div class="col-sm-2 font-weight-bold">Pekerjaan</div>
                <div class="col-sm-8">: <?= $users['pekerjaan']; ?></div>
            </div>
            <div class="my-3"></div>
            <div class="row">
                <div class="col">
                    <a href="/user/edit/<?= $users['id']; ?>" class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </span>
                        <span class="text">Edit Data</span>
                    </a>
                    <form action="/user/delete/<?= $users['id']; ?>" method="post" onsubmit="confirmDelete(event)" class="d-inline">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fa-solid fa-trash-can"></i>
                            </span>
                            <span class="text">Hapus Data</span></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
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