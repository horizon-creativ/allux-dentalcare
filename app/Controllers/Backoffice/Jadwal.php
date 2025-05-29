<?php

namespace App\Controllers\Backoffice;

use App\Controllers\BaseController;

use App\Models\UserModel;
use App\Models\JadwalModel;
use App\Models\SlotJadwalModel;

use DatePeriod;
use DateTime;
use DateInterval;

class Jadwal extends BaseController
{
    protected $userModel;
    protected $jadwalModel;
    protected $slotJadwalModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->jadwalModel = new JadwalModel();
        $this->slotJadwalModel = new SlotJadwalModel();
    }

    public function index()
    {
        // ?? Menampilkan pilihan dokter terlebih dahulu
        // Data yg akan dioper ke view
        $data['title'] = 'Jadwal'; // Judul halaman
        $data['menuGroup'] = 'Data'; //Untuk handle sistem menu
        $data['menu'] = 'Jadwal'; //Untuk handle sistem sub menu

        $data['users'] = $this->userModel->where('level_user', 'Dokter')->orderBy('name_user', 'ASC')->findAll();

        return view('Backoffice/Jadwal/Index', $data);
    }

    public function detail($id_user)
    {
        // ?? Menampilkan jadwal masing-masing dokter

        $user = $this->userModel->where('id_user', $id_user)->first();
        // Data yg akan dioper ke view
        $data['title'] = 'Jadwal - ' . $user['name_user']; // Judul halaman
        $data['menuGroup'] = 'Data'; //Untuk handle sistem menu
        $data['menu'] = 'Jadwal'; //Untuk handle sistem sub menu

        $data['user'] = $user;
        $data['jadwals'] = $this->jadwalModel->where('id_user', $id_user)->findAll();

        return view('Backoffice/Jadwal/Detail', $data);
    }

    public function create()
    {
        $vars = $this->request->getVar();

        if (!$this->validateData($vars, [
            'day_jadwal' => [
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Hari wajib dipilih.',
                ],
            ],
            'start_jadwal' => [
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Jam mulai wajib diisi.',
                ]
            ],
            'end_jadwal' => [
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Jam selesai wajib diisi.',
                ]
            ]
        ])) {
            session()->setFlashdata('modalOpen', 'add-modal');
            return redirect()->to('/backoffice/jadwal/' . $vars['id_user'])->withInput();
        }

        // Array data yang akan disimpan
        $jadwalData = [
            'id_user' => $vars['id_user'],
            'day_jadwal' => $vars['day_jadwal'],
            'start_jadwal' => date("H:i", strtotime($vars['start_jadwal'])),
            'end_jadwal' => date("H:i", strtotime($vars['end_jadwal'])),
        ];

        $save = $this->jadwalModel->save($jadwalData);

        if (!$save) {
            session()->setFlashdata('failed', 'Gagal, harap coba lagi');
            return redirect()->to('/backoffice/jadwal/' . $vars['id_user'])->withInput();
        } else {
            $id_jadwal = $this->jadwalModel->getInsertID();
            // Kalkulasi Slot per 1 Jam dari Jadwal Dokter
            $start = date("H:i", strtotime($vars['start_jadwal']));
            $end = date("H:i", strtotime($vars['end_jadwal']));

            $slots = new DatePeriod(
                new DateTime($start),
                new DateInterval('PT1H'),
                new DateTime($end)
            );

            // Proses simpan slot ke tabel slot jadwal
            foreach ($slots as $slot) {
                $time_slot = $slot->format('H:i');

                $slotJadwalData = [
                    'id_jadwal' => $id_jadwal,
                    'time_slot' => date("H:i", strtotime($time_slot))
                ];

                $save = $this->slotJadwalModel->save($slotJadwalData);
            }

            session()->setFlashdata('success', 'Berhasil meyimpan data');
            return redirect()->to('/backoffice/jadwal/' . $vars['id_user']);
        }
    }

    public function update()
    {
        $vars = $this->request->getVar();

        if (!$this->validateData($vars, [
            'day_jadwal' => [
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Hari wajib dipilih.',
                ],
            ],
            'start_jadwal' => [
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Jam mulai wajib diisi.',
                ]
            ],
            'end_jadwal' => [
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Jam selesai wajib diisi.',
                ]
            ]
        ])) {
            session()->setFlashdata('modalOpen', 'add-modal');
            return redirect()->to('/backoffice/jadwal/' . $vars['id_user'])->withInput();
        }

        // Array data yang akan disimpan
        $jadwalData = [
            'id_jadwal' => $vars['id_jadwal'],
            'id_user' => $vars['id_user'],
            'day_jadwal' => $vars['day_jadwal'],
            'start_jadwal' => date("H:i", strtotime($vars['start_jadwal'])),
            'end_jadwal' => date("H:i", strtotime($vars['end_jadwal'])),
        ];

        $save = $this->jadwalModel->save($jadwalData);

        if (!$save) {
            session()->setFlashdata('failed', 'Gagal, harap coba lagi');
            return redirect()->to('/backoffice/jadwal/' . $vars['id_user'])->withInput();
        } else {
            // Delete slot lama terlebih daulu
            $this->slotJadwalModel->where('id_jadwal', $vars['id_jadwal'])->delete(null, true);

            // Kalkulasi Slot per 1 Jam dari Jadwal Dokter
            $start = date("H:i", strtotime($vars['start_jadwal']));
            $end = date("H:i", strtotime($vars['end_jadwal']));

            $slots = new DatePeriod(
                new DateTime($start),
                new DateInterval('PT1H'),
                new DateTime($end)
            );

            // Proses simpan slot ke tabel slot jadwal
            foreach ($slots as $slot) {
                $time_slot = $slot->format('H:i');

                $slotJadwalData = [
                    'id_jadwal' => $vars['id_jadwal'],
                    'time_slot' => date("H:i", strtotime($time_slot))
                ];

                $save = $this->slotJadwalModel->save($slotJadwalData);
            }

            session()->setFlashdata('success', 'Berhasil meyimpan data');
            return redirect()->to('/backoffice/jadwal/' . $vars['id_user']);
        }
    }

    public function delete()
    {
        $vars = $this->request->getVar();

        $delete = $this->jadwalModel->delete($vars['id_jadwal'], true);

        if (!$delete) {
            session()->setFlashdata('failed', 'Gagal, harap coba lagi');
            return redirect()->to('/backoffice/jadwal/' . $vars['id_user'])->withInput();
        } else {
            $deleteSlot = $this->slotJadwalModel->where('id_jadwal', $vars['id_jadwal'])->delete(null, true);

            session()->setFlashdata('success', 'Berhasil meyimpan data');
            return redirect()->to('/backoffice/jadwal/' . $vars['id_user']);
        }
    }
}
