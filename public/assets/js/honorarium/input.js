// Ketika halaman sudah siap
document.addEventListener('DOMContentLoaded', function() {
    
    // Ambil elemen input
    var inputBruto = document.getElementById('bruto');
    var inputNetto = document.getElementById('netto');

    // Pasang event listener untuk input angka
    if (inputBruto) {
        inputBruto.addEventListener('input', updateFormat);
    }
    if (inputNetto) {
        inputNetto.addEventListener('input', updateFormat);
    }

    // Validasi form saat submit
    var form = document.getElementById('formHonorarium');
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

// Fungsi untuk update format Rupiah
function updateFormat() {
    // Ambil nilai dari input
    var bruto = parseInt(document.getElementById('bruto').value);
    var netto = parseInt(document.getElementById('netto').value);

    // Cek kalau tidak valid, set jadi 0
    if (isNaN(bruto)) {
        bruto = 0;
    }
    if (isNaN(netto)) {
        netto = 0;
    }

    // Update tampilan text kecil di bawah input
    var brutoText = document.getElementById('bruto-text');
    var nettoText = document.getElementById('netto-text');

    if (brutoText) {
        brutoText.textContent = ' ' + formatRupiah(bruto);
    }
    if (nettoText) {
        nettoText.textContent = ' ' + formatRupiah(netto);
    }
}

// Fungsi untuk format angka ke Rupiah
function formatRupiah(angka) {
    return angka.toLocaleString('id-ID');
}