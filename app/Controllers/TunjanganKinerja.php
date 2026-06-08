<?php
namespace App\Controllers;

use App\Models\TunjanganKinerjaModel;
use App\Models\BerkasModel;

class TunjanganKinerja extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new TunjanganKinerjaModel();
        helper(['form', 'url']);
    }

    public function index()
    {
        $data['title'] = 'Tunjangan Kinerja';
        return view('tunjangan_kinerja/index', $data);
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

        $data['title'] = 'Input Tunjangan Kinerja';
        return view('tunjangan_kinerja/input', $data);
    }

    public function simpan()
    {
        $id_modul = $this->model->insert($this->request->getPost());

        // Simpan ke tabel master berkas
        $berkasModel = new BerkasModel();
        $berkasModel->insert([
            'no_berkas'       => 'TK-' . date('Y') . '-' . str_pad($id_modul, 4, '0', STR_PAD_LEFT), // prefix TK untuk Tunjangan Kinerja
            'jenis_modul'     => 'tunjangan_kinerja',
            'id_modul'        => $id_modul,
            'status'          => 'menunggu_verifikasi',
            'operator_id'     => session()->get('id'),
            'created_at'      => date('Y-m-d H:i:s')
        ]);

        // Redirect dengan pesan sukses (WAJIB ADA!)
        return redirect()->to('tunjangan-kinerja')->with('success', 'Tunjangan Kinerja berhasil disimpan!');
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Tunjangan Kinerja';
        $data['tk'] = $this->model->find($id);
        if (!$data['tk']) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        return view('tunjangan_kinerja/edit', $data);
    }

    public function update($id)
    {
        $this->model->update($id, $this->request->getPost());
        return redirect()->to('tunjangan-kinerja')->with('success', 'Data berhasil diupdate!');
    }

    public function hapus($id)
    {
        $this->model->delete($id);
        return $this->response->setJSON(['status' => 'success']);
    }

    public function detail($id)
    {
        $data['title'] = 'Detail Tunjangan Kinerja';
        $data['tk'] = $this->model->find($id);
        if (!$data['tk']) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        return view('tunjangan_kinerja/detail', $data);
    }
}