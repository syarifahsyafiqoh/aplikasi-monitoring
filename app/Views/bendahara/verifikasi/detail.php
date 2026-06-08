<?= $this->extend('layout/sidebar') ?>
<?= $this->section('content') ?>
<link href="<?= base_url('assets/css/verifikasi_bendahara/detail.css') ?>" rel="stylesheet">

<div class="detail-container">
    <!-- Header -->
    <div class="detail-header">
        <h4><i class="bi bi-file-earmark-text me-2"></i>Detail & Verifikasi Berkas</h4>
    </div>

    <!-- Info Berkas Utama -->
    <div class="info-berkas-grid">
        <div class="info-item">
            <div class="info-label">
                <i class="bi bi-hash"></i>
                <span>No Berkas</span>
            </div>
            <p class="info-value"><?= esc($berkas['no_berkas']) ?></p>
        </div>
        <div class="info-item">
            <div class="info-label">
                <i class="bi bi-folder"></i>
                <span>Jenis Modul</span>
            </div>
            <p class="info-value">
                <span class="badge-module"><?= ucwords(str_replace('_', ' ', $berkas['jenis_modul'])) ?></span>
            </p>
        </div>
    </div>

    <!-- Detail Modul -->
    <div class="detail-card">
        <div class="section-header">
            <h5><i class="bi bi-list-ul"></i> Detail Berkas</h5>
        </div>

        <?php
        $d = $detail ?? [];
        ?>

        <?php if ($berkas['jenis_modul'] === 'perjalanan_dinas'): ?>
            <?php
            // Hitung total keseluruhan
            $total_keseluruhan = ($d['harian_perjalanan'] ?? 0) + ($d['penginapan'] ?? 0) + ($d['transport'] ?? 0);
            ?>
            <div class="detail-grid two-col">
                <div class="detail-item">
                    <span class="detail-label">No Surat Tugas</span>
                    <p class="detail-value"><?= esc($d['no_surat_tugas'] ?? '-') ?></p>
                </div>
                <div class="detail-item">
                    <span class="detail-label">No Akun</span>
                    <p class="detail-value"><?= esc($d['no_akun'] ?? '-') ?></p>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Sumber Dana</span>
                    <p class="detail-value"><?= strtoupper(esc($d['sumber_dana'] ?? '-')) ?></p>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Seksi</span>
                    <p class="detail-value"><?= esc($d['seksi'] ?? '-') ?></p>
                </div>
                <div class="detail-item full-width">
                    <span class="detail-label">Uraian Tugas</span>
                    <p class="detail-value"><?= nl2br(esc($d['uraian'] ?? '-')) ?></p>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Harian Perjalanan</span>
                    <p class="detail-value currency">Rp <?= number_format($d['harian_perjalanan'] ?? 0, 0, ',', '.') ?></p>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Penginapan</span>
                    <p class="detail-value currency">Rp <?= number_format($d['penginapan'] ?? 0, 0, ',', '.') ?></p>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Transport</span>
                    <p class="detail-value currency">Rp <?= number_format($d['transport'] ?? 0, 0, ',', '.') ?></p>
                </div>
                <div class="detail-item highlight-total">
                    <span class="detail-label">Total Keseluruhan</span>
                    <p class="detail-value currency fw-bold fs-5 text-primary">
                        Rp <?= number_format($total_keseluruhan, 0, ',', '.') ?>
                    </p>
                </div>
            </div>

        <?php elseif ($berkas['jenis_modul'] === 'gaji_induk'): ?>
            <div class="detail-grid">
                <div class="detail-item full-width">
                    <span class="detail-label">Uraian</span>
                    <p class="detail-value"><?= nl2br(esc($d['uraian'] ?? '-')) ?></p>
                </div>
                <div class="detail-item">
                    <span class="detail-label">No Akun</span>
                    <p class="detail-value"><?= esc($d['no_akun'] ?? '-') ?></p>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Total Uang Bruto</span>
                    <p class="detail-value currency">Rp <?= number_format($d['total_bruto'] ?? 0, 0, ',', '.') ?></p>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Total Uang Netto</span>
                    <p class="detail-value currency">Rp <?= number_format($d['total_netto'] ?? 0, 0, ',', '.') ?></p>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Seksi</span>
                    <p class="detail-value"><?= esc($d['seksi'] ?? '-') ?></p>
                </div>
            </div>

        <?php elseif (in_array($berkas['jenis_modul'], ['tunjangan_kinerja', 'uang_makan', 'honorarium'])): ?>
            <div class="detail-grid">
                <div class="detail-item full-width">
                    <span class="detail-label">Uraian</span>
                    <p class="detail-value"><?= nl2br(esc($d['uraian'] ?? '-')) ?></p>
                </div>
                <div class="detail-item">
                    <span class="detail-label">No Akun</span>
                    <p class="detail-value"><?= esc($d['no_akun'] ?? '-') ?></p>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Total Uang Bruto</span>
                    <p class="detail-value currency">Rp <?= number_format($d['total_bruto'] ?? 0, 0, ',', '.') ?></p>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Total Uang Netto</span>
                    <p class="detail-value currency">Rp <?= number_format($d['total_netto'] ?? 0, 0, ',', '.') ?></p>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Seksi</span>
                    <p class="detail-value"><?= esc($d['seksi'] ?? '-') ?></p>
                </div>
            </div>

        <?php elseif ($berkas['jenis_modul'] === 'kontraktual'): ?>
            <div class="detail-grid">
                <div class="detail-item full-width">
                    <span class="detail-label">Uraian</span>
                    <p class="detail-value"><?= nl2br(esc($d['uraian'] ?? '-')) ?></p>
                </div>
                <div class="detail-item">
                    <span class="detail-label">No Akun</span>
                    <p class="detail-value"><?= esc($d['no_akun'] ?? '-') ?></p>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Total Uang Bruto</span>
                    <p class="detail-value currency">Rp <?= number_format($d['total_bruto'] ?? 0, 0, ',', '.') ?></p>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Total Uang Netto</span>
                    <p class="detail-value currency">Rp <?= number_format($d['total_netto'] ?? 0, 0, ',', '.') ?></p>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Pajak</span>
                    <p class="detail-value currency">Rp <?= number_format($d['pajak'] ?? 0, 0, ',', '.') ?></p>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Seksi</span>
                    <p class="detail-value"><?= esc($d['seksi'] ?? '-') ?></p>
                </div>
            </div>

        <?php elseif ($berkas['jenis_modul'] === 'gup'): ?>
            <div class="detail-grid">
                <div class="detail-item">
                    <span class="detail-label">Seksi</span>
                    <p class="detail-value"><?= esc($d['seksi'] ?? '-') ?></p>
                </div>
                <div class="detail-item full-width">
                    <span class="detail-label">Uraian</span>
                    <p class="detail-value"><?= nl2br(esc($d['uraian'] ?? '-')) ?></p>
                </div>
            </div>

        <?php else: ?>
            <p class="text-center text-muted py-4">
                Detail spesifik untuk modul ini belum dikonfigurasi.
            </p>
        <?php endif; ?>
    </div>

    <div class="verifikasi-section">
        <h5 class="verifikasi-title">
            <i class="bi bi-check2-circle"></i>
            Tindakan Verifikasi
        </h5>

        <form id="form-verifikasi">
            <input type="hidden" name="id" value="<?= $berkas['id'] ?>">

            <div class="form-group">
                <label class="form-label-custom">Status Verifikasi</label>
                <select name="status" class="form-select-custom" required>
                    <option value="diverifikasi">✓ Setujui / Diverifikasi</option>
                    <option value="ditolak">✗ Tolak</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label-custom">Catatan Bendahara <span style="color: #999; font-weight: 400;">(wajib jika tolak)</span></label>
                <textarea name="catatan" class="form-textarea-custom" placeholder="Masukkan alasan penolakan atau catatan tambahan..."></textarea>
            </div>

            <div class="action-buttons">
                <a href="<?= base_url('verifikasi-berkas') ?>" class="btn-custom btn-secondary-custom">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                <button type="button" onclick="prosesVerifikasi()" class="btn-custom btn-primary-custom">
                    <i class="bi bi-check2-circle"></i> Proses Verifikasi
                </button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function prosesVerifikasi() {
    let formData = new FormData(document.getElementById('form-verifikasi'));
    let id = formData.get('id');
    let status = formData.get('status');
    let catatan = formData.get('catatan');

    if (status === 'ditolak' && !catatan.trim()) {
        Swal.fire('Peringatan', 'Catatan wajib diisi jika menolak!', 'warning');
        return;
    }

    Swal.fire({
        title: 'Konfirmasi',
        text: status === 'diverifikasi' ? 'Yakin menyetujui berkas ini?' : 'Yakin menolak berkas ini?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`<?= base_url('verifikasi-berkas/proses') ?>/${id}`, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(res => {
                if (res.status === 'success') {
                    Swal.fire('Berhasil!', res.message, 'success').then(() => {
                        window.location.href = '<?= base_url('verifikasi-berkas') ?>';
                    });
                } else {
                    Swal.fire('Gagal', res.message, 'error');
                }
            });
        }
    });
}
</script>

<?= $this->endSection() ?>