<?= $this->extend('template/body') ?>

<?= $this->section('page-content') ?>
<!-- Begin Page Content -->
<style>
    .square {
        position: relative;
        width: 100%;
        padding-bottom: 100%;
        overflow: hidden;
    }

    .square img {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        max-width: 100%;
        max-height: 100%;
        margin: auto;
        transition: all 0.3s ease-in-out;
    }

    .square:hover img {
        transform: scale(1.1);
        filter: brightness(0.8);
    }

    .overlay {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        opacity: 0;
        transition: all 0.3s ease-in-out;
    }

    .square:hover .overlay {
        opacity: 1;
    }

    .overlay i {
        font-size: 2em;
        color: white;
    }
</style>
<div class="container-fluid">

    <?php

    use App\Controllers\Permohonan;

    if (session()->getFlashdata('error')) : ?>
        <script>
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            Toast.fire({
                icon: 'error',
                title: '<?= session()->getFlashdata('error'); ?>'
            })
        </script>
    <?php endif; ?>

    <!-- Page Heading -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-auto mr-auto">
                    <h5 class="m-0 font-weight-bold text-primary">Verifikasi</h5>
                </div>
                <div class="col-auto">
                    <a href="/permohonan-baru" class="btn btn-primary btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                            <i class="fa-solid fa-angles-left"></i>
                        </span>
                        <span class="text">Kembali</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="/verifikasi/setuju" method="POST" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="card border-left-info shadow h-100">
                    <div class="card-header">
                        <p class="mb-0">Data Surat</p>
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="id_permohonan" value="<?= $permohonan['id'] ?>">
                        <div class="form-group row">
                            <label for="kolnomorsrt" class="col-sm-2 col-form-label font-weight-bold">Nomor Surat</label>
                            <div class="col-sm-10">
                                <div class="form-row">
                                    <div class="col-2">
                                        <input type="text" class="form-control" id="kolnomorsrt" name="no_instansi" placeholder="No. Instansi" value="<?= $no_instansi ?>">
                                    </div>
                                    <div class="col-auto">
                                        <label for="kolnomorsrt" class="col-form-label font-weight-bold">/</label>
                                    </div>
                                    <div class="col-2">
                                        <input type="text" class="form-control" id="kolnomorsrt" name="no_srt" placeholder="No. Surat" value="<?= $nomor_surat ?>">
                                    </div>
                                    <div class="col-auto">
                                        <label for="kolnomorsrt" class="col-form-label font-weight-bold">/</label>
                                    </div>
                                    <div class="col-2">
                                        <input type="text" class="form-control" id="kolnomorsrt" name="no_ref" placeholder="No. Referensi" value="<?= $no_referensi ?>">
                                    </div>
                                    <div class="col-auto">
                                        <label for="kolnomorsrt" class="col-form-label font-weight-bold">/</label>
                                    </div>
                                    <div class="col-2">
                                        <input type="text" class="form-control" id="kolnomorsrt" name="tahun_srt" placeholder="Tahun Surat" value="<?= date('Y') ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kolnamasrt" class="col-sm-2 col-form-label font-weight-bold">Nama Surat</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="kolnamasrt" name="nama_surat" placeholder="Nomor Surat" value="<?= $permohonan['nama_surat'] ?>" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="my-3"></div>
                <div class="card border-left-info shadow h-100">
                    <div class="card-header">
                        <p class="mb-0">Data Pemohon</p>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="kolnik" class="col-sm-2 col-form-label font-weight-bold">NIK Pemohon</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="kolnik" name="nik_pemohon" placeholder="NIK Pemohon" value="<?= $permohonan['nik_pemohon'] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kolnama" class="col-sm-2 col-form-label font-weight-bold">Nama Pemohon</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="kolnama" name="nama_pemohon" placeholder="Nama Pemohon" value="<?= $permohonan['nama_pemohon'] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kolttl" class="col-sm-2 col-form-label font-weight-bold">Tempat, Tanggal Lahir</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="kolttl" name="ttl_pemohon" placeholder="Tempat, Tanggal Lahir" value="<?= $permohonan['ttl_pemohon'] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="koljk" class="col-sm-2 col-form-label font-weight-bold">Jenis Kelamin</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="koljk" name="jk_pemohon" placeholder="Jenis Kelamin" value="<?= $permohonan['jk_pemohon'] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kolkawin" class="col-sm-2 col-form-label font-weight-bold">Status Kawin</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="kolkawin" name="status_pemohon" placeholder="Status Kawin" value="<?= $permohonan['status_pemohon'] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kolkerja" class="col-sm-2 col-form-label font-weight-bold">Pekerjaan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="kolkerja" name="kerja_pemohon" placeholder="Pekerjaan" value="<?= $permohonan['kerja_pemohon'] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kolalamat" class="col-sm-2 col-form-label font-weight-bold">Alamat</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="kolalamat" name="alamat_pemohon" placeholder="Alamat" value="<?= $permohonan['alamat_pemohon'] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="koltelp" class="col-sm-2 col-form-label font-weight-bold">No. Telp</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="koltelp" name="telp_pemohon" placeholder="No. Telp" value="<?= $permohonan['telp_pemohon'] ?>" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if ($permohonan['id_surat'] == '3') : ?>
                    <div class="my-3"></div>
                    <div class="card border-left-info shadow h-100">
                        <div class="card-header">
                            <p class="mb-0">Data Dimohonkan</p>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="kolnik" class="col-sm-2 col-form-label font-weight-bold">NIK Dimohonkan</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="kolnik" name="nik_dimohon" placeholder="NIK Dimohon" value="<?= $permohonan['nik_dimohon'] ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kolnama" class="col-sm-2 col-form-label font-weight-bold">Nama Dimohonkan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="kolnama" name="nama_dimohon" placeholder="Nama Dimohon" value="<?= $permohonan['nama_dimohon'] ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kolttl" class="col-sm-2 col-form-label font-weight-bold">Tempat, Tanggal Lahir</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="kolttl" name="ttl_dimohon" placeholder="Tempat, Tanggal Lahir" value="<?= $permohonan['ttl_dimohon'] ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="koljk" class="col-sm-2 col-form-label font-weight-bold">Jenis Kelamin</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="koljk" name="jk_dimohon" placeholder="Jenis Kelamin" value="<?= $permohonan['jk_dimohon'] ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kolalamat" class="col-sm-2 col-form-label font-weight-bold">Alamat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="kolalamat" name="alamat_dimohon" placeholder="Alamat" value="<?= $permohonan['alamat_dimohon'] ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kolkawin" class="col-sm-2 col-form-label font-weight-bold">Nama Instansi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="kolkawin" name="pendidikan" placeholder="Nama Instansi" value="<?= $permohonan['pendidikan'] ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kolkerja" class="col-sm-2 col-form-label font-weight-bold">Kelas/Semester</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="kolkerja" name="kelas" placeholder="Kelas/Semester" value="<?= $permohonan['kelas'] ?>" required>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="my-3"></div>
                <div class="card border-left-info shadow h-100">
                    <div class="card-header">
                        <p class="mb-0">Data Pendukung</p>
                    </div>
                    <div class="card-body">
                        <?php if ($permohonan['id_surat'] == '4') : ?>
                            <div class="form-group row">
                                <label for="koltglacaara" class="col-sm-2 col-form-label font-weight-bold">Tanggal Acara</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="koltglacara" name="tglacara" placeholder="Tanggal Acara" value="<?= $permohonan['tglacara'] ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kolwaktuacara" class="col-sm-2 col-form-label font-weight-bold">Waktu Acara</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="kolwaktuacara" name="waktuacara" placeholder="Waktu Acara" value="<?= $permohonan['waktuacara'] ?>" required>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if ($permohonan['id_surat'] == '2') : ?>
                            <div class="form-group row">
                                <label for="kolpenghasilan" class="col-sm-2 col-form-label font-weight-bold">Penghasilan</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Rp</div>
                                        </div>
                                        <input type="number" class="form-control <?php echo (isset($validation['penghasilan'])) ? 'is-invalid' : ''; ?>" id="kolpenghasilan" name="penghasilan" placeholder="1.234.567" value="<?= $permohonan['penghasilan'] ?>" required>
                                    </div>
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                        <?php if (isset($validation['penghasilan'])) {
                                            echo $validation['penghasilan'];
                                        } ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if ($permohonan['id_surat'] == '5') : ?>
                            <div class="form-group row">
                                <label for="kolnamausaha" class="col-sm-2 col-form-label font-weight-bold">Nama/Bidang Usaha</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="kolnamausaha" name="nama_usaha" placeholder="Nama/Bidang Usaha" value="<?= $permohonan['nama_usaha'] ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kolalamatusaha" class="col-sm-2 col-form-label font-weight-bold">Alamat Usaha</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="kolalamatusaha" name="alamat_usaha" placeholder="Alamat Usaha" value="<?= $permohonan['alamat_usaha'] ?>" required>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="form-group row">
                            <label for="kolkeperluan" class="col-sm-2 col-form-label font-weight-bold">Keperluan</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="kolkeperluan" name="keperluan" id="" rows="5" placeholder="Keperluan" required><?= $permohonan['keperluan'] ?></textarea>
                            </div>
                        </div>
                        <?php
                        $dokumen_array = explode(',', $permohonan['dokumen']);
                        ?>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label font-weight-bold">Dokumen Pendukung</label>
                            <div class="col-sm-10">
                                <div class="row">
                                    <?php foreach ($dokumen_array as $key => $da) : ?>
                                        <div class="col-md-3 mb-2">
                                            <div class="square">
                                                <a href="" data-toggle="modal" data-target="#gambar<?= $key ?>">
                                                    <img src="<?= base_url('images/' . $da) ?>" alt="<?= $da ?>" class="img-thumbnail">
                                                    <span class="overlay"><i class="fas fa-search-plus"></i></span>
                                                </a>
                                            </div>
                                        </div>
                                        <!-- modal -->
                                        <div class="modal fade" id="gambar<?= $key ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Gambar <?= $key + 1 ?></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img src="<?= base_url('images/' . $da) ?>" alt="Gambar <?= $key ?>" class="img-fluid">
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="my-2"></div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fa-solid fa-square-check"></i>
                        </span>
                        <span class="text">Setujui Permohonan</span>
                    </button>
            </form>
            <div class="mx-2"></div>
            <button type="button" class="btn btn-danger btn-icon-split" data-toggle="modal" data-target="#exampleModalCenter">
                <span class="icon text-white-50">
                    <i class="fa-solid fa-square-xmark"></i>
                </span>
                <span class="text">Tolak Permohonan</span>
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="/verifikasi/tolak" method="POST">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="id_permohonan" value="<?= $permohonan['id'] ?>">
                                <label for="alasan">Alasan Penolakan</label>
                                <input type="text" class="form-control" id="alasan" name="alasan">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fa-solid fa-square-xmark"></i>
                                </span>
                                <span class="text">Tolak Permohonan</span>
                            </button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->
<?= $this->endSection() ?>