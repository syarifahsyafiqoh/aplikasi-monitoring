<?= $this->extend('layout/sidebar') ?>
<?= $this->section('content') ?>

<link href="<?= base_url('assets/css/tunjangan_kinerja/detail-edit.css') ?>" rel="stylesheet">

<div class="row justify-content-center">
    <div class="col-lg-9">

        <!-- Page Header -->
        <div class="tk-page-header tk-page-header-edit">
            <div class="tk-page-header-icon">
                <i class="bi bi-pencil-square"></i>
            </div>
            <div class="tk-page-header-text">
                <h4>Edit Tunjangan Kinerja</h4>
                <p>Perbarui data tunjangan kinerja</p>
            </div>
        </div>

        <!-- Main Card -->
        <div class="tk-main-card">

            <!-- Informasi Dasar -->
            <div class="tk-section-head">
                <i class="bi bi-file-earmark-text"></i> Informasi Dasar
            </div>
            <div class="tk-card-body">

                <?php helper('form'); ?>
                <?= form_open('tunjangan-kinerja/update/' . ($tk['id'] ?? ''), ['class' => 'needs-validation', 'novalidate' => true]) ?>

                <div class="mb-4">
                    <label class="tk-form-label">
                        Uraian <span class="tk-form-required">*</span>
                    </label>
                    <textarea
                        name="uraian"
                        class="tk-form-textarea"
                        rows="4"
                        required
                        placeholder="Jelaskan detail tunjangan kinerja..."
                    ><?= old('uraian', $tk['uraian'] ?? '') ?></textarea>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="tk-form-label">No Akun</label>
                        <input
                            type="text"
                            name="no_akun"
                            class="tk-form-input"
                            value="<?= old('no_akun', $tk['no_akun'] ?? '') ?>"
                            placeholder="Contoh: 5211.EBA.994.002.D.524111"
                        >
                    </div>
                    <div class="col-md-6">
                        <label class="tk-form-label">Seksi</label>
                        <input
                            type="text"
                            name="seksi"
                            class="tk-form-input"
                            value="<?= old('seksi', $tk['seksi'] ?? '') ?>"
                            placeholder="Contoh: TU, PEVDAS, PKDAS..."
                        >
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
                        <label class="tk-form-label">Total Bruto (Rp)</label>
                        <input
                            type="number"
                            name="total_bruto"
                            class="tk-form-input"
                            value="<?= old('total_bruto', $tk['total_bruto'] ?? 0) ?>"
                            placeholder="0"
                            min="0"
                        >
                    </div>
                    <div class="col-md-6">
                        <label class="tk-form-label">Total Netto (Rp)</label>
                        <input
                            type="number"
                            name="total_netto"
                            class="tk-form-input"
                            value="<?= old('total_netto', $tk['total_netto'] ?? 0) ?>"
                            placeholder="0"
                            min="0"
                        >
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="tk-form-actions">
                    <a href="<?= base_url('tunjangan-kinerja') ?>" class="btn-tk-cancel">
                        <i class="bi bi-x-circle"></i> Batal
                    </a>
                    <button type="submit" class="btn-tk-submit">
                        <i class="bi bi-save"></i> Update Data
                    </button>
                </div>

                <?= form_close() ?>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>