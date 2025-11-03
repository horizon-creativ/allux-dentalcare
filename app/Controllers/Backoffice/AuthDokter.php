<?php

namespace App\Controllers\Backoffice;

use App\Controllers\BaseController;

use App\Models\DokterModel;

class AuthDokter extends BaseController
{
    protected $dokterModel;

    public function __construct()
    {
        $this->dokterModel = new DokterModel();
    }

    public function login()
    {
        if (session('logged_in_bo')) {
            return redirect()->to('/backoffice');
        }

        $data['title'] = 'Login';

        return view('Backoffice/Auth/LoginDokter', $data);
    }

    public function loginValidate()
    {
        $vars = $this->request->getVar();

        if (!$this->validateData($vars, [
            'email_dokter' => [
                'rules' => 'trim|required|valid_email',
                'errors' => [
                    'required' => 'Email wajib diisi!',
                    'valid_email' => 'Harus berupa email valid!',
                ]
            ],
            'password_dokter' => [
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Password wajib diisi!',
                ]
            ],
        ])) {
            session()->setFlashdata('failed', 'Harap lengkapi form');
            return redirect()->to('/dokter-auth/login')->withInput();
        }

        $user = $this->dokterModel->where('email_dokter', $vars['email_dokter'])->first();

        if (!$user) {
            session()->setFlashdata('failed', 'Akun tidak dapat ditemukan');
            return redirect()->to('/dokter-auth/login');
        } else {
            if ($user['level_dokter'] != 'Dokter') {
                session()->setFlashdata('failed', 'Akun tidak dapat ditemukan');
                return redirect()->to('/');
            } else {
                if (!password_verify($vars['password_dokter'], $user['password_dokter'])) {
                    session()->setFlashdata('failed', 'Password salah');
                    return redirect()->to('/dokter-auth/login')->withInput();
                } else {
                    session()->set('logged_in_bo', true);
                    session()->set('id_user', $user['id_dokter']);
                    session()->set('email_user', $user['email_dokter']);
                    session()->set('name_user', $user['name_dokter']);
                    session()->set('level_user', $user['level_dokter']);

                    session()->setFlashdata('success', 'Selamat datang ' . $user['name_dokter']);
                    return redirect()->to('/backoffice')->withInput();
                }
            }
        }
    }

    public function logout()
    {
        session()->remove('logged_in_bo');
        session()->remove('id_user');
        session()->remove('name_user');
        session()->remove('email_user');
        session()->remove('phone_user');
        session()->remove('level_user');

        session()->setFlashdata('success', 'Anda telah logout');
        return redirect()->to('/backoffice');
    }
}
