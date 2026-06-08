<?= $this->extend('layout/sidebar') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Rekap Total Anggaran / Biaya per Modul</h4>
    <a href="<?= current_url() ?>?print=1" target="_blank" class="btn btn-primary">
        <i class="bi bi-printer me-2"></i> Cetak Laporan
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Modul</th>
                    <th>Total Biaya</th>
                </tr>
            </thead>
            <tbody>
                <?php $grand_total = 0; ?>
                <?php foreach ($rekap_biaya as $r): ?>
                    <?php
                    $total_modul = $r['total_pd'] + $r['total_gaji'] + $r['total_tk'] + $r['total_um'] + $r['total_honor'] + $r['total_kontrak'] + $r['total_gup'];
                    $grand_total += $total_modul;
                    ?>
                    <tr>
                        <td><?= ucwords(str_replace('_', ' ', $r['jenis_modul'])) ?></td>
                        <td>Rp <?= number_format($total_modul, 0, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr class="table-active">
                    <td class="text-end fw-bold">Total Keseluruhan</td>
                    <td class="fw-bold">Rp <?= number_format($grand_total, 0, ',', '.') ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>