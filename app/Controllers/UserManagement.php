<?php
namespace App\Controllers;

use App\Models\UserModel;

class UserManagement extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        helper(['form', 'url']);
    }

    protected function adminOnly()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak!');
        }
    }

    public function index()
    {
        $this->adminOnly();
        $data['title'] = 'Kelola User';
        return view('admin/users/index', $data);
    }

    public function getData()
    {
        $this->adminOnly();
        $users = $this->userModel->orderBy('id', 'ASC')->findAll();
        return $this->response->setJSON(['data' => $users]);
    }

    public function input()
    {
        $this->adminOnly();
        $data['title'] = 'Tambah User Baru';
        return view('admin/users/input', $data);
    }

    public function simpan()
    {
        $this->adminOnly();
        $post = $this->request->getPost();

        $data = [
            'username' => $post['username'],
            'role'     => $post['role'],
        ];

        if (!empty($post['password'])) {
            $data['password'] = password_hash($post['password'], PASSWORD_DEFAULT);
        }

        $this->userModel->insert($data);
        return redirect()->to('kelola-user')->with('success', 'User berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $this->adminOnly();
        $data['title'] = 'Edit User';
        $data['user'] = $this->userModel->find($id);
        if (!$data['user']) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        return view('admin/users/edit', $data);
    }

    public function update($id)
    {
        $this->adminOnly();
        $post = $this->request->getPost();

        $data = [
            'username' => $post['username'],
            'role'     => $post['role'],
        ];

        if (!empty($post['password'])) {
            $data['password'] = password_hash($post['password'], PASSWORD_DEFAULT);
        }

        $this->userModel->update($id, $data);
        return redirect()->to('kelola-user')->with('success', 'User berhasil diupdate!');
    }

    public function hapus($id)
    {
        $this->adminOnly();
        if ($id == session()->get('id')) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Tidak bisa menghapus akun sendiri!']);
        }
        $this->userModel->delete($id);
        return $this->response->setJSON(['status' => 'success']);
    }
}