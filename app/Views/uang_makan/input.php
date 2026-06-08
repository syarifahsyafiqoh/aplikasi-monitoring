<?= $this->extend('layout/sidebar') ?>
<?= $this->section('content') ?>

<link href="<?= base_url('assets/css/uang_makan/input.css') ?>" rel="stylesheet">

<!-- Page Header -->
<div class="page-header-form">
    <div class="header-icon">
        <i class="bi bi-cup-hot"></i>
    </div>
    <div class="header-content">
        <h3 class="header-title">Input Uang Makan</h3>
        <p class="header-subtitle">Lengkapi formulir di bawah ini dengan data yang benar</p>
    </div>
</div>

<!-- Form Card -->
<div class="form-container">
    <div class="form-card">
        <?php helper('form'); ?>
        <?= form_open('uang-makan/simpan', ['id' => 'formUangMakan', 'class' => 'needs-validation', 'novalidate' => true]) ?>

        <!-- Uraian -->
        <div class="form-group">
            <label class="form-label">
                Uraian <span class="required">*</span>
            </label>
            <textarea name="uraian" 
                      class="form-control" 
                      rows="4" 
                      placeholder="Deskripsikan uraian uang makan..." 
                      required></textarea>
            <div class="invalid-feedback">Uraian wajib diisi!</div>
        </div>

        <!-- No Akun -->
        <div class="form-group">
            <label class="form-label">
                No Akun <span class="required">*</span>
            </label>
            <input type="text" 
                   name="no_akun" 
                   class="form-control" 
                   placeholder="Contoh: 5231101"
                   required>
            <div class="invalid-feedback">No Akun wajib diisi!</div>
        </div>

        <!-- Total Bruto dan Netto -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">
                    Total Uang Bruto <span class="required">*</span>
                </label>
                <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input type="number" 
                           name="total_bruto" 
                           id="bruto" 
                           class="form-control" 
                           value="0" 
                           min="0"
                           required>
                </div>
                <small class="form-text" id="bruto-text">Rp 0</small>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">
                    Total Uang Netto <span class="required">*</span>
                </label>
                <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input type="number" 
                           name="total_netto" 
                           id="netto" 
                           class="form-control" 
                           value="0" 
                           min="0"
                           required>
                </div>
                <small class="form-text" id="netto-text">Rp 0</small>
            </div>
        </div>

        <!-- Seksi -->
        <div class="form-group">
            <label class="form-label">
                Seksi <span class="required">*</span>
            </label>
            <input type="text" 
                   name="seksi" 
                   class="form-control" 
                   placeholder="Contoh: Seksi Perencanaan / TU / dll"
                   required>
            <div class="invalid-feedback">Seksi wajib diisi!</div>
        </div>

        <!-- Tombol -->
        <div class="form-actions">
            <a href="<?= base_url('uang-makan') ?>" class="btn-cancel">
                <i class="bi bi-x-circle"></i>
                <span>Batal</span>
            </a>
            <button type="submit" class="btn-submit">
                <i class="bi bi-check-circle"></i>
                <span>Simpan Data</span>
            </button>
        </div>

        <?= form_close() ?>
    </div>
</div>

<script src="<?= base_url('assets/js/uang_makan/input.js') ?>"></script>

<?= $this->endSection() ?>