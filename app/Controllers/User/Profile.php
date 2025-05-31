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
        $data['title'] = 'Profil';

        return view('User/Profile/Index', $data);
    }
}
