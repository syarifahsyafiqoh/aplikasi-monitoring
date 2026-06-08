<?= $this->extend('layout/sidebar') ?>
<?= $this->section('content') ?>

<link href="<?= base_url('assets/css/gaji_induk/index.css') ?>" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

<!-- Page Header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-icon">
            <i class="bi bi-cash-coin"></i>
        </div>
        <div class="page-info">
            <h4 class="page-title">Gaji Induk</h4>
            <p class="page-subtitle">Kelola data gaji induk pegawai</p>
        </div>
    </div>
    <div class="page-actions">
        <a href="<?= base_url('gaji-induk/input') ?>" class="btn-action btn-primary-action">
            <i class="bi bi-plus-circle"></i>
            <span>Input Baru</span>
        </a>
    </div>
</div>

<!-- Data Table Card -->
<div class="data-table-card">
    <div class="table-card-header">
        <div class="table-header-left">
            <h5 class="table-title">
                <i class="bi bi-list-ul"></i>
                Daftar Gaji Induk
            </h5>
        </div>
    </div>

    <div class="table-card-body">
        <div class="table-responsive">
            <table id="table-gaji" class="table custom-datatable">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Uraian</th>
                        <th>No Akun</th>
                        <th>Total Bruto</th>
                        <th>Total Netto</th>
                        <th>Pajak</th>
                        <th>Seksi</th>
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
const DATA_URL = '<?= base_url('gaji-induk/data') ?>';
const DELETE_URL = '<?= base_url('gaji-induk/hapus') ?>';
const DETAIL_URL = '<?= base_url('gaji-induk/detail') ?>';
const EDIT_URL = '<?= base_url('gaji-induk/edit') ?>';

let gajiTable;

function formatRupiah(value) {
    const amount = Number(value || 0);
    return 'Rp ' + amount.toLocaleString('id-ID');
}

function updateStats(rows) {
    let totalBruto = 0;
    let totalNetto = 0;

    rows.forEach(function (row) {
        totalBruto += Number(row.total_bruto || 0);
        totalNetto += Number(row.total_netto || 0);
    });

    document.getElementById('total-gaji').textContent = rows.length.toLocaleString('id-ID');
    document.getElementById('total-bruto').textContent = formatRupiah(totalBruto);
    document.getElementById('total-netto').textContent = formatRupiah(totalNetto);
}

$(document).ready(function () {
    gajiTable = $('#table-gaji').DataTable({
        ajax: {
            url: DATA_URL,
            dataSrc: function (json) {
                const rows = json.data || [];
                updateStats(rows);
                return rows;
            },
            error: function () {
                Swal.fire('Gagal', 'Data tidak dapat dimuat.', 'error');
            }
        },
        processing: true,
        serverSide: false,
        language: {
            processing: 'Memuat data...',
            search: 'Cari:',
            lengthMenu: 'Tampilkan _MENU_ data',
            info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',
            infoEmpty: 'Tidak ada data',
            emptyTable: 'Tidak ada data dalam tabel',
            zeroRecords: 'Data tidak ditemukan',
            paginate: {
                first: 'Pertama',
                last: 'Terakhir',
                next: 'Selanjutnya',
                previous: 'Sebelumnya'
            }
        },
        columns: [
            {
                data: null,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
                orderable: false,
                width: '50px'
            },
            {
                data: 'uraian',
                render: function (data) {
                    if (data && data.length > 50) {
                        return '<span title="' + data + '">' + data.substring(0, 50) + '...</span>';
                    }
                    return data || '-';
                }
            },
            {
                data: 'no_akun',
                render: function (data) {
                    return data || '-';
                }
            },
            {
                data: 'total_bruto',
                className: 'text-end',
                render: function (data) {
                    return formatRupiah(data);
                }
            },
            {
                data: 'total_netto',
                className: 'text-end fw-bold',
                render: function (data) {
                    return formatRupiah(data);
                }
            },
            {
                data: 'pajak',
                className: 'text-end',
                render: function (data) {
                    return formatRupiah(data);
                }
            },
            {
                data: 'seksi',
                render: function (data) {
                    return data || '-';
                }
            },
            {
                data: 'id',
                orderable: false,
                className: 'text-center',
                render: function (id) {
                    return [
                        '<a href="' + DETAIL_URL + '/' + id + '" class="btn btn-sm btn-info text-white me-1" title="Detail">',
                        '  <i class="bi bi-eye"></i>',
                        '</a>',
                        '<a href="' + EDIT_URL + '/' + id + '" class="btn btn-sm btn-warning me-1" title="Edit">',
                        '  <i class="bi bi-pencil"></i>',
                        '</a>',
                        '<button onclick="hapusData(' + id + ')" class="btn btn-sm btn-danger" title="Hapus">',
                        '  <i class="bi bi-trash"></i>',
                        '</button>'
                    ].join('');
                }
            }
        ],
        order: [[1, 'asc']],
        pageLength: 10,
        lengthMenu: [10, 25, 50, 100]
    });

    $('#filter-seksi').on('change', function () {
        gajiTable.column(6).search(this.value).draw();
    });
});

function hapusData(id) {
    Swal.fire({
        title: 'Hapus Data?',
        text: 'Data yang dihapus tidak bisa dikembalikan.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus'
    }).then(function (result) {
        if (!result.isConfirmed) {
            return;
        }

        fetch(DELETE_URL + '/' + id, {
            method: 'DELETE',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                if (data.status === 'success') {
                    gajiTable.ajax.reload(null, false);
                    Swal.fire('Berhasil', 'Data gaji induk sudah dihapus.', 'success');
                    return;
                }

                Swal.fire('Gagal', 'Data gagal dihapus.', 'error');
            })
            .catch(function () {
                Swal.fire('Gagal', 'Terjadi kesalahan saat menghapus data.', 'error');
            });
    });
}
</script>

<?= $this->endSection() ?>
