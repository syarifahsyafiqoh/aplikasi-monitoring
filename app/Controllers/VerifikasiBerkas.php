<?php
namespace App\Controllers;

use App\Models\BerkasModel;
use App\Models\PerjalananDinasModel;
use App\Models\GajiIndukModel;
use App\Models\TunjanganKinerjaModel;
use App\Models\UangMakanModel;
use App\Models\HonorariumModel;
use App\Models\KontraktualModel;
use App\Models\GupModel;

class VerifikasiBerkas extends BaseController
{
    protected $berkasModel;

    public function __construct()
    {
        $this->berkasModel = new BerkasModel();
        helper(['form', 'url']);
    }

    public function index()
    {
        if (session()->get('role') !== 'bendahara') {
            return redirect()->to('/dashboard');
        }

        $data['title'] = 'Verifikasi Berkas';
        return view('bendahara/verifikasi/index', $data);
    }

    // public function getData()
    // {
    //     $berkas = $this->berkasModel
    //                    ->select('berkas.*, users.username as operator_name')
    //                    ->join('users', 'users.id = berkas.operator_id', 'left')
    //                    ->where('berkas.status', 'menunggu_persetujuan')
    //                    ->orderBy('berkas.created_at', 'DESC')
    //                    ->findAll();

    //     // Ambil detail dari modul asal
    //     foreach ($berkas as &$b) {
    //         $detail = null;
    //         switch ($b['jenis_modul']) {
    //             case 'perjalanan_dinas':
    //                 $model = new PerjalananDinasModel();
    //                 $detail = $model->find($b['id_modul']);
    //                 break;
    //             case 'gaji_induk':
    //                 $model = new GajiIndukModel();
    //                 $detail = $model->find($b['id_modul']);
    //                 break;
    //             case 'tunjangan_kinerja':
    //                 $model = new TunjanganKinerjaModel();
    //                 $detail = $model->find($b['id_modul']);
    //                 break;
    //             case 'uang_makan':
    //                 $model = new UangMakanModel();
    //                 $detail = $model->find($b['id_modul']);
    //                 break;
    //             case 'honorarium':
    //                 $model = new HonorariumModel();
    //                 $detail = $model->find($b['id_modul']);
    //                 break;
    //             case 'kontraktual':
    //                 $model = new KontraktualModel();
    //                 $detail = $model->find($b['id_modul']);
    //                 break;
    //             case 'gup':
    //                 $model = new GupModel();
    //                 $detail = $model->find($b['id_modul']);
    //                 break;
    //         }
    //         $b['detail'] = $detail;
    //     }

    //     return $this->response->setJSON(['data' => $berkas]);
    // }

    public function getData()
    {
        $berkas = $this->berkasModel
            ->select('berkas.*, users.username as operator_name')
            ->join('users', 'users.id = berkas.operator_id', 'left')
            ->orderBy('berkas.created_at', 'DESC')
            ->findAll();

        // Ambil detail modul untuk setiap berkas
        foreach ($berkas as &$b) {
            $detail = null;
            switch ($b['jenis_modul']) {
                case 'perjalanan_dinas':
                    $model = new \App\Models\PerjalananDinasModel();
                    $detail = $model->find($b['id_modul']);
                    break;
                case 'gaji_induk':
                    $model = new \App\Models\GajiIndukModel();
                    $detail = $model->find($b['id_modul']);
                    break;
                case 'tunjangan_kinerja':
                    $model = new \App\Models\TunjanganKinerjaModel();
                    $detail = $model->find($b['id_modul']);
                    break;
                case 'uang_makan':
                    $model = new \App\Models\UangMakanModel();
                    $detail = $model->find($b['id_modul']);
                    break;
                case 'honorarium':
                    $model = new \App\Models\HonorariumModel();
                    $detail = $model->find($b['id_modul']);
                    break;
                case 'kontraktual':
                    $model = new \App\Models\KontraktualModel();
                    $detail = $model->find($b['id_modul']);
                    break;
                case 'gup':
                    $model = new \App\Models\GupModel();
                    $detail = $model->find($b['id_modul']);
                    break;
            }
            $b['detail'] = $detail;
        }

        return $this->response->setJSON(['data' => $berkas]);
    }

