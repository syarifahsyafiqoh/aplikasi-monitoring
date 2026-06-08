<?= $this->extend('layout/sidebar') ?>
<?= $this->section('content') ?>

<link href="<?= base_url('assets/css/gup/gup.css') ?>" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

<!-- Page Header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-icon">
            <i class="bi bi-cash-stack"></i>
        </div>
        <div class="page-info">
            <h4 class="page-title">GUP / UP / PTUP / TUP</h4>
            <p class="page-subtitle">Kelola data GUP, UP, PTUP, dan TUP</p>
        </div>
    </div>
    <div class="page-actions">
        <a href="<?= base_url('gup/input') ?>" class="btn-action btn-primary-action">
            <i class="bi bi-plus-circle"></i>
            <span>Input Baru</span>
        </a>
    </div>
</div>

<!-- Statistics Cards -->
<!-- <div class="stats-cards-mini">
    <div class="stat-card-mini stat-primary">
        <div class="stat-mini-icon">
            <i class="bi bi-file-earmark-text"></i>
        </div>
        <div class="stat-mini-content">
            <p class="stat-mini-label">Total Data</p>
            <h3 class="stat-mini-value" id="total-data">-</h3>
        </div>
    </div>
    <div class="stat-card-mini stat-success">
        <div class="stat-mini-icon">
            <i class="bi bi-calendar-check"></i>
        </div>
        <div class="stat-mini-content">
            <p class="stat-mini-label">Bulan Ini</p>
            <h3 class="stat-mini-value" id="bulan-ini">-</h3>
        </div>
    </div>
    <div class="stat-card-mini stat-info">
        <div class="stat-mini-icon">
            <i class="bi bi-people"></i>
        </div>
        <div class="stat-mini-content">
            <p class="stat-mini-label">Total Seksi</p>
            <h3 class="stat-mini-value" id="total-seksi">-</h3>
        </div>
    </div>
</div> -->

<!-- Data Table Card -->
<div class="data-table-card">
    <div class="table-card-header">
        <h5 class="table-title">
            <i class="bi bi-list-ul"></i>
            Daftar GUP / UP / PTUP / TUP
        </h5>
    </div>
    <div class="table-card-body">
        <div class="table-responsive">
            <table id="table-gup" class="table custom-datatable">
                <thead>
                    <tr>
                        <th width="60">No</th>
                        <th>Uraian</th>
                        <th width="160">Seksi</th>
                        <th width="160">Tanggal Input</th>
                        <th width="130">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    const table = $('#table-gup').DataTable({
        ajax: '<?= base_url('gup/data') ?>',
        columns: [
            {
                data: null,
                render: (d, t, r, m) => `<span class="table-number-badge">${m.row + 1}</span>`
            },
            {
                data: 'uraian',
                render: d => d
                    ? `<span class="uraian-text">${d.length > 80 ? d.substring(0, 80) + '…' : d}</span>`
                    : '-'
            },
            {
                data: 'seksi',
                render: d => d
                    ? `<span class="seksi-badge">${d}</span>`
                    : '<span class="text-muted">-</span>'
            },
            {
                data: 'created_at',
                render: d => d ? new Date(d).toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' }) : '-'
            },
            {
                data: 'id',
                render: id => `
                    <div class="action-buttons-group">
                        <a href="<?= base_url('gup/detail') ?>/${id}" class="btn-table-action btn-detail" title="Detail">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="<?= base_url('gup/edit') ?>/${id}" class="btn-table-action btn-edit" title="Edit">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <button onclick="hapus(${id})" class="btn-table-action btn-delete" title="Hapus">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                `
            }
        ],
        language: {
            search: '',
            searchPlaceholder: 'Cari data...',
            lengthMenu: 'Tampilkan _MENU_ data',
            info: 'Menampilkan _START_–_END_ dari _TOTAL_ data',
            infoEmpty: 'Tidak ada data',
            zeroRecords: 'Data tidak ditemukan',
            paginate: { previous: '‹', next: '›' }
        },
        drawCallback: function() {
            const info = this.api().page.info();
            $('#total-data').text(info.recordsTotal);
        }
    });
});

function hapus(id) {
    Swal.fire({
        title: 'Yakin hapus?',
        text: 'Data tidak dapat dikembalikan!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#7C8B6D'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`<?= base_url('gup/hapus') ?>/${id}`, { method: 'DELETE' })
                .then(() => {
                    $('#table-gup').DataTable().ajax.reload();
                    Swal.fire('Terhapus!', 'Data berhasil dihapus.', 'success');
                });
        }
    });
}
</script>

<?= $this->endSection() ?>