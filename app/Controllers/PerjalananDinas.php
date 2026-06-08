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


    public function simpan()
    {
        $model = new PerjalananDinasModel();
        $data = $this->request->getPost();

        // 1. Simpan dulu ke tabel perjalanan_dinas
        $id_modul = $model->insert($data);

        // 2. Simpan ke tabel master berkas
        $berkasModel = new BerkasModel();
        $berkasModel->insert([
            'no_berkas'       => 'PD-' . date('Y') . '-' . str_pad($id_modul, 4, '0', STR_PAD_LEFT),
            'jenis_modul'     => 'perjalanan_dinas',
            'id_modul'        => $id_modul,
            'status'          => 'menunggu_verifikasi',
            'operator_id'     => session()->get('id'),
            'created_at'      => date('Y-m-d H:i:s')
        ]);

        // 3. Redirect dengan pesan sukses
        return redirect()->to('perjalanan-dinas')->with('success', 'Data berhasil disimpan!');
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