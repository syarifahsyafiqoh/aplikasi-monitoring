document.addEventListener('DOMContentLoaded', function() {
    
    // Ambil elemen input
    var inputHarian = document.getElementById('harian');
    var inputPenginapan = document.getElementById('penginapan');
    var inputTransport = document.getElementById('transport');

    // Pasang event listener untuk input angka
    if (inputHarian) {
        inputHarian.addEventListener('input', hitungTotal);
    }
    if (inputPenginapan) {
        inputPenginapan.addEventListener('input', hitungTotal);
    }
    if (inputTransport) {
        inputTransport.addEventListener('input', hitungTotal);
    }

    // Validasi form saat submit
    var form = document.getElementById('formPerjalananDinas');
    if (form) {
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        });
    }

    // Cegah input minus
    var semuaInputAngka = document.querySelectorAll('input[type="number"]');
    for (var i = 0; i < semuaInputAngka.length; i++) {
        semuaInputAngka[i].addEventListener('keydown', function(e) {
            if (e.key === '-' || e.key === 'e') {
                e.preventDefault();
            }
        });
    }
});

// Fungsi untuk hitung total biaya
function hitungTotal() {
    // Ambil nilai dari input
    var harian = parseInt(document.getElementById('harian').value);
    var penginapan = parseInt(document.getElementById('penginapan').value);
    var transport = parseInt(document.getElementById('transport').value);

    // Cek kalau tidak valid, set jadi 0
    if (isNaN(harian)) {
        harian = 0;
    }
    if (isNaN(penginapan)) {
        penginapan = 0;
    }
    if (isNaN(transport)) {
        transport = 0;
    }

    // Hitung total
    var total = harian + penginapan + transport;

    // Update tampilan text kecil di bawah input
    var harianText = document.getElementById('harian-text');
    var penginapanText = document.getElementById('penginapan-text');
    var transportText = document.getElementById('transport-text');

    if (harianText) {
        harianText.textContent = ' ' + formatRupiah(harian);
    }
    if (penginapanText) {
        penginapanText.textContent = ' ' + formatRupiah(penginapan);
    }
    if (transportText) {
        transportText.textContent = ' ' + formatRupiah(transport);
    }

    // Update total biaya di kotak hijau
    var totalBiaya = document.getElementById('total-biaya');
    if (totalBiaya) {
        totalBiaya.textContent = ' ' + formatRupiah(total);
    }
}

// Fungsi untuk format angka ke Rupiah
function formatRupiah(angka) {
    return angka.toLocaleString('id-ID');
}