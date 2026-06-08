<?php
namespace App\Controllers;

use App\Models\GupModel;
use App\Models\BerkasModel;

class Gup extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new GupModel();
        helper(['form', 'url']);
    }

    public function index()
    {
        $data['title'] = 'GUP UP PTUP TUP';
        return view('gup/index', $data);
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

        $data['title'] = 'Input GUP UP PTUP TUP';
        return view('gup/input', $data);
    }

    public function simpan()
    {
        $id_modul = $this->model->insert($this->request->getPost());

        // Simpan ke tabel master berkas
        $berkasModel = new BerkasModel();
        $berkasModel->insert([
            'no_berkas'       => 'GUP-' . date('Y') . '-' . str_pad($id_modul, 4, '0', STR_PAD_LEFT), // prefix GUP untuk modul ini
            'jenis_modul'     => 'gup',
            'id_modul'        => $id_modul,
            'status'          => 'menunggu_verifikasi',
            'operator_id'     => session()->get('id'),
            'created_at'      => date('Y-m-d H:i:s')
        ]);

        // Redirect dengan pesan sukses (WAJIB ADA!)
        return redirect()->to('gup')->with('success', 'Data GUP berhasil disimpan!');
    }

    public function edit($id)
    {
        $data['title'] = 'Edit GUP UP PTUP TUP';
        $data['gup'] = $this->model->find($id);
        if (!$data['gup']) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        return view('gup/edit', $data);
    }

    public function update($id)
    {
        $this->model->update($id, $this->request->getPost());
        return redirect()->to('gup')->with('success', 'Data berhasil diupdate!');
    }

    public function hapus($id)
    {
        $this->model->delete($id);
        return $this->response->setJSON(['status' => 'success']);
    }

    public function detail($id)
    {
        $data['title'] = 'Detail GUP UP PTUP TUP';
        $data['gup'] = $this->model->find($id);
        if (!$data['gup']) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        return view('gup/detail', $data);
    }
}