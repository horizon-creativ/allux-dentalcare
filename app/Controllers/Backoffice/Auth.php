<?php

namespace App\Controllers\Backoffice;

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
        if (session('logged_in_bo')) {
            return redirect()->to('/backoffice');
        }

        $data['title'] = 'Login';

        return view('Backoffice/Auth/Login', $data);
    }

    public function loginValidate()
    {
        $vars = $this->request->getVar();

        if (!$this->validateData($vars, [
            'email_user' => [
                'rules' => 'trim|required|valid_email',
                'errors' => [
                    'required' => 'Email wajib diisi!',
                    'valid_email' => 'Harus berupa email valid!',
                ]
            ],
            'password_user' => [
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Password wajib diisi!',
                ]
            ],
        ])) {
            session()->setFlashdata('failed', 'Harap lengkapi form');
            return redirect()->to('/bo-auth/login')->withInput();
        }

        $user = $this->userModel->where('email_user', $vars['email_user'])->first();

        if (!$user) {
            session()->setFlashdata('failed', 'Akun tidak dapat ditemukan');
            return redirect()->to('/bo-auth/login');
        } else {
            if ($user['level_user'] == 'Pasien') {
                session()->setFlashdata('failed', 'Akun tidak dapat ditemukan');
                return redirect()->to('/');
            } else {
                if (!password_verify($vars['password_user'], $user['password_user'])) {
                    session()->setFlashdata('failed', 'Password salah');
                    return redirect()->to('/bo-auth/login');
                } else {
                    session()->set('logged_in_bo', true);
                    session()->set('id_user', $user['id_user']);
                    session()->set('email_user', $user['email_user']);
                    session()->set('name_user', $user['name_user']);
                    session()->set('level_user', $user['level_user']);

                    return redirect()->to('/backoffice')->withInput();
                }
            }
        }
    }
}
