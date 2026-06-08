<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BerkasModel;

class Dashboard extends BaseController
{
    protected $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();
    }

    // Helper: cek login
    protected function requireLogin()
    {
        if (! $this->session->get('logged_in')) {
            return redirect()->to('/login');
        }
        return null;
    }

    // Dashboard utama: redirect sesuai role
    public function index()
    {
        if ($redirect = $this->requireLogin()) return $redirect;

        $role = $this->session->get('role');
        return redirect()->to("/dashboard/{$role}");
    }

    // Dashboard Operator
    public function operator()
    {
        if ($redirect = $this->requireLogin()) return $redirect;
        if ($this->session->get('role') !== 'operator') {
            return redirect()->to('/dashboard');
        }

        $operatorId = (int) $this->session->get('id');
        $berkasModel = new BerkasModel();

        $berkasList = $berkasModel
            ->where('operator_id', $operatorId)
            ->orderBy('created_at', 'DESC')
            ->findAll();

        $berkasMasukHariIni = $berkasModel
            ->where('operator_id', $operatorId)
            ->where('DATE(created_at)', date('Y-m-d'))
            ->countAllResults();

        $sedangDiproses = $berkasModel
            ->where('operator_id', $operatorId)
            ->where('status', 'menunggu_verifikasi')
            ->countAllResults();

        $selesaiHariIni = $berkasModel
            ->where('operator_id', $operatorId)
            ->where('status', 'diverifikasi')
            ->where('DATE(updated_at)', date('Y-m-d'))
            ->countAllResults();

        $totalBulanIni = $berkasModel
            ->where('operator_id', $operatorId)
            ->where('YEAR(created_at)', date('Y'))
            ->where('MONTH(created_at)', date('m'))
            ->countAllResults();

        $data = [
            'title' => 'Dashboard Operator',
            'berkas_masuk_hari_ini' => $berkasMasukHariIni,
            'sedang_diproses' => $sedangDiproses,
            'selesai_hari_ini' => $selesaiHariIni,
            'total_berkas_bulan_ini' => $totalBulanIni,
            'berkas_list' => $berkasList,
        ];

        return view('dashboard/operator', $data);
    }

    // Dashboard Bendahara
    public function bendahara()
    {
        if ($redirect = $this->requireLogin()) return $redirect;
        if ($this->session->get('role') !== 'bendahara') {
            return redirect()->to('/dashboard');
        }

        $berkasModel = new \App\Models\BerkasModel();

        // Statistik utama
        $menunggu_verifikasi = $berkasModel
            ->where('status', 'menunggu_verifikasi')
            ->countAllResults();

        $diverifikasi_hari_ini = $berkasModel
            ->where('status', 'diverifikasi')
            ->where('DATE(verified_at)', date('Y-m-d'))
            ->countAllResults();

        $ditolak = $berkasModel
            ->where('status', 'ditolak')
            ->countAllResults();

        // Berkas terbaru menunggu verifikasi (5 terakhir)
        $berkas_terbaru = $berkasModel
            ->select('berkas.*, users.username as operator_name')
            ->join('users', 'users.id = berkas.operator_id', 'left')
            ->where('berkas.status', 'menunggu_verifikasi')
            ->orderBy('berkas.created_at', 'DESC')
            ->limit(5)
            ->findAll();

        $data = [
            'title'                  => 'Dashboard Bendahara',
            'menunggu_verifikasi'    => $menunggu_verifikasi,
            'diverifikasi_hari_ini'  => $diverifikasi_hari_ini,
            'ditolak'                => $ditolak,
            'berkas_terbaru'         => $berkas_terbaru,
        ];

        return view('dashboard/bendahara', $data);
    }

    // Dashboard Admin
    public function admin()
    {
        if ($redirect = $this->requireLogin()) return $redirect;
        if ($this->session->get('role') !== 'admin') {
            return redirect()->to('/dashboard');
        }

        $data = [
            'title' => 'Dashboard Admin'
        ];

        return view('dashboard/admin', $data);
    }

    public function getDashboardStats()
    {
        $userModel = new \App\Models\UserModel(); 

        $total_users     = $userModel->countAllResults();
        $total_admin     = $userModel->where('role', 'admin')->countAllResults();
        $total_bendahara = $userModel->where('role', 'bendahara')->countAllResults();
        $total_operator  = $userModel->where('role', 'operator')->countAllResults();

        $data = [
            'total_users'     => $total_users,
            'total_admin'     => $total_admin,
            'total_bendahara' => $total_bendahara,
            'total_operator'  => $total_operator,
        ];

        return $this->response->setJSON($data);
    }
}
