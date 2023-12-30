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

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-auto mr-auto">
                    <h5 class="m-0 font-weight-bold text-primary">Arsip Surat</h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataArsip" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>No. Surat</th>
                            <th>Jenis Surat</th>
                            <th>NIK Pemohon</th>
                            <th>Nama Pemohon</th>
                            <th>Keperluan</th>
                            <th>Tgl. pengajuan</th>
                            <th>Tgl. Verifikasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($arsip as $a) :
                        ?>
                            <tr>
                                <th scope="row"><?= $i++ ?></th>
                                <td><?= $a['no_instansi'] . '/' . $a['no_srt'] . '/' . $a['no_ref'] . '/' . $a['tahun_srt']; ?></td>
                                <td><?= $a['nama_surat_lain'] ? $a['nama_surat_lain'] : $a['nama_surat']; ?></td>
                                <td><?= $a['nik_pemohon']; ?></td>
                                <td><?= $a['nama_pemohon']; ?></td>
                                <td><?= $a['keperluan']; ?></td>
                                <td><?= $a['tgl_pengajuan']; ?></td>
                                <td><?= $a['tgl_verif']; ?></td>
                                <td>
                                    <a href="/arsip-surat/detail/<?= $a['id']; ?>" class="btn btn-primary btn-icon-split btn-sm">
                                        <span class="icon text-white-50">
                                            <i class="fa-solid fa-info"></i>
                                        </span>
                                        <span class="text">Detail</span>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th>No. Surat</th>
                            <th>Jenis Surat</th>
                            <th>NIK Pemohon</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>Tgl. Verifikasi</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

</div>
<script>
    $(document).ready(function() {
        // DataTables dengan opsi dasar dan menambahkan beberapa tombol untuk ekspor data
        var table = $('#dataArsip').DataTable({
            responsive: true,
            lengthChange: false,
            autoWidth: true,
            columnDefs: [{
                targets: [4, 6],
                visible: false
            }],
            buttons: [{
                extend: 'excel',
                text: 'Excel',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7] // menghilangkan kolom ke-2
                }
            }, {
                extend: 'pdf',
                text: 'PDF',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7] // menghilangkan kolom ke-2
                }
            }, {
                extend: 'csv',
                text: 'CSV',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5] // menghilangkan kolom ke-2
                }
            }, {
                extend: 'pageLength',
                text: 'Panjang Data'
            }, {
                extend: 'colvis',
                text: 'Kolom'
            }]
        });

        // Menempatkan tombol di dalam wrapper DataTables
        table.buttons().container().appendTo('#dataArsip_wrapper .col-md-6:eq(0)');

        // Membuat input pencarian di dalam footer
        $('#dataArsip tfoot th').each(function() {
            var title = $(this).text();
            if (title == "Tgl. Verifikasi") {
                $(this).html('<input type="date" placeholder="Search ' + title + '" />');
            } else if (title != "") {
                $(this).html('<input type="text" placeholder="Search ' + title + '" />');
            }
        });

        // Menerapkan fungsi pencarian untuk setiap kolom
        table.columns([1, 2, 3, 7]).every(function() {
            var that = this;

            $('input', this.footer()).on('keyup change clear', function() {
                if (that.search() !== this.value) {
                    that.search(this.value).draw();
                }
            });
        });
    });
</script>
<!-- <script>
    $(function() {
        $("#dataArsip").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "buttons": ["pageLength", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#dataArsip_wrapper .col-md-6:eq(0)');
    });
</script> -->
<!-- /.container-fluid -->
<?= $this->endSection() ?>