<?php

namespace App\Controllers\Backoffice;

use App\Controllers\BaseController;

use App\Models\UserModel;

class User extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data['title'] = 'User';
        $data['menuGroup'] = 'Master';
        $data['menu'] = 'User';

        $data['users'] = $this->userModel->findAll();

        return view('Backoffice/User/Index', $data);
    }
}
