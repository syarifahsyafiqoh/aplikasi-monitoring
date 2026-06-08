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

    public function simpan()
    {
        $id_modul = $this->model->insert($this->request->getPost());

        // Simpan ke tabel master berkas
        $berkasModel = new BerkasModel();
        $berkasModel->insert([
            'no_berkas'       => 'UM-' . date('Y') . '-' . str_pad($id_modul, 4, '0', STR_PAD_LEFT), // prefix UM untuk Uang Makan
            'jenis_modul'     => 'uang_makan',
            'id_modul'        => $id_modul,
            'status'          => 'menunggu_verifikasi',
            'operator_id'     => session()->get('id'),
            'created_at'      => date('Y-m-d H:i:s')
        ]);

        // Redirect dengan pesan sukses (WAJIB ADA!)
        return redirect()->to('uang-makan')->with('success', 'Uang Makan berhasil disimpan!');
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