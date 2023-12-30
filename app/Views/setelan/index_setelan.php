<?= $this->extend('template/body') ?>

<?= $this->section('page-content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <?php if (session()->getFlashdata('success')) : ?>
        <script>
            Swal.fire(
                'Good job!',
                '<?= session()->getFlashdata('success'); ?>',
                'success'
            )
        </script>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
        <script>
            Swal.fire(
                'Error!',
                '<?= session()->getFlashdata('error'); ?>',
                'error'
            )
        </script>
    <?php endif; ?>

    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4 h-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Format Penomoran</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4 font-weight-bold">Nomor Instansi</div>
                        <div class="col-sm-6">: <?= $nomor['no_instansi']; ?></div>
                    </div>
                    <div class="my-2"></div>
                    <div class="row">
                        <div class="col-sm-4 font-weight-bold">Nomor Referensi</div>
                        <div class="col-sm-6">: <?= $nomor['no_referensi']; ?></div>
                    </div>
                    <div class="my-2"></div>
                    <div class="row">
                        <div class="col-sm-4 font-weight-bold">Tahun Surat</div>
                        <div class="col-sm-6">: <?= date('Y'); ?></div>
                    </div>
                    <div class="my-2"></div>
                    <div class="row">
                        <div class="col-sm-4 font-weight-bold">Preview Penulisan</div>
                        <div class="col-sm-6">: <?= $nomor['no_instansi'] . '/' . 'Surat Ke' . '/' . $nomor['no_referensi'] . '/' . date('Y'); ?></div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="#" data-toggle="modal" data-target="#nomorModal" class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </span>
                        <span class="text">Ubah Data</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card shadow mb-4 h-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Perangkat Desa</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4 font-weight-bold">Kepala Desa</div>
                        <div class="col-sm-6">: <?= $perangkat['kades']; ?></div>
                    </div>
                    <div class="my-2"></div>
                    <div class="row">
                        <div class="col-sm-4 font-weight-bold">Babinsa</div>
                        <div class="col-sm-6">: <?= $perangkat['babinsa']; ?></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 font-weight-bold">NRP Babinsa</div>
                        <div class="col-sm-6">: <?= $perangkat['nrp_babinsa']; ?></div>
                    </div>
                    <div class="my-2"></div>
                    <div class="row">
                        <div class="col-sm-4 font-weight-bold">Bhabinkamtibmas</div>
                        <div class="col-sm-6">: <?= $perangkat['bhabinkamtibmas']; ?></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 font-weight-bold">NRP Bhabinkamtibmas</div>
                        <div class="col-sm-6">: <?= $perangkat['nrp_bhabin']; ?></div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="#" data-toggle="modal" data-target="#kadesModal" class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </span>
                        <span class="text">Ubah Data</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card shadow mt-4 mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Jenis Surat</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="text-center">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Surat</th>
                                    <th scope="col" class="col-6">Deskripsi</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($surat as $srt) :
                                ?>
                                    <tr>
                                        <th scope="row"><?= $i++; ?></th>
                                        <td><?= $srt['nama_surat']; ?></td>
                                        <td class="col-6"><?= $srt['deskripsi']; ?></td>
                                        <td class="text-center">
                                            <label class="switch">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="switch<?php echo $srt['id_surat']; ?>" <?php echo ($srt['status'] == 1 ? "checked" : ""); ?>>
                                                    <label class="custom-control-label" for="switch<?php echo $srt['id_surat']; ?>"></label>
                                                </div>
                                            </label>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- kades Modal-->
    <div class="modal fade" id="kadesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah data perangkat desa</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="/setelan/update/perangkat/<?= $perangkat['id']; ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="kolkades">Kepala Desa</label>
                            <input type="text" class="form-control" id="kolkades" name="kades" placeholder="Nama Kepala Desa" value="<?= $perangkat['kades']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="kolbabinsa">Babinsa</label>
                            <input type="text" class="form-control" id="kolbabinsa" name="babinsa" placeholder="Nama Babinsa" value="<?= $perangkat['babinsa']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="kolnrpbabin">NRP Babinsa</label>
                            <input type="text" class="form-control" id="kolnrpbabin" name="nrp_babin" placeholder="NRP Babinsa" value="<?= $perangkat['nrp_babinsa']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="kolbhabin">Bhabinkamtibmas</label>
                            <input type="text" class="form-control" id="kolbhabin" name="bhabinkamtibmas" placeholder="Nama Bhabinkamtibmas" value="<?= $perangkat['bhabinkamtibmas']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="kolnrpbhabin">NRP Bhabinkamtibmas</label>
                            <input type="text" class="form-control" id="kolnrpbhabin" name="nrp_bhabin" placeholder="NRP Bhabinkamtibmas" value="<?= $perangkat['nrp_bhabin']; ?>" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fa-solid fa-floppy-disk"></i>
                            </span>
                            <span class="text">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- nomor Modal -->
    <div class="modal fade" id="nomorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah format penomoran</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="/setelan/update/nomor/<?= $nomor['id']; ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="kolinstansi">Nomor Instansi</label>
                            <input type="text" class="form-control" id="kolinstansi" name="no_instansi" placeholder="Nomor Instansi" value="<?= $nomor['no_instansi']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="kolref">Nomor Referensi</label>
                            <input type="text" class="form-control" id="kolref" name="no_referensi" placeholder="Nomor Referensi" value="<?= $nomor['no_referensi']; ?>" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fa-solid fa-floppy-disk"></i>
                            </span>
                            <span class="text">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<script>
    $(document).ready(function() {
        $('.custom-control-input').on('change', function() {
            var id = $(this).attr('id').replace('switch', '');
            var status = $(this).prop('checked') ? 1 : 0;
            $.ajax({
                url: 'setelan/update/status',
                type: 'POST',
                dataType: 'json',
                data: {
                    id: id,
                    status: status,
                    "<?= csrf_token(); ?>": "<?= csrf_hash(); ?>"
                },
                beforeSend: function() {
                    // menampilkan loading screen
                },
                success: function(response) {
                    // menghilangkan loading screen
                    if (response.success) {
                        // sukses, lakukan apa yang perlu dilakukan
                        var Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        Toast.fire({
                            icon: 'success',
                            title: 'Perubahan tersimpan.'
                        })
                    } else {
                        // gagal, lakukan apa yang perlu dilakukan
                        var Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        Toast.fire({
                            icon: 'error',
                            title: 'Perubahan gagal tersimpan.'
                        })

                    }
                },
            });
        });
    });
</script>
<!-- /.container-fluid -->
<?= $this->endSection() ?>