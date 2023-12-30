<?= $this->extend('template/body') ?>

<?= $this->section('page-content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <?php if (session()->getFlashdata('message')) : ?>
        <script>
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            Toast.fire({
                icon: 'success',
                title: '<?= session()->getFlashdata('message') ?>'
            })
        </script>
    <?php endif; ?>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <?php if (in_groups('admin')) : ?>
            <h1 class="h3 mb-0 text-gray-800">Dashboard Admin</h1>
        <?php else : ?>
            <h1 class="h3 mb-0 text-gray-800">Dashboard Warga</h1>
        <?php endif; ?>

        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Permohonan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-envelopes-bulk fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Permohonan Disetujui</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $disetujui; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-envelope-circle-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Permohonan Ditangguhkan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $ditangguhkan; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-envelope-open-text fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Permohonan Ditolak</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $ditolak; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-trash fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Row favorite -->



    <?php if (in_groups('admin')) : ?>
        <div class="row">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Jenis Surat Terpopular (Kategori Umum)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $favoritUmum[0]['jumlah_permohonan']; ?></div>
                                <div class="small font-weight-bold mb-1">
                                    <?= $favoritUmum[0]['nama_surat']; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-solid fa-envelopes-bulk fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Jenis Surat Terpopular (Kategori Lainnya)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $favoritLainnya[0]['jumlah_permohonan']; ?></div>
                                <div class="small font-weight-bold mb-1">
                                    <?= $favoritLainnya[0]['nama_surat_lain']; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-solid fa-envelope-circle-check fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-xl-6 col-md-6">
                <div class="card shadow">
                    <div class="card-header">
                        <p class="font-weight-bold mb-0">Total Permohonan Per Surat (Kategori Umum)</p>
                    </div>
                    <div class="card-body">
                        <canvas id="chartUmum"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-md-6">
                <div class="card shadow">
                    <div class="card-header">
                        <p class="font-weight-bold mb-0">Total Permohonan Per Surat (Kategori Lainnya)</p>
                    </div>
                    <div class="card-body">
                        <canvas id="chartLainnya"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header">
                        <p class="font-weight-bold mb-0">Data Frekuensi Permohonan <?= date('Y') ?></p>
                    </div>
                    <div class="card-body">
                        <canvas id="chart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(function() {
                const data = <?= json_encode($data) ?>;
                const maxDataValue = Math.max(...data);

                var ctx = document.getElementById('chart').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: <?= json_encode($labels) ?>,
                        datasets: [{
                            label: 'Jumlah Permohonan',
                            data: <?= json_encode($data) ?>,
                            backgroundColor: 'rgba(75, 192, 192, 0.5)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: 'Data Frekuensi Permohonan Per Bulan'
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                suggestedMax: maxDataValue + 5,
                                ticks: {
                                    stepSize: 1,
                                }
                            }
                        }
                    }
                });
            });
        </script>
        <script>
            $(function() {
                const data = <?= json_encode($dataUmum) ?>;

                var ctx = document.getElementById('chartUmum').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: <?= json_encode($labelsUmum) ?>,
                        datasets: [{
                            label: 'Jumlah Permohonan',
                            data: <?= json_encode($dataUmum) ?>,
                            backgroundColor: 'rgba(75, 192, 192, 0.5)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1,
                                }
                            }
                        }
                    }
                });
            });
        </script>
        <script>
            $(function() {
                const data = <?= json_encode($dataLain) ?>;

                var ctx = document.getElementById('chartLainnya').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: <?= json_encode($labelsLain) ?>,
                        datasets: [{
                            label: 'Jumlah Permohonan',
                            data: <?= json_encode($dataLain) ?>,
                            backgroundColor: 'rgba(75, 192, 192, 0.5)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1,
                                }
                            }
                        }
                    }
                });
            });
        </script>
    <?php endif; ?>
    <!-- Content Row -->

</div>
<!-- /.container-fluid -->
<?= $this->endSection() ?>