<?= $this->extend('layout/sidebar') ?>
<?= $this->section('content') ?>

<link href="<?= base_url('assets/css/perjalanan_dinas/input.css') ?>" rel="stylesheet">

<!-- Page Header -->
<div class="page-header-form">
    <div class="header-icon">
        <i class="bi bi-airplane-engines-fill"></i>
    </div>
    <div class="header-content">
        <h3 class="header-title">Input Perjalanan Dinas</h3>
        <p class="header-subtitle">Lengkapi formulir di bawah ini dengan data yang benar</p>
    </div>
</div>

<!-- Form Card -->
<div class="form-container">
    <div class="form-card">
        <?php helper('form'); ?>
        <?= form_open('perjalanan-dinas/simpan', ['id' => 'formPerjalananDinas', 'class' => 'needs-validation', 'novalidate' => true]) ?>

        <!-- No Surat Tugas -->
        <div class="form-group">
            <label class="form-label">
                No Surat Tugas <span class="required">*</span>
            </label>
            <input type="text" 
                   name="no_surat_tugas" 
                   class="form-control" 
                   placeholder="Contoh: 001/SPT/PD/XII/2025" 
                   required>
            <div class="invalid-feedback">Wajib diisi!</div>
        </div>

        <!-- Sumber Dana -->
        <div class="form-group">
            <label class="form-label">
                Sumber Dana <span class="required">*</span>
            </label>
            <select name="sumber_dana" class="form-select" required>
                <option value="">-- Pilih Sumber Dana --</option>
                <option value="RM"  {{ old('sumber_dana') === 'RM' ? 'selected' : '' }}>RM</option>
                <option value="PNP" {{ old('sumber_dana') === 'PNP' ? 'selected' : '' }}>PNP</option>
            </select>
            <div class="invalid-feedback">Pilih salah satu!</div>
        </div>

        <!-- Posisi No Akun -->
        <div class="mb-4">
            <label class="form-label fw-bold text-secondary">Posisi No Akun</label>
            <div class="d-flex gap-4">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="posisi_no_akun" id="atas" value="atas" <?= old('posisi_no_akun') === 'atas' ? 'checked' : '' ?> required>
                    <label class="form-check-label" for="atas">Atas</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="posisi_no_akun" id="bawah" value="bawah" <?= old('posisi_no_akun') === 'bawah' ? 'checked' : '' ?> required>
                    <label class="form-check-label" for="bawah">Bawah</label>
                </div>
            </div>
            <div class="invalid-feedback">Pilih salah satu!</div>
        </div>

        <!-- Uraian Tugas -->
        <div class="form-group">
            <label class="form-label">
                Uraian Tugas <span class="required">*</span>
            </label>
            <textarea name="uraian" 
                      class="form-control" 
                      rows="5" 
                      placeholder="Tujuan perjalanan, lokasi, durasi, kegiatan..." 
                      required></textarea>
            <div class="invalid-feedback">Wajib diisi!</div>
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
            <div class="invalid-feedback">Wajib diisi!</div>
        </div>

        <!-- Harian Perjalanan -->
        <div class="form-group">
            <label class="form-label">
                Total Harian Perjalanan (Rp) <span class="required">*</span>
            </label>
            <div class="input-group">
                <span class="input-group-text">Rp</span>
                <input type="number" 
                       name="harian_perjalanan" 
                       id="harian" 
                       class="form-control" 
                       value="0" 
                       min="0">
            </div>
            <small class="form-text" id="harian-text">Rp </small>
        </div>

        <!-- Penginapan -->
        <div class="form-group">
            <label class="form-label">
                Total Penginapan (Rp) <span class="required">*</span>
            </label>
            <div class="input-group">
                <span class="input-group-text">Rp</span>
                <input type="number" 
                       name="penginapan" 
                       id="penginapan" 
                       class="form-control" 
                       value="0" 
                       min="0">
            </div>
            <small class="form-text" id="penginapan-text">Rp </small>
        </div>

        <!-- Transport -->
        <div class="form-group">
            <label class="form-label">
                Total Transport (Rp) <span class="required">*</span>
            </label>
            <div class="input-group">
                <span class="input-group-text">Rp</span>
                <input type="number" 
                       name="transport" 
                       id="transport" 
                       class="form-control" 
                       value="0" 
                       min="0">
            </div>
            <small class="form-text" id="transport-text">Rp </small>
        </div>

        <div class="form-group">
            <label class="form-label">
                Seksi <span class="required">*</span>
            </label>
            <select name="seksi" class="form-select" required>
                <option value="">-- Pilih Seksi --</option>
                <option value="TU">TU</option>
                <option value="PKDAS">PKDAS</option>
                <option value="PEVDAS">PEVDAS</option>
                <option value="RHL">RHL</option>
            </select>
            <div class="invalid-feedback">Pilih salah satu!</div>
        </div>

        <!-- Total Biaya -->
        <div class="total-box">
            <div class="total-label">Total Biaya Keseluruhan:</div>
            <div class="total-value" id="total-biaya">Rp </div>
        </div>

        <!-- Tombol -->
        <div class="form-actions">
            <a href="<?= base_url('perjalanan-dinas') ?>" class="btn-cancel">
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

<script src="<?= base_url('assets/js/perjalanan_dinas/input.js') ?>"></script>

<?= $this->endSection() ?>