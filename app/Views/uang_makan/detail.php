<?= $this->extend('layout/sidebar') ?>
<?= $this->section('content') ?>

<link href="<?= base_url('assets/css/uang_makan/detail-edit.css') ?>" rel="stylesheet">

<div class="row justify-content-center">
    <div class="col-lg-9">

        <!-- Page Header -->
        <div class="um-page-header">
            <div class="um-page-header-icon">
                <i class="bi bi-cup-hot"></i>
            </div>
            <div class="um-page-header-text">
                <h4>Detail Uang Makan</h4>
                <p>Informasi lengkap data uang makan</p>
            </div>
        </div>

        <!-- Main Card -->
        <div class="um-main-card">

            <!-- Informasi Dasar -->
            <div class="um-section-head">
                <i class="bi bi-file-earmark-text"></i> Informasi Dasar
            </div>
            <div class="um-card-body">
                <div class="row g-3 mb-3">
                    <div class="col-12">
                        <div class="um-field">
                            <div class="um-field-label">
                                <i class="bi bi-card-text"></i> Uraian
                            </div>
                            <p class="um-field-value"><?= esc($um['uraian']) ?: '-' ?></p>
                        </div>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="um-field">
                            <div class="um-field-label">
                                <i class="bi bi-upc-scan"></i> No Akun
                            </div>
                            <p class="um-field-value">
                                <?php if (!empty($um['no_akun'])): ?>
                                    <span class="um-akun-badge"><?= esc($um['no_akun']) ?></span>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="um-field">
                            <div class="um-field-label">
                                <i class="bi bi-diagram-3"></i> Seksi
                            </div>
                            <p class="um-field-value">
                                <?php if (!empty($um['seksi'])): ?>
                                    <span class="um-seksi-badge"><?= esc($um['seksi']) ?></span>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rincian Keuangan -->
            <div class="um-section-head">
                <i class="bi bi-cash-coin"></i> Rincian Keuangan
            </div>
            <div class="um-card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="um-field um-field-bruto">
                            <div class="um-field-label">
                                <i class="bi bi-coin"></i> Total Bruto
                            </div>
                            <p class="um-field-value">
                                Rp <?= number_format($um['total_bruto'], 0, ',', '.') ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="um-field um-field-netto">
                            <div class="um-field-label">
                                <i class="bi bi-wallet2"></i> Total Netto
                            </div>
                            <p class="um-field-value">
                                Rp <?= number_format($um['total_netto'], 0, ',', '.') ?>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="um-actions">
                    <a href="<?= base_url('uang-makan') ?>" class="btn-um-back">
                        <i class="bi bi-arrow-left"></i> Kembali ke Daftar
                    </a>
                    <a href="<?= base_url('uang-makan/edit/' . $um['id']) ?>" class="btn-um-edit">
                        <i class="bi bi-pencil"></i> Edit Data
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>