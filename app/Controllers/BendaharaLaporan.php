<?php
namespace App\Controllers;

use App\Models\BerkasModel;

class BendaharaLaporan extends BaseController
{
    protected $berkasModel;

    public function __construct()
    {
        $this->berkasModel = new BerkasModel();
    }

    public function index()
    {
        if (session()->get('role') !== 'bendahara') {
            return redirect()->to('/dashboard');
        }

        $berkasTerverifikasi = $this->berkasModel
            ->select('berkas.*, users.username as operator_name')
            ->join('users', 'users.id = berkas.operator_id', 'left')
            ->where('berkas.status', 'diverifikasi')
            ->orderBy('berkas.updated_at', 'DESC')
            ->findAll();

        $rekapModul = $this->berkasModel
            ->select('jenis_modul, COUNT(*) as jumlah')
            ->where('status', 'diverifikasi')
            ->groupBy('jenis_modul')
            ->orderBy('jumlah', 'DESC')
            ->findAll();

        $data = [
            'title'                => 'Laporan Verifikasi Berkas',
            'total_terverifikasi'  => count($berkasTerverifikasi),
            'rekap_modul'          => $rekapModul,
            'berkas_terverifikasi' => $berkasTerverifikasi,
        ];

        // Jika ada parameter ?print=1, render view cetak khusus (tanpa layout sidebar)
        if ($this->request->getGet('print') === '1') {
            return view('bendahara/laporan/cetak_berkas_terverifikasi', $data);
        }

        // Jika tidak, tampilkan halaman normal dengan layout sidebar
        return view('bendahara/laporan/index', $data);
    }
}