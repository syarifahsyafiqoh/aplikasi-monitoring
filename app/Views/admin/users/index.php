<?= $this->extend('layout/sidebar') ?>
<?= $this->section('content') ?>

<link href="<?= base_url('assets/css/admin/user/index.css') ?>" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

<div class="card border-0 shadow">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0"><i class="bi bi-people me-2"></i> Kelola User</h4>
        <a href="<?= base_url('kelola-user/input') ?>" class="btn btn-light">
            <i class="bi bi-person-plus"></i> Tambah User
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table id="table-user" class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Tanggal Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    $('#table-user').DataTable({
        ajax: '<?= base_url('kelola-user/data') ?>',
        columns: [
            { data: null, render: (d,t,r,m) => m.row + 1 },
            { data: "username" },
            { data: "role", render: r => `<span class="badge bg-${r==='admin'?'danger':(r==='bendahara'?'warning':'success')}">${r.toUpperCase()}</span>` },
            { data: "created_at", render: d => new Date(d).toLocaleDateString('id-ID') },
            { data: "id", render: id => `
                <a href="<?= base_url('kelola-user/edit') ?>/${id}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                <button onclick="hapus(${id})" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
            ` }
        ]
    });
});
function hapus(id) {
    Swal.fire({
        title: 'Yakin hapus user ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus!'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`<?= base_url('kelola-user/hapus') ?>/${id}`, { method: 'DELETE' })
                .then(r => r.json())
                .then(res => {
                    if (res.status === 'success') {
                        $('#table-user').DataTable().ajax.reload();
                        Swal.fire('Terhapus!', '', 'success');
                    } else {
                        Swal.fire('Error', res.message, 'error');
                    }
                });
        }
    });
}
</script>

<?= $this->endSection() ?>