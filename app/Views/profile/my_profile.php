<?= $this->extend('template/body') ?>

<?= $this->section('page-content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <?php if (session()->getFlashdata('sukses')) : ?>
        <script>
            Swal.fire(
                'Good job!',
                '<?= session()->getFlashdata('sukses'); ?>',
                'success'
            )
        </script>
    <?php endif; ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-auto mr-auto">
                    <h5 class="m-0 font-weight-bold text-primary">Profil User</h5>
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
            <?php if (user()->email) : ?>
                <div class="row">
                    <div class="col-sm-2 font-weight-bold">Email</div>
                    <div class="col-sm-8">: <?= user()->email; ?></div>
                </div>
                <div class="my-3"></div>
            <?php endif; ?>
            <?php if (user()->username) : ?>
                <div class="row">
                    <div class="col-sm-2 font-weight-bold">NIK(Username)</div>
                    <div class="col-sm-8">: <?= user()->username; ?></div>
                </div>
                <div class="my-3"></div>
            <?php endif; ?>
            <?php if (user()->nama) : ?>
                <div class="row">
                    <div class="col-sm-2 font-weight-bold">Nama</div>
                    <div class="col-sm-8">: <?= user()->nama; ?></div>
                </div>
                <div class="my-3"></div>
            <?php endif; ?>
            <?php if (user()->tempat) : ?>
                <div class="row">
                    <div class="col-sm-2 font-weight-bold">Tempat, Tanggal Lahir</div>
                    <div class="col-sm-8">: <?= user()->tempat; ?>, <?= user()->tgllhr; ?></div>
                </div>
                <div class="my-3"></div>
            <?php endif; ?>
            <?php if (user()->jk) : ?>
                <div class="row">
                    <div class="col-sm-2 font-weight-bold">Jenis Kelamin</div>
                    <div class="col-sm-8">: <?= user()->jk; ?></div>
                </div>
                <div class="my-3"></div>
            <?php endif; ?>
            <?php if (user()->alamat) : ?>
                <div class="row">
                    <div class="col-sm-2 font-weight-bold">Alamat</div>
                    <div class="col-sm-8">: <?= user()->alamat; ?></div>
                </div>
                <div class="my-3"></div>
            <?php endif; ?>
            <?php if (user()->telp) : ?>
                <div class="row">
                    <div class="col-sm-2 font-weight-bold">Telp(Whatsapp)</div>
                    <div class="col-sm-8">: <?= user()->telp; ?></div>
                </div>
                <div class="my-3"></div>
            <?php endif; ?>
            <?php if (user()->agama) : ?>
                <div class="row">
                    <div class="col-sm-2 font-weight-bold">Agama</div>
                    <div class="col-sm-8">: <?= user()->agama; ?></div>
                </div>
                <div class="my-3"></div>
            <?php endif; ?>
            <?php if (user()->kawin) : ?>
                <div class="row">
                    <div class="col-sm-2 font-weight-bold">Status Perkawinan</div>
                    <div class="col-sm-8">: <?= user()->kawin; ?></div>
                </div>
                <div class="my-3"></div>
            <?php endif; ?>
            <?php if (user()->kerja) : ?>
                <div class="row">
                    <div class="col-sm-2 font-weight-bold">Pekerjaan</div>
                    <div class="col-sm-8">: <?= user()->kerja; ?></div>
                </div>
                <div class="my-3"></div>
            <?php endif; ?>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <p class="h6 mb-0 font-weight-bold">Ubah Password</p>
                        </div>
                        <form action="/profil/ubah-password" method="POST">
                            <?= csrf_field(); ?>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="kolpassword" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control <?php echo (session()->getFlashdata('error_password')) ? 'is-invalid' : ''; ?>" name="password" id="kolpassword" placeholder="Password" required>
                                        <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                            <?php if (session()->getFlashdata('error_password')) {
                                                echo session()->getFlashdata('error_password');
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="kolpassword_baru" class="col-sm-2 col-form-label">Password Baru</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control <?php echo (isset($validation['password_baru'])) ? 'is-invalid' : ''; ?>" name="password_baru" id="kolpassword_baru" placeholder="Password baru" required>
                                        <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                            <?php if (isset($validation['password_baru'])) {
                                                echo $validation['password_baru'];
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="kolkonfirmasipassword" class="col-sm-2 col-form-label">Konfirmasi Password Baru</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control <?php echo (isset($validation['konfirmasi'])) ? 'is-invalid' : ''; ?>" name="konfirmasi" id="kolkonfirmasipassword" placeholder="Konfirmasi password baru" required>
                                        <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                            <?php if (isset($validation['konfirmasi'])) {
                                                echo $validation['konfirmasi'];
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success btn-icon-split btn-sm">
                                    <span class="icon text-white-50">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </span>
                                    <span class="text">Ubah Password</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <div class="card border-warning mb-3">
                        <div class="card-header">
                            <h4 class="mb-0 card-title font-weight-bold text-warning">INFO!</h4>
                        </div>
                        <div class="card-body">
                            <p class="card-text font-weight-bold text-secondary">Jika terdapat kesalahan pada data anda mohon untuk menghubungi admin desa dengan bukti yang menunjukan kesalahan data agar segera dibetulkan.</p>
                        </div>
                        <div class="card-footer">
                            <p class="card-text font-weight-bold text-secondary">Admin Desa Kemlokolegi</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<?= $this->endSection() ?>