<?= $this->extend('layout/sidebar') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Rekap Jumlah Berkas per Modul</h4>
    <a href="<?= current_url() ?>?print=1" target="_blank" class="btn btn-primary">
        <i class="bi bi-printer me-2"></i> Cetak Laporan
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <?php if (!empty($rekap_modul)): ?>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th width="50">No</th>
                            <th>Modul</th>
                            <th class="text-center">Jumlah Berkas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($rekap_modul as $rm): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= ucwords(str_replace('_', ' ', $rm['jenis_modul'])) ?></td>
                                <td class="text-center fw-bold"><?= number_format($rm['jumlah']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot class="table-active">
                        <tr>
                            <td colspan="2" class="text-end fw-bold">Total Keseluruhan</td>
                            <td class="text-center fw-bold"><?= number_format(array_sum(array_column($rekap_modul, 'jumlah'))) ?></td>
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