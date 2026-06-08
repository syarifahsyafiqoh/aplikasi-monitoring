<?= $this->extend('layout/sidebar') ?>
<?= $this->section('content') ?>

<link href="<?= base_url('assets/css/gup/gup.css') ?>" rel="stylesheet">

<div class="row justify-content-center">
    <div class="col-lg-8">

        <!-- Page Header -->
        <div class="form-page-header">
            <h4>
                <i class="bi bi-plus-circle"></i>
                Input GUP / UP / PTUP / TUP
            </h4>
            <p>Tambah data baru GUP, UP, PTUP, atau TUP</p>
        </div>

        <!-- Form Card -->
        <div class="form-card">
            <div class="form-card-body">

                <?php helper('form'); ?>
                <?= form_open('gup/simpan', ['class' => 'needs-validation', 'novalidate' => true]) ?>

                <div class="mb-4">
                    <label class="form-section-label">
                        Uraian <span class="form-required">*</span>
                    </label>
                    <textarea
                        name="uraian"
                        class="form-textarea-custom"
                        rows="6"
                        required
                        placeholder="Jelaskan detail GUP, UP, PTUP, TUP..."
                    ></textarea>
                </div>

                <div class="mb-2">
                    <label class="form-section-label">Seksi</label>
                    <input
                        type="text"
                        name="seksi"
                        class="form-input-custom"
                        placeholder="Contoh: TU, PEVDAS, PKDAS, RHL..."
                    >
                </div>

                <div class="form-actions">
                    <a href="<?= base_url('gup') ?>" class="btn-form btn-form-secondary">
                        <i class="bi bi-arrow-left"></i> Batal
                    </a>
                    <button type="submit" class="btn-form btn-form-primary">
                        <i class="bi bi-save"></i> Simpan Data
                    </button>
                </div>

                <?= form_close() ?>
            </div>
        </div>

    </div>
</div>

<?= $this->endSection() ?>