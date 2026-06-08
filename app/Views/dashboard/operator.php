<?= $this->extend('layout/sidebar') ?>
<?= $this->section('content') ?>

<link href="<?= base_url('assets/css/dashboard_operator.css') ?>" rel="stylesheet">

<?php
$berkasList = $berkas_list ?? [];
$initialVisible = 5;

$modulNames = [
    'perjalanan_dinas' => 'Perjalanan Dinas',
    'gaji_induk' => 'Gaji Induk',
    'tunjangan_kinerja' => 'Tunjangan Kinerja',
    'uang_makan' => 'Uang Makan',
    'honorarium' => 'Honorarium',
    'kontraktual' => 'Kontraktual',
    'gup' => 'GUP UP PTUP TUP',
];

$modulRoutes = [
    'perjalanan_dinas' => 'perjalanan-dinas/detail/',
    'gaji_induk' => 'gaji-induk/detail/',
    'tunjangan_kinerja' => 'tunjangan-kinerja/detail/',
    'uang_makan' => 'uang-makan/detail/',
    'honorarium' => 'honorarium/detail/',
    'kontraktual' => 'kontraktual/detail/',
    'gup' => 'gup/detail/',
];

$statusClass = [
    'menunggu_verifikasi' => 'status-warning',
    'diverifikasi' => 'status-success',
    'ditolak' => 'status-review',
    'draft' => 'status-process',
    'disetujui' => 'status-success',
];
?>

<div class="welcome-section">
    <div class="welcome-content">
        <h2 class="welcome-title">Selamat Datang Kembali, <span class="username"><?= session()->get('username') ?></span>!</h2>
        <p class="welcome-subtitle">Berikut adalah ringkasan aktivitas berkas Anda hari ini</p>
    </div>
</div>

<div class="stats-container">
    <div class="stat-card stat-primary">
        <div class="stat-icon">
            <i class="bi bi-inbox-fill"></i>
        </div>
        <div class="stat-content">
            <p class="stat-label">Berkas Masuk Hari Ini</p>
            <h2 class="stat-value"><?= number_format($berkas_masuk_hari_ini ?? 0) ?></h2>
            <span class="stat-badge badge-primary">Data hari ini</span>
        </div>
    </div>

    <div class="stat-card stat-warning">
        <div class="stat-icon">
            <i class="bi bi-hourglass-split"></i>
        </div>
        <div class="stat-content">
            <p class="stat-label">Sedang Diproses</p>
            <h2 class="stat-value"><?= number_format($sedang_diproses ?? 0) ?></h2>
            <span class="stat-badge badge-warning">Menunggu verifikasi</span>
        </div>
    </div>

    <div class="stat-card stat-success">
        <div class="stat-icon">
            <i class="bi bi-check-circle-fill"></i>
        </div>
        <div class="stat-content">
            <p class="stat-label">Selesai Hari Ini</p>
            <h2 class="stat-value"><?= number_format($selesai_hari_ini ?? 0) ?></h2>
            <span class="stat-badge badge-success">Berkas diverifikasi</span>
        </div>
    </div>

    <div class="stat-card stat-info">
        <div class="stat-icon">
            <i class="bi bi-folder2-open"></i>
        </div>
        <div class="stat-content">
            <p class="stat-label">Total Berkas Bulan Ini</p>
            <h2 class="stat-value"><?= number_format($total_berkas_bulan_ini ?? 0) ?></h2>
            <span class="stat-badge badge-info"><?= date('F Y') ?></span>
        </div>
    </div>
</div>

