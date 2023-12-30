<?= $this->extend('template/body') ?>

<?= $this->section('page-content') ?>
<!-- Begin Page Content -->

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js" integrity="sha512-k6/Bkb8Fxf/c1Tkyl39yJwcOZ1P4cRrJu77p83zJjN2Z55prbFHxPs9vN7q3l3+tSMGPDdoH51AEU8Vgo1cgAA==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css" integrity="sha512-3JRrEUwaCkFUBLK1N8HehwQgu8e23jTH4np5NHOmQOobuC4ROQxFwFgBLTnhcnQRMs84muMh0PnnwXlPq5MGjg==" crossorigin="anonymous" />
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
                    <h5 class="m-0 font-weight-bold text-primary">Form Pengajuan Surat Keterangan Izin Hiburan</h5>
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
            <form action="/permohonan/save/4" method="POST" enctype="multipart/form-data">
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
                    <label for="koltglacara" class="col-sm-2 col-form-label font-weight-bold">Tanggal Acara</label>
                    <div class="col-sm-10">
                        <div class="form-row">
                            <div class="col">
                                <div class="input-group date" id="datetimepicker7" data-target-input="nearest">
                                    <input type="text" name="tglmulai" class="form-control <?php echo (isset($validation['tglmulai'])) ? 'is-invalid' : ''; ?> datetimepicker-input" data-target="#datetimepicker7" value="<?= old('tglmulai'); ?>" />
                                    <div class="input-group-append" data-target="#datetimepicker7" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                        <?php if (isset($validation['tglmulai'])) {
                                            echo $validation['tglmulai'];
                                        } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <label for="" class="col-form-label font-weight-bold"> Sampai </label>
                            </div>
                            <div class="col">
                                <div class="input-group date" id="datetimepicker8" data-target-input="nearest">
                                    <input type="text" name="tglselesai" class="form-control <?php echo (isset($validation['tglselesai'])) ? 'is-invalid' : ''; ?> datetimepicker-input" data-target="#datetimepicker8" value="<?= old('tglselesai'); ?>" />
                                    <div class="input-group-append" data-target="#datetimepicker8" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                        <?php if (isset($validation['tglselesai'])) {
                                            echo $validation['tglselesai'];
                                        } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kolwaktuacara" class="col-sm-2 col-form-label font-weight-bold">Waktu Acara</label>
                    <div class="col-sm-10">
                        <div class="form-row">
                            <div class="col">
                                <div class="input-group date" id="datawaktumulai" data-target-input="nearest">
                                    <input type="text" name="waktumulai" class="form-control <?php echo (isset($validation['waktumulai'])) ? 'is-invalid' : ''; ?> datetimepicker-input" data-target="#datawaktumulai" value="<?= old('waktumulai'); ?>" />
                                    <div class="input-group-append" data-target="#datawaktumulai" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                        <?php if (isset($validation['waktumulai'])) {
                                            echo $validation['waktumulai'];
                                        } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <label for="" class="col-form-label font-weight-bold"> Sampai </label>
                            </div>
                            <div class="col">
                                <div class="input-group date" id="datawaktuselesai" data-target-input="nearest">
                                    <input type="text" name="waktuselesai" class="form-control <?php echo (isset($validation['waktuselesai'])) ? 'is-invalid' : ''; ?> datetimepicker-input" data-target="#datawaktuselesai" value="<?= old('waktuselesai'); ?>" />
                                    <div class="input-group-append" data-target="#datawaktuselesai" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                        <?php if (isset($validation['waktuselesai'])) {
                                            echo $validation['waktuselesai'];
                                        } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kolkeperluan" class="col-sm-2 col-form-label font-weight-bold">Keperluan/Nama Acara</label>
                    <div class="col-sm-10">
                        <textarea class="form-control <?php echo (isset($validation['keperluan'])) ? 'is-invalid' : ''; ?>" id="kolkeperluan" name="keperluan" id="" rows="5" placeholder="Keperluan"><?= old('keperluan'); ?></textarea>
                        <div id="validationServerUsernameFeedback" class="invalid-feedback">
                            <?php if (isset($validation['keperluan'])) {
                                echo $validation['keperluan'];
                            } ?>
                        </div>
                        <small id="desckeperluan" class="form-text text-muted">
                            Tulis nama acara/hiburan (ex: Hiburan Electone, Orkes, Jaranan) (maks 300 karakter).
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
<script type="text/javascript">
    $(function() {
        $('#datetimepicker7').datetimepicker({
            format: 'DD-MM-YYYY'
        });
        $('#datetimepicker8').datetimepicker({
            useCurrent: false,
            format: 'DD-MM-YYYY'
        });
        $("#datetimepicker7").on("change.datetimepicker", function(e) {
            $('#datetimepicker8').datetimepicker('minDate', e.date);
        });
        $("#datetimepicker8").on("change.datetimepicker", function(e) {
            $('#datetimepicker7').datetimepicker('maxDate', e.date);
        });
    });
</script>
<script type="text/javascript">
    $(function() {
        $('#datawaktumulai').datetimepicker({
            useCurrent: true,
            format: 'HH:mm'
        });
        $('#datawaktuselesai').datetimepicker({
            useCurrent: true,
            format: 'HH:mm'
        });
        $("#datawaktumulai").on("change.datetimepicker", function(e) {
            $('#datawaktuselesai').datetimepicker('minDate', e.date);
        });
        $("#datawaktuselesai").on("change.datetimepicker", function(e) {
            $('#datawaktumulai').datetimepicker('maxDate', e.date);
        });
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