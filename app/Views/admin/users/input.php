<?= $this->extend('layout/sidebar') ?>
<?= $this->section('content') ?>

<link href="<?= base_url('assets/css/admin/user/input.css') ?>" rel="stylesheet">

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card border-0 shadow">
            <div class="card-header bg-primary text-white text-center">
                <h4>Tambah User Baru</h4>
            </div>
            <div class="card-body">

                <?php helper('form'); ?>
                <?= form_open('kelola-user/simpan') ?>

                <div class="mb-3">
                    <label class="form-label fw-bold">Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Role</label>
                    <select name="role" class="form-select" required>
                        <option value="">Pilih Role</option>
                        <option value="operator">Operator</option>
                        <option value="bendahara">Bendahara</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <div class="d-flex justify-content-end gap-3">
                    <a href="<?= base_url('kelola-user') ?>" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i>
                        <span>Batal</span>
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i>
                        <span>Simpan User</span>
                    </button>
                </div>

                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>