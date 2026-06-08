$(document).ready(function() {
    $('#table-pd').DataTable({
        ajax: DATA_URL,
        processing: true,
        serverSide: false,
        language: {
            processing: 'Memuat data...',
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty: "Tidak ada data",
            paginate: {
                first: "Pertama",
                last: "Terakhir",
                next: "Selanjutnya",
                previous: "Sebelumnya"
            }
        },
        columns: [
            // No (dihitung otomatis)
            { 
                data: null, 
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
                orderable: false,
                width: "50px"
            },
            
            // No Surat Tugas
            { data: "no_surat_tugas" },
            
            // Uraian (potong panjang + tooltip)
            { 
                data: "uraian",
                render: function (data) {
                    if (data) {
                        return '<span title="' + data + '">' + data.substring(0, 50) + (data.length > 50 ? '...' : '') + '</span>';
                    }
                    return '-';
                }
            },
            
            // No Akun
            { data: "no_akun", render: d => d || '-' },
            
            // Harian Perjalanan (rupiah)
            { 
                data: "harian_perjalanan",
                className: "text-end",
                render: function (data) {
                    let val = parseInt(data) || 0;
                    return 'Rp ' + val.toLocaleString('id-ID');
                }
            },
            
            // Penginapan (rupiah)
            { 
                data: "penginapan",
                className: "text-end",
                render: function (data) {
                    let val = parseInt(data) || 0;
                    return 'Rp ' + val.toLocaleString('id-ID');
                }
            },
            
            // Transport (rupiah)
            { 
                data: "transport",
                className: "text-end",
                render: function (data) {
                    let val = parseInt(data) || 0;
                    return 'Rp ' + val.toLocaleString('id-ID');
                }
            },
            
            // Total Biaya (hitung manual)
            { 
                data: null,
                className: "text-end fw-bold",
                render: function (data) {
                    let harian = parseInt(data.harian_perjalanan) || 0;
                    let penginapan = parseInt(data.penginapan) || 0;
                    let transport = parseInt(data.transport) || 0;
                    let total = harian + penginapan + transport;
                    return 'Rp ' + total.toLocaleString('id-ID');
                }
            },
            
            // Seksi
            { data: "seksi", render: d => d || '-' },
            
            // Aksi
            { 
                data: "id",
                orderable: false,
                className: "text-center",
                render: function (id) {
                    return `
                        <a href="${DETAIL_URL}/${id}" class="btn btn-sm btn-info text-white me-1" title="Detail">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="${EDIT_URL}/${id}" class="btn btn-sm btn-warning me-1" title="Edit">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <button onclick="hapusData(${id})" class="btn btn-sm btn-danger" title="Hapus">
                            <i class="bi bi-trash"></i>
                        </button>
                    `;
                }
            }
        ],
        order: [[1, 'desc']], // urutkan dari tanggal terbaru
        pageLength: 10,
        lengthMenu: [10, 25, 50, 100]
    });
});

// Fungsi hapus (sudah OK, tidak perlu diubah)
function hapusData(id) {
    Swal.fire({
        title: 'Hapus Data?',
        text: "Data yang dihapus tidak bisa dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(DELETE_URL + '/' + id, { 
                method: 'DELETE',
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(response => response.json())
            .then(data => {
                table.ajax.reload();
                Swal.fire('Berhasil!', 'Data sudah dihapus.', 'success');
            })
            .catch(error => {
                Swal.fire('Gagal!', 'Terjadi kesalahan.', 'error');
            });
        }
    });
}