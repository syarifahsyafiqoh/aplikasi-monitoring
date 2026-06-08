<?= $this->extend('layout/sidebar') ?>
<?= $this->section('content') ?>

<link href="<?= base_url('assets/css/perjalanan_dinas/detail.css') ?>" rel="stylesheet">

<div class="row justify-content-center">
    <div class="col-lg-9">

        <!-- Page Header -->
        <div class="detail-page-header">
            <div class="detail-page-header-icon">
                <i class="bi bi-airplane-engines"></i>
            </div>
            <div class="detail-page-header-text">
                <h4>Detail Perjalanan Dinas</h4>
                <p>Informasi lengkap data perjalanan dinas</p>
            </div>
        </div>

        <!-- Main Card -->
        <div class="detail-main-card">

            <!-- Identitas -->
            <div class="detail-section-head">
                <i class="bi bi-file-earmark-text"></i> Identitas Surat
            </div>
            <div class="detail-card-body">
                <div class="row g-3 mb-3">
                    <div class="col-md-6 d-flex">
                        <div class="detail-field w-100">
                            <div class="detail-field-label">
                                <i class="bi bi-hash"></i> No Surat Tugas
                            </div>
                            <p class="detail-field-value"><?= esc($pd['no_surat_tugas'] ?? '-') ?></p>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex">
                        <div class="detail-field w-100">
                            <div class="detail-field-label">
                                <i class="bi bi-bank"></i> Sumber Dana
                            </div>
                            <p class="detail-field-value">
                                <?php
                                    $sd = strtolower($pd['sumber_dana'] ?? '');
                                    $badgeClass = ($sd === 'atas') ? 'pd-badge-primary' : 'pd-badge-info';
                                ?>
                                <span class="pd-badge <?= $badgeClass ?>">
                                    <?= strtoupper(esc($pd['sumber_dana'] ?? '-')) ?>
                                </span>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-6 d-flex">
                        <div class="detail-field w-100">
                            <div class="detail-field-label">
                                <i class="bi bi-diagram-3"></i> Seksi
                            </div>
                            <p class="detail-field-value">
                                <?php if (!empty($pd['seksi'])): ?>
                                    <span class="pd-seksi-badge"><?= esc($pd['seksi']) ?></span>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex">
                        <div class="detail-field w-100">
                            <div class="detail-field-label">
                                <i class="bi bi-layers"></i> Posisi No Akun
                            </div>
                            <p class="detail-field-value"><?= ucfirst(esc($pd['posisi_no_akun'] ?? '-')) ?></p>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="detail-field">
                            <div class="detail-field-label">
                                <i class="bi bi-upc-scan"></i> No Akun
                            </div>
                            <p class="detail-field-value">
                                <?php if (!empty($pd['no_akun'])): ?>
                                    <span class="pd-akun-badge"><?= esc($pd['no_akun']) ?></span>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Uraian -->
            <div class="detail-section-head">
                <i class="bi bi-card-text"></i> Uraian Tugas
            </div>
            <div class="detail-card-body">
                <div class="detail-field">
                    <div class="detail-field-label">
                        <i class="bi bi-justify-left"></i> Uraian
                    </div>
                    <p class="detail-field-value"><?= nl2br(esc($pd['uraian'] ?? '-')) ?></p>
                </div>
            </div>

            <!-- Rincian Biaya -->
            <div class="detail-section-head">
                <i class="bi bi-cash-coin"></i> Rincian Biaya
            </div>
            <div class="detail-card-body">
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <div class="detail-field detail-field-currency">
                            <div class="detail-field-label">
                                <i class="bi bi-sun"></i> Harian Perjalanan
                            </div>
                            <p class="detail-field-value">
                                Rp <?= number_format($pd['harian_perjalanan'] ?? 0, 0, ',', '.') ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="detail-field detail-field-currency">
                            <div class="detail-field-label">
                                <i class="bi bi-building"></i> Penginapan
                            </div>
                            <p class="detail-field-value">
                                Rp <?= number_format($pd['penginapan'] ?? 0, 0, ',', '.') ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="detail-field detail-field-currency">
                            <div class="detail-field-label">
                                <i class="bi bi-truck"></i> Transport
                            </div>
                            <p class="detail-field-value">
                                Rp <?= number_format($pd['transport'] ?? 0, 0, ',', '.') ?>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Total Box -->
                <div class="detail-total-box">
                    <div class="detail-total-box-label">
                        <i class="bi bi-calculator"></i>
                        Total Biaya Perjalanan Dinas
                    </div>
                    <div class="detail-total-box-value">
                        Rp <?= number_format(
                            ($pd['harian_perjalanan'] ?? 0) +
                            ($pd['penginapan']        ?? 0) +
                            ($pd['transport']         ?? 0),
                            0, ',', '.'
                        ) ?>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="detail-actions">
                    <a href="<?= base_url('perjalanan-dinas') ?>" class="btn-detail-back">
                        <i class="bi bi-arrow-left"></i> Kembali ke Daftar
                    </a>
                    <a href="<?= base_url('perjalanan-dinas/edit/' . $pd['id']) ?>" class="btn-detail-edit">
                        <i class="bi bi-pencil"></i> Edit Data
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>