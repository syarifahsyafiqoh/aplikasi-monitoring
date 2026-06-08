<?= $this->extend('layout/sidebar') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Rekap Jumlah Berkas per Status</h4>
    <a href="<?= current_url() ?>?print=1" target="_blank" class="btn btn-primary">
        <i class="bi bi-printer me-2"></i> Cetak Laporan
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rekap_status as $rs): ?>
                    <tr>
                        <td><?= ucfirst(str_replace('_', ' ', $rs['status'])) ?></td>
                        <td><?= number_format($rs['jumlah']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>