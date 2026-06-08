<?= $this->extend('layout/sidebar') ?>
<?= $this->section('content') ?>

<link href="<?= base_url('assets/css/perjalanan_dinas/edit.css') ?>" rel="stylesheet">

<div class="row justify-content-center">
    <div class="col-lg-8 col-xl-7">
        <div class="card border-0 shadow-lg">
            <div class="card-header bg-warning text-dark text-center py-4">
                <h3 class="mb-0">
                    <i class="bi bi-pencil-square me-3"></i>
                    Edit Perjalanan Dinas
                </h3>
            </div>

            <div class="card-body p-4 p-lg-5">

                <?php helper('form'); ?>
                <?= form_open('perjalanan-dinas/update/' . $pd['id'], ['class' => 'needs-validation', 'novalidate' => true]) ?>  <!-- Ubah $pd->id jadi $pd['id'] -->

                <!-- No Surat Tugas -->
                <div class="mb-4">
                    <label class="form-label fw-bold text-success">No Surat Tugas</label>
                    <input type="text" 
                           name="no_surat_tugas" 
                           class="form-control form-control-lg" 
                           value="<?= old('no_surat_tugas', $pd['no_surat_tugas'] ?? '') ?>"  
                           required>
                    <div class="invalid-feedback">Wajib diisi!</div>
                </div>

                <!-- Uraian -->
                <div class="mb-4">
                    <label class="fw-bold text-success">Uraian Tugas</label>
                    <textarea name="uraian" class="form-control" rows="4" required><?= old('uraian', $pd['uraian'] ?? '') ?></textarea>  <!-- Ubah $pd->uraian jadi $pd['uraian'] -->
                    <div class="invalid-feedback">Wajib diisi!</div>
                </div>

                <!-- No Akun -->
                <div class="mb-4">
                    <label class="fw-bold text-success">No Akun</label>
                    <input type="text" name="no_akun" class="form-control" value="<?= old('no_akun', $pd['no_akun'] ?? '') ?>" required>  <!-- Ubah $pd->no_akun jadi $pd['no_akun'] -->
                    <div class="invalid-feedback">Wajib diisi!</div>
                </div>

                <!-- Sumber Dana -->
                <div class="mb-4">
                    <label class="fw-bold text-success">Sumber Dana</label>
                    <select name="sumber_dana" class="form-select" required>
                        <option value="">Pilih Sumber Dana</option>
                        <option value="RM" <?= old('sumber_dana', $pd['sumber_dana'] ?? '') === 'RM' ? 'selected' : '' ?>>RM</option>
                        <option value="PNP" <?= old('sumber_dana', $pd['sumber_dana'] ?? '') === 'PNP' ? 'selected' : '' ?>>PNP</option>
                    </select>
                    <div class="invalid-feedback">Pilih salah satu!</div>
                </div>

                <!-- Posisi No Akun -->
                <div class="mb-4">
                    <label class="fw-bold text-success">Posisi No Akun</label>
                    <div class="d-flex gap-4">
                        <div class="form-check">
                            <input type="radio" name="posisi_no_akun" value="atas" class="form-check-input" <?= old('posisi_no_akun', $pd['posisi_no_akun'] ?? '') === 'atas' ? 'checked' : '' ?> required>
                            <label class="form-check-label">Atas</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="posisi_no_akun" value="bawah" class="form-check-input" <?= old('posisi_no_akun', $pd['posisi_no_akun'] ?? '') === 'bawah' ? 'checked' : '' ?> required>
                            <label class="form-check-label">Bawah</label>
                        </div>
                    </div>
                    <div class="invalid-feedback">Pilih salah satu!</div>
                </div>

                <!-- Harian Perjalanan -->
                <div class="mb-4">
                    <label class="fw-bold text-success">Harian Perjalanan</label>
                    <input type="number" name="harian_perjalanan" class="form-control" value="<?= old('harian_perjalanan', $pd['harian_perjalanan'] ?? 0) ?>" required>
                    <div class="invalid-feedback">Wajib diisi!</div>
                </div>

                <!-- Penginapan -->
                <div class="mb-4">
                    <label class="fw-bold text-success">Penginapan</label>
                    <input type="number" name="penginapan" class="form-control" value="<?= old('penginapan', $pd['penginapan'] ?? 0) ?>" required>
                    <div class="invalid-feedback">Wajib diisi!</div>
                </div>

                <!-- Transport -->
                <div class="mb-4">
                    <label class="fw-bold text-success">Transport</label>
                    <input type="number" name="transport" class="form-control" value="<?= old('transport', $pd['transport'] ?? 0) ?>" required>
                    <div class="invalid-feedback">Wajib diisi!</div>
                </div>

                <!-- Seksi -->
                <div class="mb-4">
                    <label class="fw-bold text-success">Seksi</label>
                    <select name="seksi" class="form-select" required>
                        <option value="">Pilih Seksi</option>
                        <option value="TU" <?= old('seksi', $pd['seksi'] ?? '') === 'TU' ? 'selected' : '' ?>>TU</option>
                        <option value="PKDAS" <?= old('seksi', $pd['seksi'] ?? '') === 'PKDAS' ? 'selected' : '' ?>>PKDAS</option>
                        <option value="PEVDAS" <?= old('seksi', $pd['seksi'] ?? '') === 'PEVDAS' ? 'selected' : '' ?>>PEVDAS</option>
                        <option value="RHL" <?= old('seksi', $pd['seksi'] ?? '') === 'RHL' ? 'selected' : '' ?>>RHL</option>
                    </select>
                    <div class="invalid-feedback">Pilih salah satu!</div>
                </div>

                <!-- Tombol -->
                <div class="d-flex flex-column flex-md-row gap-3 justify-content-end">
                    <a href="<?= base_url('perjalanan-dinas') ?>" 
                       class="btn btn-outline-secondary btn-lg px-5">
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