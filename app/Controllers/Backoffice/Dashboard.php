<?php

namespace App\Controllers\Backoffice;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\BookingModel;
use App\Models\DokterModel;
use App\Models\LayananModel;
use App\Models\ObatModel;
use App\Models\PasienModel;
use App\Models\PaymentModel;

class Dashboard extends BaseController
{
    protected $userModel;
    protected $bookingModel;
    protected $layananModel;
    protected $obatModel;
    protected $paymentModel;
    protected $dokterModel;
    protected $pasienModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->bookingModel = new BookingModel();
        $this->layananModel = new LayananModel();
        $this->obatModel = new ObatModel();
        $this->paymentModel = new PaymentModel();
        $this->dokterModel = new DokterModel();
        $this->pasienModel = new PasienModel();
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['menuGroup'] = '';
        $data['menu'] = 'Dashboard';

        $data['jmlPasien'] = $this->pasienModel->where('level_pasien', 'Pasien')->countAllResults();
        $data['jmlDokter'] = $this->dokterModel->where('level_dokter', 'Dokter')->countAllResults();
        $data['jmlBooking'] = $this->bookingModel->where('status_booking !=', 'Cancelled')->countAllResults();
        $data['jmlLayanan'] = $this->layananModel->countAllResults();
        $data['jmlObat'] = $this->obatModel->countAllResults();
        $data['jmlPenghasilan'] = $this->paymentModel->select('SUM(amount_payment - change_payment) AS total_payment')->first();
        $data['jmlPasienPerDokter'] = $this->bookingModel->getPasienPerDokter(session('id_user'));
        $data['jmlPenanganan'] = $this->bookingModel->getBookingPerDokter(session('id_user'));

        return view('Backoffice/Dashboard/Index', $data);
    }
}
