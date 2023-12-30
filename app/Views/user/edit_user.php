<?= $this->extend('template/body') ?>

<?= $this->section('page-content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-auto mr-auto">
                    <h5 class="m-0 font-weight-bold text-primary">Edit User</h5>
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
            <form action="/user/update/<?= $users['id']; ?>" method="post">
                <?= csrf_field(); ?>
                <input type="hidden" name="niklama" value="<?= $users['username'] ?>">
                <input type="hidden" name="emaillama" value="<?= $users['email'] ?>">
                <input type="hidden" name="password_hash" value="<?= $users['password_hash'] ?>">
                <div class="form-group row">
                    <label for="kolnik" class="col-sm-2 col-form-label">NIK</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control <?php echo (isset($validation['nik'])) ? 'is-invalid' : ''; ?>" name="nik" id="kolnik" placeholder="NIK" value="<?= (old('nik')) ? old('nik') : $users['username']; ?>">
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
                        <input type="text" class="form-control <?php echo (isset($validation['nama'])) ? 'is-invalid' : ''; ?>" name="nama" id="kolnama" placeholder="Nama Lengkap" value="<?= (old('nama')) ? old('nama') : $users['nama']; ?>">
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
                        <input type="text" class="form-control <?php echo (isset($validation['tempat'])) ? 'is-invalid' : ''; ?>" name="tempat" id="koltempat" placeholder="Tempat Lahir" value="<?= (old('tempat')) ? old('tempat') : $users['tempat']; ?>">
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
                        <input type="date" class="form-control <?php echo (isset($validation['tgllhr'])) ? 'is-invalid' : ''; ?>" name="tgllhr" id="koltanggal" placeholder="Tanggal Lahir" value="<?= (old('tgllhr')) ? old('tgllhr') : $users['tgllhr']; ?>">
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
                                <option value="<?= $key ?>" <?= (old('jk') == $key || $users['jk'] == $key) ? 'selected' : '' ?>><?= $value ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kolalamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?php echo (isset($validation['alamat'])) ? 'is-invalid' : ''; ?>" name="alamat" id="koltempat" placeholder="Alamat" value="<?= (old('alamat')) ? old('alamat') : $users['alamat']; ?>">
                        <div id="validationServerUsernameFeedback" class="invalid-feedback">
                            <?php if (isset($validation['alamat'])) {
                                echo $validation['alamat'];
                            } ?>
                        </div>
                    </div>
                </div>
                <?php
                $telp = $users['telp'];
                $fixtelp = substr($telp, 2, strlen($telp) - 2);
                ?>
                <div class="form-group row">
                    <label for="koltelp" class="col-sm-2 col-form-label">Nomor HP(Whatsapp)</label>
                    <div class="col-auto">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">+62</div>
                            </div>
                            <input type="number" class="form-control <?php echo (isset($validation['telp'])) ? 'is-invalid' : ''; ?>" name="telp" id="koltelp" placeholder="888########" value="<?= (old('telp')) ? old('telp') : $fixtelp; ?>">
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
                                <option value="<?= $key ?>" <?= (old('agama') == $key || $users['agama'] == $key) ? 'selected' : '' ?>><?= $value ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kolkawin" class="col-sm-2 col-form-label">Status Perkawinan</label>
                    <div class="col-auto">
                        <select class="form-control" name="kawin" id="kolkawin">
                            <?php foreach ($optkawin as $key => $value) : ?>
                                <option value="<?= $key ?>" <?= (old('kawin') == $key || $users['kawin'] == $key) ? 'selected' : '' ?>><?= $value ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kolkerja" class="col-sm-2 col-form-label">Pekerjaan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?php echo (isset($validation['kerja'])) ? 'is-invalid' : ''; ?>" name="kerja" id="kolkerja" placeholder="Pekerjaan" value="<?= (old('kerja')) ? old('kerja') : $users['pekerjaan']; ?>">
                        <div id="validationServerUsernameFeedback" class="invalid-feedback">
                            <?php if (isset($validation['kerja'])) {
                                echo $validation['kerja'];
                            } ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kolemail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control <?php echo (isset($validation['email'])) ? 'is-invalid' : ''; ?>" name="email" id="kolemail" placeholder="Email" value="<?= (old('email')) ? old('email') : $users['email']; ?>">
                        <div id="validationServerUsernameFeedback" class="invalid-feedback">
                            <?php if (isset($validation['email'])) {
                                echo $validation['email'];
                            } ?>
                        </div>
                    </div>
                </div>
                <div class="card border-primary mb-3">
                    <div class="card-header"><small>Kosongkan kolom password jika tidak ingin merubah password.</small></div>
                    <div class="card-body">
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
                    </div>
                </div>
                <div class="my-2"></div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fa-solid fa-user-plus"></i>
                        </span>
                        <span class="text">Edit Data</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<?= $this->endSection() ?>