<?php

namespace App\Controllers\Backoffice;

use App\Controllers\BaseController;

use App\Models\BookingModel;
use App\Models\DokterModel;
use App\Models\UserModel;
use App\Models\LayananModel;
use App\Models\SlotJadwalModel;
use App\Models\JadwalModel;
use App\Models\InvoiceModel;
use App\Models\InvoiceItemModel;
use App\Models\ObatModel;

class BookingPasien extends BaseController
{
    protected $bookingModel;
    protected $userModel;
    protected $layananModel;
    protected $slotJadwalModel;
    protected $jadwalModel;
    protected $invoiceModel;
    protected $invoiceItemModel;
    protected $obatModel;
    protected $dokterModel;

    public function __construct()
    {
        $this->bookingModel = new BookingModel();
        $this->userModel = new UserModel();
        $this->layananModel = new LayananModel();
        $this->slotJadwalModel = new SlotJadwalModel();
        $this->jadwalModel = new JadwalModel();
        $this->invoiceModel = new InvoiceModel();
        $this->invoiceItemModel = new InvoiceItemModel();
        $this->obatModel = new ObatModel();
        $this->dokterModel = new DokterModel();
    }

    public function index()
    {
        $data['title'] = 'Booking Pasien';
        $data['menuGroup'] = 'Booking';
        $data['menu'] = 'Booking Pasien';

        // Akses Model ke dalam View
        $data['userModel'] = $this->userModel;
        $data['layananModel'] = $this->layananModel;
        $data['slotJadwalModel'] = $this->slotJadwalModel;
        $data['jadwalModel'] = $this->jadwalModel;
        // Ambil data booking list
        $data['bookings'] = $this->bookingModel->where('DATE(date_booking) =', date("Y-m-d"))->where('status_booking', 'Confirmed')->orderBy('date_booking', 'ASC')->findAll();
        // Ambil data booking yang sedang dalam perawatan
        $data['bookingPerawatan'] = $this->bookingModel->where('status_booking', 'Dalam Perawatan')->first();

        return view('Backoffice/BookingPasien/Index', $data);
    }

    public function detail($id_booking)
    {
        $booking = $this->bookingModel->where('id_booking', $id_booking)->first();
        $pasien = $this->userModel->where('id_user', $booking['id_user'])->first();
        $slotJadwal = $this->slotJadwalModel->where('id_slot_jadwal', $booking['id_slot_jadwal'])->first();
        $jadwal = $this->jadwalModel->where('id_jadwal', $slotJadwal['id_jadwal'])->first();
        $dokter = $this->dokterModel->where('id_dokter', $jadwal['id_dokter'])->first();
        $invoice = $this->invoiceModel->where('id_booking', $id_booking)->first();
        $invoiceItems = $this->invoiceItemModel->where('id_invoice', $invoice['id_invoice'])->findAll();

        $data['title'] = 'Booking - ' . $booking['code_booking'];
        $data['menuGroup'] = 'Booking';
        $data['menu'] = 'Booking Pasien';

        // Akses Model ke dalam View
        $data['userModel'] = $this->userModel;
        $data['layananModel'] = $this->layananModel;
        $data['slotJadwalModel'] = $this->slotJadwalModel;
        $data['jadwalModel'] = $this->jadwalModel;
        // Ambil data booking detail
        $data['booking'] = $booking;
        $data['pasien'] = $pasien;
        $data['slotJadwal'] = $slotJadwal;
        $data['jadwal'] = $jadwal;
        $data['dokter'] = $dokter;
        $data['invoice'] = $invoice;
        $data['invoiceItems'] = $invoiceItems;
        // Ambil data layanan dan obat
        $data['layanans'] = $this->layananModel->findAll();
        $data['obats'] = $this->obatModel->findAll();

        return view('Backoffice/BookingPasien/Detail', $data);
    }

