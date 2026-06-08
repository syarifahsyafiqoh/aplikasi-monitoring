<?= $this->extend('layout/sidebar') ?>
<?= $this->section('content') ?>

<link href="<?= base_url('assets/css/perjalanan_dinas/index.css') ?>" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

<!-- Page Header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-icon">
            <i class="bi bi-airplane-engines-fill"></i>
        </div>
        <div class="page-info">
            <h4 class="page-title">Perjalanan Dinas</h4>
            <p class="page-subtitle">Kelola data perjalanan dinas pegawai</p>
        </div>
    </div>
    <div class="page-actions">
        <a href="<?= base_url('perjalanan-dinas') ?>?print=1" target="_blank" class="btn-action btn-export">
            <i class="bi bi-printer"></i>
            <span>Cetak Laporan</span>
        </a>
        <a href="<?= base_url('perjalanan-dinas/input') ?>" class="btn-action btn-primary-action">
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
                Daftar Perjalanan Dinas
            </h5>
        </div>
    </div>
    
    <div class="table-card-body">
        <div class="table-responsive">
            <table id="table-pd" class="table custom-datatable">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>No Surat Tugas</th>
                        <th>Uraian Tugas</th>
                        <th>No Akun</th>
                        <th>Harian</th>
                        <th>Penginapan</th>
                        <th>Transport</th>
                        <th>Total Biaya</th>
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
    const BASE_URL = '<?= base_url() ?>';
    const DATA_URL = '<?= base_url('perjalanan-dinas/data') ?>';
    const DELETE_URL = '<?= base_url('perjalanan-dinas/hapus') ?>';
    const DETAIL_URL = '<?= base_url('perjalanan-dinas/detail') ?>';
    const EDIT_URL = '<?= base_url('perjalanan-dinas/edit') ?>';
</script>
<script src="<?= base_url('assets/js/perjalanan_dinas/index.js') ?>"></script>

<?= $this->endSection() ?>