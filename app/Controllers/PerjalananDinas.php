<?php
namespace App\Controllers;

use App\Models\PerjalananDinasModel;
use App\Models\BerkasModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class PerjalananDinas extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new PerjalananDinasModel();
        helper(['form', 'url']);
    }

    public function index()
    {
        $data['title'] = 'Daftar Perjalanan Dinas';

        // Cek apakah user minta mode cetak (?print=1)
        if ($this->request->getGet('print') === '1') {
            $perjalanan_dinas = $this->model
                ->orderBy('created_at', 'DESC')
                ->findAll();

            $data['perjalanan_dinas'] = $perjalanan_dinas;

            // Render view cetak khusus
            return view('perjalanan_dinas/cetak_perjadin', $data);
        }

        return view('perjalanan_dinas/index', $data);
    }

    public function getData()
    {
        $data = $this->model->orderBy('created_at', 'DESC')->findAll();
        return $this->response->setJSON(['data' => $data]);
    }

    public function input()
    {
        if (session()->get('role') !== 'operator') {
            return redirect()->to('/dashboard');
        }
        $data['title'] = 'Input Perjalanan Dinas Baru';
        return view('perjalanan_dinas/input', $data);
    }

    // public function simpan()
    // {
    //     $this->model->insert($this->request->getPost());
    //     return redirect()->to('perjalanan-dinas')->with('success', 'Data berhasil disimpan!');
    // }

    // Method helper untuk membuat approval steps
    private function buatApprovalSteps($berkasId, $jenisModul)
    {
        $workflowModel = new \App\Models\Workflow();
        $workflowStepModel = new \App\Models\WorkflowStep();
        $berkasApprovalModel = new \App\Models\BerkasApproval();

        // Ambil workflow untuk modul ini
        $workflow = $workflowModel->where('jenis_modul', $jenisModul)->first();

        if (!$workflow) {
            // Jika belum ada workflow, buat default
            $workflowId = $workflowModel->insert([
                'nama_workflow' => 'Default ' . ucwords(str_replace('_', ' ', $jenisModul)),
                'jenis_modul'   => $jenisModul,
                'is_active'     => 1
            ]);

            // Default workflow: Operator → Bendahara → Kepala Balai
            $defaultSteps = ['bendahara', 'kepala_balai'];
            $urutan = 1;
            foreach ($defaultSteps as $role) {
                $workflowStepModel->insert([
                    'workflow_id' => $workflowId,
                    'urutan'      => $urutan++,
                    'role'        => $role
                ]);
            }
            $workflow = $workflowModel->find($workflowId);
        }

        // Ambil steps workflow
        $steps = $workflowStepModel->where('workflow_id', $workflow['id'])
                                ->orderBy('urutan', 'ASC')
                                ->findAll();

        // Buat record approval untuk setiap step
        foreach ($steps as $step) {
            $berkasApprovalModel->insert([
                'berkas_id'        => $berkasId,
                'workflow_step_id' => $step['id'],
                'status'           => 'pending',
                'created_at'       => date('Y-m-d H:i:s')
            ]);
        }
    }


    public function simpan()
    {
        if (session()->get('role') !== 'operator') {
            return redirect()->to('/dashboard')->with('error', 'Akses hanya untuk Operator!');
        }

        $model = new PerjalananDinasModel();
        $data = $this->request->getPost();

        // 1. Simpan data ke tabel perjalanan_dinas
        $id_modul = $model->insert($data);

        // 2. Simpan ke tabel master berkas
        $berkasModel = new BerkasModel();
        $berkasId = $berkasModel->insert([
            'no_berkas'       => 'PD-' . date('Y') . '-' . str_pad($id_modul, 4, '0', STR_PAD_LEFT),
            'jenis_modul'     => 'perjalanan_dinas',
            'id_modul'        => $id_modul,
            'status'          => 'menunggu_persetujuan',   // Ubah status awal
            'operator_id'     => session()->get('id'),
            'created_at'      => date('Y-m-d H:i:s')
        ]);

        // 3. Buat approval steps sesuai workflow
        $this->buatApprovalSteps($berkasId, 'perjalanan_dinas');

        return redirect()->to('perjalanan-dinas')->with('success', 'Data berhasil disimpan dan masuk ke proses approval!');
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Perjalanan Dinas';
        $data['pd'] = $this->model->find($id);
        if (!$data['pd']) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        return view('perjalanan_dinas/edit', $data);
    }

    public function detail($id)
    {
        $data['title'] = 'Detail Perjalanan Dinas';
        $data['pd'] = $this->model->find($id);
        if (!$data['pd']) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        return view('perjalanan_dinas/detail', $data);
    }

    public function update($id)
    {
        $this->model->update($id, $this->request->getPost());
        return redirect()->to('perjalanan-dinas')->with('success', 'Data berhasil diupdate!');
    }

    public function hapus($id)
    {
        $this->model->delete($id);
        return $this->response->setJSON(['status' => 'success']);
    }
}