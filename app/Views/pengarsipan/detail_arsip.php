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

    <?php if (session()->getFlashdata('error')) : ?>
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

    <?php if (session()->getFlashdata('success')) : ?>
        <script>
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            Toast.fire({
                icon: 'success',
                title: '<?= session()->getFlashdata('success'); ?>'
            })
        </script>
    <?php endif; ?>

    <!-- Page Heading -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-auto mr-auto">
                    <h5 class="m-0 font-weight-bold text-primary">Detail Arsip</h5>
                </div>
                <div class="col-auto">
                    <a href="/arsip-surat" class="btn btn-primary btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                            <i class="fa-solid fa-angles-left"></i>
                        </span>
                        <span class="text">Kembali</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
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
                                    <input type="text" class="form-control" id="kolnomorsrt" name="no_instansi" placeholder="No. Instansi" value="<?= $permohonan['no_instansi'] ?>" readonly>
                                </div>
                                <div class="col-auto">
                                    <label for="kolnomorsrt" class="col-form-label font-weight-bold">/</label>
                                </div>
                                <div class="col-2">
                                    <input type="text" class="form-control" id="kolnomorsrt" name="no_srt" placeholder="No. Surat" value="<?= $permohonan['no_srt'] ?>" readonly>
                                </div>
                                <div class="col-auto">
                                    <label for="kolnomorsrt" class="col-form-label font-weight-bold">/</label>
                                </div>
                                <div class="col-2">
                                    <input type="text" class="form-control" id="kolnomorsrt" name="no_ref" placeholder="No. Referensi" value="<?= $permohonan['no_ref'] ?>" readonly>
                                </div>
                                <div class="col-auto">
                                    <label for="kolnomorsrt" class="col-form-label font-weight-bold">/</label>
                                </div>
                                <div class="col-2">
                                    <input type="text" class="form-control" id="kolnomorsrt" name="tahun_srt" placeholder="Tahun Surat" value="<?= $permohonan['tahun_srt'] ?>" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kolnamasrt" class="col-sm-2 col-form-label font-weight-bold">Nama Surat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="kolnamasrt" name="nama_surat" placeholder="Nama Surat" value="<?= $permohonan['nama_surat_lain'] ? $permohonan['nama_surat_lain'] : $permohonan['nama_surat']; ?>" readonly>
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
                                <input type="number" class="form-control" id="kolnik" name="nik_pemohon" placeholder="NIK Pemohon" value="<?= $permohonan['nik_dimohon'] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kolnama" class="col-sm-2 col-form-label font-weight-bold">Nama Dimohonkan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="kolnama" name="nama_pemohon" placeholder="Nama Pemohon" value="<?= $permohonan['nama_dimohon'] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kolttl" class="col-sm-2 col-form-label font-weight-bold">Tempat, Tanggal Lahir</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="kolttl" name="ttl_pemohon" placeholder="Tempat, Tanggal Lahir" value="<?= $permohonan['ttl_dimohon'] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="koljk" class="col-sm-2 col-form-label font-weight-bold">Jenis Kelamin</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="koljk" name="jk_pemohon" placeholder="Jenis Kelamin" value="<?= $permohonan['jk_dimohon'] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kolalamat" class="col-sm-2 col-form-label font-weight-bold">Alamat</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="kolalamat" name="alamat_pemohon" placeholder="Alamat" value="<?= $permohonan['alamat_dimohon'] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kolkawin" class="col-sm-2 col-form-label font-weight-bold">Nama Instansi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="kolkawin" name="status_pemohon" placeholder="Status Kawin" value="<?= $permohonan['pendidikan'] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kolkerja" class="col-sm-2 col-form-label font-weight-bold">Kelas/Semester</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="kolkerja" name="kerja_pemohon" placeholder="Pekerjaan" value="<?= $permohonan['kelas'] ?>" readonly>
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
                                <input type="text" class="form-control" id="koltglacara" name="tglacara" placeholder="Tanggal Acara" value="<?= $permohonan['tglacara'] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kolwaktuacara" class="col-sm-2 col-form-label font-weight-bold">Waktu Acara</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="kolwaktuacara" name="waktuacara" placeholder="Waktu Acara" value="<?= $permohonan['waktuacara'] ?>" readonly>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if ($permohonan['id_surat'] == '7') : ?>
                        <div class="form-group row">
                            <label for="koldomisili" class="col-sm-2 col-form-label font-weight-bold">Alamat Domisili</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="koldomisili" name="domisili" placeholder="Alamat Domisili" value="<?= $permohonan['domisili'] ?>" readonly>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if ($permohonan['id_surat'] == '5') : ?>
                        <div class="form-group row">
                            <label for="kolnamausaha" class="col-sm-2 col-form-label font-weight-bold">Nama/Bidang Usaha</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="kolnamausaha" name="nama_usaha" placeholder="Nama/Bidang Usaha" value="<?= $permohonan['nama_usaha'] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kolalamatusaha" class="col-sm-2 col-form-label font-weight-bold">Alamat Usaha</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="kolalamatusaha" name="alamat_usaha" placeholder="Alamat Usaha" value="<?= $permohonan['alamat_usaha'] ?>" readonly>
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
                                    <input type="number" class="form-control" id="kolpenghasilan" name="penghasilan" placeholder="1.234.567" value="<?= $permohonan['penghasilan'] ?>" readonly>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="form-group row">
                        <label for="kolkeperluan" class="col-sm-2 col-form-label font-weight-bold">Keperluan</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="kolkeperluan" name="keperluan" id="" rows="5" placeholder="Keperluan" readonly><?= $permohonan['keperluan'] ?></textarea>
                        </div>
                    </div>
                    <?php
                    $dokumen_array = explode(',', $permohonan['dokumen']);
                    ?>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label font-weight-bold">Dokumen Pendukung</label>
                        <div class="col-sm-10">
                            <div class="row">
                                <?php foreach ($dokumen_array as $key => $ds) : ?>
                                    <div class="col-md-3 mb-2">
                                        <div class="square">
                                            <a href="" data-toggle="modal" data-target="#gambar<?= $key ?>">
                                                <img src="<?= base_url('images/' . $ds) ?>" alt="<?= $ds ?>" class="img-thumbnail">
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
                                                    <img src="<?= base_url('images/' . $ds) ?>" alt="Gambar <?= $key ?>" class="img-fluid">
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
            <div class="my-3"></div>
            <?php
            $dokumen_scan = explode(',', $permohonan['scan_surat']);
            ?>
            <div class="card border-left-info shadow h-100">
                <div class="card-header">
                    <p class="mb-0">Scan Surat</p>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label font-weight-bold">Scan Surat</label>
                        <div class="col-sm-10">
                            <div class="row">
                                <?php foreach ($dokumen_scan as $key => $ds) : ?>
                                    <div class="col-md-3 mb-2">
                                        <div class="square">
                                            <a href="" data-toggle="modal" data-target="#gambarscan<?= $key ?>">
                                                <img src="<?= base_url('images/' . $ds) ?>" alt="<?= $ds ?>" class="img-thumbnail">
                                                <span class="overlay"><i class="fas fa-search-plus"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- modal -->
                                    <div class="modal fade" id="gambarscan<?= $key ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Gambar <?= $key + 1 ?></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <img src="<?= base_url('images/' . $ds) ?>" alt="Gambar <?= $key ?>" class="img-fluid">
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
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-end">
                <a href="" class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#modalUploadBaru">
                    <span class="icon text-white-50">
                        <i class="fa-solid fa-file-arrow-up"></i>
                    </span>
                    <span class="text">Upload Scan Baru</span>
                </a>
                <div class="mx-2"></div>
                <a href="/verifikasi/cetak-surat-<?= $permohonan['id_surat']; ?>/<?= $permohonan['id']; ?>" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fa-solid fa-print"></i>
                    </span>
                    <span class="text">Print</span>
                </a>
                <div class="mx-2"></div>
                <form action="/arsip-surat/delete/<?= $permohonan['id'] ?>" method="post" onsubmit="confirmDelete(event)" class="d-inline">
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

<!-- Modal Upload -->
<div class="modal fade" id="modalUploadBaru" tabindex="-1" aria-labelledby="modalUpdateLabelBaru" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalUpdateLabelBaru">Upload Scan Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('arsip-surat/upload-baru'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="dokumen">Scan Surat</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="scan" accept=".jpg, .jpeg, .png">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="<?= $permohonan['id']; ?>">
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
<!-- Modal Upload -->
<script>
    $(document).ready(function() {
        bsCustomFileInput.init()
    });
</script>
<script>
    function confirmDelete(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Apakah Anda yakin?',
            html: "<p class='text-center'>Anda tidak akan dapat mengembalikan tindakan ini!</p><div></div><p class='text-center'><small><strong><mark>Penghapusan hanya dilakukan untuk penggantian arsip.</mark></strong></small></p><p class='text-center'><small><strong><mark>Mohon catat nomor surat sebelum menghapus data!.</mark></strong></small></p>",
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