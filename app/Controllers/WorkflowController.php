<?php

namespace App\Controllers;

use App\Models\Workflow;
use App\Models\WorkflowStep;
use App\Models\BerkasModel;

class WorkflowController extends BaseController
{
    protected $workflowModel;
    protected $workflowStepModel;
    protected $berkasModel;

    public function __construct()
    {
        $this->workflowModel     = new Workflow();
        $this->workflowStepModel = new WorkflowStep();
        $this->berkasModel       = new BerkasModel();
        
        helper(['form', 'url']);
    }

    // Halaman utama pengelolaan workflow (Admin only)
    public function index()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Akses hanya untuk Admin!');
        }

        $workflows = $this->workflowModel->findAll();

        // Ambil steps untuk setiap workflow
        foreach ($workflows as &$w) {
            $w['steps'] = $this->workflowStepModel
                            ->where('workflow_id', $w['id'])
                            ->orderBy('urutan', 'ASC')
                            ->findAll();
        }

        $data = [
            'title'     => 'Pengelolaan Workflow Approval',
            'workflows' => $workflows
        ];

        return view('workflow/index', $data);
    }

    // Form tambah / edit workflow
    public function form($id = null)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard');
        }

        $data = [
            'title' => $id ? 'Edit Workflow' : 'Tambah Workflow Baru',
            'workflow' => $id ? $this->workflowModel->find($id) : null,
            'steps' => $id ? $this->workflowStepModel->where('workflow_id', $id)
                            ->orderBy('urutan', 'ASC')->findAll() : []
        ];

        return view('workflow/form', $data);
    }

    // Simpan workflow + steps
    public function save()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard');
        }

        $jenisModul = $this->request->getPost('jenis_modul');

        // Cek apakah workflow untuk modul ini sudah ada
        $existing = $this->workflowModel->where('jenis_modul', $jenisModul)->first();

        if ($existing) {
            $id = $existing['id'];
            $this->workflowModel->update($id, [
                'nama_workflow' => $this->request->getPost('nama_workflow'),
                'is_active'     => $this->request->getPost('is_active') ?? 1,
            ]);
        } else {
            $id = $this->workflowModel->insert([
                'nama_workflow' => $this->request->getPost('nama_workflow'),
                'jenis_modul'   => $jenisModul,
                'is_active'     => $this->request->getPost('is_active') ?? 1,
            ]);
        }

        // Hapus steps lama dan buat yang baru
        $this->workflowStepModel->where('workflow_id', $id)->delete();

        $roles = $this->request->getPost('role');
        $urutan = 1;

        if (is_array($roles)) {
            foreach ($roles as $role) {
                if (!empty($role)) {
                    $this->workflowStepModel->insert([
                        'workflow_id' => $id,
                        'urutan'      => $urutan++,
                        'role'        => $role
                    ]);
                }
            }
        }

        return redirect()->to('/workflow')->with('success', 'Workflow berhasil disimpan!');
    }

    // Hapus workflow
    public function delete($id)
    {
        if (session()->get('role') !== 'admin') {
            return $this->response->setJSON(['status' => 'error']);
        }

        $this->workflowModel->delete($id);
        return $this->response->setJSON(['status' => 'success']);
    }
}