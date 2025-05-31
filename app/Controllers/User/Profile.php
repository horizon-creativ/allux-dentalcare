<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;

use App\Models\UserModel;

class Profile extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        if (!session('logged_in_user')) {
            return redirect()->to('/');
        }

        $data['title'] = 'Profil';

        // Ambil data user berdasarkan id yang ada di session
        $data['user'] = $this->userModel->where('id_user', session('id_user'))->first();

        return view('User/Profile/Index', $data);
    }
}
