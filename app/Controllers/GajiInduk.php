<?php
namespace App\Controllers;

use App\Models\GajiIndukModel;
use App\Models\BerkasModel;

class GajiInduk extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new GajiIndukModel();
        helper(['form', 'url']);
    }

    public function index()
    {
        $data['title'] = 'Gaji Induk';
        return view('gaji_induk/index', $data);
    }

    public function getData()
    {
        $data = $this->model->orderBy('created_at', 'DESC')->findAll();
        return $this->response->setJSON(['data' => $data]);
    }

    public function input()
    {
        // Cek role operator (sama seperti PerjalananDinas)
        if (session()->get('role') !== 'operator') {
            return redirect()->to('/dashboard')->with('error', 'Akses hanya untuk operator!');
        }

        $data['title'] = 'Input Gaji Induk';
        return view('gaji_induk/input', $data);
    }

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

        $model = new GajiIndukModel();
        $id_modul = $model->insert($this->request->getPost());

        $berkasModel = new BerkasModel();
        $berkasId = $berkasModel->insert([
            'no_berkas'       => 'GI-' . date('Y') . '-' . str_pad($id_modul, 4, '0', STR_PAD_LEFT),
            'jenis_modul'     => 'gaji_induk',
            'id_modul'        => $id_modul,
            'status'          => 'menunggu_persetujuan',
            'operator_id'     => session()->get('id'),
            'created_at'      => date('Y-m-d H:i:s')
        ]);

        $this->buatApprovalSteps($berkasId, 'gaji_induk');
        // Setelah simpan ke tabel berkas
        $this->logActivity($id_modul, 'create', 'Operator membuat berkas baru');

        return redirect()->to('gaji-induk')->with('success', 'Data berhasil disimpan dan masuk ke proses approval!');
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Gaji Induk';
        $data['gi'] = $this->model->find($id);
        if (!$data['gi']) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        return view('gaji_induk/edit', $data);
    }

    public function detail($id)
    {
        $data['title'] = 'Detail Gaji Induk';
        $data['gi'] = $this->model->find($id);
        if (!$data['gi']) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        return view('gaji_induk/detail', $data);
    }

    public function update($id)
    {
        $this->model->update($id, $this->request->getPost());
        return redirect()->to('gaji-induk')->with('success', 'Data berhasil diupdate!');
    }

    public function hapus($id)
    {
        $this->model->delete($id);
        return $this->response->setJSON(['status' => 'success']);
    }
}