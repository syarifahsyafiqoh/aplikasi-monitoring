<?= $this->extend('layout/sidebar') ?>
<?= $this->section('content') ?>

<link href="<?= base_url('assets/css/kontraktual/index.css') ?>" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

<!-- Page Header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-icon">
            <i class="bi bi-cash-coin me-2"></i>
        </div>
        <div class="page-info">
            <h4 class="page-title">Kontraktual</h4>
            <p class="page-subtitle">Kelola data kontraktual</p>
        </div>
    </div>
    <div class="page-actions">
        <a href="<?= base_url('kontraktual/input') ?>" class="btn-action btn-primary-action">
            <i class="bi bi-plus-circle"></i>
            <span>Input Baru</span>
        </a>
    </div>
</div>

<div class="card border-0 shadow">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
        <h4 class="mb-0">
            <i class="bi bi-cash-coin me-2"></i> Daftar Kontraktual
        </h4>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table id="table-gaji" class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="60">No</th>
                        <th>Uraian</th>
                        <th>No Akun</th>
                        <th>Total Uang Bruto</th>
                        <th>Total Uang Netto</th>
                        <th>Pajak</th>
                        <th>Seksi</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Script Datatables + SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    $('#table-gaji').DataTable({
        ajax: '<?= base_url('kontraktual/data') ?>',
        processing: true,
        serverSide: false,
        columns: [
            { data: null, render: (data, type, row, meta) => meta.row + 1 },
            { data: "uraian", render: data => data.length > 50 ? data.substr(0,50)+'...' : data },
            { data: "no_akun" },
            { data: "total_uang_bruto", render: data => 'Rp ' + parseInt(data).toLocaleString('id-ID') },
            { data: "total_uang_netto", render: data => 'Rp ' + parseInt(data).toLocaleString('id-ID') },
            { data: "pajak", render: data => 'Rp ' + parseInt(data).toLocaleString('id-ID') },
            { data: "seksi" },
            { data: "id", render: id => `
                <a href="<?= base_url('kontraktual/detail') ?>/${id}" class="btn btn-sm btn-info text-white me-1" title="Detail">
                    <i class="bi bi-eye"></i>
                </a>
                <a href="<?= base_url('kontraktual/edit') ?>/${id}" class="btn btn-sm btn-warning me-1" title="Edit">
                    <i class="bi bi-pencil"></i>
                </a>
                <button onclick="hapus(${id})" class="btn btn-sm btn-danger" title="Hapus">
                    <i class="bi bi-trash"></i>
                </button>
            ` }
        ],
        order: [[0, 'desc']]
    });
});

function hapus(id) {
    Swal.fire({
        title: 'Yakin hapus data ini?',
        text: "Data yang dihapus tidak bisa dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`<?= base_url('gaji-induk/hapus') ?>/${id}`, { method: 'DELETE' })
                .then(response => response.json())
                .then(() => {
                    $('#table-gaji').DataTable().ajax.reload();
                    Swal.fire('Terhapus!', 'Data gaji induk telah dihapus.', 'success');
                });
        }
    });
}
</script>

<?= $this->endSection() ?>