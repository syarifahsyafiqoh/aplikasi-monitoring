<?php
namespace App\Controllers;

use App\Models\BerkasModel;

class OperatorLaporan extends BaseController
{
    protected $berkasModel;

    public function __construct()
    {
        $this->berkasModel = new BerkasModel();
    }

    // Halaman Induk (4 card)
    public function index()
    {
        $data = [
            'title' => 'Laporan Saya',
        ];

        return view('operator/laporan/index', $data);
    }

    // Halaman 1: Rekap Jumlah Berkas per Status
    public function jumlahPerStatus()
    {
        $operator_id = session()->get('id');

        $rekap_status = $this->berkasModel
            ->select('status, COUNT(*) as jumlah')
            ->where('operator_id', $operator_id)
            ->groupBy('status')
            ->findAll();

        $data = [
            'title'        => 'Rekap Jumlah Berkas per Status',
            'rekap_status' => $rekap_status,
        ];

        // Jika ?print=1, render view cetak khusus
        if ($this->request->getGet('print') === '1') {
            return view('operator/laporan/cetak_jumlah_per_status', $data);
        }

        return view('operator/laporan/jumlah_per_status', $data);
    }

    // Halaman 2: Rekap Jumlah Berkas per Modul
    public function jumlahPerModul()
    {
        $operator_id = session()->get('id');

        $rekap_modul = $this->berkasModel
            ->select('jenis_modul, COUNT(*) as jumlah')
            ->where('operator_id', $operator_id)
            ->groupBy('jenis_modul')
            ->findAll();

        $data = [
            'title'        => 'Rekap Jumlah Berkas per Modul',
            'rekap_modul'  => $rekap_modul,
        ];

        // Jika ?print=1, render view cetak khusus
        if ($this->request->getGet('print') === '1') {
            return view('operator/laporan/cetak_jumlah_per_modul', $data);
        }

        return view('operator/laporan/jumlah_per_modul', $data);
    }

    // Halaman 3: Rekap Total Anggaran/Biaya per Modul
    public function totalBiayaPerModul()
    {
        $operator_id = session()->get('id');

        $rekap_biaya = $this->berkasModel
            ->select('jenis_modul, 
                    SUM(CASE WHEN jenis_modul = "perjalanan_dinas" THEN (pd.harian_perjalanan + pd.penginapan + pd.transport) ELSE 0 END) as total_pd,
                    SUM(CASE WHEN jenis_modul = "gaji_induk" THEN gi.total_netto ELSE 0 END) as total_gaji,
                    SUM(CASE WHEN jenis_modul = "tunjangan_kinerja" THEN tk.total_netto ELSE 0 END) as total_tk,
                    SUM(CASE WHEN jenis_modul = "uang_makan" THEN um.total_netto ELSE 0 END) as total_um,
                    SUM(CASE WHEN jenis_modul = "honorarium" THEN ho.total_netto ELSE 0 END) as total_honor,
                    SUM(CASE WHEN jenis_modul = "kontraktual" THEN kt.total_uang_netto ELSE 0 END) as total_kontrak,
                    SUM(CASE WHEN jenis_modul = "gup" THEN 0 ELSE 0 END) as total_gup')
            ->where('berkas.operator_id', $operator_id)
            ->join('perjalanan_dinas as pd', 'pd.id = berkas.id_modul AND berkas.jenis_modul = "perjalanan_dinas"', 'left')
            ->join('gaji_induk as gi', 'gi.id = berkas.id_modul AND berkas.jenis_modul = "gaji_induk"', 'left')
            ->join('tunjangan_kinerja as tk', 'tk.id = berkas.id_modul AND berkas.jenis_modul = "tunjangan_kinerja"', 'left')
            ->join('uang_makan as um', 'um.id = berkas.id_modul AND berkas.jenis_modul = "uang_makan"', 'left')
            ->join('honorarium as ho', 'ho.id = berkas.id_modul AND berkas.jenis_modul = "honorarium"', 'left')
            ->join('kontraktual as kt', 'kt.id = berkas.id_modul AND berkas.jenis_modul = "kontraktual"', 'left')
            ->join('gup as g', 'g.id = berkas.id_modul AND berkas.jenis_modul = "gup"', 'left')
            ->groupBy('berkas.jenis_modul')
            ->findAll();

        $grand_total = 0;
        foreach ($rekap_biaya as $r) {
            $grand_total += $r['total_pd'] + $r['total_gaji'] + $r['total_tk'] + $r['total_um'] + $r['total_honor'] + $r['total_kontrak'] + $r['total_gup'];
        }

        $data = [
            'title'       => 'Rekap Total Anggaran / Biaya per Modul',
            'rekap_biaya' => $rekap_biaya,
            'grand_total' => $grand_total,
        ];

        // Jika ?print=1, render view cetak khusus
        if ($this->request->getGet('print') === '1') {
            return view('operator/laporan/cetak_total_biaya_per_modul', $data);
        }

        return view('operator/laporan/total_biaya_per_modul', $data);
    }

    // Halaman 4: Riwayat Verifikasi & Rekap per Seksi
    public function rekapPerSeksi()
    {
        $operator_id = session()->get('id');

        $rekap_seksi = $this->berkasModel
            ->select("
                COALESCE(
                    pd.seksi,
                    gi.seksi,
                    tk.seksi,
                    um.seksi,
                    ho.seksi,
                    kt.seksi,
                    g.seksi,
                    'Tidak Diketahui'
                ) as seksi,
                COUNT(*) as jumlah
            ")
            ->where('berkas.operator_id', $operator_id)
            ->join('perjalanan_dinas as pd', 'pd.id = berkas.id_modul AND berkas.jenis_modul = "perjalanan_dinas"', 'left')
            ->join('gaji_induk as gi', 'gi.id = berkas.id_modul AND berkas.jenis_modul = "gaji_induk"', 'left')
            ->join('tunjangan_kinerja as tk', 'tk.id = berkas.id_modul AND berkas.jenis_modul = "tunjangan_kinerja"', 'left')
            ->join('uang_makan as um', 'um.id = berkas.id_modul AND berkas.jenis_modul = "uang_makan"', 'left')
            ->join('honorarium as ho', 'ho.id = berkas.id_modul AND berkas.jenis_modul = "honorarium"', 'left')
            ->join('kontraktual as kt', 'kt.id = berkas.id_modul AND berkas.jenis_modul = "kontraktual"', 'left')
            ->join('gup as g', 'g.id = berkas.id_modul AND berkas.jenis_modul = "gup"', 'left')
            ->groupBy('seksi')
            ->orderBy('jumlah', 'DESC')
            ->findAll();

        $data = [
            'title'       => 'Rekap Berkas per Seksi',
            'rekap_seksi' => $rekap_seksi,
        ];

        // Untuk print khusus, bisa langsung render view cetak
        if ($this->request->getGet('print') === '1') {
            return view('operator/laporan/cetak_rekap_per_seksi', $data);
        }

        return view('operator/laporan/rekap_per_seksi', $data);
    }
}