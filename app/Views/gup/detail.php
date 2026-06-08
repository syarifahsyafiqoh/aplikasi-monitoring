<?= $this->extend('layout/sidebar') ?>
<?= $this->section('content') ?>

<link href="<?= base_url('assets/css/gup/gup.css') ?>" rel="stylesheet">

<div class="row justify-content-center">
    <div class="col-lg-8">

        <!-- Page Header -->
        <div class="detail-page-header">
            <h4>
                <i class="bi bi-file-earmark-text"></i>
                Detail GUP / UP / PTUP / TUP
            </h4>
        </div>

        <!-- Detail Card -->
        <div class="detail-card">
            <div class="detail-section-header">
                <h5>
                    <i class="bi bi-list-ul"></i>
                    Informasi Data
                </h5>
            </div>
            <div class="detail-card-body">

                <div class="detail-item">
                    <div class="detail-label">
                        <i class="bi bi-card-text"></i>
                        Uraian
                    </div>
                    <p class="detail-value"><?= nl2br(esc($gup['uraian'])) ?: '-' ?></p>
                </div>

                <div class="detail-item">
                    <div class="detail-label">
                        <i class="bi bi-people"></i>
                        Seksi
                    </div>
                    <p class="detail-value">
                        <?php if (!empty($gup['seksi'])): ?>
                            <span class="seksi-badge"><?= esc($gup['seksi']) ?></span>
                        <?php else: ?>
                            <span class="text-muted">-</span>
                        <?php endif; ?>
                    </p>
                </div>

                <div class="detail-actions">
                    <a href="<?= base_url('gup') ?>" class="btn-form btn-form-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <a href="<?= base_url('gup/edit/' . $gup['id']) ?>" class="btn-form btn-form-warning">
                        <i class="bi bi-pencil"></i> Edit Data
                    </a>
                </div>

            </div>
        </div>

    </div>
</div>

<?= $this->endSection() ?>