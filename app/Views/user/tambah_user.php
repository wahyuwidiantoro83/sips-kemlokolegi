<?= $this->extend('template/body') ?>

<?= $this->section('page-content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Bootstrap Datepicker CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    <!-- Bootstrap Datepicker JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <!-- Page Heading -->

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-auto mr-auto">
                    <h5 class="m-0 font-weight-bold text-primary">Tambah User</h5>
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
            <form action="/user/save" method="post">
                <?= csrf_field(); ?>
                <div class="form-group row">
                    <label for="kolnik" class="col-sm-2 col-form-label">NIK</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control <?php echo (isset($validation['nik'])) ? 'is-invalid' : ''; ?>" name="nik" id="kolnik" placeholder="NIK" value="<?= old('nik'); ?>">
                        <div id="validationServerUsernameFeedback" class="invalid-feedback">
                            <?php if (isset($validation['nik'])) {
                                echo $validation['nik'];
                            } ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kolnama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?php echo (isset($validation['nama'])) ? 'is-invalid' : ''; ?>" name="nama" id="kolnama" placeholder="Nama Lengkap" value="<?= old('nama'); ?>">
                        <div id="validationServerUsernameFeedback" class="invalid-feedback">
                            <?php if (isset($validation['nama'])) {
                                echo $validation['nama'];
                            } ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="koltempat" class="col-sm-2 col-form-label">Tempat Lahir</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?php echo (isset($validation['tempat'])) ? 'is-invalid' : ''; ?>" name="tempat" id="koltempat" placeholder="Tempat Lahir" value="<?= old('tempat'); ?>">
                        <div id="validationServerUsernameFeedback" class="invalid-feedback">
                            <?php if (isset($validation['tempat'])) {
                                echo $validation['tempat'];
                            } ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="koltanggal" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                    <div class="col-auto">
                        <input type="text" class="form-control <?php echo (isset($validation['tgllhr'])) ? 'is-invalid' : ''; ?>" id="koltanggal" name="tgllhr" placeholder="dd/mm/yyyy" value="<?= old('tgllhr'); ?>">
                        <div id="validationServerUsernameFeedback" class="invalid-feedback">
                            <?php if (isset($validation['tgllhr'])) {
                                echo $validation['tgllhr'];
                            } ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="koljk" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-auto">
                        <select class="form-control" name="jk" id="koljk">
                            <?php foreach ($optjk as $key => $value) : ?>
                                <option value="<?= $key ?>" <?= old('jk') == $key ? 'selected' : '' ?>><?= $value ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kolalamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-6">
                        <input type="text" class="form-control <?php echo (isset($validation['dusun'])) ? 'is-invalid' : ''; ?>" name="dusun" placeholder="Dusun" value="<?= old('dusun'); ?>">
                        <div id="validationServerUsernameFeedback" class="invalid-feedback">
                            <?php if (isset($validation['dusun'])) {
                                echo $validation['dusun'];
                            } ?>
                        </div>
                    </div>
                    <div class="col">
                        <input type="number" class="form-control <?php echo (isset($validation['rt'])) ? 'is-invalid' : ''; ?>" name="rt" placeholder="RT" value="<?= old('rt'); ?>">
                        <div id="validationServerUsernameFeedback" class="invalid-feedback">
                            <?php if (isset($validation['rt'])) {
                                echo $validation['rt'];
                            } ?>
                        </div>
                    </div>
                    <div class="col">
                        <input type="number" class="form-control <?php echo (isset($validation['rw'])) ? 'is-invalid' : ''; ?>" name="rw" placeholder="RW" value="<?= old('rw'); ?>">
                        <div id="validationServerUsernameFeedback" class="invalid-feedback">
                            <?php if (isset($validation['rw'])) {
                                echo $validation['rw'];
                            } ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="koltelp" class="col-sm-2 col-form-label">Nomor HP(Whatsapp)</label>
                    <div class="col-auto">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">+62</div>
                            </div>
                            <input type="number" class="form-control <?php echo (isset($validation['telp'])) ? 'is-invalid' : ''; ?>" name="telp" id="koltelp" placeholder="888########" value="<?= old('telp'); ?>">
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                <?php if (isset($validation['telp'])) {
                                    echo $validation['telp'];
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kolagama" class="col-sm-2 col-form-label">Agama</label>
                    <div class="col-auto">
                        <select class="form-control" name="agama" id="kolagama">
                            <?php foreach ($optagama as $key => $value) : ?>
                                <option value="<?= $key ?>" <?= old('agama') == $key ? 'selected' : '' ?>><?= $value ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kolkawin" class="col-sm-2 col-form-label">Status Perkawinan</label>
                    <div class="col-auto">
                        <select class="form-control" name="kawin" id="kolkawin">
                            <?php foreach ($optkawin as $key => $value) : ?>
                                <option value="<?= $key ?>" <?= old('kawin') == $key ? 'selected' : '' ?>><?= $value ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kolkerja" class="col-sm-2 col-form-label">Pekerjaan</label>
                    <div class="col-auto">
                        <select class="form-control" name="kerja" id="kolkerja" onchange="showInput()">
                            <?php foreach ($optkerja as $key => $value) : ?>
                                <option value="<?= $key ?>" <?= old('kerja') == $key ? 'selected' : '' ?>><?= $value ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row" id="kerjalainnya-input" style="display: none;">
                    <label for="kerjalainnya" class="col-sm-2 col-form-label">Tulis Pekerjaan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?php echo (isset($validation['kerjalainnya'])) ? 'is-invalid' : ''; ?>" id="kerjalainnya" name="kerjalainnya" placeholder="Tuliskan Pekerjaan" value="<?= old('kerjalainnya'); ?>">
                        <div id="validationServerUsernameFeedback" class="invalid-feedback">
                            <?php if (isset($validation['kerjalainnya'])) {
                                echo $validation['kerjalainnya'];
                            } ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kolemail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control <?php echo (isset($validation['email'])) ? 'is-invalid' : ''; ?>" name="email" id="kolemail" placeholder="Email" value="<?= old('email'); ?>">
                        <div id="validationServerUsernameFeedback" class="invalid-feedback">
                            <?php if (isset($validation['email'])) {
                                echo $validation['email'];
                            } ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kolpassword" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control <?php echo (isset($validation['password'])) ? 'is-invalid' : ''; ?>" name="password" id="kolpassword" placeholder="Password" value="<?= old('password'); ?>">
                        <div id="validationServerUsernameFeedback" class="invalid-feedback">
                            <?php if (isset($validation['password'])) {
                                echo $validation['password'];
                            } ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kolkonfirmasipassword" class="col-sm-2 col-form-label">Konfirmasi Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control <?php echo (isset($validation['password2'])) ? 'is-invalid' : ''; ?>" name="password2" id="kolkonfirmasipassword" placeholder="Konfirmasi Password">
                        <div id="validationServerUsernameFeedback" class="invalid-feedback">
                            <?php if (isset($validation['password2'])) {
                                echo $validation['password2'];
                            } ?>
                        </div>
                    </div>
                </div>
                <div class="my-2"></div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fa-solid fa-user-plus"></i>
                        </span>
                        <span class="text">Tambahkan Data</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
<script>
    var jobSelect = document.getElementById('kolkerja');
    var jobLainnya = document.getElementById('kerjalainnya-input');

    // Tampilkan input field ketika pilihan "Lainnya" dipilih
    if (jobSelect.value === 'other') {
        jobLainnya.style.display = 'flex';
    }

    jobSelect.addEventListener('change', function() {
        if (jobSelect.value == 'other') {
            jobLainnya.style.display = 'flex';
        } else {
            jobLainnya.style.display = 'none';
        }
    });
</script>

<Script>
    $(document).ready(function() {
        // Inisialisasi datepicker
        $('#koltanggal').datepicker({
            format: 'yyyy-mm-dd',
            endDate: '-17y', // Set minimum age to 17 years ago from today
            autoclose: true
        });
    });
</Script>
<!-- /.container-fluid -->
<?= $this->endSection() ?>