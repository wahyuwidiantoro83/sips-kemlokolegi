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

    <!-- Page Heading -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-auto mr-auto">
                    <h5 class="m-0 font-weight-bold text-primary">Form Pengajuan Surat Keterangan Usaha</h5>
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
            <form action="/permohonan/save/5" method="POST" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <?php if (in_groups('admin')) : ?>
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
                <?php endif ?>

                <?php if (in_groups('user')) : ?>
                    <div class="form-group row">
                        <label for="kolnik" class="col-sm-2 col-form-label font-weight-bold">NIK Pemohon</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control <?php echo (isset($validation['nik_pemohon'])) ? 'is-invalid' : ''; ?>" id="kolnik" name="nik_pemohon" placeholder="NIK Pemohon" value="<?= user()->username ?>" readonly>
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                <?php if (isset($validation['nik_pemohon'])) {
                                    echo $validation['nik_pemohon'];
                                } ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kolnama" class="col-sm-2 col-form-label font-weight-bold">Nama Pemohon</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?php echo (isset($validation['nama_pemohon'])) ? 'is-invalid' : ''; ?>" id="kolnama" name="nama_pemohon" placeholder="Nama Pemohon" value="<?= user()->nama ?>" readonly>
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                <?php if (isset($validation['nama_pemohon'])) {
                                    echo $validation['nama_pemohon'];
                                } ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    $tanggal = user()->tgllhr;
                    $tanggalfix = date('d-m-Y', strtotime($tanggal));
                    ?>
                    <div class="form-group row">
                        <label for="kolttl" class="col-sm-2 col-form-label font-weight-bold">Tempat, Tanggal Lahir</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?php echo (isset($validation['ttl_pemohon'])) ? 'is-invalid' : ''; ?>" id="kolttl" name="ttl_pemohon" placeholder="Tempat, Tanggal Lahir" value="<?= user()->tempat . ', ' . $tanggalfix ?>" readonly>
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                <?php if (isset($validation['ttl_pemohon'])) {
                                    echo $validation['ttl_pemohon'];
                                } ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="koljk" class="col-sm-2 col-form-label font-weight-bold">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?php echo (isset($validation['jk_pemohon'])) ? 'is-invalid' : ''; ?>" id="koljk" name="jk_pemohon" placeholder="Jenis Kelamin" value="<?= user()->jk == 'L' ? 'Laki-laki' : 'Perempuan' ?>" readonly>
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                <?php if (isset($validation['jk_pemohon'])) {
                                    echo $validation['jk_pemohon'];
                                } ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kolkawin" class="col-sm-2 col-form-label font-weight-bold">Status Kawin</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?php echo (isset($validation['status_pemohon'])) ? 'is-invalid' : ''; ?>" id="kolkawin" name="status_pemohon" placeholder="Status Kawin" value="<?= user()->kawin ?>" readonly>
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                <?php if (isset($validation['status_pemohon'])) {
                                    echo $validation['status_pemohon'];
                                } ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kolkerja" class="col-sm-2 col-form-label font-weight-bold">Pekerjaan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?php echo (isset($validation['kerja_pemohon'])) ? 'is-invalid' : ''; ?>" id="kolkerja" name="kerja_pemohon" placeholder="Pekerjaan" value="<?= user()->pekerjaan ?>" readonly>
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                <?php if (isset($validation['kerja_pemohon'])) {
                                    echo $validation['kerja_pemohon'];
                                } ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kolalamat" class="col-sm-2 col-form-label font-weight-bold">Alamat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?php echo (isset($validation['alamat_pemohon'])) ? 'is-invalid' : ''; ?>" id="kolalamat" name="alamat_pemohon" placeholder="Alamat" value="<?= user()->alamat ?>" readonly>
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                <?php if (isset($validation['alamat_pemohon'])) {
                                    echo $validation['alamat_pemohon'];
                                } ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="koltelp" class="col-sm-2 col-form-label font-weight-bold">No Telp</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control <?php echo (isset($validation['telp_pemohon'])) ? 'is-invalid' : ''; ?>" id="koltelp" name="telp_pemohon" placeholder="No Telp" value="<?= user()->telp ?>" readonly>
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                <?php if (isset($validation['telp_pemohon'])) {
                                    echo $validation['telp_pemohon'];
                                } ?>
                            </div>
                        </div>
                    </div>
                <?php endif ?>
                <div class="form-group row">
                    <label for="kolusaha" class="col-sm-2 col-form-label font-weight-bold">Nama Usaha</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?php echo (isset($validation['nama_usaha'])) ? 'is-invalid' : ''; ?>" id="kolusaha" name="nama_usaha" placeholder="Nama Usaha" required>
                        <div id="validationServerUsernameFeedback" class="invalid-feedback">
                            <?php if (isset($validation['nama_usaha'])) {
                                echo $validation['nama_usaha'];
                            } ?>
                        </div>
                        <small id="desckeperluan" class="form-text text-muted">
                            Tulis nama/bidang usaha (Contoh: Peternakan Sapi, Pertanian, Percetakan, dll).
                        </small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kolalamatusaha" class="col-sm-2 col-form-label font-weight-bold">Alamat Usaha</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?php echo (isset($validation['alamat_usaha'])) ? 'is-invalid' : ''; ?>" id="kolalamatusaha" name="alamat_usaha" placeholder="Alamat Usaha" required>
                        <div id="validationServerUsernameFeedback" class="invalid-feedback">
                            <?php if (isset($validation['alamat_usaha'])) {
                                echo $validation['alamat_usaha'];
                            } ?>
                        </div>
                        <small id="desckeperluan" class="form-text text-muted">
                            Tulis alamat lokasi usaha.
                        </small>
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
                            <input type="file" class="custom-file-input <?php echo (isset($validation['dokumen'])) ? 'is-invalid' : ''; ?>" id="customFile" name="dokumen[]" accept=".jpg, .jpeg, .png" multiple>
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