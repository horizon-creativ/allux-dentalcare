<?php

namespace App\Controllers\Backoffice;

use App\Controllers\BaseController;
use Mpdf\Mpdf;

use App\Models\BookingModel;
use App\Models\SlotJadwalModel;
use App\Models\JadwalModel;
use App\Models\UserModel;
use App\Models\LayananModel;

class RiwayatBooking extends BaseController
{
    protected $bookingModel;
    protected $slotJadwalModel;
    protected $jadwalModel;
    protected $userModel;
    protected $layananModel;

    public function __construct()
    {
        $this->bookingModel = new BookingModel();
        $this->slotJadwalModel = new SlotJadwalModel();
        $this->jadwalModel = new JadwalModel();
        $this->userModel = new UserModel();
        $this->layananModel = new LayananModel();
    }

    public function index()
    {
        $daterange = $this->request->getVar('daterange');

        if ($daterange) {
            $dates = explode("-", urldecode($daterange));
            $dateFrom = date("Y-m-d", strtotime($dates[0]));
            $dateTo = date("Y-m-d", strtotime($dates[1]));
        } else {
            $dateFrom = date("Y-m-d");
            $dateTo = date("Y-m-d");
        }


        $data['title'] = 'Riwayat Booking';
        $data['menuGroup'] = 'Riwayat';
        $data['menu'] = 'Riwayat Booking';

        $data['userModel'] = $this->userModel;
        $data['layananModel'] = $this->layananModel;
        $data['slotJadwalModel'] = $this->slotJadwalModel;
        $data['jadwalModel'] = $this->jadwalModel;


        $data['bookings'] = $this->bookingModel->where('DATE(date_booking) >=', $dateFrom)->where('DATE(date_booking) <=', $dateTo)->orderBy('date_booking', 'DESC')->findAll();

        return view('Backoffice/RiwayatBooking/Index', $data);
    }
}
