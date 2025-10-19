<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;

use App\Models\PasienModel;

class Auth extends BaseController
{
    protected $pasienModel;

    public function __construct()
    {
        $this->pasienModel = new PasienModel();
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
            'name_pasien' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama lengkap wajib diisi.',
                ]
            ],
            'phone_pasien' => [
                'rules' => 'trim|required|min_length[10]|max_length[15]|numeric|is_unique[tb_pasien.phone_pasien]',
                'errors' => [
                    'required' => 'Nomor telepon wajib diisi.',
                    'min_length' => 'Nomor telepon minimal 10 karakter',
                    'max_length' => 'Nomor telepon maksimal 15 karakter',
                    'numeric' => 'Nomor telepon harus berupa angka',
                    'is_unique' => 'Nomor telepon sudah terdaftar',
                ]
            ],
            'email_pasien' => [
                'rules' => 'trim|required|max_length[30]|valid_email|is_unique[tb_pasien.email_pasien]',
                'errors' => [
                    'required' => 'Email wajib diisi',
                    'max_length' => 'Email maksimal 30 karakter',
                    'valid_email' => 'Harus berupa email yang valid',
                    'is_unique' => 'Email sudah terdaftar',
                ]
            ],
            'password_pasien' => [
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

        // Array data pasien untuk disimpan ke tabel pasien
        $pasienData = [
            'email_pasien' => $vars['email_pasien'],
            'password_pasien' => password_hash($vars['password_pasien'], PASSWORD_DEFAULT),
            'name_pasien' => $vars['name_pasien'],
            'phone_pasien' => $vars['phone_pasien'],
            'level_pasien' => 'Pasien',
        ];

        // Proses simpan ke tabel pasien
        $save = $this->pasienModel->save($pasienData);

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
            'email_pasien' => [
                'rules' => 'trim|required|valid_email',
                'errors' => [
                    'required' => 'Email wajib diisi',
                    'valid_email' => 'Harus berupa email yang valid',
                ]
            ],
            'password_pasien' => [
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Password wajib diisi',
                ]
            ]
        ])) {
            session()->setFlashdata('failed', 'Harap lengkapi form');
            return redirect()->to('/login')->withInput();
        }

        // Ambil data pasien berdasarkan email
        $pasien = $this->pasienModel->where('email_pasien', $vars['email_pasien'])->first();

        if (!$pasien) {
            // Kalau email tidak ada di database
            session()->setFlashdata('failed', 'Email belum terdaftar');
            return redirect()->to('/login')->withInput();
        } else {
            if (!password_verify($vars['password_pasien'], $pasien['password_pasien'])) {
                // Apabila password salah
                session()->setFlashdata('failed', 'Password salah, harap coba lagi');
                return redirect()->to('/login')->withInput();
            } else {
                session()->set('logged_in_user', true);
                session()->set('id_user', $pasien['id_pasien']);
                session()->set('email_user', $pasien['email_pasien']);
                session()->set('phone_user', $pasien['phone_pasien']);
                session()->set('name_user', $pasien['name_pasien']);
                session()->set('level_user', $pasien['level_pasien']);

                session()->setFlashdata('success', 'Selamat datang ' . $pasien['name_pasien']);
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
