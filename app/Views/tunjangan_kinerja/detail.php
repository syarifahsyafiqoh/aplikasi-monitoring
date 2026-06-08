<?= $this->extend('layout/sidebar') ?>
<?= $this->section('content') ?>

<link href="<?= base_url('assets/css/tunjangan_kinerja/detail-edit.css') ?>" rel="stylesheet">

<div class="row justify-content-center">
    <div class="col-lg-9">

        <!-- Page Header -->
        <div class="tk-page-header">
            <div class="tk-page-header-icon">
                <i class="bi bi-trophy"></i>
            </div>
            <div class="tk-page-header-text">
                <h4>Detail Tunjangan Kinerja</h4>
                <p>Informasi lengkap data tunjangan kinerja</p>
            </div>
        </div>

        <!-- Main Card -->
        <div class="tk-main-card">

            <!-- Informasi Dasar -->
            <div class="tk-section-head">
                <i class="bi bi-file-earmark-text"></i> Informasi Dasar
            </div>
            <div class="tk-card-body">
                <div class="row g-3 mb-3">
                    <div class="col-12">
                        <div class="tk-field">
                            <div class="tk-field-label">
                                <i class="bi bi-card-text"></i> Uraian
                            </div>
                            <p class="tk-field-value"><?= esc($tk['uraian']) ?: '-' ?></p>
                        </div>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="tk-field">
                            <div class="tk-field-label">
                                <i class="bi bi-upc-scan"></i> No Akun
                            </div>
                            <p class="tk-field-value">
                                <?php if (!empty($tk['no_akun'])): ?>
                                    <span class="tk-akun-badge"><?= esc($tk['no_akun']) ?></span>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="tk-field">
                            <div class="tk-field-label">
                                <i class="bi bi-diagram-3"></i> Seksi
                            </div>
                            <p class="tk-field-value">
                                <?php if (!empty($tk['seksi'])): ?>
                                    <span class="tk-seksi-badge"><?= esc($tk['seksi']) ?></span>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rincian Keuangan -->
            <div class="tk-section-head">
                <i class="bi bi-cash-coin"></i> Rincian Keuangan
            </div>
            <div class="tk-card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="tk-field tk-field-bruto">
                            <div class="tk-field-label">
                                <i class="bi bi-coin"></i> Total Bruto
                            </div>
                            <p class="tk-field-value">
                                Rp <?= number_format($tk['total_bruto'], 0, ',', '.') ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="tk-field tk-field-netto">
                            <div class="tk-field-label">
                                <i class="bi bi-wallet2"></i> Total Netto
                            </div>
                            <p class="tk-field-value">
                                Rp <?= number_format($tk['total_netto'], 0, ',', '.') ?>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="tk-actions">
                    <a href="<?= base_url('tunjangan-kinerja') ?>" class="btn-tk-back">
                        <i class="bi bi-arrow-left"></i> Kembali ke Daftar
                    </a>
                    <a href="<?= base_url('tunjangan-kinerja/edit/' . $tk['id']) ?>" class="btn-tk-edit">
                        <i class="bi bi-pencil"></i> Edit Data
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>