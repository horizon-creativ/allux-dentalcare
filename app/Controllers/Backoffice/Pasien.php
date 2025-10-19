<?php

namespace App\Controllers\Backoffice;

use App\Controllers\BaseController;

use App\Models\PasienModel;

class Pasien extends BaseController
{
    protected $pasienModel;

    public function __construct()
    {
        $this->pasienModel = new PasienModel();
    }

    public function index()
    {
        $data['title'] = 'Data Pasien';
        $data['menuGroup'] = 'Data';
        $data['menu'] = 'Pasien';

        // Ambil data pasien yang levelnya pasien
        $data['pasiens'] = $this->pasienModel->where('level_pasien', 'Pasien')->findAll();

        return view('Backoffice/Pasien/Index', $data);
    }
}
