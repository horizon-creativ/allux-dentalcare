<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;

use App\Models\UserModel;
use App\Models\BookingModel;
use App\Models\SlotJadwalModel;
use App\Models\JadwalModel;
use App\Models\LayananModel;

class Profile extends BaseController
{
    protected $userModel;
    protected $bookingModel;
    protected $slotJadwalModel;
    protected $jadwalModel;
    protected $layananModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->bookingModel = new BookingModel();
        $this->slotJadwalModel = new SlotJadwalModel();
        $this->jadwalModel = new JadwalModel();
        $this->layananModel = new LayananModel();
    }

    public function index()
    {
        if (!session('logged_in_user')) {
            return redirect()->to('/');
        }

        $data['title'] = 'Profil';

        // Akses model di dalam view
        $data['slotJadwalModel'] = $this->slotJadwalModel;
        $data['jadwalModel'] = $this->jadwalModel;
        $data['userModel'] = $this->userModel;
        $data['layananModel'] = $this->layananModel;

        // Ambil data user berdasarkan id yang ada di session
        $data['user'] = $this->userModel->where('id_user', session('id_user'))->first();
        // Ambil data booking untuk history
        $data['bookings'] = $this->bookingModel->where('id_user', session('id_user'))->findAll();

        return view('User/Profile/Index', $data);
    }
}
