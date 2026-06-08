<?= $this->extend('layout/sidebar') ?>
<?= $this->section('content') ?>

<link href="<?= base_url('assets/css/uang_makan/index.css') ?>" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

<!-- Page Header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-icon">
            <i class="bi bi-cup-hot"></i>
        </div>
        <div class="page-info">
            <h4 class="page-title">Uang Makan</h4>
            <p class="page-subtitle">Kelola data uang makan pegawai</p>
        </div>
    </div>
    <div class="page-actions">
        <a href="<?= base_url('uang-makan/input') ?>" class="btn-action btn-primary-action">
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
                Daftar Uang Makan
            </h5>
        </div>
        <div class="table-header-right">
        </div>
    </div>
    
    <div class="table-card-body">
        <div class="table-responsive">
            <table id="table-um" class="table custom-datatable">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Uraian</th>
                        <th>No Akun</th>
                        <th>Total Bruto</th>
                        <th>Total Netto</th>
                        <th>Seksi</th>
                        <th>Tanggal Input</th>
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
var table;

$(document).ready(function() {
    
    table = $('#table-um').DataTable({
        ajax: {
            url: '<?= base_url('uang-makan/data') ?>',
            dataSrc: function(json) {
                var rows = json.data || [];
                hitungStatistik(rows);
                return rows;
            },
            error: function() {
                Swal.fire({
                    title: 'Gagal!',
                    text: 'Data uang makan tidak dapat dimuat.',
                    icon: 'error',
                    confirmButtonColor: '#dc3545'
                });
            }
        },
        processing: true,
        serverSide: false,
        language: {
            processing: 'Memuat data...',
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty: "Tidak ada data",
            emptyTable: "Tidak ada data dalam tabel",
            paginate: {
                first: "Pertama",
                last: "Terakhir",
                next: "Selanjutnya",
                previous: "Sebelumnya"
            }
        },
        columns: [
            // Kolom nomor urut
            { 
                data: null, 
                render: function(data, type, row, meta) {
                    var nomor = meta.row + 1;
                    return '<span class="table-number-badge">' + nomor + '</span>';
                },
                orderable: false 
            },
            
            // Kolom Uraian
            { 
                data: "uraian",
                render: function(data) {
                    if (data && data.length > 50) {
                        return '<span title="' + data + '">' + data.substring(0, 50) + '...</span>';
                    }
                    return data || '-';
                }
            },
            
            // Kolom No Akun
            {  
                data: "no_akun",
                render: function(data) {
                    return data ? '<span class="akun-badge">' + data + '</span>' : '-';
                }
            },
            
            // Kolom Total Bruto
            {  
                data: "total_bruto",
                className: "text-end",
                render: function(data) {
                    var nilai = parseInt(data) || 0;
                    return '<span class="currency-value">Rp ' + nilai.toLocaleString('id-ID') + '</span>';
                }
            },
            
            // Kolom Total Netto
            {  
                data: "total_netto",
                className: "text-end",
                render: function(data) {
                    var nilai = parseInt(data) || 0;
                    return '<strong class="total-value">Rp ' + nilai.toLocaleString('id-ID') + '</strong>';
                }
            },
            
            // Kolom Seksi
            { 
                data: "seksi",
                render: function(data) {
                    return data ? '<span class="seksi-badge">' + data + '</span>' : '-';
                }
            },
            
            // Kolom Tanggal
            { 
                data: "created_at",
                render: function(data) {
                    if (data) {
                        var tanggal = new Date(data);
                        return tanggal.toLocaleDateString('id-ID');
                    }
                    return '-';
                }
            },
            
            // Kolom Aksi
            {  
                data: "id", 
                orderable: false,
                className: "text-center",
                render: function(id) {
                    var html = '<div class="action-buttons-group">';
                    html += '<a href="<?= base_url('uang-makan/detail') ?>/' + id + '" class="btn-table-action btn-detail" title="Lihat Detail"><i class="bi bi-eye"></i></a>';
                    html += '<a href="<?= base_url('uang-makan/edit') ?>/' + id + '" class="btn-table-action btn-edit" title="Edit Data"><i class="bi bi-pencil"></i></a>';
                    html += '<button onclick="hapusData(' + id + ')" class="btn-table-action btn-delete" title="Hapus Data"><i class="bi bi-trash"></i></button>';
                    html += '</div>';
                    return html;
                }
            }
        ],
        order: [[0, 'desc']],
        pageLength: 10
    });

    // Filter berdasarkan Seksi
    $('#filter-seksi').on('change', function() {
        table.column(5).search(this.value).draw();
    });
});

// Fungsi untuk menghitung statistik
function hitungStatistik(rows) {
    var data = rows || [];
    var jumlahTotal = data.length;
    var totalBruto = 0;
    var totalNetto = 0;

    for (var i = 0; i < data.length; i++) {
        totalBruto = totalBruto + (parseInt(data[i].total_bruto) || 0);
        totalNetto = totalNetto + (parseInt(data[i].total_netto) || 0);
    }

    $('#total-um').text(jumlahTotal);
    $('#total-bruto').text('Rp ' + totalBruto.toLocaleString('id-ID'));
    $('#total-netto').text('Rp ' + totalNetto.toLocaleString('id-ID'));
}

// Fungsi untuk hapus data
function hapusData(id) {
    Swal.fire({
        title: 'Hapus Data?',
        text: "Data yang dihapus tidak bisa dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Menghapus...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            fetch('<?= base_url('uang-makan/hapus') ?>/' + id, { 
                method: 'DELETE',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                table.ajax.reload();
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Data uang makan sudah dihapus.',
                    icon: 'success',
                    confirmButtonColor: '#7C8B6D'
                });
            })
            .catch(function(error) {
                Swal.fire({
                    title: 'Gagal!',
                    text: 'Terjadi kesalahan.',
                    icon: 'error',
                    confirmButtonColor: '#dc3545'
                });
            });
        }
    });
}
</script>

<?= $this->endSection() ?>
