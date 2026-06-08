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

    public function simpan()
    {
        $id_modul = $this->model->insert($this->request->getPost());

        // Simpan ke tabel master berkas
        $berkasModel = new BerkasModel();
        $berkasModel->insert([
            'no_berkas'       => 'GI-' . date('Y') . '-' . str_pad($id_modul, 4, '0', STR_PAD_LEFT), // prefix GI untuk Gaji Induk
            'jenis_modul'     => 'gaji_induk',
            'id_modul'        => $id_modul,
            'status'          => 'menunggu_verifikasi',
            'operator_id'     => session()->get('id'),
            'created_at'      => date('Y-m-d H:i:s')
        ]);

        // Redirect dengan pesan sukses (WAJIB ADA!)
        return redirect()->to('gaji-induk')->with('success', 'Gaji Induk berhasil disimpan!');
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