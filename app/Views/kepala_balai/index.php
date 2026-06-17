<?= $this->extend('layout/sidebar') ?>
<?= $this->section('content') ?>

<div class="page-header">
    <h1><i class="bi bi-check-circle-fill me-2 text-primary"></i>Persetujuan Akhir Kepala Balai</h1>
    <p class="text-muted">Daftar berkas yang sudah diverifikasi Bendahara dan menunggu persetujuan akhir Anda</p>
</div>

<!-- Statistik Singkat -->
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card text-center border-primary">
            <div class="card-body">
                <h3 class="text-primary"><?= number_format($menunggu_persetujuan ?? 0) ?></h3>
                <p class="mb-0">Menunggu Persetujuan Anda</p>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Data -->
<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0" id="table-persetujuan">
                <thead class="table-light">
                    <tr>
                        <th width="50">No</th>
                        <th>No Berkas</th>
                        <th>Modul</th>
                        <th>Operator</th>
                        <th>Tanggal Diverifikasi</th>
                        <th width="130">Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    $('#table-persetujuan').DataTable({
        ajax: '<?= base_url('persetujuan-kepala/data') ?>',
        processing: true,
        columns: [
            { data: null, render: (d, t, r, m) => m.row + 1 },
            { data: "no_berkas", render: d => `<strong>${d}</strong>` },
            { data: "jenis_modul", render: d => (d || '').replace(/_/g, ' ').toUpperCase() },
            { data: "operator_name" },
            { data: "updated_at", render: d => d ? new Date(d).toLocaleString('id-ID') : '-' },
            { data: "id", render: id => `
                <a href="<?= base_url('persetujuan-kepala/detail') ?>/${id}" class="btn btn-sm btn-primary">
                    <i class="bi bi-eye"></i> Detail
                </a>
            ` }
        ],
        language: {
            search: "Cari berkas:",
            zeroRecords: "Tidak ada berkas yang menunggu persetujuan akhir",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ berkas"
        }
    });
});
</script>

<?= $this->endSection() ?>