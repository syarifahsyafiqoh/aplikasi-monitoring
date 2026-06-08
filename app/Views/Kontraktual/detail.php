<?= $this->extend('layout/sidebar') ?>
<?= $this->section('content') ?>

<link href="<?= base_url('assets/css/kontraktual/detail.css') ?>" rel="stylesheet">

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow">
            <div class="card-header bg-info text-white text-center py-4">
                <h3 class="mb-0">
                    <i class="bi bi-eye me-3"></i> Detail Kontraktual
                </h3>
            </div>
            <div class="card-body p-5">

                <div class="row g-4">
                    <div class="col-12">
                        <label class="fw-bold text-info">Uraian</label>
                        <p class="form-control-plaintext border p-3 bg-light"><?= esc($kntr['uraian']) ?: '-' ?></p>
                    </div>

                    <div class="col-12">
                        <label class="fw-bold text-info">No Akun</label>
                        <p class="form-control-plaintext border p-3 bg-light"><?= esc($kntr['no_akun']) ?: '-' ?></p>
                    </div>

                    <div class="col-12">
                        <label class="fw-bold text-info">Seksi</label>
                        <p class="form-control-plaintext border p-3 bg-light"><?= esc($kntr['seksi']) ?: '-' ?></p>
                    </div>

                    <div class="col-12">
                        <label class="fw-bold text-info">Total Uang Bruto</label>
                        <p class="form-control-plaintext border p-3 bg-light fs-5 text-primary fw-bold">
                            Rp <?= number_format($kntr['total_uang_bruto'], 0, ',', '.') ?>
                        </p>
                    </div>

                    <div class="col-12">
                        <label class="fw-bold text-info">Total Uang Netto</label>
                        <p class="form-control-plaintext border p-3 bg-light fs-5 text-success fw-bold">
                            Rp <?= number_format($kntr['total_uang_netto'], 0, ',', '.') ?>
                        </p>
                    </div>

                    <div class="col-12">
                        <label class="fw-bold text-info">Pajak</label>
                        <p class="form-control-plaintext border p-3 bg-light fs-5 text-danger fw-bold">
                            Rp <?= number_format($kntr['pajak'], 0, ',', '.') ?>
                        </p>
                    </div>
                </div>

                <div class="mt-5 text-end">
                    <a href="<?= base_url('kontraktual') ?>" class="btn btn-secondary btn-lg px-5">
                        <i class="bi bi-arrow-left me-2"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>