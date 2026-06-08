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

    public function getData()
    {
        $berkas = $this->berkasModel
                       ->select('berkas.*, users.username as operator_name')
                       ->join('users', 'users.id = berkas.operator_id', 'left')
                       ->where('berkas.status', 'menunggu_verifikasi')
                       ->orderBy('berkas.created_at', 'DESC')
                       ->findAll();

        // Ambil detail dari modul asal
        foreach ($berkas as &$b) {
            $detail = null;
            switch ($b['jenis_modul']) {
                case 'perjalanan_dinas':
                    $model = new PerjalananDinasModel();
                    $detail = $model->find($b['id_modul']);
                    break;
                case 'gaji_induk':
                    $model = new GajiIndukModel();
                    $detail = $model->find($b['id_modul']);
                    break;
                case 'tunjangan_kinerja':
                    $model = new TunjanganKinerjaModel();
                    $detail = $model->find($b['id_modul']);
                    break;
                case 'uang_makan':
                    $model = new UangMakanModel();
                    $detail = $model->find($b['id_modul']);
                    break;
                case 'honorarium':
                    $model = new HonorariumModel();
                    $detail = $model->find($b['id_modul']);
                    break;
                case 'kontraktual':
                    $model = new KontraktualModel();
                    $detail = $model->find($b['id_modul']);
                    break;
                case 'gup':
                    $model = new GupModel();
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
        if (!$berkas) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

        $detail = null;
        switch ($berkas['jenis_modul']) {
            case 'perjalanan_dinas':
                $model = new PerjalananDinasModel();
                $detail = $model->find($berkas['id_modul']);
                break;
            case 'gaji_induk':
                $model = new GajiIndukModel();
                $detail = $model->find($berkas['id_modul']);
                break;
            // tambah case untuk modul lain seperti atas
            case 'tunjangan_kinerja':
                $model = new TunjanganKinerjaModel();
                $detail = $model->find($berkas['id_modul']);
                break;
            case 'uang_makan':
                $model = new UangMakanModel();
                $detail = $model->find($berkas['id_modul']);
                break;
            case 'honorarium':
                $model = new HonorariumModel();
                $detail = $model->find($berkas['id_modul']);
                break;
            case 'kontraktual':
                $model = new KontraktualModel();
                $detail = $model->find($berkas['id_modul']);
                break;
            case 'gup':
                $model = new GupModel();
                $detail = $model->find($berkas['id_modul']);
                break;
        }

        $data['berkas'] = $berkas;
        $data['detail'] = $detail;
        $data['title'] = 'Verifikasi Berkas - ' . ucwords(str_replace('_', ' ', $berkas['jenis_modul']));

        return view('bendahara/verifikasi/detail', $data);
    }

    public function proses($id)
    {
        if (session()->get('role') !== 'bendahara') {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Akses ditolak']);
        }

        $post = $this->request->getPost();
        $status = $post['status'];
        $catatan = $post['catatan'] ?? null;

        $this->berkasModel->update($id, [
            'status' => $status,
            'catatan_bendahara' => $catatan
        ]);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => $status === 'diverifikasi' ? 'Berkas berhasil diverifikasi!' : 'Berkas ditolak!'
        ]);
    }
}
