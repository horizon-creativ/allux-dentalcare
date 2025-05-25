<?php

namespace App\Controllers\Backoffice;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    protected $title;

    public function __construct()
    {
        // if (!session('logged_in_bo')) {
        //     return redirect()->to('/backoffice/login');
        // }
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['menuGroup'] = '';
        $data['menu'] = 'Dashboard';

        return view('Backoffice/Dashboard/Index', $data);
    }
}
