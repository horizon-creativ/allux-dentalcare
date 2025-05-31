<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function login()
    {
        $data['title'] = 'Login';

        return view('User/Auth/Login', $data);
    }

    public function register()
    {
        $data['title'] = 'Daftar';

        return view('User/Auth/Register', $data);
    }

    public function registerValidate()
    {
        $vars = $this->request->getVar();

        if (!$this->validateData($vars, [
            'name_user' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama lengkap wajib diisi.',
                ]
            ],
            'phone_user' => [
                'rules' => 'trim|required|min_length[10]|max_length[15]|numeric|is_unique[tb_user.phone_user]',
                'errors' => [
                    'required' => 'Nomor telepon wajib diisi.',
                    'min_length' => 'Nomor telepon minimal 10 karakter',
                    'max_length' => 'Nomor telepon maksimal 15 karakter',
                    'numeric' => 'Nomor telepon harus berupa angka',
                    'is_unique' => 'Nomor telepon sudah terdaftar',
                ]
            ],
            'email_user' => [
                'rules' => 'trim|required|max_length[30]|valid_email|is_unique[tb_user.email_user]',
                'errors' => [
                    'required' => 'Email wajib diisi',
                    'max_length' => 'Email maksimal 30 karakter',
                    'valid_email' => 'Harus berupa email yang valid',
                    'is_unique' => 'Email sudah terdaftar',
                ]
            ],
            'password_user' => [
                'rules' => 'trim|required|min_length[8]',
                'errors' => [
                    'required' => 'Password wajib diisi',
                    'min_length' => 'Password minimal 8 karakter',
                ]
            ]
        ])) {
            session()->setFlashdata('failed', 'Harap lengkapi form');
            return redirect()->to('/register')->withInput();
        }

        // Array data user untuk disimpan ke tabel user
        $userData = [
            'email_user' => $vars['email_user'],
            'password_user' => password_hash($vars['password_user'], PASSWORD_DEFAULT),
            'name_user' => $vars['name_user'],
            'phone_user' => $vars['phone_user'],
            'level_user' => 'Pasien',
        ];

        // Proses simpan ke tabel user
        $save = $this->userModel->save($userData);

        if (!$save) {
            session()->setFlashdata('failed', 'Gagal, harap coba lagi');
            return redirect()->to('/register')->withInput();
        } else {
            session()->setFlashdata('success', 'Berhasil daftar, silahkan login');
            return redirect()->to('/login')->withInput();
        }
    }

    public function loginValidate()
    {
        $vars = $this->request->getVar();

        if (!$this->validateData($vars, [
            'email_user' => [
                'rules' => 'trim|required|valid_email',
                'errors' => [
                    'required' => 'Email wajib diisi',
                    'valid_email' => 'Harus berupa email yang valid',
                ]
            ],
            'password_user' => [
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Password wajib diisi',
                ]
            ]
        ])) {
            session()->setFlashdata('failed', 'Harap lengkapi form');
            return redirect()->to('/login')->withInput();
        }

        // Ambil data user berdasarkan email
        $user = $this->userModel->where('email_user', $vars['email_user'])->first();

        if (!$user) {
            // Kalau email tidak ada di database
            session()->setFlashdata('failed', 'Email belum terdaftar');
            return redirect()->to('/login')->withInput();
        } else {
            if (!password_verify($vars['password_user'], $user['password_user'])) {
                // Apabila password salah
                session()->setFlashdata('failed', 'Password salah, harap coba lagi');
                return redirect()->to('/login')->withInput();
            } else {
                session()->set('logged_in_user', true);
                session()->set('id_user', $user['id_user']);
                session()->set('email_user', $user['email_user']);
                session()->set('phone_user', $user['phone_user']);
                session()->set('name_user', $user['name_user']);
                session()->set('level_user', $user['level_user']);

                session()->setFlashdata('success', 'Selamat datang ' . $user['name_user']);
                return redirect()->to('/');
            }
        }
    }

    public function logout()
    {
        session()->remove('logged_in_user');
        session()->remove('id_user');
        session()->remove('name_user');
        session()->remove('email_user');
        session()->remove('phone_user');
        session()->remove('level_user');

        session()->setFlashdata('success', 'Anda telah logout');
        return redirect()->to('/');
    }
}
