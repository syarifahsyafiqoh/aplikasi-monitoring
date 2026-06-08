<?php
namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/' . session()->get('role'));
        }
        return view('auth/login');
    }

    // PROSES LOGIN
    public function attemptLogin()
    {
        $model    = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $model->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            $sessionData = [
                'id'        => $user['id'],
                'username'  => $user['username'],
                'role'      => $user['role'],
                'logged_in' => true
            ];
            session()->set($sessionData);

            return redirect()->to('/' . $user['role']);
        }

        session()->setFlashdata('error', 'Username atau password salah!');
        return redirect()->to('/login');
    }

    // LOGOUT
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}