    public function detail($id)
    {
        if (session()->get('role') !== 'bendahara') {
            return redirect()->to('/dashboard');
        }

        $berkas = $this->berkasModel->find($id);
        if (!$berkas) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Ambil detail modul sesuai jenis
        $detail = null;
        switch ($berkas['jenis_modul']) {
            case 'perjalanan_dinas':
                $model = new \App\Models\PerjalananDinasModel();
                $detail = $model->find($berkas['id_modul']);
                break;
            case 'gaji_induk':
                $model = new \App\Models\GajiIndukModel();
                $detail = $model->find($berkas['id_modul']);
                break;
            case 'tunjangan_kinerja':
                $model = new \App\Models\TunjanganKinerjaModel();
                $detail = $model->find($berkas['id_modul']);
                break;
            case 'uang_makan':
                $model = new \App\Models\UangMakanModel();
                $detail = $model->find($berkas['id_modul']);
                break;
            case 'honorarium':
                $model = new \App\Models\HonorariumModel();
                $detail = $model->find($berkas['id_modul']);
                break;
            case 'kontraktual':
                $model = new \App\Models\KontraktualModel();
                $detail = $model->find($berkas['id_modul']);
                break;
            case 'gup':
                $model = new \App\Models\GupModel();
                $detail = $model->find($berkas['id_modul']);
                break;
        }

        // Ambil riwayat approval
        $berkasApprovalModel = new \App\Models\BerkasApproval();
        $approval_history = $berkasApprovalModel
            ->select('berkas_approvals.*, workflow_steps.role, workflow_steps.urutan')
            ->join('workflow_steps', 'workflow_steps.id = berkas_approvals.workflow_step_id')
            ->where('berkas_approvals.berkas_id', $id)
            ->orderBy('workflow_steps.urutan', 'ASC')
            ->findAll();

        // Ambil langkah yang sedang aktif (pending)
        $current_step = $berkasApprovalModel
            ->select('berkas_approvals.*, workflow_steps.role, workflow_steps.urutan')
            ->join('workflow_steps', 'workflow_steps.id = berkas_approvals.workflow_step_id')
            ->where('berkas_approvals.berkas_id', $id)
            ->where('berkas_approvals.status', 'pending')
            ->orderBy('workflow_steps.urutan', 'ASC')
            ->first();

        $data = [
            'title'             => 'Detail & Verifikasi Berkas',
            'berkas'            => $berkas,
            'detail'            => $detail,
            'approval_history'  => $approval_history,
            'current_step'      => $current_step,
        ];

        return view('bendahara/verifikasi/detail', $data);
    }

    // Proses Approval dengan Workflow
    public function proses($id)
    {
        if (session()->get('role') !== 'bendahara') {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Akses ditolak']);
        }

        $post    = $this->request->getPost();
        $status  = $post['status'] ?? ''; 
        $catatan = $post['catatan'] ?? null;

        if (!in_array($status, ['diverifikasi', 'ditolak'])) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Status tidak valid']);
        }

        // Update tabel berkas utama
        $this->berkasModel->update($id, [
            'status'            => $status,
            'catatan_bendahara' => $catatan,
            'updated_at'        => date('Y-m-d H:i:s')
        ]);

        // Update riwayat approval
        $approvalModel = new \App\Models\BerkasApproval();
        
