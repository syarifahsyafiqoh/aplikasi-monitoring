<?= $this->extend('layout/sidebar') ?>
<?= $this->section('content') ?>

<link href="<?= base_url('assets/css/admin/dashboard.css') ?>" rel="stylesheet">

<!-- Page Header -->
<div class="page-header-dashboard">
    <div class="header-content">
        <div class="header-left">
            <p class="welcome-text">Selamat datang kembali,</p>
            <h1 class="page-title">
                <i class="bi bi-speedometer2"></i>
                Dashboard Admin
            </h1>
        </div>
    </div>
</div>


<!-- Statistics Cards -->
<div class="stats-grid">
    <div class="stat-card total">
        <div class="stat-header">
            <div class="stat-icon"><i class="bi bi-people-fill"></i></div>
            <div class="stat-info">
                <p class="stat-label">Total User</p>
                <h2 class="stat-value" id="total-users">Memuat...</h2>
            </div>
        </div>
    </div>

    <div class="stat-card admin">
        <div class="stat-header">
            <div class="stat-icon"><i class="bi bi-shield-fill-check"></i></div>
            <div class="stat-info">
                <p class="stat-label">Admin</p>
                <h2 class="stat-value" id="total-admin">Memuat...</h2>
            </div>
        </div>
    </div>

    <div class="stat-card bendahara">
        <div class="stat-header">
            <div class="stat-icon"><i class="bi bi-cash-stack"></i></div>
            <div class="stat-info">
                <p class="stat-label">Bendahara</p>
                <h2 class="stat-value" id="total-bendahara">Memuat...</h2>
            </div>
        </div>
    </div>

    <div class="stat-card operator">
        <div class="stat-header">
            <div class="stat-icon"><i class="bi bi-person-check-fill"></i></div>
            <div class="stat-info">
                <p class="stat-label">Operator</p>
                <h2 class="stat-value" id="total-operator">Memuat...</h2>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="quick-actions-card">
    <h3 class="section-title">
        <i class="bi bi-lightning-charge-fill"></i>
        Aksi Cepat
    </h3>
    <div class="actions-grid">
        <a href="<?= base_url('kelola-user') ?>" class="action-button">
            <div class="action-icon">
                <i class="bi bi-people"></i>
            </div>
            <div class="action-text">
                <div class="action-title">Kelola User</div>
                <div class="action-subtitle">Lihat semua user</div>
            </div>
        </a>

        <a href="<?= base_url('kelola-user/input') ?>" class="action-button">
            <div class="action-icon">
                <i class="bi bi-person-plus"></i>
            </div>
            <div class="action-text">
                <div class="action-title">Tambah User</div>
                <div class="action-subtitle">Buat user baru</div>
            </div>
        </a>
    </div>
</div>

<!-- Info Cards -->
<div class="info-grid">
    <!-- Tentang Peran Admin -->
    <div class="info-card">
        <h3 class="section-title">
            <i class="bi bi-info-circle-fill"></i>
            Tentang Peran Admin
        </h3>
        <ul class="info-list">
            <li class="info-item">
                <h4 class="info-item-title">Manajemen User</h4>
                <p class="info-item-text">Menambah, mengedit, dan menghapus user sistem</p>
            </li>
            <li class="info-item">
                <h4 class="info-item-title">Mengatur Role</h4>
                <p class="info-item-text">Menentukan peran setiap user (Admin, Bendahara, Operator)</p>
            </li>
            <li class="info-item">
                <h4 class="info-item-title">Monitoring Akses</h4>
                <p class="info-item-text">Memantau akses user</p>
            </li>
        </ul>
    </div>

    <!-- Panduan Singkat -->
    <div class="info-card">
        <h3 class="section-title">
            <i class="bi bi-book-fill"></i>
            Panduan Singkat
        </h3>
        <ul class="info-list">
            <li class="info-item">
                <h4 class="info-item-title">Role Admin</h4>
                <p class="info-item-text">Manajemen User</p>
            </li>
            <li class="info-item">
                <h4 class="info-item-title">Role Bendahara</h4>
                <p class="info-item-text">Mengelola persetujuan data keuangan</p>
            </li>
            <li class="info-item">
                <h4 class="info-item-title">Role Operator</h4>
                <p class="info-item-text">Input dan edit data keuangan</p>
            </li>
        </ul>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script>

function loadStats() {
    fetch('<?= base_url('dashboard/stats') ?>')
        .then(res => res.json())
        .then(data => {
            document.getElementById('total-users').textContent     = data.total_users.toLocaleString('id-ID');
            document.getElementById('total-admin').textContent     = data.total_admin.toLocaleString('id-ID');
            document.getElementById('total-bendahara').textContent = data.total_bendahara.toLocaleString('id-ID');
            document.getElementById('total-operator').textContent  = data.total_operator.toLocaleString('id-ID');
        })
        .catch(err => {
            console.log('Gagal load stats:', err);
            document.getElementById('total-users').textContent = 'Error';
        });
}


window.onload = function() {
    loadStats();
    setInterval(loadStats, 30000);
};
</script>

<?= $this->endSection() ?>
