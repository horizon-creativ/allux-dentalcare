<?php

namespace App\Controllers\Backoffice;

use App\Controllers\BaseController;

use App\Models\UserModel;

class Pasien extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data['title'] = 'Data Pasien';
        $data['menuGroup'] = 'Data';
        $data['menu'] = 'Pasien';

        // Ambil data user yang levelnya pasien
        $data['users'] = $this->userModel->where('level_user', 'Pasien')->findAll();

        return view('Backoffice/Pasien/Index', $data);
    }
}
