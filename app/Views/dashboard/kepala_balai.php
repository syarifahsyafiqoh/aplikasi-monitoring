<?= $this->extend('layout/sidebar') ?>
<?= $this->section('content') ?>

<div class="welcome-section" style="background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%); color: white;">
    <h2>Selamat Datang, Kepala Balai</h2>
    <p>Persetujuan akhir berkas keuangan</p>
</div>

<div class="row g-4 mt-4">
    <div class="col-md-4">
        <div class="stat-card">
            <i class="bi bi-hourglass"></i>
            <h3><?= number_format($menunggu_persetujuan ?? 0) ?></h3>
            <p>Menunggu Persetujuan Anda</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <i class="bi bi-check-circle"></i>
            <h3><?= number_format($sudah_disetujui ?? 0) ?></h3>
            <p>Sudah Disetujui</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <i class="bi bi-x-circle"></i>
            <h3><?= number_format($ditolak ?? 0) ?></h3>
            <p>Ditolak</p>
        </div>
    </div>
</div>

<!-- Berkas Menunggu Persetujuan -->
<!-- Berkas Terbaru Menunggu Persetujuan -->
<div class="recent-files">
    <h5 class="section-title mb-4">
        <i class="bi bi-folder-symlink me-2"></i> Berkas Terbaru Menunggu Persetujuan Akhir
    </h5>
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>No Berkas</th>
                    <th>Modul</th>
                    <th>Operator</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($berkas_terbaru)): ?>
                    <?php $no = 1; foreach ($berkas_terbaru as $b): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><strong><?= esc($b['no_berkas']) ?></strong></td>
                            <td><?= ucwords(str_replace('_', ' ', esc($b['jenis_modul']))) ?></td>
                            <td><?= esc($b['operator_name'] ?? '-') ?></td>
                            <td><?= date('d M Y H:i', strtotime($b['updated_at'])) ?></td>
                            <td>
                                <a href="<?= base_url('persetujuan-kepala/detail/' . $b['id']) ?>" class="btn btn-sm btn-primary">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            Belum ada berkas yang menunggu persetujuan akhir
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>