<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'Home';

        return view('User/Home/Index', $data);
    }
}
