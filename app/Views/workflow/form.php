<?= $this->extend('layout/sidebar') ?>
<?= $this->section('content') ?>
<?php $workflow = $workflow ?? []; ?>

<h2><?= !empty($workflow) ? 'Edit' : 'Tambah' ?> Workflow Approval</h2>

<?= form_open('workflow/save') ?>
    <?= csrf_field() ?>
    <input type="hidden" name="id" value="<?= $workflow['id'] ?? '' ?>">

    <div class="mb-3">
        <label class="form-label">Nama Workflow</label>
        <input type="text" name="nama_workflow" class="form-control" value="<?= old('nama_workflow', $workflow['nama_workflow'] ?? '') ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Jenis Modul</label>
        <select name="jenis_modul" class="form-select" required>
            <option value="">Pilih Jenis Modul</option>
            <option value="perjalanan_dinas" <?= old('jenis_modul', $workflow['jenis_modul'] ?? '') == 'perjalanan_dinas' ? 'selected' : '' ?>>Perjalanan Dinas</option>
            <option value="gaji_induk" <?= old('jenis_modul', $workflow['jenis_modul'] ?? '') == 'gaji_induk' ? 'selected' : '' ?>>Gaji Induk</option>
            <option value="tunjangan_kinerja" <?= old('jenis_modul', $workflow['jenis_modul'] ?? '') == 'tunjangan_kinerja' ? 'selected' : '' ?>>Tunjangan Kinerja</option>
            <option value="uang_makan" <?= old('jenis_modul', $workflow['jenis_modul'] ?? '') == 'uang_makan' ? 'selected' : '' ?>>Uang Makan</option>
            <option value="honorarium" <?= old('jenis_modul', $workflow['jenis_modul'] ?? '') == 'honorarium' ? 'selected' : '' ?>>Honorarium</option>
            <option value="kontraktual" <?= old('jenis_modul', $workflow['jenis_modul'] ?? '') == 'kontraktual' ? 'selected' : '' ?>>Kontraktual</option>
            <option value="gup" <?= old('jenis_modul', $workflow['jenis_modul'] ?? '') == 'gup' ? 'selected' : '' ?>>GUP</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="is_active" class="form-select">
            <option value="1" <?= old('is_active', $workflow['is_active'] ?? 1) == 1 ? 'selected' : '' ?>>Aktif</option>
            <option value="0" <?= old('is_active', $workflow['is_active'] ?? 1) == 0 ? 'selected' : '' ?>>Non Aktif</option>
        </select>
    </div>

    <hr>
    <h5>Urutan Approval</h5>
    <div id="steps-container">
        <!-- Steps akan ditambahkan via JS -->
    </div>

    <button type="button" class="btn btn-secondary" onclick="tambahStep()">+ Tambah Langkah Approval</button>

    <div class="mt-4">
        <button type="submit" class="btn btn-primary">Simpan Workflow</button>
        <a href="<?= base_url('workflow') ?>" class="btn btn-secondary">Batal</a>
    </div>
<?= form_close() ?>

<script>
let stepCount = <?= count($steps ?? []) ?> || 0;

function tambahStep() {
    stepCount++;
    const container = document.getElementById('steps-container');
    
    const div = document.createElement('div');
    div.className = 'input-group mb-2';
    div.innerHTML = `
        <span class="input-group-text">Langkah ${stepCount}</span>
        <select name="role[]" class="form-select">
            <option value="operator">Operator</option>
            <option value="bendahara">Bendahara</option>
            <option value="kepala_balai">Kepala Balai</option>
        </select>
        <button type="button" class="btn btn-danger" onclick="this.parentElement.remove()">Hapus</button>
    `;
    container.appendChild(div);
}

// Load existing steps jika edit
<?php if (!empty($steps)): ?>
    window.onload = function() {
        <?php foreach ($steps as $step): ?>
            stepCount++;
            const container = document.getElementById('steps-container');
            const div = document.createElement('div');
            div.className = 'input-group mb-2';
            div.innerHTML = `
                <span class="input-group-text">Langkah ${stepCount}</span>
                <select name="role[]" class="form-select">
                    <option value="operator" <?= $step['role']=='operator'?'selected':'' ?>>Operator</option>
                    <option value="bendahara" <?= $step['role']=='bendahara'?'selected':'' ?>>Bendahara</option>
                    <option value="kepala_balai" <?= $step['role']=='kepala_balai'?'selected':'' ?>>Kepala Balai</option>
                </select>
                <button type="button" class="btn btn-danger" onclick="this.parentElement.remove()">Hapus</button>
            `;
            container.appendChild(div);
        <?php endforeach; ?>
    };
<?php endif; ?>
</script>

<?= $this->endSection() ?>