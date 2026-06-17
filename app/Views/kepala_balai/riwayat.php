<?= $this->extend('layout/sidebar') ?>
<?= $this->section('content') ?>

<div class="page-header">
    <h1><i class="bi bi-clock-history me-2"></i>Riwayat Persetujuan Saya</h1>
    <p class="text-muted">Daftar berkas yang telah Anda setujui sebagai Kepala Balai</p>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>No Berkas</th>
                        <th>Modul</th>
                        <th>Operator</th>
                        <th>Tanggal Disetujui</th>
                        <th>Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($riwayat)): ?>
                        <?php $no = 1; foreach ($riwayat as $b): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><strong><?= esc($b['no_berkas']) ?></strong></td>
                            <td><?= ucwords(str_replace('_', ' ', $b['jenis_modul'])) ?></td>
                            <td><?= esc($b['operator_name'] ?? '-') ?></td>
                            <td><?= date('d M Y H:i', strtotime($b['updated_at'])) ?></td>
                            <td><?= esc($b['catatan_bendahara'] ?? '-') ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                Belum ada berkas yang Anda setujui
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>