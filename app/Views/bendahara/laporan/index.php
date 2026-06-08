<?= $this->extend('layout/sidebar') ?>
<?= $this->section('content') ?>

<link href="<?= base_url('assets/css/verifikasi_bendahara/index-laporan.css') ?>" rel="stylesheet">

<!-- Page Header -->
<div class="laporan-header" style="background: linear-gradient(135deg, #6D8B7C 0%, #638890 100%);">
    <h3>
        <i class="bi bi-clipboard-data"></i>
        Laporan Berkas Terverifikasi
    </h3>
    <a href="<?= current_url() ?>?print=1" target="_blank" class="btn-print">
        <i class="bi bi-printer"></i> Cetak Laporan
    </a>
</div>

<!-- Stat Card -->
<div class="stat-total-card">
    <div class="stat-total-content">
        <h6>Total Berkas Terverifikasi</h6>
        <h2><?= number_format($total_terverifikasi) ?></h2>
    </div>
    <div class="stat-total-icon">
        <i class="bi bi-check2-circle"></i>
    </div>
</div>

<!-- Rekap Berdasarkan Modul -->
<div class="card laporan-card">
    <div class="card-header">
        <h5>Rekap Berdasarkan Modul</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="laporan-table">
                <thead>
                    <tr>
                        <th>Modul</th>
                        <th width="160" class="text-center-custom">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($rekap_modul)): ?>
                        <?php foreach ($rekap_modul as $rm): ?>
                            <tr>
                                <td><?= ucwords(str_replace('_', ' ', esc($rm['jenis_modul']))) ?></td>
                                <td class="text-center-custom"><strong><?= number_format($rm['jumlah']) ?></strong></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="2" class="empty-state">Belum ada berkas terverifikasi.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Daftar Berkas Terverifikasi -->
<div class="card laporan-card">
    <div class="card-header">
        <h5>Daftar Berkas Terverifikasi</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="laporan-table">
                <thead>
                    <tr>
                        <th width="60" class="text-center-custom">No</th>
                        <th>No Berkas</th>
                        <th>Modul</th>
                        <th>Operator</th>
                        <th width="140" class="text-center-custom">Status</th>
                        <th width="180">Tanggal Input</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($berkas_terverifikasi)): ?>
                        <?php $no = 1; ?>
                        <?php foreach ($berkas_terverifikasi as $b): ?>
                            <tr>
                                <td class="text-center-custom"><?= $no++ ?></td>
                                <td><strong><?= esc($b['no_berkas']) ?></strong></td>
                                <td><?= ucwords(str_replace('_', ' ', esc($b['jenis_modul']))) ?></td>
                                <td><?= esc($b['operator_name'] ?? '-') ?></td>
                                <td class="text-center-custom">
                                    <span class="badge-verified">Diverifikasi</span>
                                </td>
                                <td><?= date('d M Y H:i', strtotime($b['created_at'])) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="empty-state">Tidak ada data untuk ditampilkan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>