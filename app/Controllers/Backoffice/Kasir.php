<?php

namespace App\Controllers\Backoffice;

use App\Controllers\BaseController;

use App\Models\InvoiceModel;
use App\Models\InvoiceItemModel;
use App\Models\BookingModel;
use App\Models\PaymentModel;

use Mpdf\Mpdf;

class Kasir extends BaseController
{
    protected $invoiceModel;
    protected $invoiceItemModel;
    protected $bookingModel;
    protected $paymentModel;

    public function __construct()
    {
        $this->invoiceModel = new InvoiceModel();
        $this->invoiceItemModel = new InvoiceItemModel();
        $this->bookingModel = new BookingModel();
        $this->paymentModel = new PaymentModel();
    }

    public function index()
    {
        // Data yg akan dioper ke view
        $data['title'] = 'Kasir'; // Judul halaman
        $data['menuGroup'] = ''; //Untuk handle sistem menu
        $data['menu'] = 'Kasir'; //Untuk handle sistem sub menu

        $data['invoices'] = $this->invoiceModel->where('status_invoice', 'Waiting Payment')->orderBy('created_at', 'DESC')->findAll();

        return view('Backoffice/Kasir/Index', $data);
    }

    public function detail($id_invoice)
    {
        $invoice = $this->invoiceModel->where('id_invoice', $id_invoice)->first();
        // Cek status, kalau paid maka akan redirect
        if ($invoice['status_invoice'] == 'Paid') {
            session()->setFlashdata('failed', 'Invoice sudah terproses');
            return redirect()->to('/backoffice/kasir/');
        }
        // Data yg akan dioper ke view
        $data['title'] = 'Transaksi - ' . $invoice['no_invoice']; // Judul halaman
        $data['menuGroup'] = ''; //Untuk handle sistem menu
        $data['menu'] = 'Kasir'; //Untuk handle sistem sub menu

        $data['invoice'] = $invoice;
        $data['booking'] = $this->bookingModel->where('id_booking', $invoice['id_booking'])->first();
        $data['invoiceItems'] = $this->invoiceItemModel->where('id_invoice', $invoice['id_invoice'])->findAll();

        return view('Backoffice/Kasir/Detail', $data);
    }

    public function pay()
    {
        $vars = $this->request->getVar();

        if ($vars['type_payment'] == 'TUNAI') {
            $amountRules = 'trim|required|numeric';
        } else {
            $amountRules = 'trim';
        }

        if (!$this->validateData($vars, [
            'amount_payment' => [
                'rules' => $amountRules,
                'errors' => [
                    'required' => 'Jumlah bayar wajib diisi',
                    'numeric' => 'Jumlah bayar harus berupa angka'
                ]
            ]
        ])) {
            session()->setFlashdata('modalOpen', 'pay-modal');
            session()->setFlashdata('failed', 'Harap lengkapi form');
            return redirect()->to('/backoffice/kasir/' . $vars['id_invoice'])->withInput();
        }

        if ($vars['type_payment'] == 'TUNAI') {
            if ($vars['amount_payment'] < $vars['total_invoice']) {
                session()->setFlashdata('modalOpen', 'pay-modal');
                session()->setFlashdata('failed', 'Jumlah bayar tidak bisa lebih kecil dari total');
                return redirect()->to('/backoffice/kasir/' . $vars['id_invoice'])->withInput();
            }
        }

        $amount_payment = $vars['type_payment'] == 'TUNAI' ? $vars['amount_payment'] : $vars['total_invoice'];

        $paymentData = [
            'id_invoice' => $vars['id_invoice'],
            'type_payment' => $vars['type_payment'],
            'amount_payment' => $amount_payment,
            'change_payment' => $amount_payment - $vars['total_invoice'],
        ];

        $save = $this->paymentModel->save($paymentData);

        if (!$save) {
            session()->setFlashdata('modalOpen', 'pay-modal');
            session()->setFlashdata('failed', 'Terjadi kesalahan, harap coba lagi');
            return redirect()->to('/backoffice/kasir/' . $vars['id_invoice'])->withInput();
        } else {
            $invoiceData = [
                'id_invoice' => $vars['id_invoice'],
                'status_invoice' => 'Paid',
            ];

            $save = $this->invoiceModel->save($invoiceData);

            if (!$save) {
                session()->setFlashdata('modalOpen', 'pay-modal');
                session()->setFlashdata('failed', 'Terjadi kesalahan, harap coba lagi');
                return redirect()->to('/backoffice/kasir/' . $vars['id_invoice'])->withInput();
            } else {
                // Arahkan ke halaman cetak
                return redirect()->to('/backoffice/kasir/print/' . $vars['id_invoice']);
            }
        }
    }

    public function print($id_invoice)
    {
        // Prose print struk
        $invoice = $this->invoiceModel->where('id_invoice', $id_invoice)->first();
        $invoiceItems = $this->invoiceItemModel->where('id_invoice', $id_invoice)->findAll();
        $booking = $this->bookingModel->where('id_booking', $invoice['id_booking'])->first();
        $payment = $this->paymentModel->where('id_invoice', $id_invoice)->first();

        $data['invoice'] = $invoice;
        $data['booking'] = $booking;
        $data['payment'] = $payment;
        $data['invoiceItems'] = $invoiceItems;

        $view = view('Backoffice/Kasir/Print', $data);

        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => [58, 297], // 58mm x 100mm (bisa disesuaikan)
            'margin_left' => 2,
            'margin_right' => 2,
            'margin_top' => 2,
            'margin_bottom' => 2,
        ]);

        $mpdf->WriteHTML($view);

        // Output sebagai browser PDF
        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', 'inline;filename=' . 'Struk#' . $invoice['no_invoice'])
            ->setBody($mpdf->Output('', 'S')); // 'S' = return as string
    }
}
