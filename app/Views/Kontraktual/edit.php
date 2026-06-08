<?= $this->extend('layout/sidebar') ?>
<?= $this->section('content') ?>

<link href="<?= base_url('assets/css/kontraktual/edit.css') ?>" rel="stylesheet">

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow">
            <div class="card-header bg-warning text-dark text-center py-4">
                <h3 class="mb-0">
                    <i class="bi bi-pencil-square me-2"></i> Edit Kontraktual
                </h3>
            </div>
            <div class="card-body p-5">

                <?php helper('form'); ?>
                <?= form_open('kontraktual/update/' . $kntr['id'], ['class' => 'needs-validation', 'novalidate' => true]) ?>

                <div class="mb-4">
                    <label class="form-label fw-bold">Uraian <span class="text-danger">*</span></label>
                    <textarea name="uraian" class="form-control" rows="4" placeholder="Masukkan uraian kontraktual" required><?= old('uraian', $kntr['uraian']) ?></textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">No Akun</label>
                    <input type="text" name="no_akun" class="form-control form-control-lg" value="<?= old('no_akun', $kntr['no_akun']) ?>" placeholder="Contoh: 5231101">
                </div>

                <div class="row g-4">
                    <div class="col-md-4">
                        <label class="fw-bold">Total Uang Bruto (Rp)</label>
                        <input type="number" name="total_uang_bruto" class="form-control form-control-lg" value="<?= old('total_uang_bruto', $kntr['total_uang_bruto']) ?>" min="0" placeholder="0">
                    </div>
                    <div class="col-md-4">
                        <label class="fw-bold">Total Uang Netto (Rp)</label>
                        <input type="number" name="total_uang_netto" class="form-control form-control-lg" value="<?= old('total_uang_netto', $kntr['total_uang_netto']) ?>" min="0" placeholder="0">
                    </div>
                    <div class="col-md-4">
                        <label class="fw-bold">Pajak (Rp)</label>
                        <input type="number" name="pajak" class="form-control form-control-lg" value="<?= old('pajak', $kntr['pajak']) ?>" min="0" placeholder="0">
                    </div>
                </div>

                <div class="mb-5 mt-4">
                    <label class="fw-bold">Seksi</label>
                    <select name="seksi" class="form-control form-control-lg" required>
                        <option value="">-- Pilih Seksi --</option>
                        <option value="TU" <?= old('seksi', $kntr['seksi']) === 'TU' ? 'selected' : '' ?>>TU</option>
                        <option value="PKDAS" <?= old('seksi', $kntr['seksi']) === 'PKDAS' ? 'selected' : '' ?>>PKDAS</option>
                        <option value="PEVDAS" <?= old('seksi', $kntr['seksi']) === 'PEVDAS' ? 'selected' : '' ?>>PEVDAS</option>
                        <option value="RHL" <?= old('seksi', $kntr['seksi']) === 'RHL' ? 'selected' : '' ?>>RHL</option>
                    </select>
                </div>

                <div class="d-flex justify-content-end gap-3">
                    <a href="<?= base_url('kontraktual') ?>" class="btn btn-outline-secondary btn-lg px-5">
                        <i class="bi bi-x-circle"></i>
                        Batal
                    </a>
                    <button type="submit" class="btn btn-warning btn-lg px-5">
                        <i class="bi bi-save me-2"></i> Update Data
                    </button>
                </div>

                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>