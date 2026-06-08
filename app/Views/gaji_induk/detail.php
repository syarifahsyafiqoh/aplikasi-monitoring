<?= $this->extend('layout/sidebar') ?>
<?= $this->section('content') ?>

<link href="<?= base_url('assets/css/gaji_induk/detail-edit.css') ?>" rel="stylesheet">

<div class="row justify-content-center">
    <div class="col-lg-9">

        <!-- Page Header -->
        <div class="gi-page-header">
            <div class="gi-page-header-icon">
                <i class="bi bi-cash-stack"></i>
            </div>
            <div class="gi-page-header-text">
                <h4>Detail Gaji Induk</h4>
                <p>Informasi lengkap data gaji induk</p>
            </div>
        </div>

        <!-- Main Card -->
        <div class="gi-main-card">

            <!-- Identitas -->
            <div class="gi-section-head">
                <i class="bi bi-file-earmark-text"></i> Informasi Dasar
            </div>
            <div class="gi-card-body">
                <div class="row g-3 mb-3">
                    <div class="col-12">
                        <div class="gi-field">
                            <div class="gi-field-label">
                                <i class="bi bi-card-text"></i> Uraian
                            </div>
                            <p class="gi-field-value"><?= nl2br(esc($gi['uraian'] ?? '-')) ?></p>
                        </div>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="gi-field">
                            <div class="gi-field-label">
                                <i class="bi bi-upc-scan"></i> No Akun
                            </div>
                            <p class="gi-field-value">
                                <?php if (!empty($gi['no_akun'])): ?>
                                    <span class="gi-akun-badge"><?= esc($gi['no_akun']) ?></span>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="gi-field">
                            <div class="gi-field-label">
                                <i class="bi bi-diagram-3"></i> Seksi
                            </div>
                            <p class="gi-field-value">
                                <?php if (!empty($gi['seksi'])): ?>
                                    <span class="gi-seksi-badge"><?= esc($gi['seksi']) ?></span>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rincian Keuangan -->
            <div class="gi-section-head">
                <i class="bi bi-cash-coin"></i> Rincian Keuangan
            </div>
            <div class="gi-card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="gi-field gi-field-bruto">
                            <div class="gi-field-label">
                                <i class="bi bi-coin"></i> Total Bruto
                            </div>
                            <p class="gi-field-value">
                                Rp <?= number_format($gi['total_bruto'] ?? 0, 0, ',', '.') ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="gi-field gi-field-netto">
                            <div class="gi-field-label">
                                <i class="bi bi-wallet2"></i> Total Netto
                            </div>
                            <p class="gi-field-value">
                                Rp <?= number_format($gi['total_netto'] ?? 0, 0, ',', '.') ?>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="gi-actions">
                    <a href="<?= base_url('gaji-induk') ?>" class="btn-gi-back">
                        <i class="bi bi-arrow-left"></i> Kembali ke Daftar
                    </a>
                    <a href="<?= base_url('gaji-induk/edit/' . $gi['id']) ?>" class="btn-gi-edit">
                        <i class="bi bi-pencil"></i> Edit Data
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>