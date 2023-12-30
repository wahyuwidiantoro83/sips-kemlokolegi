<?= $this->extend('template/body') ?>

<?= $this->section('page-content') ?>
<!-- Begin Page Content -->
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

    <?php if (in_groups('admin')) : ?>
        <!-- Page Heading -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-auto mr-auto">
                        <h5 class="m-0 font-weight-bold text-primary">Form Pengarsipan Surat Lainnya</h5>
                    </div>
                    <div class="col-auto">
                        <a href="/permohonan" class="btn btn-primary btn-icon-split btn-sm">
                            <span class="icon text-white-50">
                                <i class="fa-solid fa-angles-left"></i>
                            </span>
                            <span class="text">Kembali</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="/permohonan/save/8" method="POST" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
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
                            <input type="text" class="form-control" id="kolnamasrt" name="nama_surat_lain" placeholder="Nama Surat">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kolnik" class="col-sm-2 col-form-label font-weight-bold">NIK Pemohon</label>
                        <div class="col-sm-10">
                            <select class="form-control search" name="search"></select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kolnama" class="col-sm-2 col-form-label font-weight-bold">Nama Pemohon</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="kolnama" name="nama_pemohon" placeholder="Nama Pemohon">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kolttl" class="col-sm-2 col-form-label font-weight-bold">Tempat, Tanggal Lahir</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="kolttl" name="ttl_pemohon" placeholder="Tempat, Tanggal Lahir">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="koljk" class="col-sm-2 col-form-label font-weight-bold">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="koljk" name="jk_pemohon" placeholder="Jenis Kelamin">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kolkawin" class="col-sm-2 col-form-label font-weight-bold">Status Kawin</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="kolkawin" name="status_pemohon" placeholder="Status Kawin">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kolkerja" class="col-sm-2 col-form-label font-weight-bold">Pekerjaan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="kolkerja" name="kerja_pemohon" placeholder="Pekerjaan">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kolalamat" class="col-sm-2 col-form-label font-weight-bold">Alamat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="kolalamat" name="alamat_pemohon" placeholder="Alamat">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="koltelp" class="col-sm-2 col-form-label font-weight-bold">No Telp</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="koltelp" name="telp_pemohon" placeholder="No Telp">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kolkeperluan" class="col-sm-2 col-form-label font-weight-bold">Keperluan</label>
                        <div class="col-sm-10">
                            <textarea class="form-control <?php echo (isset($validation['keperluan'])) ? 'is-invalid' : ''; ?>" id="kolkeperluan" name="keperluan" id="" rows="5" placeholder="Keperluan"><?= old('keperluan'); ?></textarea>
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                <?php if (isset($validation['keperluan'])) {
                                    echo $validation['keperluan'];
                                } ?>
                            </div>
                            <small id="desckeperluan" class="form-text text-muted">
                                Tulis keperluan dengan jelas dan diawali huruf kapital (ex: Untuk mengurus BPJS) (maks 300 karakter).
                            </small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label font-weight-bold">Dokumen Pendukung</label>
                        <div class="col-sm-10">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input <?php echo (isset($validation['dokumen'])) ? 'is-invalid' : ''; ?>" id="customFile" name="dokumen[]" accept=".jpg, .jpeg, .png" multiple max="3">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                    <?php if (isset($validation['dokumen'])) {
                                        echo $validation['dokumen'];
                                    } ?>
                                </div>
                            </div>
                            <small id="desckeperluan" class="form-text text-muted">
                                Upload dokumen pendukung seperti Scan Ktp, Scan KK, dan dokumen lainnya yang dapat mendukung alasan permohonan. (Max File: 4, Max Size: 1MB, Format: .jpg, .jpeg, .png)
                            </small>
                        </div>
                    </div>
                    <div class="my-2"></div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fa-solid fa-paper-plane"></i>
                            </span>
                            <span class="text">Ajukan Permohonan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

    <?php endif ?>

</div>
<script>
    $(document).ready(function() {
        bsCustomFileInput.init()
    });
</script>
<?php if (in_groups('admin')) : ?>
    <script>
        $('.search').select2({
            placeholder: '--- Cari NIK ---',
            allowClear: true,
            tags: true,
            createTag: function(params) {
                return {
                    id: params.term,
                    text: params.term,
                    newOption: true
                }
            },
            ajax: {
                url: '<?php echo base_url('permohonan/cari'); ?>',
                type: 'POST',
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        }).on('select2:select', function(e) {
            var data = e.params.data;
            var tanggal = data.tgllhr.substring(8, 10);
            var bulan = data.tgllhr.substring(5, 7);
            var tahun = data.tgllhr.substring(0, 4);
            var jk = (data.jk == 'L') ? 'Laki-laki' : 'Perempuan';
            $('#kolnama').val(data.nama);
            $('#kolttl').val(data.tempat + ', ' + tanggal + '-' + bulan + '-' + tahun);
            $('#koljk').val(jk);
            $('#kolkawin').val(data.kawin);
            $('#kolkerja').val(data.pekerjaan);
            $('#kolalamat').val(data.alamat);
            $('#koltelp').val(data.telp);
        }).on('select2:unselect', function(e) {
            $('#kolnama').val('');
            $('#kolttl').val('');
            $('#koljk').val('');
            $('#kolkawin').val('');
            $('#kolkerja').val('');
            $('#kolalamat').val('');
            $('#koltelp').val('');
        });
    </script>
<?php endif; ?>
<!-- /.container-fluid -->
<?= $this->endSection() ?>