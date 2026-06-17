<?= $this->extend('layout/sidebar') ?>
<?= $this->section('content') ?>
<?php
$berkas = $berkas ?? [];
$detail = $detail ?? [];
?>

<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h4><i class="bi bi-clipboard-check me-2"></i>Persetujuan Akhir - <?= ucwords(str_replace('_', ' ', $berkas['jenis_modul'] ?? '')) ?></h4>
    </div>
    <div class="card-body">

        <!-- Info Berkas -->
        <div class="row mb-4">
            <div class="col-md-6">
                <strong>No Berkas:</strong> <?= esc($berkas['no_berkas']) ?><br>
                <strong>Modul:</strong> <?= ucwords(str_replace('_', ' ', $berkas['jenis_modul'])) ?><br>
                <strong>Operator:</strong> <?= esc($berkas['operator_name']) ?>
            </div>
            <div class="col-md-6 text-end">
                <strong>Status Saat Ini:</strong> 
                <span class="badge bg-warning">Menunggu Persetujuan Kepala Balai</span>
            </div>
        </div>

        <!-- Detail Modul akan muncul di sini nanti -->
        <?php if ($detail): ?>
            <hr>
            <h5>Detail Berkas</h5>
            <pre><?= print_r($detail, true) ?></pre> <!-- Sementara untuk debug -->
        <?php endif; ?>

        <!-- Form Persetujuan -->
        <form id="form-persetujuan">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label class="form-label fw-bold">Catatan Kepala Balai (Opsional)</label>
                <textarea name="catatan" class="form-control" rows="4" placeholder="Masukkan catatan jika ada..."></textarea>
            </div>

            <div class="d-flex gap-3 justify-content-end">
                <button type="button" onclick="prosesPersetujuan('ditolak')" class="btn btn-danger btn-lg px-5">
                    <i class="bi bi-x-circle"></i> Tolak
                </button>
                <button type="button" onclick="prosesPersetujuan('disetujui')" class="btn btn-success btn-lg px-5">
                    <i class="bi bi-check-circle"></i> Setujui Berkas
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function prosesPersetujuan(status) {
    if (!confirm('Yakin ingin ' + (status === 'disetujui' ? 'menyetujui' : 'menolak') + ' berkas ini?')) {
        return;
    }

    let formData = new FormData(document.getElementById('form-persetujuan'));
    formData.append('status', status);

    fetch('<?= base_url('persetujuan-kepala/proses/' . $berkas['id']) ?>', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(res => {
        alert(res.message);
        if (res.status === 'success') {
            window.location.href = '<?= base_url('persetujuan-kepala') ?>';
        }
    })
    .catch(err => alert('Terjadi kesalahan'));
}
</script>

<?= $this->endSection() ?>