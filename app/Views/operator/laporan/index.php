<?= $this->extend('layout/sidebar') ?>
<?= $this->section('content') ?>

<div class="page-header">
    <h3 class="page-title">
        <i class="bi bi-clipboard-data me-2 text-primary"></i>
        Laporan Saya
    </h3>
</div>

<div class="row g-4">
    <!-- Card 1 -->
    <div class="col-md-6 col-lg-3">
        <a href="<?= base_url('laporan-operator/jumlah_per_status') ?>" class="card text-decoration-none text-dark shadow-sm h-100 border-primary">
            <div class="card-body text-center">
                <i class="bi bi-bar-chart-line-fill display-4 text-primary mb-3"></i>
                <h5>Rekap Jumlah per Status</h5>
                <p class="text-muted">Lihat jumlah berkas berdasarkan status</p>
            </div>
        </a>
    </div>

    <!-- Card 2 -->
    <div class="col-md-6 col-lg-3">
        <a href="<?= base_url('laporan-operator/jumlah_per_modul') ?>" class="card text-decoration-none text-dark shadow-sm h-100 border-success">
            <div class="card-body text-center">
                <i class="bi bi-grid-3x3-gap-fill display-4 text-success mb-3"></i>
                <h5>Rekap Jumlah per Modul</h5>
                <p class="text-muted">Jumlah berkas per jenis modul</p>
            </div>
        </a>
    </div>

    <!-- Card 3 -->
    <div class="col-md-6 col-lg-3">
        <a href="<?= base_url('laporan-operator/total_biaya_per_modul') ?>" class="card text-decoration-none text-dark shadow-sm h-100 border-warning">
            <div class="card-body text-center">
                <i class="bi bi-currency-dollar display-4 text-warning mb-3"></i>
                <h5>Total Anggaran per Modul</h5>
                <p class="text-muted">Total biaya/anggaran yang diajukan per modul</p>
            </div>
        </a>
    </div>

    <!-- Card 4 -->
    <div class="col-md-6 col-lg-3">
        <a href="<?= base_url('laporan-operator/rekap_per_seksi') ?>" class="card text-decoration-none text-dark shadow-sm h-100 border-info">
            <div class="card-body text-center">
                <i class="bi bi-clock-history display-4 text-info mb-3"></i>
                <h5>Riwayat Verifikasi & Seksi</h5>
                <p class="text-muted">Riwayat proses verifikasi & rekap per seksi</p>
            </div>
        </a>
    </div>
</div>

<?= $this->endSection() ?>