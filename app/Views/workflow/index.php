<?= $this->extend('layout/sidebar') ?>
<?= $this->section('content') ?>

<div class="page-header">
    <h2><i class="bi bi-diagram-3"></i> Pengelolaan Workflow Approval</h2>
    <a href="<?= base_url('workflow/form') ?>" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Workflow Baru
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>Nama Workflow</th>
                    <th>Jenis Modul</th>
                    <th>Status</th>
                    <th>Langkah Approval</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($workflows)): ?>
                    <tr>
                        <td colspan="5" class="text-center py-4">Belum ada workflow yang dibuat.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($workflows as $w): ?>
                        <tr>
                            <td><?= esc($w['nama_workflow']) ?></td>
                            <td><?= ucwords(str_replace('_', ' ', $w['jenis_modul'])) ?></td>
                            <td>
                                <?= $w['is_active'] ? '<span class="badge bg-success">Aktif</span>' : '<span class="badge bg-secondary">Nonaktif</span>' ?>
                            </td>
                            <td>
                                <?php
                                $steps = $this->workflowStepModel->where('workflow_id', $w['id'])
                                        ->orderBy('urutan')->findAll();
                                foreach ($steps as $step) {
                                    echo '<span class="badge bg-info me-1">' . ucfirst($step['role']) . '</span>';
                                }
                                ?>
                            </td>
                            <td>
                                <a href="<?= base_url('workflow/form/' . $w['id']) ?>" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="#" onclick="hapusWorkflow(<?= $w['id'] ?>)" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function hapusWorkflow(id) {
    if (confirm('Yakin menghapus workflow ini?')) {
        fetch(`<?= base_url('workflow/delete') ?>/${id}`, { method: 'DELETE' })
            .then(() => location.reload());
    }
}
</script>

<?= $this->endSection() ?>