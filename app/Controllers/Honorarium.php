<?php
namespace App\Controllers;

use App\Models\HonorariumModel;
use App\Models\BerkasModel;

class Honorarium extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new HonorariumModel();
        helper(['form', 'url']);
    }

    public function index()
    {
        $data['title'] = 'Honorarium';
        return view('honorarium/index', $data);
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

        $data['title'] = 'Input Honorarium';
        return view('honorarium/input', $data);
    }

    public function simpan()
    {
        $id_modul = $this->model->insert($this->request->getPost());

        // Simpan ke tabel master berkas
        $berkasModel = new BerkasModel();
        $berkasModel->insert([
            'no_berkas'       => 'HO-' . date('Y') . '-' . str_pad($id_modul, 4, '0', STR_PAD_LEFT), // prefix HO untuk Honorarium
            'jenis_modul'     => 'honorarium',
            'id_modul'        => $id_modul,
            'status'          => 'menunggu_verifikasi',
            'operator_id'     => session()->get('id'),
            'created_at'      => date('Y-m-d H:i:s')
        ]);

        // Redirect dengan pesan sukses (WAJIB ADA!)
        return redirect()->to('honorarium')->with('success', 'Honorarium berhasil disimpan!');
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Honorarium';
        $data['hon'] = $this->model->find($id);
        if (!$data['hon']) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        return view('honorarium/edit', $data);
    }

    public function update($id)
    {
        $this->model->update($id, $this->request->getPost());
        return redirect()->to('honorarium')->with('success', 'Data berhasil diupdate!');
    }

    public function hapus($id)
    {
        $this->model->delete($id);
        return $this->response->setJSON(['status' => 'success']);
    }

    public function detail($id)
    {
        $data['title'] = 'Detail Honorarium';
        $data['hon'] = $this->model->find($id);
        if (!$data['hon']) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        return view('honorarium/detail', $data);
    }
}