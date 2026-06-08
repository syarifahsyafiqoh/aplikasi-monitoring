<?= $this->extend('layout/sidebar') ?>
<?= $this->section('content') ?>

<link href="<?= base_url('assets/css/gaji_induk/detail-edit.css') ?>" rel="stylesheet">

<div class="row justify-content-center">
    <div class="col-lg-9">

        <!-- Page Header -->
        <div class="gi-page-header gi-page-header-edit">
            <div class="gi-page-header-icon">
                <i class="bi bi-pencil-square"></i>
            </div>
            <div class="gi-page-header-text">
                <h4>Edit Gaji Induk</h4>
                <p>Perbarui data gaji induk</p>
            </div>
        </div>

        <!-- Main Card -->
        <div class="gi-main-card">

            <!-- Informasi Dasar -->
            <div class="gi-section-head">
                <i class="bi bi-file-earmark-text"></i> Informasi Dasar
            </div>
            <div class="gi-card-body">

                <?php helper('form'); ?>
                <?= form_open('gaji-induk/update/' . $gi['id'], ['class' => 'needs-validation', 'novalidate' => true]) ?>

                <div class="mb-4">
                    <label class="gi-form-label">
                        Uraian <span class="gi-form-required">*</span>
                    </label>
                    <textarea
                        name="uraian"
                        class="gi-form-textarea"
                        rows="4"
                        required
                        placeholder="Jelaskan detail gaji induk..."
                    ><?= old('uraian', $gi['uraian']) ?></textarea>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="gi-form-label">No Akun</label>
                        <input
                            type="text"
                            name="no_akun"
                            class="gi-form-input"
                            value="<?= old('no_akun', $gi['no_akun']) ?>"
                            placeholder="Contoh: 5211.EBA.994.002.D.524111"
                        >
                    </div>
                    <div class="col-md-6">
                        <label class="gi-form-label">Seksi</label>
                        <input
                            type="text"
                            name="seksi"
                            class="gi-form-input"
                            value="<?= old('seksi', $gi['seksi']) ?>"
                            placeholder="Contoh: TU, PEVDAS, PKDAS..."
                        >
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
                        <label class="gi-form-label">Total Bruto (Rp)</label>
                        <input
                            type="number"
                            name="total_bruto"
                            class="gi-form-input"
                            value="<?= old('total_bruto', $gi['total_bruto']) ?>"
                            placeholder="0"
                            min="0"
                        >
                    </div>
                    <div class="col-md-6">
                        <label class="gi-form-label">Total Netto (Rp)</label>
                        <input
                            type="number"
                            name="total_netto"
                            class="gi-form-input"
                            value="<?= old('total_netto', $gi['total_netto']) ?>"
                            placeholder="0"
                            min="0"
                        >
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="gi-form-actions">
                    <a href="<?= base_url('gaji-induk') ?>" class="btn-gi-cancel">
                        <i class="bi bi-x-circle"></i> Batal
                    </a>
                    <button type="submit" class="btn-gi-submit">
                        <i class="bi bi-save"></i> Update Data
                    </button>
                </div>

                <?= form_close() ?>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>