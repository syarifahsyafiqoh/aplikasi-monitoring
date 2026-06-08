<?= $this->extend('layout/sidebar') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Rekap Berkas per Seksi</h4>
    <!-- <a href="<?= base_url('laporan-operator/export?type=rekap_per_seksi') ?>" class="btn btn-sm btn-success">
        <i class="bi bi-file-earmark-pdf"></i> Export PDF
    </a> -->
    <a href="<?= current_url() ?>?print=1" target="_blank" class="btn btn-primary">
        <i class="bi bi-printer me-2"></i> Cetak Laporan
    </a>
</div>

<!-- <div class="mb-4 text-end no-print">
    <a href="<?= current_url() ?>?print=1" target="_blank" class="btn btn-primary">
        <i class="bi bi-printer me-2"></i> Cetak Laporan
    </a>
</div> -->

<div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <?php if (!empty($rekap_seksi)): ?>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th width="50">No</th>
                            <th>Seksi</th>
                            <th class="text-center">Jumlah Berkas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($rekap_seksi as $rs): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= esc($rs['seksi']) ?></td>
                                <td class="text-center fw-bold"><?= number_format($rs['jumlah']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot class="table-active">
                        <tr>
                            <td colspan="2" class="text-end fw-bold">Total Keseluruhan</td>
                            <td class="text-center fw-bold">
                                <?= number_format(array_sum(array_column($rekap_seksi, 'jumlah'))) ?>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-info text-center py-4">
                <i class="bi bi-info-circle me-2"></i>
                Belum ada berkas yang Anda buat
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>