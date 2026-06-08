<?= $this->extend('layout/sidebar') ?>
<?= $this->section('content') ?>

<link href="<?= base_url('assets/css/honorarium/detail-edit.css') ?>" rel="stylesheet">

<div class="row justify-content-center">
    <div class="col-lg-9">

        <!-- Page Header -->
        <div class="hon-page-header">
            <div class="hon-page-header-icon">
                <i class="bi bi-award"></i>
            </div>
            <div class="hon-page-header-text">
                <h4>Detail Honorarium</h4>
                <p>Informasi lengkap data honorarium</p>
            </div>
        </div>

        <!-- Main Card -->
        <div class="hon-main-card">

            <!-- Informasi Dasar -->
            <div class="hon-section-head">
                <i class="bi bi-file-earmark-text"></i> Informasi Dasar
            </div>
            <div class="hon-card-body">
                <div class="row g-3 mb-3">
                    <div class="col-12">
                        <div class="hon-field">
                            <div class="hon-field-label">
                                <i class="bi bi-card-text"></i> Uraian
                            </div>
                            <p class="hon-field-value"><?= esc($hon['uraian'] ?? '-') ?></p>
                        </div>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="hon-field">
                            <div class="hon-field-label">
                                <i class="bi bi-upc-scan"></i> No Akun
                            </div>
                            <p class="hon-field-value">
                                <?php if (!empty($hon['no_akun'])): ?>
                                    <span class="hon-akun-badge"><?= esc($hon['no_akun']) ?></span>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="hon-field">
                            <div class="hon-field-label">
                                <i class="bi bi-diagram-3"></i> Seksi
                            </div>
                            <p class="hon-field-value">
                                <?php if (!empty($hon['seksi'])): ?>
                                    <span class="hon-seksi-badge"><?= esc($hon['seksi']) ?></span>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rincian Keuangan -->
            <div class="hon-section-head">
                <i class="bi bi-cash-coin"></i> Rincian Keuangan
            </div>
            <div class="hon-card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="hon-field hon-field-bruto">
                            <div class="hon-field-label">
                                <i class="bi bi-coin"></i> Total Bruto
                            </div>
                            <p class="hon-field-value">
                                Rp <?= number_format($hon['total_bruto'] ?? 0, 0, ',', '.') ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="hon-field hon-field-netto">
                            <div class="hon-field-label">
                                <i class="bi bi-wallet2"></i> Total Netto
                            </div>
                            <p class="hon-field-value">
                                Rp <?= number_format($hon['total_netto'] ?? 0, 0, ',', '.') ?>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="hon-actions">
                    <a href="<?= base_url('honorarium') ?>" class="btn-hon-back">
                        <i class="bi bi-arrow-left"></i> Kembali ke Daftar
                    </a>
                    <a href="<?= base_url('honorarium/edit/' . $hon['id']) ?>" class="btn-hon-edit">
                        <i class="bi bi-pencil"></i> Edit Data
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>