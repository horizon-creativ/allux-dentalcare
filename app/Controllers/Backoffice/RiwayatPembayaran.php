<?php

namespace App\Controllers\Backoffice;

use App\Controllers\BaseController;
use Mpdf\Mpdf;

use App\Models\BookingModel;
use App\Models\SlotJadwalModel;
use App\Models\JadwalModel;
use App\Models\UserModel;
use App\Models\LayananModel;
use App\Models\InvoiceModel;
use App\Models\PaymentModel;

class RiwayatPembayaran extends BaseController
{
    protected $bookingModel;
    protected $slotJadwalModel;
    protected $jadwalModel;
    protected $userModel;
    protected $layananModel;
    protected $invoiceModel;
    protected $paymentModel;

    public function __construct()
    {
        $this->bookingModel = new BookingModel();
        $this->slotJadwalModel = new SlotJadwalModel();
        $this->jadwalModel = new JadwalModel();
        $this->userModel = new UserModel();
        $this->layananModel = new LayananModel();
        $this->invoiceModel = new InvoiceModel();
        $this->paymentModel = new PaymentModel();
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


        $data['title'] = 'Riwayat Pembayaran';
        $data['menuGroup'] = 'Riwayat';
        $data['menu'] = 'Riwayat Pembayaran';

        $data['bookingModel'] = $this->bookingModel;
        $data['userModel'] = $this->userModel;
        $data['layananModel'] = $this->layananModel;
        $data['slotJadwalModel'] = $this->slotJadwalModel;
        $data['jadwalModel'] = $this->jadwalModel;
        $data['paymentModel'] = $this->paymentModel;

        $data['invoices'] = $this->invoiceModel->where('DATE(updated_at) >=', $dateFrom)->where('DATE(updated_at) <=', $dateTo)->where('status_invoice !=', 'Pending')->orderBy('updated_at', 'DESC')->findAll();

        return view('Backoffice/RiwayatPembayaran/Index', $data);
    }
}
