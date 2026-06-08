<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('test-db', 'TestDb::index');

$routes->get('test', 'Test::index');

$routes->get('/', 'Auth::login');
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::attemptLogin');
$routes->get('logout', 'Auth::logout');

// SEMUA YANG BUTUH LOGIN
$routes->group('', ['filter' => 'auth'], function($routes) {

    // Dashboard utama: langsung redirect ke role masing-masing
    $routes->get('dashboard', function() {
        return redirect()->to('/dashboard/' . session()->get('role'));
    });

    // DASHBOARD PER ROLE 
    $routes->get('dashboard/operator', 'Dashboard::operator');
    $routes->get('dashboard/bendahara', 'Dashboard::bendahara');
    $routes->get('dashboard/admin', 'Dashboard::admin');
    $routes->get('dashboard/stats', 'Dashboard::getDashboardStats');

    $routes->get('admin', 'Admin::index');
    $routes->get('bendahara', 'Bendahara::index');
    $routes->get('operator', 'Operator::index');

    // langsung dari /operator ke dashboard operator (biar tidak berubah)
    $routes->get('operator', 'Dashboard::operator');
    $routes->get('bendahara', 'Dashboard::bendahara');
    $routes->get('admin', 'Dashboard::admin');

    // Perjalanan Dinas
    $routes->get('perjalanan-dinas', 'PerjalananDinas::index');
    $routes->get('perjalanan-dinas/data', 'PerjalananDinas::getData');
    $routes->get('perjalanan-dinas/input', 'PerjalananDinas::input');
    $routes->post('perjalanan-dinas/simpan', 'PerjalananDinas::simpan');
    $routes->get('perjalanan-dinas/edit/(:num)', 'PerjalananDinas::edit/$1');
    $routes->post('perjalanan-dinas/update/(:num)', 'PerjalananDinas::update/$1');
    $routes->get('perjalanan-dinas/detail/(:num)', 'PerjalananDinas::detail/$1');
    $routes->delete('perjalanan-dinas/hapus/(:num)', 'PerjalananDinas::hapus/$1');
    $routes->get('perjalanan-dinas/pdf', 'PerjalananDinas::exportPdf');

    // Gaji Induk
    $routes->get('gaji-induk', 'GajiInduk::index');
    $routes->get('gaji-induk/data', 'GajiInduk::getData');
    $routes->get('gaji-induk/input', 'GajiInduk::input');
    $routes->post('gaji-induk/simpan', 'GajiInduk::simpan');
    $routes->get('gaji-induk/edit/(:num)', 'GajiInduk::edit/$1');
    $routes->post('gaji-induk/update/(:num)', 'GajiInduk::update/$1');
    $routes->get('gaji-induk/detail/(:num)', 'GajiInduk::detail/$1');
    $routes->delete('gaji-induk/hapus/(:num)', 'GajiInduk::hapus/$1');

    // Tunjangan Kinerja
    $routes->get('tunjangan-kinerja', 'TunjanganKinerja::index');
    $routes->get('tunjangan-kinerja/data', 'TunjanganKinerja::getData');
    $routes->get('tunjangan-kinerja/input', 'TunjanganKinerja::input');
    $routes->post('tunjangan-kinerja/simpan', 'TunjanganKinerja::simpan');
    $routes->get('tunjangan-kinerja/edit/(:num)', 'TunjanganKinerja::edit/$1');
    $routes->post('tunjangan-kinerja/update/(:num)', 'TunjanganKinerja::update/$1');
    $routes->delete('tunjangan-kinerja/hapus/(:num)', 'TunjanganKinerja::hapus/$1');
    $routes->get('tunjangan-kinerja/detail/(:num)', 'TunjanganKinerja::detail/$1');

    // Uang Makan
    $routes->get('uang-makan', 'UangMakan::index');
    $routes->get('uang-makan/data', 'UangMakan::getData');
    $routes->get('uang-makan/input', 'UangMakan::input');
    $routes->post('uang-makan/simpan', 'UangMakan::simpan');
    $routes->get('uang-makan/edit/(:num)', 'UangMakan::edit/$1');
    $routes->post('uang-makan/update/(:num)', 'UangMakan::update/$1');
    $routes->delete('uang-makan/hapus/(:num)', 'UangMakan::hapus/$1');
    $routes->get('uang-makan/detail/(:num)', 'UangMakan::detail/$1');

    // Honorarium
    $routes->get('honorarium', 'Honorarium::index');
    $routes->get('honorarium/data', 'Honorarium::getData');
    $routes->get('honorarium/input', 'Honorarium::input');
    $routes->post('honorarium/simpan', 'Honorarium::simpan');
    $routes->get('honorarium/edit/(:num)', 'Honorarium::edit/$1');
    $routes->post('honorarium/update/(:num)', 'Honorarium::update/$1');
    $routes->delete('honorarium/hapus/(:num)', 'Honorarium::hapus/$1');
    $routes->get('honorarium/detail/(:num)', 'Honorarium::detail/$1');

    // Kontraktual
    $routes->get('kontraktual', 'Kontraktual::index');
    $routes->get('kontraktual/data', 'Kontraktual::getData');
    $routes->get('kontraktual/input', 'Kontraktual::input');
    $routes->post('kontraktual/simpan', 'Kontraktual::simpan');
    $routes->get('kontraktual/edit/(:num)', 'Kontraktual::edit/$1');
    $routes->post('kontraktual/update/(:num)', 'Kontraktual::update/$1');
    $routes->delete('kontraktual/hapus/(:num)', 'Kontraktual::hapus/$1');
    $routes->get('kontraktual/detail/(:num)', 'Kontraktual::detail/$1');

    // GUP UP PTUP TUP
    $routes->get('gup', 'Gup::index');
    $routes->get('gup/data', 'Gup::getData');
    $routes->get('gup/input', 'Gup::input');
    $routes->post('gup/simpan', 'Gup::simpan');
    $routes->get('gup/edit/(:num)', 'Gup::edit/$1');
    $routes->post('gup/update/(:num)', 'Gup::update/$1');
    $routes->delete('gup/hapus/(:num)', 'Gup::hapus/$1');
    $routes->get('gup/detail/(:num)', 'Gup::detail/$1');

    // Kelola User (hanya  admin)
    $routes->get('kelola-user', 'UserManagement::index');
    $routes->get('kelola-user/data', 'UserManagement::getData');
    $routes->get('kelola-user/input', 'UserManagement::input');
    $routes->post('kelola-user/simpan', 'UserManagement::simpan');
    $routes->get('kelola-user/edit/(:num)', 'UserManagement::edit/$1');
    $routes->post('kelola-user/update/(:num)', 'UserManagement::update/$1');
    $routes->delete('kelola-user/hapus/(:num)', 'UserManagement::hapus/$1');

    //verifikasi berkas
    $routes->get('verifikasi-berkas', 'VerifikasiBerkas::index');
    $routes->get('verifikasi-berkas/data', 'VerifikasiBerkas::getData');
    $routes->get('verifikasi-berkas/detail/(:num)', 'VerifikasiBerkas::detail/$1');
    $routes->post('verifikasi-berkas/proses/(:num)', 'VerifikasiBerkas::proses/$1');

    //laporan bendahara
    $routes->get('laporan', 'BendaharaLaporan::index');
    $routes->get('laporan/export', 'BendaharaLaporan::export');

    // Halaman induk laporan operator
    $routes->get('laporan-operator', 'OperatorLaporan::index');

    // Halaman spesifik
    $routes->get('laporan-operator/jumlah_per_status', 'OperatorLaporan::jumlahPerStatus');
    $routes->get('laporan-operator/jumlah_per_modul', 'OperatorLaporan::jumlahPerModul');
    $routes->get('laporan-operator/total_biaya_per_modul', 'OperatorLaporan::totalBiayaPerModul');
    $routes->get('laporan-operator/rekap_per_seksi', 'OperatorLaporan::rekapPerSeksi');

    // Export PDF (bisa per halaman atau satu untuk semua)
    $routes->get('laporan-operator/export', 'OperatorLaporan::exportPdf');
});