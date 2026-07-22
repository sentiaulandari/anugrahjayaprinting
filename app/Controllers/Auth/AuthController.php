<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\PelangganModel;
use CodeIgniter\HTTP\RedirectResponse;

class AuthController extends BaseController
{
    protected UserModel $userModel;
    protected PelangganModel $pelangganModel;

    public function __construct()
    {
        $this->userModel      = new UserModel();
        $this->pelangganModel = new PelangganModel();
    }

    public function login(): RedirectResponse|string
    {
        if (session()->get('logged_in')) {
            return $this->redirectByLevel();
        }

        return view('auth/login', ['title' => 'Login']);
    }

    public function loginProcess(): RedirectResponse
    {
        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $user     = $this->userModel->findByUsername($username);

        if (!$user || !password_verify($password, $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Username atau password salah.');
        }

        session()->set([
            'logged_in'    => true,
            'id_user'      => $user['id_user'],
            'username'     => $user['username'],
            'nama_lengkap' => $user['nama_lengkap'],
            'level'        => $user['level'],
        ]);

        if ($user['level'] === 'pelanggan') {
            $pelanggan = $this->pelangganModel->getByIdUser($user['id_user']);
            if ($pelanggan) {
                session()->set('id_pelanggan', $pelanggan['id_pelanggan']);
            }
        }

        return $this->redirectByLevel();
    }

    public function register(): RedirectResponse|string
    {
        if (session()->get('logged_in')) {
            return $this->redirectByLevel();
        }

        return view('auth/register', ['title' => 'Daftar Akun']);
    }

    public function registerProcess(): RedirectResponse
    {
        $rules = [
            'nama_lengkap' => 'required|max_length[100]',
            'username'     => 'required|min_length[3]|max_length[50]|is_unique[users.username]',
            'email'        => 'required|valid_email|is_unique[users.email]',
            'no_hp'        => 'required|max_length[15]',
            'password'     => 'required|min_length[6]',
            'konfirmasi'   => 'required|matches[password]',
        ];

        $messages = [
            'username'   => ['is_unique' => 'Username sudah digunakan.'],
            'email'      => ['is_unique' => 'Email sudah terdaftar.'],
            'konfirmasi' => ['matches'   => 'Konfirmasi password tidak cocok.'],
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->userModel->insert([
            'username'     => $this->request->getPost('username'),
            'password'     => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'email'        => $this->request->getPost('email'),
            'no_hp'        => $this->request->getPost('no_hp'),
            'level'        => 'pelanggan',
            'created_at'   => date('Y-m-d H:i:s'),
        ]);

        $idUser = $this->userModel->getInsertID();

        $this->pelangganModel->insert([
            'id_user'        => $idUser,
            'nama_pelanggan' => $this->request->getPost('nama_lengkap'),
            'email'          => $this->request->getPost('email'),
            'no_hp'          => $this->request->getPost('no_hp'),
            'created_at'     => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/auth/login')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    public function logout(): RedirectResponse
    {
        session()->destroy();
        return redirect()->to('/auth/login')->with('success', 'Anda telah logout.');
    }

    private function redirectByLevel(): RedirectResponse
    {
        $level = session()->get('level');

        if ($level === 'admin' || $level === 'pimpinan') {
            return redirect()->to('/admin/dashboard');
        }

        return redirect()->to('/pelanggan/dashboard');
    }
}