        $approvalModel->where('berkas_id', $id)
                    ->where('role', 'bendahara')
                    ->set([
                        'status'      => ($status === 'diverifikasi') ? 'approved' : 'rejected',
                        'approved_at' => date('Y-m-d H:i:s'),
                        'catatan'     => $catatan
                    ])
                    ->update();

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => ($status === 'diverifikasi') ? 'Berkas berhasil diverifikasi!' : 'Berkas telah ditolak!'
        ]);
    }

    // Halaman utama Kepala Balai
    public function kepalaBalaiIndex()
    {
        if (session()->get('role') !== 'kepala_balai') {
            return redirect()->to('/dashboard');
        }

        $data['title'] = 'Persetujuan Akhir - Kepala Balai';
        return view('kepala_balai/index', $data);
    }

    // Detail persetujuan
    public function kepalaBalaiDetail($id)
    {
        if (session()->get('role') !== 'kepala_balai') {
            return redirect()->to('/dashboard');
        }

        $berkasModel = new \App\Models\BerkasModel();
        $berkas = $berkasModel->select('berkas.*, users.username as operator_name')
                            ->join('users', 'users.id = berkas.operator_id', 'left')
                            ->find($id);

        if (!$berkas || $berkas['status'] !== 'diverifikasi') {
            return redirect()->to('persetujuan-kepala')->with('error', 'Berkas tidak ditemukan atau bukan tahap persetujuan Anda');
        }

        // Ambil detail modul
        $detail = null;
        switch ($berkas['jenis_modul']) {
            case 'perjalanan_dinas': $model = new \App\Models\PerjalananDinasModel(); $detail = $model->find($berkas['id_modul']); break;
            case 'gaji_induk': $model = new \App\Models\GajiIndukModel(); $detail = $model->find($berkas['id_modul']); break;
            case 'tunjangan_kinerja': $model = new \App\Models\TunjanganKinerjaModel(); $detail = $model->find($berkas['id_modul']); break;
            case 'uang_makan': $model = new \App\Models\UangMakanModel(); $detail = $model->find($berkas['id_modul']); break;
            case 'honorarium': $model = new \App\Models\HonorariumModel(); $detail = $model->find($berkas['id_modul']); break;
            case 'kontraktual': $model = new \App\Models\KontraktualModel(); $detail = $model->find($berkas['id_modul']); break;
            case 'gup': $model = new \App\Models\GupModel(); $detail = $model->find($berkas['id_modul']); break;
            // tambahkan case lain jika perlu
        }

        $data = [
            'title'  => 'Persetujuan Akhir',
            'berkas' => $berkas,
            'detail' => $detail
        ];

        return view('kepala_balai/detail', $data);
    }

    // Proses Approve / Tolak oleh Kepala Balai
    public function kepalaBalaiProses($id)
    {
        if (session()->get('role') !== 'kepala_balai') {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Akses ditolak']);
        }

        $status  = $this->request->getPost('status');
        $catatan = $this->request->getPost('catatan');

        if (!in_array($status, ['disetujui', 'ditolak'])) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Status tidak valid']);
        }

        $berkasModel = new \App\Models\BerkasModel();
        $berkasModel->update($id, [
            'status'            => $status,
            'catatan_bendahara' => $catatan,
            'updated_at'        => date('Y-m-d H:i:s')
        ]);

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => ($status === 'disetujui') ? 'Berkas berhasil disetujui!' : 'Berkas telah ditolak!'
        ]);
    }

    // Data untuk tabel Kepala Balai (AJAX)
    public function kepalaBalaiData()
    {
        if (session()->get('role') !== 'kepala_balai') {
            return $this->response->setJSON(['data' => []]);
        }

        $berkasModel = new \App\Models\BerkasModel();

        $berkas = $berkasModel
            ->select('berkas.*, users.username as operator_name')
            ->join('users', 'users.id = berkas.operator_id', 'left')
            ->where('berkas.status', 'diverifikasi')
            ->orderBy('berkas.updated_at', 'DESC')
            ->findAll();

        // Debug
        log_message('error', 'Kepala Balai Data - Jumlah berkas: ' . count($berkas));

        return $this->response->setJSON(['data' => $berkas]);
    }

    // Detail sudah ada sebelumnya, pastikan method kepalaBalaiDetail ada
    // Proses sudah ada sebelumnya

    // Riwayat Persetujuan Kepala Balai
    public function kepalaBalaiRiwayat()
    {
        if (session()->get('role') !== 'kepala_balai') {
            return redirect()->to('/dashboard');
        }

        $berkasModel = new \App\Models\BerkasModel();

        $data = [
            'title' => 'Riwayat Persetujuan Kepala Balai',
            'riwayat' => $berkasModel
                        ->select('berkas.*, users.username as operator_name')
                        ->join('users', 'users.id = berkas.operator_id', 'left')
                        ->where('berkas.status', 'disetujui')
                        ->orderBy('berkas.updated_at', 'DESC')
                        ->findAll()
        ];

        return view('kepala_balai/riwayat', $data);
    }
}
