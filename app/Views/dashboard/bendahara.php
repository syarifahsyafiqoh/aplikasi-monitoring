<?= $this->extend('layout/sidebar') ?>
<?= $this->section('content') ?>
<link href="<?= base_url('assets/css/dashboard_bendahara.css') ?>" rel="stylesheet">

<!-- Welcome Section -->
<div class="welcome-section" style="background: linear-gradient(135deg, #6D8B7C 0%, #638890 100%);">
    <div class="welcome-content">
        <h2 class="welcome-title">Selamat Datang Kembali, <span class="username"><?= session()->get('username') ?></span>!</h2>
        <p class="welcome-subtitle">Ringkasan verifikasi berkas hari ini</p>
    </div>
</div>

<!-- Statistics Cards -->
<div class="stats-container">
    <div class="stat-card stat-warning">
        <div class="stat-icon">
            <i class="bi bi-hourglass-split"></i>
        </div>
        <div class="stat-content">
            <p class="stat-label">Menunggu Verifikasi</p>
            <h2 class="stat-value"><?= number_format($menunggu ?? 0) ?></h2>
            <span class="stat-badge badge-warning">Perlu segera diproses</span>
        </div>
    </div>

    <div class="stat-card stat-success">
        <div class="stat-icon">
            <i class="bi bi-check2-all"></i>
        </div>
        <div class="stat-content">
            <p class="stat-label">Diverifikasi Hari Ini</p>
            <h2 class="stat-value"><?= number_format($diverifikasi_hari_ini ?? 0) ?></h2>
            <span class="stat-badge badge-success">Sudah selesai</span>
        </div>
    </div>

    <div class="stat-card stat-danger">
        <div class="stat-icon">
            <i class="bi bi-x-circle-fill"></i>
        </div>
        <div class="stat-content">
            <p class="stat-label">Ditolak</p>
            <h2 class="stat-value"><?= number_format($ditolak ?? 0) ?></h2>
            <span class="stat-badge badge-danger">Perlu follow up</span>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="quick-actions">
    <h5 class="section-title mb-4">
        <i class="bi bi-lightning-charge-fill me-2"></i> Aksi Cepat
    </h5>
    <div class="row g-4">
        <div class="col-md-6">
            <a href="<?= base_url('verifikasi-berkas') ?>" class="action-card action-primary">
                <div class="action-icon">
                    <i class="bi bi-check2-square"></i>
                </div>
                <div class="action-content">
                    <h6 class="action-title">Verifikasi Berkas</h6>
                    <p class="action-subtitle">Proses berkas menunggu</p>
                </div>
            </a>
        </div>
        <div class="col-md-6">
            <a href="<?= base_url('laporan') ?>" class="action-card action-info">
                <div class="action-icon">
                    <i class="bi bi-clipboard-data"></i>
                </div>
                <div class="action-content">
                    <h6 class="action-title">Lihat Laporan</h6>
                    <p class="action-subtitle">Rekap status berkas</p>
                </div>
            </a>
        </div>
    </div>
</div>

<!-- Berkas Terbaru Menunggu Verifikasi -->
<div class="recent-files">
    <h5 class="section-title mb-4">
        <i class="bi bi-folder-symlink me-2"></i> Berkas Terbaru Menunggu Verifikasi
    </h5>
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="table-light">
                <tr>
                    <th width="40">No</th>
                    <th>No Berkas</th>
                    <th>Modul</th>
                    <th>Operator</th>
                    <th>Tanggal Input</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($berkas_terbaru)): ?>
                    <?php $no = 1; foreach ($berkas_terbaru as $b): ?>
                        <tr>
                            <td><span class="table-number"><?= $no++ ?></span></td>
                            <td><strong class="berkas-no"><?= esc($b['no_berkas']) ?></strong></td>
                            <td><?= ucwords(str_replace('_', ' ', esc($b['jenis_modul']))) ?></td>
                            <td>
                                <div class="sender-info">
                                    <i class="bi bi-person-circle"></i>
                                    <span><?= esc($b['operator_name'] ?? 'Unknown') ?></span>
                                </div>
                            </td>
                            <td><?= date('d M Y H:i', strtotime($b['created_at'])) ?></td>
                            <td>
                                <a href="<?= base_url('verifikasi-berkas/detail/' . $b['id']) ?>" 
                                   class="btn btn-sm btn-primary">
                                    <i class="bi bi-eye"></i> Verifikasi
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            Belum ada berkas menunggu verifikasi
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>