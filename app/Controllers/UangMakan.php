<?php
namespace App\Controllers;

use App\Models\UangMakanModel;
use App\Models\BerkasModel;

class UangMakan extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new UangMakanModel();
        helper(['form', 'url']);
    }

    public function index()
    {
        $data['title'] = 'Uang Makan';
        return view('uang_makan/index', $data);
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

        $data['title'] = 'Input Uang Makan';
        return view('uang_makan/input', $data);
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

        $model = new UangMakanModel();
        $id_modul = $model->insert($this->request->getPost());

        $berkasModel = new BerkasModel();
        $berkasId = $berkasModel->insert([
            'no_berkas'       => 'UM-' . date('Y') . '-' . str_pad($id_modul, 4, '0', STR_PAD_LEFT),
            'jenis_modul'     => 'uang_makan',
            'id_modul'        => $id_modul,
            'status'          => 'menunggu_persetujuan',
            'operator_id'     => session()->get('id'),
            'created_at'      => date('Y-m-d H:i:s')
        ]);

        $this->buatApprovalSteps($berkasId, 'uang_makan');

        return redirect()->to('uang-makan')->with('success', 'Data berhasil disimpan dan masuk ke proses approval!');
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Uang Makan';
        $data['um'] = $this->model->find($id);
        if (!$data['um']) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        return view('uang_makan/edit', $data);
    }

    public function update($id)
    {
        $this->model->update($id, $this->request->getPost());
        return redirect()->to('uang-makan')->with('success', 'Data berhasil diupdate!');
    }

    public function hapus($id)
    {
        $this->model->delete($id);
        return $this->response->setJSON(['status' => 'success']);
    }

    public function detail($id)
    {
        $data['title'] = 'Detail Uang Makan';
        $data['um'] = $this->model->find($id);
        if (!$data['um']) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        return view('uang_makan/detail', $data);
    }
}