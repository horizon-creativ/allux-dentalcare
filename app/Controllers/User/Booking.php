<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;

use App\Models\JadwalModel;
use App\Models\UserModel;
use App\Models\LayananModel;
use App\Models\SlotJadwalModel;
use App\Models\BookingModel;

class Booking extends BaseController
{
    protected $jadwalModel;
    protected $userModel;
    protected $layananModel;
    protected $slotJadwalModel;
    protected $bookingModel;

    public function __construct()
    {
        $this->jadwalModel = new JadwalModel();
        $this->userModel = new UserModel();
        $this->layananModel = new LayananModel();
        $this->slotJadwalModel = new SlotJadwalModel();
        $this->bookingModel = new BookingModel();
    }

    public function detail($id_booking)
    {
        if (!session('logged_in_user')) {
            return redirect()->to('/');
        }

        $booking = $this->bookingModel->where('id_booking', $id_booking)->first();
        $layanan = $this->layananModel->where('id_layanan', $booking['id_layanan'])->first();
        $slotJadwal = $this->slotJadwalModel->where('id_slot_jadwal', $booking['id_slot_jadwal'])->first();
        $jadwal = $this->jadwalModel->where('id_jadwal', $slotJadwal['id_jadwal'])->first();
        $dokter = $this->userModel->where('id_user', $jadwal['id_user'])->first();

        $data['title'] = $booking['code_booking'];

        $data['booking'] = $booking;
        $data['layanan'] = $layanan;
        $data['slotJadawl'] = $slotJadwal;
        $data['jadwal'] = $jadwal;
        $data['dokter'] = $dokter;

        return view('User/Booking/Detail', $data);
    }

    public function date()
    {
        if (!session('logged_in_user')) {
            return redirect()->to('/');
        }

        $data['title'] = 'Booking';

        return view('User/Booking/Date', $data);
    }

    public function slot()
    {
        if (!session('logged_in_user')) {
            return redirect()->to('/');
        }

        $vars = $this->request->getVar();
        $date_booking = date("Y-m-d", strtotime($vars['date_booking'])); //Tgl booking
        $day_booking = date('w', strtotime($vars['date_booking'])); //Hari booking

        if ($date_booking < date("Y-m-d")) {
            session()->setFlashdata('failed', 'Tanggal booking tidak boleh lebih kecil dari tanggal hari ini');
            return redirect()->to('/booking')->withInput();
        }

        // Akses model di dalam view
        $data['bookingModel'] = $this->bookingModel;

        $data['title'] = 'Slot Booking';
        $data['date_booking'] = $vars['date_booking'];
        $data['day_booking'] = date('w', strtotime($vars['date_booking']));

        // Ambil data slot jadwal di hari tersebut, slot join ke tabel jadwal
        $data['slots'] = $this->slotJadwalModel->join('tb_jadwal', 'tb_jadwal.id_jadwal = tb_slot_jadwal.id_jadwal')->where('tb_jadwal.day_jadwal', $day_booking)->orderBy('tb_slot_jadwal.time_slot', 'ASC')->findAll();

        return view('User/Booking/Slot', $data);
    }

    public function layanan()
    {
        if (!session('logged_in_user')) {
            return redirect()->to('/');
        }

        $vars = $this->request->getVar();
        $date_booking = date("Y-m-d", strtotime($vars['date_booking'])); //Tgl booking
        $id_slot = $vars['slt'];

        if ($date_booking < date("Y-m-d")) {
            session()->setFlashdata('failed', 'Tanggal booking tidak boleh lebih kecil dari tanggal hari ini');
            return redirect()->to('/booking')->withInput();
        }

        $data['title'] = 'Slot Booking';
        $data['date_booking'] = $vars['date_booking'];
        $data['day_booking'] = date('w', strtotime($vars['date_booking']));

        // Ambil data layanan
        $data['layanans'] = $this->layananModel->findAll();
        // Ambil data slot yang sudah dipilih
        $data['slot'] = $this->slotJadwalModel->where('id_slot_jadwal', $id_slot)->first();

        return view('User/Booking/Layanan', $data);
    }

    public function save()
    {
        $vars = $this->request->getVar();

        if (!$this->validateData($vars, [
            'id_layanan' => [
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Layanan wajib dipilih.',
                ]
            ],
            'keluhan_booking' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Keluhan wajib diisi.',
                ]
            ]
        ])) {
            session()->setFlashdata('failed', 'Harap lengkapi form');
            return redirect()->to('/booking/layanan?date_booking=' . $vars['date_booking'] . '&slt=' . $vars['id_slot_jadwal'])->withInput();
        }

        $slotJadwal = $this->slotJadwalModel->where('id_slot_jadwal', $vars['id_slot_jadwal'])->first();

        $bookingData = [
            'id_user' => session('id_user'),
            'id_slot_jadwal' => $vars['id_slot_jadwal'],
            'id_layanan' => $vars['id_layanan'],
            'code_booking' => 'ALX-' . session('id_user') .  $vars['id_slot_jadwal'] . rand(100, 999),
            'date_booking' => date("Y-m-d H:i:s", strtotime($vars['date_booking'] . " " . $slotJadwal['time_slot'])),
            'keluhan_booking' => $vars['keluhan_booking'],
            'status_booking' => 'Waiting',
        ];

        $save = $this->bookingModel->save($bookingData);

        if (!$save) {
            session()->setFlashdata('failed', 'Gagal, harap coba lagi');
            return redirect()->to('/booking/layanan?date_booking=' . $vars['date_booking'] . '&slt=' . $vars['id_slot_jadwal'])->withInput();
        } else {
            session()->setFlashdata('success', 'Berhasil membuat booking');
            return redirect()->to('/profile');
        }
    }

    public function cancel($id_booking)
    {
        // Siapkan data untuk diupdate statusnya
        $bookingData = [
            'id_booking' => $id_booking,
            'status_booking' => 'Cancelled',
        ];

        $save = $this->bookingModel->save($bookingData);

        if (!$save) {
            return redirect()->to('/booking/detail/' . $id_booking);
        } else {
            session()->setFlashdata('success', 'Berhasil membatalkan booking');
            return redirect()->to('/profile');
        }
    }
}