    public function addLayanan()
    {
        $vars = $this->request->getVar();

        if (!$this->validateData($vars, [
            'qty_layanan' => [
                'rules' => 'trim|required|numeric',
                'errors' => [
                    'required' => 'Qty wajib diisi',
                    'numeric' => 'Qty harus berupa angka',
                ]
            ]
        ])) {
            session()->setFlashdata('modalOpen', 'add-layanan-modal');
            session()->setFlashdata('failed', 'Harap lengkapi form');
            return redirect()->to('/backoffice/booking-pasien/' . $vars['id_booking'])->withInput();
        }

        $layanan = $this->layananModel->where('id_layanan', $vars['id_layanan'])->first();

        if (!$layanan) {
            session()->setFlashdata('modalOpen', 'add-layanan-modal');
            session()->setFlashdata('failed', 'Layanan tidak dapat ditemukan');
            return redirect()->to('/backoffice/booking-pasien/' . $vars['id_booking'])->withInput();
        } else {
            $invoiceItemData = [
                'id_invoice' => $vars['id_invoice'],
                'name_item' => $layanan['name_layanan'],
                'desc_item' => $layanan['desc_layanan'],
                'type_item' => 'Layanan',
                'price_item' => $layanan['price_layanan'],
                'qty_item' => $vars['qty_layanan'],
                'total_item' => $layanan['price_layanan'] * $vars['qty_layanan'],
            ];

            $save = $this->invoiceItemModel->save($invoiceItemData);

            if (!$save) {
                session()->setFlashdata('modalOpen', 'add-layanan-modal');
                session()->setFlashdata('failed', 'Gagal harap coba lagi');
                return redirect()->to('/backoffice/booking-pasien/' . $vars['id_booking'])->withInput();
            } else {
                session()->setFlashdata('success', 'Berhasil menambah layanan');
                return redirect()->to('/backoffice/booking-pasien/' . $vars['id_booking'])->withInput();
            }
        }
    }

    public function addObat()
    {
        $vars = $this->request->getVar();

        if (!$this->validateData($vars, [
            'qty_obat' => [
                'rules' => 'trim|required|numeric',
                'errors' => [
                    'required' => 'Qty wajib diisi',
                    'numeric' => 'Qty harus berupa angka',
                ]
            ],
            'desc_obat' => [
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Instruksi pemakaian wajib diisi',
                ]
            ]
        ])) {
            session()->setFlashdata('modalOpen', 'add-obat-modal');
            session()->setFlashdata('failed', 'Harap lengkapi form');
            return redirect()->to('/backoffice/booking-pasien/' . $vars['id_booking'])->withInput();
        }

        $obat = $this->obatModel->where('id_obat', $vars['id_obat'])->first();