<div class="recent-files">
    <div class="section-header">
        <h5 class="section-title">
            <i class="bi bi-clock-history"></i>
            Berkas Terbaru
        </h5>
        <div class="search-box">
            <i class="bi bi-search"></i>
            <input id="dashboardSearch" type="text" class="form-control" placeholder="Cari berkas...">
        </div>
        <a href="#" id="toggleAllRows" class="view-all-link">
            Lihat Semua <i class="bi bi-arrow-right"></i>
        </a>
    </div>

    <div class="table-card">
        <div class="table-responsive">
            <table class="custom-table" id="dashboardBerkasTable">
                <thead>
                    <tr>
                        <th width="60">No</th>
                        <th>No Berkas</th>
                        <th>Jenis Berkas</th>
                        <th>Pengirim</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($berkasList)): ?>
                        <?php foreach ($berkasList as $index => $row): ?>
                            <?php
                            $jenisModul = $row['jenis_modul'] ?? '';
                            $modulLabel = $modulNames[$jenisModul] ?? ucwords(str_replace('_', ' ', $jenisModul));
                            $routePrefix = $modulRoutes[$jenisModul] ?? '';
                            $detailUrl = $routePrefix !== '' ? base_url($routePrefix . ($row['id_modul'] ?? 0)) : '#';
                            $status = $row['status'] ?? 'draft';
                            $statusText = ucwords(str_replace('_', ' ', $status));
                            $statusBadge = $statusClass[$status] ?? 'status-process';
                            $hiddenClass = $index >= $initialVisible ? 'd-none extra-row' : '';
                            $searchText = strtolower(trim(($row['no_berkas'] ?? '') . ' ' . $modulLabel . ' ' . $statusText));
                            ?>
                            <tr class="dashboard-row <?= $hiddenClass ?>" data-search="<?= esc($searchText, 'attr') ?>">
                                <td><span class="table-number"><?= $index + 1 ?></span></td>
                                <td><strong class="berkas-no"><?= esc($row['no_berkas'] ?? '-') ?></strong></td>
                                <td><?= esc($modulLabel) ?></td>
                                <td>
                                    <div class="sender-info">
                                        <i class="bi bi-person-circle"></i>
                                        <span><?= esc(session()->get('username')) ?></span>
                                    </div>
                                </td>
                                <td><?= !empty($row['created_at']) ? date('d M Y', strtotime($row['created_at'])) : '-' ?></td>
                                <td><span class="status-badge <?= esc($statusBadge) ?>"><?= esc($statusText) ?></span></td>
                                <td>
                                    <div class="action-group">
                                        <a href="<?= esc($detailUrl) ?>" class="btn-action btn-view" title="Lihat Detail">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr id="emptyRowDefault">
                            <td colspan="7" class="text-center text-muted py-4">Belum ada berkas.</td>
                        </tr>
                    <?php endif; ?>
                    <tr id="emptyRowSearch" class="d-none">
                        <td colspan="7" class="text-center text-muted py-4">Berkas tidak ditemukan.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
(function () {
    const searchInput = document.getElementById('dashboardSearch');
    const toggleLink = document.getElementById('toggleAllRows');
    const rows = Array.from(document.querySelectorAll('#dashboardBerkasTable .dashboard-row'));
    const emptySearchRow = document.getElementById('emptyRowSearch');
    const initialVisible = <?= $initialVisible ?>;
    let showAll = false;

    function applyFilters() {
        const keyword = (searchInput ? searchInput.value : '').trim().toLowerCase();
        let visibleCount = 0;

        rows.forEach(function (row, index) {
            const text = row.getAttribute('data-search') || '';
            const matched = keyword === '' || text.includes(keyword);
            const allowByToggle = showAll || index < initialVisible;
            const shouldShow = matched && allowByToggle;

            row.classList.toggle('d-none', !shouldShow);
            if (shouldShow) {
                visibleCount += 1;
            }
        });

        if (emptySearchRow) {
            emptySearchRow.classList.toggle('d-none', !(rows.length > 0 && visibleCount === 0));
        }
    }

    if (searchInput) {
        searchInput.addEventListener('input', applyFilters);
    }

    if (toggleLink) {
        toggleLink.addEventListener('click', function (event) {
            event.preventDefault();
            showAll = !showAll;
            toggleLink.innerHTML = showAll
                ? 'Tampilkan Ringkas <i class="bi bi-arrow-up"></i>'
                : 'Lihat Semua <i class="bi bi-arrow-right"></i>';
            applyFilters();
        });
    }

    applyFilters();
})();
</script>

<?= $this->endSection() ?>
