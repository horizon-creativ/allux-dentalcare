<?php

namespace App\Controllers\Backoffice;

use App\Controllers\BaseController;

use App\Models\BookingModel;
use App\Models\UserModel;
use App\Models\LayananModel;
use App\Models\SlotJadwalModel;
use App\Models\JadwalModel;

class BookingMasuk extends BaseController
{
    protected $bookingModel;
    protected $userModel;
    protected $layananModel;
    protected $slotJadwalModel;
    protected $jadwalModel;

    public function __construct()
    {
        $this->bookingModel = new BookingModel();
        $this->userModel = new UserModel();
        $this->layananModel = new LayananModel();
        $this->slotJadwalModel = new SlotJadwalModel();
        $this->jadwalModel = new JadwalModel();
    }

    public function index()
    {
        $data['title'] = 'Booking Masuk';
        $data['menuGroup'] = 'Booking';
        $data['menu'] = 'Booking Masuk';

        // Akses Model ke dalam View
        $data['userModel'] = $this->userModel;
        $data['layananModel'] = $this->layananModel;
        $data['slotJadwalModel'] = $this->slotJadwalModel;
        $data['jadwalModel'] = $this->jadwalModel;
        // Ambil data booking list
        $data['bookings'] = $this->bookingModel->where('DATE(date_booking) >=', date("Y-m-d"))->orderBy('date_booking', 'ASC')->findAll();

        return view('Backoffice/BookingMasuk/Index', $data);
    }

    public function confirm()
    {
        $vars = $this->request->getVar();

        $bookingData = [
            'id_booking' => $vars['id_booking'],
            'status_booking' => $vars['status_booking'],
        ];

        $save = $this->bookingModel->save($bookingData);

        if (!$save) {
            session()->setFlashdata('modalOpen', 'detail-modal' . $vars['id_booking']);
            session()->setFlashdata('failed', 'Gagal, harap coba lagi');
            return redirect()->to('/backoffice/booking-masuk')->withInput();
        } else {
            session()->setFlashdata('success', 'Booking ' . $vars['status_booking']);
            return redirect()->to('/backoffice/booking-masuk')->withInput();
        }
    }
}