        if (!$obat) {
            session()->setFlashdata('modalOpen', 'add-obat-modal');
            session()->setFlashdata('failed', 'Obat tidak dapat ditemukan');
            return redirect()->to('/backoffice/booking-pasien/' . $vars['id_booking'])->withInput();
        } else {
            $invoiceItemData = [
                'id_invoice' => $vars['id_invoice'],
                'name_item' => $obat['name_obat'],
                'desc_item' => $vars['desc_obat'],
                'type_item' => 'Obat',
                'price_item' => $obat['price_obat'],
                'qty_item' => $vars['qty_obat'],
                'total_item' => $obat['price_obat'] * $vars['qty_obat'],
            ];

            $save = $this->invoiceItemModel->save($invoiceItemData);

            if (!$save) {
                session()->setFlashdata('modalOpen', 'add-layanan-modal');
                session()->setFlashdata('failed', 'Gagal harap coba lagi');
                return redirect()->to('/backoffice/booking-pasien/' . $vars['id_booking'])->withInput();
            } else {
                session()->setFlashdata('success', 'Berhasil menambah layanan');
                return redirect()->to('/backoffice/booking-pasien/' . $vars['id_booking'])->withInput();
            }
        }
    }

    public function updateItem()
    {
        $vars = $this->request->getVar();

        if (!$this->validateData($vars, [
            'qty_item' => [
                'rules' => 'trim|required|numeric',
                'errors' => [
                    'required' => 'Qty wajib diisi',
                    'numeric' => 'Qty harus berupa angka',
                ]
            ],
        ])) {
            session()->setFlashdata('modalOpen', 'edit-modal' . $vars['id_invoice_item']);
            session()->setFlashdata('failed', 'Harap lengkapi form');
            return redirect()->to('/backoffice/booking-pasien/' . $vars['id_booking'])->withInput();
        }

        $invoiceItem = $this->invoiceItemModel->where('id_invoice_item', $vars['id_invoice_item'])->first();

        $invoiceItemData = [
            'id_invoice_item' => $vars['id_invoice_item'],
            'qty_item' => $vars['qty_item'],
            'total_item' => $invoiceItem['price_item'] * $vars['qty_item'],
        ];

        $save = $this->invoiceItemModel->save($invoiceItemData);

        if (!$save) {
            session()->setFlashdata('failed', 'Gagal harap coba lagi');
            return redirect()->to('/backoffice/booking-pasien/' . $vars['id_booking'])->withInput();
        } else {
            session()->setFlashdata('success', 'Berhasil mengubah item');
            return redirect()->to('/backoffice/booking-pasien/' . $vars['id_booking'])->withInput();
        }
    }

    public function deleteItem()
    {
        $vars = $this->request->getVar();

        $save = $this->invoiceItemModel->delete($vars['id_invoice_item'], true);

        if (!$save) {
            session()->setFlashdata('failed', 'Gagal harap coba lagi');
            return redirect()->to('/backoffice/booking-pasien/' . $vars['id_booking'])->withInput();
        } else {
            session()->setFlashdata('success', 'Berhasil menghapus item');
            return redirect()->to('/backoffice/booking-pasien/' . $vars['id_booking'])->withInput();
        }
    }

    public function finish()
    {
        $vars = $this->request->getVar();

        $id_booking = $vars['id_booking'];
        $id_invoice = $vars['id_invoice'];
        $total_invoice = $vars['total_invoice'];

        $bookingData = [
            'id_booking' => $id_booking,
            'status_booking' => 'Completed',
        ];

        $save = $this->bookingModel->save($bookingData);

        if (!$save) {
            session()->setFlashdata('failed', 'Gagal harap coba lagi');
            return redirect()->to('/backoffice/booking-pasien/' . $vars['id_booking'])->withInput();
        } else {
            $invoiceData = [
                'id_invoice' => $id_invoice,
                'total_invoice' => $total_invoice,
                'status_invoice' => 'Waiting Payment',
            ];

            $save = $this->invoiceModel->save($invoiceData);

            if (!$save) {
                session()->setFlashdata('failed', 'Gagal harap coba lagi');
                return redirect()->to('/backoffice/booking-pasien/' . $vars['id_booking'])->withInput();
            } else {
                session()->setFlashdata('success', 'Berhasil menyelesaikan perawatan');
                return redirect()->to('/backoffice/booking-pasien/')->withInput();
            }
        }
    }

    public function perawatan()
    {
        $vars = $this->request->getVar();

        $id_booking = $vars['id_booking'];

        // Cek Apakah ada booking yang sedang dalam perawatan
        $cekBooking = $this->bookingModel->where('status_booking', 'Dalam Perawatan')->first();

        if ($cekBooking) {
            session()->setFlashdata('failed', 'Sedang ada perawatan berjalan, selesaikan perawatan terlebih dahulu');
            return redirect()->to('/backoffice/booking-pasien')->withInput();
        } else {
            $bookingData = [
                'id_booking' => $id_booking,
                'status_booking' => 'Dalam Perawatan',
            ];

            $save = $this->bookingModel->save($bookingData);

            if (!$save) {
                session()->setFlashdata('failed', 'Gagal, harap coba lagi');
                return redirect()->to('/backoffice/booking-pasien')->withInput();
            } else {
                $booking = $this->bookingModel->where('id_booking', $id_booking)->first();
                $pasien = $this->userModel->where('id_user', $booking['id_user'])->first();
                $layanan = $this->layananModel->where('id_layanan', $booking['id_layanan'])->first();
                $slotJadwal = $this->slotJadwalModel->where('id_slot_jadwal', $booking['id_slot_jadwal'])->first();
                $jadwal = $this->jadwalModel->where('id_jadwal', $slotJadwal['id_jadwal'])->first();
                $dokter = $this->userModel->where('id_user', $jadwal['id_user'])->first();

                $invoiceData = [
                    'id_booking' => $id_booking,
                    'no_invoice' => str_pad($id_booking, 5, '0', STR_PAD_LEFT) . '/ALX/INV/' . date('m/Y'),
                    'code_booking' => $booking['code_booking'],
                    'date_booking' => $booking['date_booking'],
                    'keluhan_booking' => $booking['keluhan_booking'],
                    'name_dokter' => $dokter['name_user'],
                    'phone_dokter' => $dokter['phone_user'],
                    'name_pasien' => $pasien['name_user'],
                    'phone_pasien' => $pasien['phone_user'],
                    'status_invoice' => 'Pending',
                ];

                $saveInvoice = $this->invoiceModel->save($invoiceData);

                if (!$saveInvoice) {
                    session()->setFlashdata('failed', 'Invoice gagal terbuat');
                    return redirect()->to('/backoffice/booking-pasien')->withInput();
                } else {
                    $id_invoice = $this->invoiceModel->getInsertID();

                    $invoiceItemData = [
                        'id_invoice' => $id_invoice,
                        'name_item' => $layanan['name_layanan'],
                        'desc_item' => $layanan['desc_layanan'],
                        'type_item' => 'Layanan',
                        'price_item' => $layanan['price_layanan'],
                        'qty_item' => 1,
                        'total_item' => $layanan['price_layanan'] * 1,
                    ];

                    $saveInvoiceItem = $this->invoiceItemModel->save($invoiceItemData);

                    if (!$saveInvoiceItem) {
                        session()->setFlashdata('failed', 'Gagal, harap coba lagi');
                        return redirect()->to('/backoffice/booking-pasien')->withInput();
                    } else {
                        session()->setFlashdata('success', 'Berhasil memulai perawatan');
                        return redirect()->to('/backoffice/booking-pasien/' . $id_booking)->withInput();
                    }
                }
            }
        }
    }
}
