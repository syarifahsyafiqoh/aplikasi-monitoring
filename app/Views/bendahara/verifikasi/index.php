<?= $this->extend('layout/sidebar') ?>
<?= $this->section('content') ?>
<link href="<?= base_url('assets/css/verifikasi_berkas.css') ?>" rel="stylesheet">
<link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<div class="verifikasi-header mb-4" style="background: linear-gradient(135deg, #6D8B7C 0%, #638890 100%);">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
        <div>
            <h3 class="mb-1">
                <i class="bi bi-check2-circle me-2"></i>Verifikasi Berkas
            </h3>
            <p class="mb-0">Daftar berkas dari semua modul yang menunggu verifikasi Anda.</p>
        </div>
        <span class="badge text-bg-light border px-3 py-2" id="badge-total">0 berkas</span>
    </div>
</div>

<div class="card border-0 shadow-sm verifikasi-card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table id="table-verifikasi" class="table table-hover align-middle mb-0 w-100">
                <thead>
                    <tr>
                        <th width="70">No</th>
                        <th>No Berkas</th>
                        <th>Jenis Modul</th>
                        <th>Uraian / Perihal</th>
                        <th>Pengirim / Operator</th>
                        <th width="180">Tanggal Input</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    const table = $('#table-verifikasi').DataTable({
        ajax: '<?= base_url('verifikasi-berkas/data') ?>',
        processing: true,
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            zeroRecords: "Tidak ada berkas menunggu verifikasi",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ berkas",
            infoEmpty: "Menampilkan 0 data",
            paginate: {
                previous: "Sebelumnya",
                next: "Berikutnya"
            }
        },
        columns: [
            { data: null, render: (d, t, r, m) => m.row + m.settings._iDisplayStart + 1 },
            { data: "no_berkas", render: d => `<span class="fw-semibold text-dark">${d}</span>` },
            { data: "jenis_modul", render: d => (d || '').replaceAll('_', ' ').toUpperCase() },
            { data: "detail.uraian", render: d => d ? d.substring(0, 50) + (d.length > 50 ? '...' : '') : '-' },
            { data: "operator_name", render: d => d || '-' },
            { data: "created_at", render: d => new Date(d).toLocaleString('id-ID') },
            { data: "id", render: id => `
                <a href="<?= base_url('verifikasi-berkas/detail') ?>/${id}" class="btn btn-sm btn-verifikasi">
                    <i class="bi bi-eye"></i> Verifikasi
                </a>
            ` }
        ]
    });

    table.on('xhr.dt', function() {
        const json = table.ajax.json();
        const total = json && json.data ? json.data.length : 0;
        $('#badge-total').text(`${total} berkas`);
    });
});
</script>

<?= $this->endSection() ?>
