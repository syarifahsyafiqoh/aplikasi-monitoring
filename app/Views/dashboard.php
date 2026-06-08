<?= $this->include('layout/header') ?>

<!-- Page Title & Breadcrumb -->
<div class="row mb-4">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="bi bi-house-door me-1"></i> Dashboard
                </li>
            </ol>
        </nav>
        <h2 class="text-klhk fw-bold mb-0">Dashboard Monitoring Berkas</h2>
        <p class="text-muted">Selamat datang di Sistem Monitoring Berkas BPDAS Barito</p>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row g-4 mb-4">
    <!-- Total Berkas -->
    <div class="col-md-6 col-xl-3">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <p class="text-muted mb-1">Total Berkas</p>
                        <h3 class="text-klhk fw-bold mb-0">
                            <?= $total_berkas ?? 0 ?>
                        </h3>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="bg-klhk-light rounded-circle d-flex align-items-center justify-content-center" 
                             style="width: 60px; height: 60px;">
                            <i class="bi bi-folder-fill text-klhk fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-transparent">
                <small class="text-success">
                    <i class="bi bi-arrow-up"></i> 5% dari bulan lalu
                </small>
            </div>
        </div>
    </div>

    <!-- Berkas Diproses -->
    <div class="col-md-6 col-xl-3">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <p class="text-muted mb-1">Sedang Diproses</p>
                        <h3 class="text-warning fw-bold mb-0">
                            <?= $berkas_proses ?? 0 ?>
                        </h3>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="bg-warning bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" 
                             style="width: 60px; height: 60px;">
                            <i class="bi bi-hourglass-split text-warning fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-transparent">
                <small class="text-muted">
                    <i class="bi bi-clock"></i> Memerlukan perhatian
                </small>
            </div>
        </div>
    </div>

    <!-- Berkas Selesai -->
    <div class="col-md-6 col-xl-3">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <p class="text-muted mb-1">Berkas Selesai</p>
                        <h3 class="text-success fw-bold mb-0">
                            <?= $berkas_selesai ?? 0 ?>
                        </h3>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" 
                             style="width: 60px; height: 60px;">
                            <i class="bi bi-check-circle-fill text-success fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-transparent">
                <small class="text-success">
                    <i class="bi bi-check2"></i> Bulan ini: <?= $selesai_bulan_ini ?? 0 ?>
                </small>
            </div>
        </div>
    </div>

    <!-- Berkas Ditolak -->
    <div class="col-md-6 col-xl-3">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <p class="text-muted mb-1">Berkas Ditolak</p>
                        <h3 class="text-danger fw-bold mb-0">
                            <?= $berkas_ditolak ?? 0 ?>
                        </h3>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="bg-danger bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" 
                             style="width: 60px; height: 60px;">
                            <i class="bi bi-x-circle-fill text-danger fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-transparent">
                <small class="text-muted">
                    <i class="bi bi-info-circle"></i> Perlu perbaikan
                </small>
            </div>
        </div>
    </div>
</div>

<!-- Charts & Recent Activity -->
<div class="row g-4 mb-4">
    <!-- Charts Statistik -->
    <div class="col-lg-8">
        <div class="card h-100">
            <div class="card-header">
                <i class="bi bi-bar-chart-fill me-2"></i>
                Statistik Berkas Bulanan
            </div>
            <div class="card-body">
                <canvas id="berkasChart" height="300"></canvas>
            </div>
        </div>
    </div>

    <!-- Aktivitas Terbaru -->
    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-header">
                <i class="bi bi-clock-history me-2"></i>
                Aktivitas Terbaru
            </div>
            <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                <?php if (!empty($recent_activities)): ?>
                    <?php foreach ($recent_activities as $activity): ?>
                        <div class="activity-item mb-3 pb-3 border-bottom">
                            <div class="d-flex align-items-start">
                                <div class="activity-icon bg-klhk-light rounded-circle me-3">
                                    <i class="bi bi-file-earmark-text text-klhk"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1 fw-bold"><?= esc($activity['title']) ?></h6>
                                    <p class="mb-1 text-muted small"><?= esc($activity['description']) ?></p>
                                    <small class="text-muted">
                                        <i class="bi bi-clock me-1"></i>
                                        <?= date('d/m/Y H:i', strtotime($activity['created_at'])) ?>
                                    </small>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="text-center py-4">
                        <i class="bi bi-inbox fs-1 text-muted"></i>
                        <p class="text-muted mt-2">Belum ada aktivitas</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Recent Documents Table -->
<div class="row g-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <i class="bi bi-file-earmark-text me-2"></i>
                    Berkas Terbaru
                </div>
                <a href="<?= base_url('berkas') ?>" class="btn btn-sm btn-klhk">
                    <i class="bi bi-eye me-1"></i> Lihat Semua
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Berkas</th>
                                <th>Jenis Berkas</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Petugas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($recent_documents)): ?>
                                <?php $no = 1; foreach ($recent_documents as $doc): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td>
                                            <strong><?= esc($doc['nomor_berkas']) ?></strong>
                                        </td>
                                        <td><?= esc($doc['jenis_berkas']) ?></td>
                                        <td><?= date('d/m/Y', strtotime($doc['tanggal'])) ?></td>
                                        <td>
                                            <?php
                                            $status_class = [
                                                'Proses' => 'warning',
                                                'Selesai' => 'success',
                                                'Ditolak' => 'danger',
                                                'Pending' => 'secondary'
                                            ];
                                            $class = $status_class[$doc['status']] ?? 'secondary';
                                            ?>
                                            <span class="badge bg-<?= $class ?>">
                                                <?= esc($doc['status']) ?>
                                            </span>
                                        </td>
                                        <td><?= esc($doc['petugas']) ?></td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="<?= base_url('berkas/detail/' . $doc['id']) ?>" 
                                                   class="btn btn-outline-primary" title="Detail">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="<?= base_url('berkas/edit/' . $doc['id']) ?>" 
                                                   class="btn btn-outline-secondary" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <i class="bi bi-inbox fs-1 text-muted"></i>
                                        <p class="text-muted mt-2">Belum ada data berkas</p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    // Statistik Chart
    const ctx = document.getElementById('berkasChart');
    if (ctx) {
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ago', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Berkas Masuk',
                    data: <?= json_encode($chart_data['masuk'] ?? [12, 19, 15, 25, 22, 30, 28, 35, 32, 40, 38, 45]) ?>,
                    borderColor: '#4C3D19',
                    backgroundColor: 'rgba(76, 61, 25, 0.1)',
                    tension: 0.4
                }, {
                    label: 'Berkas Selesai',
                    data: <?= json_encode($chart_data['selesai'] ?? [10, 15, 13, 20, 18, 25, 23, 30, 28, 35, 33, 40]) ?>,
                    borderColor: '#889063',
                    backgroundColor: 'rgba(136, 144, 99, 0.1)',
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
</script>

<?= $this->include('layout/footer') ?>